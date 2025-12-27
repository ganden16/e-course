<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MentorRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'specialization' => 'required|string|max:255',
            'experience' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'students_taught' => 'nullable|integer|min:0',
            'email' => 'required|email|max:255|unique:mentors,email',
            'phone' => 'nullable|string|max:20',
            'is_active' => 'boolean',
        ];

        // For update, make email unique check ignore current mentor
        if (request()->method() === 'PUT' || request()->method() === 'PATCH') {
            $mentorId = request()->route('mentor')->id;
            $rules['email'] = 'required|email|max:255|unique:mentors,email,' . $mentorId;
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
            'name.required' => 'Nama mentor wajib diisi',
            'name.max' => 'Nama mentor maksimal 255 karakter',
            'bio.string' => 'Bio harus berupa teks',
            'image.image' => 'File yang diupload harus berupa gambar',
            'image.mimes' => 'Gambar harus berformat jpeg, png, jpg, atau gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'specialization.required' => 'Spesialisasi wajib diisi',
            'specialization.max' => 'Spesialisasi maksimal 255 karakter',
            'experience.string' => 'Pengalaman harus berupa teks',
            'experience.max' => 'Pengalaman maksimal 255 karakter',
            'rating.numeric' => 'Rating harus berupa angka',
            'rating.min' => 'Rating tidak boleh kurang dari 0',
            'rating.max' => 'Rating tidak boleh lebih dari 5',
            'students_taught.integer' => 'Jumlah orang harus berupa angka',
            'students_taught.min' => 'Jumlah orang tidak boleh kurang dari 0',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email maksimal 255 karakter',
            'email.unique' => 'Email sudah digunakan',
            'phone.string' => 'Nomor telepon harus berupa teks',
            'phone.max' => 'Nomor telepon maksimal 20 karakter',
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
            'name' => 'Nama',
            'bio' => 'Bio',
            'image' => 'Gambar',
            'specialization' => 'Spesialisasi',
            'experience' => 'Pengalaman',
            'rating' => 'Rating',
            'students_taught' => 'Jumlah Orang',
            'email' => 'Email',
            'phone' => 'Nomor Telepon',
            'is_active' => 'Status Aktif',
        ];
    }
}
