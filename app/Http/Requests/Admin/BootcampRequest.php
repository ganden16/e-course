<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BootcampRequest extends FormRequest
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
        $rules = [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0|gt:price',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'students' => 'nullable|integer|min:0',
            'duration' => 'required|string|max:100',
            'level' => 'required|in:beginner,intermediate,advanced',
            'schedule' => 'required|string|max:255',
            'start_date' => 'nullable|date|after_or_equal:today',
            'description' => 'required|string',
            'features' => 'nullable|string',
            'curriculum' => 'nullable|string',
            'learning_outcomes' => 'nullable|string',
            'career_support' => 'nullable|string',
            'requirements' => 'nullable|string',
            'is_active' => 'boolean',
            'mentors' => 'nullable|array',
            'mentors.*' => 'exists:mentors,id',
        ];

        // For update, make image optional if already exists
        if (request()->method() === 'PUT' || request()->method() === 'PATCH') {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            // For create, image is required
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Judul bootcamp wajib diisi',
            'title.max' => 'Judul bootcamp maksimal 255 karakter',
            'category.required' => 'Kategori bootcamp wajib diisi',
            'price.required' => 'Harga bootcamp wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'price.min' => 'Harga tidak boleh kurang dari 0',
            'original_price.gt' => 'Harga asli harus lebih besar dari harga diskon',
            'image.required' => 'Gambar bootcamp wajib diupload',
            'image.image' => 'File yang diupload harus berupa gambar',
            'image.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'duration.required' => 'Durasi bootcamp wajib diisi',
            'level.required' => 'Level bootcamp wajib dipilih',
            'level.in' => 'Level harus salah satu dari: beginner, intermediate, advanced',
            'schedule.required' => 'Jadwal bootcamp wajib diisi',
            'start_date.after_or_equal' => 'Tanggal mulai tidak boleh kurang dari hari ini',
            'description.required' => 'Deskripsi bootcamp wajib diisi',
            'mentors.*.exists' => 'Mentor yang dipilih tidak valid',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'Judul',
            'category_id' => 'Kategori',
            'price' => 'Harga',
            'original_price' => 'Harga Asli',
            'image' => 'Gambar',
            'rating' => 'Rating',
            'students' => 'Jumlah Siswa',
            'duration' => 'Durasi',
            'level' => 'Level',
            'schedule' => 'Jadwal',
            'start_date' => 'Tanggal Mulai',
            'description' => 'Deskripsi',
            'features' => 'Fitur',
            'curriculum' => 'Kurikulum',
            'learning_outcomes' => 'Hasil Pembelajaran',
            'career_support' => 'Dukungan Karir',
            'requirements' => 'Persyaratan',
            'is_active' => 'Status Aktif',
            'mentors' => 'Mentor',
        ];
    }
}
