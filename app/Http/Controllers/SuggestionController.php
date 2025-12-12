<?php

namespace App\Http\Controllers;

use App\Services\MasterService;
use App\Http\Requests\IndexRequest;
use App\Services\SuggestionService;
use App\Http\Requests\MasterDepartmentRequest;

class SuggestionController extends Controller
{
    public function index(IndexRequest $request, SuggestionService $service, MasterDepartmentRequest $masterRequest, MasterService $masterService)
    {
        $validated = $request->validated();
        $suggestions = $service->index($validated);

        $validatedDepartment = $masterRequest->validated();
        $departments = $masterService->list_master_department($validatedDepartment);

        return view('suggestions.index', compact('suggestions', 'departments'));
    }
}
