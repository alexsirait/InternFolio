<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Department;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use App\Http\Requests\IndexRequest;
use App\Http\Controllers\Controller;
use App\Services\SuggestionService;
use Illuminate\Support\Facades\Cache;

class SuggestionController extends Controller
{
    public function dashboard(SuggestionService $service)
    {
        $suggestions = $service->dashboard();

        if ($suggestions->isEmpty()) {
            return response()->error('Data tidak ditemukan', 404);
        }

        return response()->success($suggestions, 'Berhasil mengambil data');
    }

    public function index(IndexRequest $request, SuggestionService $service)
    {
        $validated = $request->validated();
        $suggestions = $service->index($validated);

        if ($suggestions->isEmpty()) {
            return response()->error('Data tidak ditemukan', 404);
        }

        // 7. Response
        return response()->success($suggestions, 'Berhasil mengambil data');
    }

    public function show(Suggestion $suggestion, SuggestionService $service)
    {
        $cachedSuggestion = $service->show($suggestion);

        $cachedSuggestion->makeHidden([
            'suggestion_id',
            'suggestion_uuid',
            'user_id',
            'category_id',
        ]);

        return response()->success($cachedSuggestion, 'Berhasil mengambil detail data');
    }
}
