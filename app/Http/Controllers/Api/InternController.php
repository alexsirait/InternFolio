<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Http\Requests\Intern\IndexRequest;

class InternController extends Controller
{
    public function dashboard()
    {
        $data = [
            'user_uuid',
            'user_id',
            'user_name',
            'position',
            'user_image',
            'join_date',
            'end_date',
            'school',
            'major',
            'linkedin_url',
            'instagram_url',
        ];

        $users = User::query()
            ->where('is_admin', 0)
            ->limit(3)
            ->orderByDesc('user_id')
            ->with(['rating' => function ($query) {
                $query->select('user_id', 'rating_range');
            }])
            ->get($data);

        if ($users->isEmpty()) {
            return response()->error('Data tidak ditemukan', 404);
        }

        return response()->success($users, 'Berhasil mengambil data');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $validated = $request->validated();

        $data = [
            'user_uuid',
            'user_id',
            'user_name',
            'position',
            'user_image',
            'join_date',
            'end_date',
            'school',
            'major',
            'linkedin_url',
            'instagram_url',
        ];

        $query = User::query()
            ->where('is_admin', 0)
            ->select($data)
            ->with(['rating' => function ($query) {
                $query->select('user_id', 'rating_range');
            }])
            ->orderByDesc('user_id');

        $departmentId = null;

        if (isset($validated['department_uuid'])) {
            $uuid = $validated['department_uuid'];

            $department = Department::where('department_uuid', $uuid)->first(['department_id']);

            if ($department) {
                $departmentId = $department->department_id;
            } else {
                return response()->error('Department tidak ditemukan', 404);
            }
        }

        $query
            ->filterByDepartment($departmentId)
            ->search($validated['search'] ?? null);

        $perPage = $validated['per_page'] ?? 10;

        $users = $query->paginate($perPage);

        return response()->success($users, 'Berhasil mengambil data');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->loadCount(['projects', 'suggestions']);

        $user->load([
            'department' => function ($query) {
                $query->select('department_id', 'department_name');
            },
            'rating' => function ($query) {
                $query->select('user_id', 'rating_range');
            },
            'projects' => function ($query) {
                $query->select('user_id', 'category_id', 'project_uuid', 'project_title', 'project_description')
                    ->with(['category' => function ($query) {
                        $query->select('category_id', 'category_name', 'bg_color', 'txt_color');
                    }])
                    ->latest()
                    ->limit(3);
            },
            'suggestions' => function ($query) {
                $query->select('user_id', 'category_id', 'suggestion_uuid', 'suggestion_title')
                    ->with(['category' => function ($query) {
                        $query->select('category_id', 'category_name', 'bg_color', 'txt_color');
                    }])
                    ->latest()
                    ->limit(3);
            },
        ]);

        $joinDate = Carbon::parse($user->join_date);
        $endDate = Carbon::parse($user->end_date);

        // Hitung total hari
        $totalDays = $joinDate->diffInDays($endDate);

        // Rata-rata hari dalam sebulan (gunakan 30.4375: 365.25 / 12)
        $durationDecimal = $totalDays / 30.4375;

        // Pembulatan ke nilai terdekat (0.5 ke atas)
        $durationRounded = round($durationDecimal);

        // Tetapkan atribut
        $user->setAttribute('duration_months', $durationRounded);

        $user->makeHidden([
            'user_id',
            'user_uuid',
            'email',
            'deleted_at',
            'department_uuid',
        ]);

        return response()->success($user, 'Berhasil mengambil detail data');
    }
}
