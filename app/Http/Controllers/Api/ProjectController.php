<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\IndexRequest;
use App\Http\Controllers\Controller;
use App\Services\ProjectService;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
{
    public function dashboard(ProjectService $service)
    {
        $projects = $service->dashboard();

        if ($projects->isEmpty()) {
            return response()->error('Data tidak ditemukan', 404);
        }

        return response()->success($projects, 'Berhasil mengambil data');
    }

    public function index(IndexRequest $request, ProjectService $service)
    {
        $validated = $request->validated();
        $projects = $service->index($validated);

        if ($projects->isEmpty()) {
            return response()->error('Data tidak ditemukan', 404);
        }

        return response()->success($projects, 'Berhasil mengambil data');
    }

    public function show(Project $project, ProjectService $service)
    {
        $cachedProject = $service->show($project);

        $cachedProject->makeHidden([
            'project_id',
            'project_uuid',
            'user_id',
            'category_id',
        ]);

        return response()->success($cachedProject, 'Berhasil mengambil detail data');
    }
}
