<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Department;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class SuggestionService
{
    public function dashboard()
    {
        $data = [
            'suggestion_uuid',
            'user_id',
            'category_id',
            'suggestion_title',
            'created_at',
        ];

        // Key Redis
        $cacheKey = 'suggestion_dashboard';
        $ttl = 60 * 60;

        return Cache::remember($cacheKey, $ttl, function () use ($data) {
            return Suggestion::query()
                ->limit(4)
                ->latest()
                ->with(['user' => function ($query) {
                    $query->select('user_id', 'user_name', 'user_badge', 'user_image');
                }])
                ->with(['category' => function ($query) {
                    $query->select('category_id', 'category_name', 'bg_color', 'txt_color');
                }])
                ->get($data);
        });
    }

    public function index(array $validated)
    {
        $page = $validated['page'] ?? 1;
        $perPage = $validated['per_page'] ?? 10;
        $search = $validated['search'] ?? null;

        LengthAwarePaginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $departmentId = null;
        if (isset($validated['department_uuid'])) {
            $department = Department::where('department_uuid', $validated['department_uuid'])->first(['department_id']);
            if (!$department) {
                return response()->error('Department tidak ditemukan', 404);
            }
            $departmentId = $department->department_id;
        }

        $categoryId = null;
        if (isset($validated['category_uuid'])) {
            $category = Category::where('category_uuid', $validated['category_uuid'])->first(['category_id']);
            if (!$category) {
                return response()->error('Category tidak ditemukan', 404);
            }
            $categoryId = $category->category_id;
        }

        $cacheKey = 'suggestion_index_' .
            'dpt' . ($departmentId ?? 'null') .
            '_cat' . ($categoryId ?? 'null') .
            '_search' . ($search ? md5($search) : 'null') .
            '_page' . $page .
            '_perpage' . $perPage;

        $ttl = 60 * 60;

        $data = [
            'suggestion_uuid',
            'user_id',
            'category_id',
            'suggestion_title',
            'created_at',
        ];

        return Cache::remember(
            $cacheKey,
            $ttl,
            function () use ($data, $departmentId, $categoryId, $search, $perPage) {

                $query = Suggestion::query()
                    ->select($data)
                    ->with(['user' => function ($query) {
                        $query->select('user_id', 'department_id', 'user_name', 'user_badge', 'user_image');
                    }])
                    ->with(['category' => function ($query) {
                        $query->select('category_id', 'category_name', 'bg_color', 'txt_color');
                    }])
                    ->latest();

                $query->filterByCategory($categoryId)
                    ->filterByDepartment($departmentId)
                    ->search($search);

                return $query->paginate($perPage);
            }
        );
    }

    public function show(Suggestion $suggestion)
    {
        $cacheKey = 'suggestion_detail_' . $suggestion->suggestion_uuid;
        $ttl = 30 * 60;

        return Cache::remember($cacheKey, $ttl, function () use ($suggestion) {
            $suggestion->load([
                'category' => function ($query) {
                    $query->select('category_id', 'category_name', 'bg_color', 'txt_color');
                },
                'user' => function ($query) {
                    $query->select('user_id', 'department_id', 'user_name', 'user_badge', 'user_image')
                        ->with(['department' => function ($query) {
                            $query->select('department_id', 'department_name', 'department_code');
                        }]);
                },
            ]);

            $currentCategoryId = $suggestion->category_id;
            $currentSuggestionId = $suggestion->suggestion_id;

            $relatedSuggestions = Suggestion::query()
                ->select('user_id', 'category_id', 'suggestion_uuid', 'suggestion_title')
                ->where('category_id', $currentCategoryId)
                ->where('suggestion_id', '!=', $currentSuggestionId)
                ->with([
                    'category' => function ($query) {
                        $query->select('category_id', 'category_name', 'bg_color', 'txt_color');
                    },
                    'user' => function ($query) {
                        $query->select('user_id', 'user_name', 'user_badge', 'user_image');
                    },
                ])
                ->latest()
                ->limit(3)
                ->get();

            $suggestion->setAttribute('related_suggestions', $relatedSuggestions);

            return $suggestion;
        });
    }
}
