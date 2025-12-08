<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterCategoryRequest;
use App\Http\Requests\MasterDepartmentRequest;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MasterController extends Controller
{
    public function list_master_department(MasterDepartmentRequest $request)
    {
        $validated = $request->validated();
        $search = $validated['search'] ?? null;

        // Key Redis
        $cacheKey = 'master_department_search_' . ($search ? md5($search) : 'all');
        $expirationInMinutes = 60;

        $selectFields = [
            'department_uuid',
            'department_code',
            'department_name',
        ];

        $data = Cache::remember($cacheKey, $expirationInMinutes * 60, function () use ($search, $selectFields) {
            return Department::query()
                ->search($search)
                ->get($selectFields);
        });

        if ($data->isEmpty()) {
            return response()->error('Data kosong', 404);
        }

        return response()->success($data, 'Berhasil mengambil data');
    }

    public function list_master_category(MasterCategoryRequest $request)
    {
        $validated = $request->validated();
        $search = $validated['search'] ?? null;
        $type = $validated['type'];

        // Key Redis
        $cacheKey = 'master_category_type_' . $type . '_search_' . ($search ? md5($search) : 'all');
        $expirationInMinutes = 60;

        $selectFields = [
            'category_uuid',
            'category_name',
        ];

        $data = Cache::remember($cacheKey, $expirationInMinutes * 60, function () use ($search, $type, $selectFields) {
            return Category::query()
                ->where('category_type', $type)
                ->search($search)
                ->get($selectFields);
        });

        if ($data->isEmpty()) {
            return response()->error('Data kategori ' . $type . ' tidak ditemukan', 404);
        }

        return response()->success($data, 'Berhasil mengambil data kategori ' . $type);
    }
}
