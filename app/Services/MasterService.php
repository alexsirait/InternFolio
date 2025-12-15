<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class MasterService
{
    public function list_master_department(array $validated)
    {
        $search = $validated['search'] ?? null;

        // Key Redis
        $cacheKey = 'master_department_search_' . ($search ? md5($search) : 'all');
        $expirationInMinutes = 60;

        $selectFields = [
            'department_uuid',
            'department_code',
            'department_name',
        ];

        return Cache::remember($cacheKey, $expirationInMinutes * 60, function () use ($search, $selectFields) {
            return Department::query()
                ->search($search)
                ->get($selectFields);
        });
    }

    public function list_master_category(array $validated)
    {
        $search = $validated['search'] ?? null;
        $type = $validated['type'];

        // Key Redis
        $cacheKey = 'master_category_type_' . $type . '_search_' . ($search ? md5($search) : 'all');
        $expirationInMinutes = 60;

        $selectFields = [
            'category_uuid',
            'category_name',
        ];

        return Cache::remember($cacheKey, $expirationInMinutes * 60, function () use ($search, $type, $selectFields) {
            return Category::query()
                ->where('category_type', $type)
                ->search($search)
                ->get($selectFields);
        });
    }
}
