<?php

namespace App\Http\Controllers;

use App\Services\MasterService;
use App\Http\Requests\IndexRequest;
use App\Services\SuggestionService;
// use App\Http\Requests\MasterCategoryRequest;
use App\Http\Requests\MasterDepartmentRequest;
use App\Models\Suggestion;
use App\Models\ShortLink;

class SuggestionController extends Controller
{
    public function index(IndexRequest $request, SuggestionService $service, MasterDepartmentRequest $masterRequest, MasterService $masterService)
    {
        $validated = $request->validated();
        $suggestions = $service->index($validated);

        $validatedDepartment = $masterRequest->validated();
        $departments = $masterService->list_master_department($validatedDepartment);

        $categories = $masterService->list_master_category([
            'type'   => 'Suggestion',
            'search' => $validated['search'] ?? null,
        ]);

        return view('suggestions.index', compact('suggestions', 'departments', 'categories'));
    }

    public function show(SuggestionService $service, Suggestion $suggestion)
    {
        $suggestionData = $service->show($suggestion);
        
        // Generate or get existing shortlink
        $shortLink = ShortLink::createForModel(
            $suggestion,
            route('suggestion.show', $suggestion->suggestion_uuid)
        );

        return view('suggestions.show', [
            'suggestion' => $suggestionData,
            'shortLink' => $shortLink
        ]);
    }
}
