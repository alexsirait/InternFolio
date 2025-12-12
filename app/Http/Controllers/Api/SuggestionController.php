<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Department;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use App\Http\Requests\IndexRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SuggestionController extends Controller
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
        $expirationInMinutes = 60;

        $suggestions = Cache::remember($cacheKey, $expirationInMinutes * 60, function () use ($data) {
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

        if ($suggestions->isEmpty()) {
            return response()->error('Data tidak ditemukan', 404);
        }

        return response()->success($suggestions, 'Berhasil mengambil data');
    }

    public function index(IndexRequest $request)
    {
        $validated = $request->validated();
        $perPage = $validated['per_page'] ?? 10;
        $search = $validated['search'] ?? null;
        $page = $validated['page'] ?? 1;

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

        $expirationInMinutes = 60;

        $data = [
            'suggestion_uuid',
            'user_id',
            'category_id',
            'suggestion_title',
            'created_at',
        ];

        $suggestions = Cache::remember(
            $cacheKey,
            $expirationInMinutes * 60,
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

        if ($suggestions->isEmpty()) {
            return response()->error('Data tidak ditemukan', 404);
        }

        // 7. Response
        return response()->success($suggestions, 'Berhasil mengambil data');
    }

    public function show(Suggestion $suggestion)
    {
        $cacheKey = 'suggestion_detail_' . $suggestion->suggestion_uuid;
        $expirationInMinutes = 30;

        $cachedSuggestion = Cache::remember($cacheKey, $expirationInMinutes * 60, function () use ($suggestion) {
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


        $cachedSuggestion->makeHidden([
            'suggestion_id',
            'suggestion_uuid',
            'user_id',
            'category_id',
        ]);

        return response()->success($cachedSuggestion, 'Berhasil mengambil detail data');
    }
}
