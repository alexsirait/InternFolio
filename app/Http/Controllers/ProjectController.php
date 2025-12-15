<?php

namespace App\Http\Controllers;

use App\Services\MasterService;
use App\Services\ProjectService;
use App\Http\Requests\IndexRequest;
// use App\Http\Requests\MasterCategoryRequest;
use App\Http\Requests\MasterDepartmentRequest;

class ProjectController extends Controller
{
    public function index(
        IndexRequest $request,
        ProjectService $service,
        MasterDepartmentRequest $masterDepartmentRequest,
        MasterService $masterService,
        // MasterCategoryRequest $masterCategoryRequest,
    ) {
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
}
