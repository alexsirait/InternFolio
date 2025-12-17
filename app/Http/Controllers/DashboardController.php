<?php

namespace App\Http\Controllers;

use App\Services\InternService;
use App\Services\ProjectService;
use App\Services\SuggestionService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(
        InternService $internService,
        ProjectService $projectService,
        SuggestionService $suggestionService,
    ) {
        // Ambil dashboard intern
        $interns = $internService->dashboard();
        // Ambil dashboard project
        $projects = $projectService->dashboard();
        // Ambil dashboard suggestion
        $suggestions = $suggestionService->dashboard();

        // Count untuk statistik
        $totalInterns = $internService->count();
        $totalProjects = $projectService->count();
        $totalSuggestions = $suggestionService->count();

        return view('home', [
            'interns'           => $interns,
            'projects'          => $projects,
            'suggestions'       => $suggestions,
            'totalInterns'      => $totalInterns,
            'totalProjects'     => $totalProjects,
            'totalSuggestions'  => $totalSuggestions,
        ]);
    }
}
