<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\IndexRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
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
        $expirationInMinutes = 60;

        $projects = Cache::remember($cacheKey, $expirationInMinutes * 60, function () use ($data) {
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

        if ($projects->isEmpty()) {
            return response()->error('Data tidak ditemukan', 404);
        }

        return response()->success($projects, 'Berhasil mengambil data');
    }

    public function index(IndexRequest $request)
    {
        $validated = $request->validated();
        $perPage = $validated['per_page'] ?? 10;
        $search = $validated['search'] ?? null;
        $page = $validated['page'] ?? 1;

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

        $cacheKey = 'project_index_' .
            'dpt' . ($departmentId ?? 'null') .
            '_cat' . ($categoryId ?? 'null') .
            '_search' . ($search ? md5($search) : 'null') .
            '_page' . $page .
            '_perpage' . $perPage;

        $expirationInMinutes = 60;

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

        $projects = Cache::remember(
            $cacheKey,
            $expirationInMinutes * 60,
            function () use ($data, $departmentId, $categoryId, $search, $perPage) {

                $query = Project::query()
                    ->select($data)
                    ->with(['user' => function ($query) {
                        $query->select('user_id', 'department_id', 'user_name', 'user_badge', 'user_image');
                    }])
                    ->with(['category' => function ($query) {
                        $query->select('category_id', 'category_name', 'bg_color', 'txt_color');
                    }])
                    ->with(['photos' => function ($query) {
                        $query->select('project_id', 'photo_url')->oldest()->limit(1);
                    }])
                    ->latest();

                $query->filterByCategory($categoryId)
                    ->filterByDepartment($departmentId)
                    ->search($search);

                return $query->paginate($perPage);
            }
        );

        if ($projects->isEmpty()) {
            return response()->error('Data tidak ditemukan', 404);
        }

        return response()->success($projects, 'Berhasil mengambil data');
    }

    public function show(Project $project)
    {
        $cacheKey = 'project_detail_' . $project->project_uuid;
        $expirationInMinutes = 30;

        $cachedProject = Cache::remember($cacheKey, $expirationInMinutes * 60, function () use ($project) {
            $project->loadCount('photos');

            $project->load([
                'photos' => function ($query) {
                    $query->select('project_id', 'photo_url');
                },
                'category' => function ($query) {
                    $query->select('category_id', 'category_name', 'bg_color', 'txt_color');
                },
                'user' => function ($query) {
                    $query->select('user_id', 'department_id', 'user_name', 'user_badge', 'user_image')
                        ->with(['department' => function ($query) {
                            $query->select('department_id', 'department_name', 'department_code');
                        }]);
                },
            ]);

            return $project;
        });


        $cachedProject->makeHidden([
            'project_id',
            'project_uuid',
            'user_id',
            'category_id',
        ]);

        return response()->success($cachedProject, 'Berhasil mengambil detail data');
    }
}
