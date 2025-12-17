<?php

namespace App\Http\Controllers;

use App\Services\MasterService;
use App\Services\ProjectService;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\MasterDepartmentRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(IndexRequest $request, ProjectService $service, MasterDepartmentRequest $masterDepartmentRequest, MasterService $masterService)
    {
        $validated = $request->validated();
        $projects = $service->index($validated);

        $validatedDepartment = $masterDepartmentRequest->validated();
        $departments = $masterService->list_master_department($validatedDepartment);

        $categories = $masterService->list_master_category([
            'type'   => 'Project',
            'search' => $validated['search'] ?? null,
        ]);

        return view('projects.index', compact('projects', 'departments', 'categories'));
    }

    public function show(ProjectService $service, Project $project)
    {
        $project = $service->show($project);

        return view('projects.show', compact('project'));
    }
}
