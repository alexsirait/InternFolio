<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:255',
            'department_uuid' => 'nullable|string|max:36',
            'category_uuid' => 'nullable|string|max:36',
            'per_page' => 'nullable|integer|min:1|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'department_uuid.max' => 'Department UUID tidak valid, maksimal :max karakter.',
            'category_uuid.max' => 'Category UUID tidak valid, maksimal :max karakter.',
            'per_page.max' => 'Nilai per halaman maksimal harus 100.',
            'per_page.integer' => 'Nilai per halaman harus angka',
            'search.max' => 'Search tidak boleh lebih dari :max',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors()
        ], 422));
    }
}
