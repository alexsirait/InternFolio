<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Department;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use App\Http\Requests\IndexRequest;
use App\Http\Controllers\Controller;

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

        $suggestions = Suggestion::query()
            ->limit(3)
            ->latest()
            ->with(['user' => function ($query) {
                $query->select('user_id', 'user_name', 'user_badge', 'user_image');
            }])
            ->with(['category' => function ($query) {
                $query->select('category_id', 'category_name', 'bg_color', 'txt_color');
            }])
            ->get($data);

        if ($suggestions->isEmpty()) {
            return response()->error('Data tidak ditemukan', 404);
        }

        return response()->success($suggestions, 'Berhasil mengambil data');
    }

    public function index(IndexRequest $request)
    {
        $validated = $request->validated();

        $data = [
            'suggestion_uuid',
            'user_id',
            'category_id',
            'suggestion_title',
            'created_at',
        ];

        $query = Suggestion::query()
            ->select($data)
            ->with(['user' => function ($query) {
                $query->select('user_id', 'department_id', 'user_name', 'user_badge', 'user_image');
            }])
            ->with(['category' => function ($query) {
                $query->select('category_id', 'category_name', 'bg_color', 'txt_color');
            }])
            ->latest();

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

        $categoryId = null;

        if (isset($validated['category_uuid'])) {
            $uuid = $validated['category_uuid'];

            $category = Category::where('category_uuid', $uuid)->first(['category_id']);

            if ($category) {
                $categoryId = $category->category_id;
            } else {
                return response()->error('category tidak ditemukan', 404);
            }
        }

        $query
            ->filterByCategory($categoryId)
            ->filterByDepartment($departmentId)
            ->search($validated['search'] ?? null);

        $perPage = $validated['per_page'] ?? 10;

        $suggestions = $query->paginate($perPage);

        return response()->success($suggestions, 'Berhasil mengambil data');
    }

    public function show(Suggestion $suggestion)
    {
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

        $suggestion->makeHidden([
            'suggestion_id',
            'suggestion_uuid',
            'user_id',
            'category_id',
        ]);

        return response()->success($suggestion, 'Berhasil mengambil detail data');
    }
}
