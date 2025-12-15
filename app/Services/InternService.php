<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Cache;

class InternService
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

        // Key Redis
        $cacheKey = 'intern_dashboard';
        $ttl = 60 * 60;

        return Cache::remember($cacheKey, $ttl, function () use ($data) {
            return User::query()
                ->where('is_admin', 0)
                ->limit(3)
                ->latest()
                ->with(['rating' => function ($query) {
                    $query->select('user_id', 'rating_range');
                }])
                ->get($data);
        });
    }

    public function index(array $validated)
    {
        $page = $validated['page'] ?? 1;
        $perPage = $validated['per_page'] ?? 10;
        $search = $validated['search'] ?? null;
        $sort = $validated['sort'] ?? 'latest';

        $departmentId = null;
        if (isset($validated['department_uuid'])) {
            $department = Department::where('department_uuid', $validated['department_uuid'])->first(['department_id']);
            if (!$department) {
                return response()->error('Department tidak ditemukan', 404);
            }
            $departmentId = $department->department_id;
        }

        $cacheKey = 'intern_index_' .
            ($departmentId ? 'dept_' . $departmentId : 'no_dept') .
            '_search_' . ($search ? md5($search) : 'no_search') .
            '_sort_' . $sort .
            '_page_' . $page .
            '_perpage_' . $perPage;

        $ttl = 60 * 60;
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

        return Cache::remember($cacheKey, $ttl, function () use ($data, $departmentId, $page, $search, $perPage, $sort) {
            $query = User::query()
                ->where('is_admin', 0)
                ->select($data)
                ->with(['rating:user_id,rating_range']);

            $query->filterByDepartment($departmentId)
                ->search($search);

            match ($sort) {
                'rating' => $query->leftJoin('ratings', 'ratings.user_id', '=', 'users.user_id')
                    ->orderByDesc('ratings.rating_range')
                    ->select('users.*'),

                'oldest' => $query->oldest(),

                default  => $query->latest(),
            };

            return $query->paginate($perPage, ['*'], 'page', $page);
        });
    }

    public function show(User $user)
    {
        $cacheKey = 'intern_detail_' . $user->user_uuid;
        $ttl = 30 * 60;

        return Cache::remember($cacheKey, $ttl, function () use ($user) {
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

            return $user;
        });
    }
}
