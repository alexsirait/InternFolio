<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\InternController as InternApiController;

class InternController extends Controller
{
    // public function index(InternApiController $internApi)
    // {
    //     $interns = $internApi->index()->getData();

    //     return view('intern.index', [
    //         'interns'        => $interns->data ?? [],
    //     ]);
    // }
}
