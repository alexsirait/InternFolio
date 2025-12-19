<?php

namespace App\Http\Controllers;

use App\Services\MasterService;
use App\Services\ProjectService;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\MasterDepartmentRequest;
use App\Models\Project;
use App\Models\ShortLink;

class ProjectController extends Controller
{
    public function index(IndexRequest $request, ProjectService $service, MasterDepartmentRequest $masterDepartmentRequest, MasterService $masterService)
    {
        $validated = $request->validated();
        $projects = $service->index($validated);

        // Load all departments and categories for dropdown (ignore search parameter)
        $departments = $masterService->list_master_department([]);
        $categories = $masterService->list_master_category([
            'type' => 'Project',
        ]);

        return view('projects.index', compact('projects', 'departments', 'categories'));
    }

    public function show(ProjectService $service, Project $project)
    {
        $projectData = $service->show($project);

        // Generate or get existing shortlink
        $shortLink = ShortLink::createForModel(
            $project,
            route('project.show', $project->project_uuid)
        );

        return view('projects.show', [
            'project' => $projectData,
            'shortLink' => $shortLink
        ]);
    }
}
