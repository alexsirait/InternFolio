<?php

namespace App\Http\Controllers;

use App\Services\MasterService;
use App\Services\ProjectService;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\MasterDepartmentRequest;

class ProjectController extends Controller
{
    public function index(IndexRequest $request, ProjectService $service, MasterDepartmentRequest $masterRequest, MasterService $masterService)
    {
        $validated = $request->validated();
        $projects = $service->index($validated);

        $validatedDepartment = $masterRequest->validated();
        $departments = $masterService->list_master_department($validatedDepartment);

        return view('projects.index', compact('projects', 'departments'));
    }
}
