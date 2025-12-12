<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\InternController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SuggestionController;

class DashboardController extends Controller
{
    public function index(
        InternController $internApi,
        ProjectController $projectApi,
        SuggestionController $suggestionApi
    ) {
        // Ambil dashboard intern
        $interns = $internApi->dashboard()->getData();

        // Ambil dashboard project
        $projects = $projectApi->dashboard()->getData();

        // Ambil dashboard suggestion
        $suggestions = $suggestionApi->dashboard()->getData();

        return view('home', [
            'interns'        => $interns->data ?? [],
            'projects'     => $projects->data ?? [],
            'suggestions'     => $suggestions->data ?? [],
        ]);
    }
}
