<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterCategoryRequest;
use App\Http\Requests\MasterDepartmentRequest;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function list_master_department(MasterDepartmentRequest $request)
    {
        $validated = $request->validated();

        $data = Department::query()
            ->search($validated['search'] ?? null)
            ->get([
                'department_uuid',
                'department_code',
                'department_name',
            ]);

        if ($data->isEmpty()) {
            return response()->error('Data kosong', 404);
        }

        return response()->success($data, 'Berhasil mengambil data');
    }

    public function list_master_category(MasterCategoryRequest $request)
    {
        $validated = $request->validated();

        $type = $validated['type'];

        $data = Category::query()
            ->where('category_type', $type)
            ->search($validated['search'] ?? null)
            ->get([
                'category_uuid',
                'category_name',
            ]);

        if ($data->isEmpty()) {
            return response()->error('Data kategori ' . $type . ' tidak ditemukan', 404);
        }

        return response()->success($data, 'Berhasil mengambil data kategori ' . $type);
    }
}
