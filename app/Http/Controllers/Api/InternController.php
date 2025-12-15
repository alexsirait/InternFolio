<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Services\InternService;
use App\Http\Requests\IndexRequest;
use App\Http\Controllers\Controller;

class InternController extends Controller
{
    public function dashboard(InternService $service)
    {
        $users = $service->dashboard();

        if ($users->isEmpty()) {
            return response()->error('Data tidak ditemukan', 404);
        }

        return response()->success($users, 'Berhasil mengambil data');
    }

    public function index(IndexRequest $request, InternService $service)
    {
        $validated = $request->validated();
        $users = $service->index($validated);

        if ($users->isEmpty()) {
            return response()->error('Data tidak ditemukan', 404);
        }

        return response()->success($users, 'Berhasil mengambil data');
    }

    public function show(User $user, InternService $service)
    {
        $cachedUser = $service->show($user);

        $cachedUser->makeHidden([
            'user_id',
            'user_uuid',
            'email',
            'deleted_at',
            'department_uuid',
        ]);

        return response()->success($cachedUser, 'Berhasil mengambil detail data');
    }
}
