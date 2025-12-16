<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Project;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Support\Facades\Cache;

class ProjectService
{
    public function dashboard()
    {
        $data = [
            'project_uuid',
            'project_id',
            'user_id',
            'category_id',
            'project_title',
            'project_description',
            'project_technology',
            'project_duration',
        ];

        // Key Redis
        $cacheKey = 'project_dashboard';
        $ttl = 60 * 60;

        return Cache::remember($cacheKey, $ttl, function () use ($data) {
            return Project::query()
                ->limit(3)
                ->latest()
                ->with(['user' => function ($query) {
                    $query->select('user_id', 'user_name', 'user_badge', 'user_image');
                }])
                ->with(['category' => function ($query) {
                    $query->select('category_id', 'category_name', 'bg_color', 'txt_color');
                }])
                ->with(['photos' => function ($query) {
                    $query->select('project_id', 'photo_url')
                        ->oldest()
                        ->limit(1);
                }])
                ->get($data);
        });
    }

    public function index(array $validated)
    {
        $page = $validated['page'] ?? 1;
        $perPage = $validated['per_page'] ?? 10;
        $search = $validated['search'] ?? null;
        $sort = $validated['sort'] ?? 'latest';

        $departmentId = null;
        if (isset($validated['department_uuid'])) {
            $department = Department::where('department_uuid', $validated['department_uuid'])->first(['department_id']);
            if (!$department) {
                return response()->error('Department tidak ditemukan', 404);
            }
            $departmentId = $department->department_id;
        }

        $categoryId = null;
        if (isset($validated['category_uuid'])) {
            $category = Category::where('category_uuid', $validated['category_uuid'])->first(['category_id']);
            if (!$category) {
                return response()->error('Category tidak ditemukan', 404);
            }
            $categoryId = $category->category_id;
        }

        $cacheKey = 'project_index_' . md5(json_encode([
            'department' => $departmentId,
            'category'   => $categoryId,
            'search'     => $search,
            'sort'       => $sort ?? 'default',
            'page'       => (int) $page,
            'perPage'    => (int) $perPage,
        ]));

        $tll = 60 * 60;

        $data = [
            'project_uuid',
            'project_id',
            'user_id',
            'category_id',
            'project_title',
            'project_description',
            'project_technology',
            'project_duration',
        ];

        return Cache::remember(
            $cacheKey,
            $tll,
            function () use ($data, $departmentId, $categoryId, $search, $perPage, $page, $sort) {

                $query = Project::query()
                    ->select($data)
                    ->with([
                        'user:user_id,department_id,user_name,user_badge,user_image',
                        'category:category_id,category_name,bg_color,txt_color',
                    ])
                    ->with(['photos' => function ($query) {
                        $query->select('project_id', 'photo_url')->oldest()->limit(1);
                    }]);

                $query->filterByCategory($categoryId)
                    ->filterByDepartment($departmentId)
                    ->search($search);

                match ($sort) {
                    'oldest' => $query->oldest(),

                    default  => $query->latest(),
                };

                return $query->paginate($perPage, ['*'], 'page', $page);
            }
        );
    }

    public function show(Project $project)
    {
        $cacheKey = 'project_detail_' . $project->project_uuid;
        $ttl = 30 * 60;

        return Cache::remember($cacheKey, $ttl, function () use ($project) {
            $project->loadCount('photos');

            $project->load([
                'photos' => function ($query) {
                    $query->select('project_id', 'photo_url');
                },
                'category' => function ($query) {
                    $query->select('category_id', 'category_name', 'bg_color', 'txt_color');
                },
                'user' => function ($query) {
                    $query->select('user_id', 'user_uuid', 'department_id', 'user_name', 'user_badge', 'user_image')
                        ->with(['department' => function ($query) {
                            $query->select('department_id', 'department_name', 'department_code');
                        }]);
                },
            ]);

            return $project;
        });
    }
}
