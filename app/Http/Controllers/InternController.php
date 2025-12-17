<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Http\Requests\MasterDepartmentRequest;
use App\Models\User;
use App\Services\InternService;
use App\Services\MasterService;

class InternController extends Controller
{
    public function index(IndexRequest $request, InternService $service, MasterDepartmentRequest $masterRequest, MasterService $masterService)
    {
        $validated = $request->validated();
        $interns = $service->index($validated);

        $validatedDepartment = $masterRequest->validated();
        $departments = $masterService->list_master_department($validatedDepartment);

        return view('interns.index', compact('interns', 'departments'));
    }

    public function show(InternService $service, User $user)
    {
        $intern = $service->show($user);

        return view('interns.show', compact('intern'));
    }
}
