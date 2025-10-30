<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\IndexRequest;
use App\Http\Controllers\Controller;

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

        $projects = Project::query()
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

        if ($projects->isEmpty()) {
            return response()->error('Data tidak ditemukan', 404);
        }

        return response()->success($projects, 'Berhasil mengambil data');
    }

    public function index(IndexRequest $request)
    {
        $validated = $request->validated();

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

        $query = Project::query()
            ->select($data)
            ->with(['user' => function ($query) {
                $query->select('user_id', 'department_id', 'user_name', 'user_badge', 'user_image');
            }])
            ->with(['category' => function ($query) {
                $query->select('category_id', 'category_name', 'bg_color', 'txt_color');
            }])
            ->with(['photos' => function ($query) {
                $query->select('project_id', 'photo_url')
                    ->oldest()
                    ->limit(1);
            }])
            ->latest();

        $departmentId = null;

        if (isset($validated['department_uuid'])) {
            $uuid = $validated['department_uuid'];

            $department = Department::where('department_uuid', $uuid)->first(['department_id']);

            if ($department) {
                $departmentId = $department->department_id;
            } else {
                return response()->error('Department tidak ditemukan', 404);
            }
        }

        $categoryId = null;

        if (isset($validated['category_uuid'])) {
            $uuid = $validated['category_uuid'];

            $category = Category::where('category_uuid', $uuid)->first(['category_id']);

            if ($category) {
                $categoryId = $category->category_id;
            } else {
                return response()->error('Category tidak ditemukan', 404);
            }
        }

        $query
            ->filterByCategory($categoryId)
            ->filterByDepartment($departmentId)
            ->search($validated['search'] ?? null);

        $perPage = $validated['per_page'] ?? 10;

        $projects = $query->paginate($perPage);

        return response()->success($projects, 'Berhasil mengambil data');
    }

    public function show(Project $project)
    {
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

        $project->makeHidden([
            'project_id',
            'project_uuid',
            'user_id',
            'category_id',
        ]);

        return response()->success($project, 'Berhasil mengambil detail data');
    }
}
