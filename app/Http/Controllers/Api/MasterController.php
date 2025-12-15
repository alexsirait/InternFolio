<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Services\MasterService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\MasterCategoryRequest;
use App\Http\Requests\MasterDepartmentRequest;

class MasterController extends Controller
{
    public function list_master_department(MasterDepartmentRequest $request, MasterService $service)
    {
        $validated = $request->validated();
        $data = $service->list_master_department($validated);

        if ($data->isEmpty()) {
            return response()->error('Data kosong', 404);
        }

        return response()->success($data, 'Berhasil mengambil data');
    }

    public function list_master_category(MasterCategoryRequest $request, MasterService $service)
    {
        $validated = $request->validated();
        $type = $validated['type'];
        $data = $service->list_master_category($validated);

        if ($data->isEmpty()) {
            return response()->error('Data kategori ' . $type . ' tidak ditemukan', 404);
        }

        return response()->success($data, 'Berhasil mengambil data kategori ' . $type);
    }
}
