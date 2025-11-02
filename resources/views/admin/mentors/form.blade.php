@extends('admin.layouts.app')

@section('title', isset($mentor) ? 'Edit Mentor' : 'Create New Mentor')
@section('header', isset($mentor) ? 'Edit Mentor' : 'Create New Mentor')

@php
    // Load language files for products and bootcamps
    $productData = include lang_path('id/product.php');
    $bootcampData = include lang_path('id/bootcamp.php');

    $mentors = [];

    // Extract mentors from products
    foreach ($productData['products'] as $product) {
        $mentors[] = [
            'id' => count($mentors) + 1,
            'name' => $product['instructor'],
            'email' => strtolower(str_replace(' ', '.', $product['instructor'])) . '@healthcare.com',
            'specialization' => $product['category'],
            'rating' => $product['rating'],
            'students' => $product['enrolled'],
            'courses' => 1,
            'bootcamps' => 0,
            'status' => $product['status'],
            'joined_date' => '2023-01-15',
            'avatar' => 'https://images.unsplash.com/photo-' . rand(1472099645, 1579076445) . '?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80'
        ];
    }

    // Extract mentors from bootcamps
    foreach ($bootcampData['bootcamps'] as $bootcamp) {
        if ($bootcamp['mentor'] !== 'Not Assigned') {
            $existingMentor = null;
            foreach ($mentors as $index => $mentor) {
                if ($mentor['name'] === $bootcamp['mentor']) {
                    $existingMentor = $index;
                    break;
                }
            }

            if ($existingMentor !== null) {
                $mentors[$existingMentor]['bootcamps']++;
                $mentors[$existingMentor]['students'] += $bootcamp['enrolled'];
            } else {
                $mentors[] = [
                    'id' => count($mentors) + 1,
                    'name' => $bootcamp['mentor'],
                    'email' => strtolower(str_replace(' ', '.', $bootcamp['mentor'])) . '@healthcare.com',
                    'specialization' => $bootcamp['category'],
                    'rating' => 4.5 + (rand(0, 10) / 10),
                    'students' => $bootcamp['enrolled'],
                    'courses' => 0,
                    'bootcamps' => 1,
                    'status' => $bootcamp['status'],
                    'joined_date' => '2023-01-15',
                    'avatar' => 'https://images.unsplash.com/photo-' . rand(1472099645, 1579076445) . '?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80'
                ];
            }
        }
    }

    // If editing, get the mentor data
    if (isset($mentor)) {
        $mentorData = collect($mentors)->firstWhere('id', $mentor);
    }
@endphp

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">{{ isset($mentor) ? 'Edit Mentor' : 'Tambah Mentor Baru' }}</h2>
        </div>

        <form class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Informasi Dasar</h3>
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Depan</label>
                                    <input type="text"
                                           name="first_name"
                                           value="{{ $mentorData['first_name'] ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                           placeholder="Masukkan nama depan">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Belakang</label>
                                    <input type="text"
                                           name="last_name"
                                           value="{{ $mentorData['last_name'] ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                           placeholder="Masukkan nama belakang">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email"
                                       name="email"
                                       value="{{ $mentorData['email'] ?? '' }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="Masukkan email">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                                <textarea rows="4"
                                          name="bio"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan bio mentor">{{ $mentorData['bio'] ?? '' }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Spesialisasi</label>
                                    <select name="specialization" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                                        <option value="">Pilih Spesialisasi</option>
                                        <option value="Web Development" {{ ($mentorData['specialization'] ?? '') === 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                        <option value="Data Science" {{ ($mentorData['specialization'] ?? '') === 'Data Science' ? 'selected' : '' }}>Data Science</option>
                                        <option value="Marketing" {{ ($mentorData['specialization'] ?? '') === 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                        <option value="UI/UX Design" {{ ($mentorData['specialization'] ?? '') === 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                                        <option value="active" {{ ($mentorData['status'] ?? '') === 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="inactive" {{ ($mentorData['status'] ?? '') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Bergabung</label>
                                <input type="date"
                                       name="joined_date"
                                       value="{{ $mentorData['joined_date'] ?? '' }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Experience -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Pengalaman</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pengalaman Kerja (tahun)</label>
                                <input type="number"
                                       name="experience_years"
                                       value="{{ $mentorData['experience_years'] ?? '' }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="Contoh: 10">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Perusahaan Sebelumnya</label>
                                <input type="text"
                                       name="previous_companies"
                                       value="{{ $mentorData['previous_companies'] ?? '' }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="Contoh: Google, Microsoft, Apple">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Sertifikat</label>
                                <textarea rows="3"
                                          name="certifications"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan sertifikat, satu per baris">{{ implode("\n", $mentorData['certifications'] ?? []) }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Masukkan setiap sertifikat pada baris baru</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Media Sosial</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn</label>
                                <input type="url"
                                       name="linkedin"
                                       value="{{ $mentorData['linkedin'] ?? '' }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="https://linkedin.com/in/username">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Twitter</label>
                                <input type="url"
                                       name="twitter"
                                       value="{{ $mentorData['twitter'] ?? '' }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="https://twitter.com/username">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                                <input type="url"
                                       name="website"
                                       value="{{ $mentorData['website'] ?? '' }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="https://website.com">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Profile Image -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Foto Profil</h3>
                        <div class="space-y-4">
                            <div>
                                <img class="w-full h-48 object-cover rounded-lg"
                                     src="{{ $mentorData['avatar'] ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80' }}"
                                     alt="Profile image">
                            </div>
                            <div>
                                <button type="button" class="w-full bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange">
                                    Upload Photo
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Statistik</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                <input type="number"
                                       name="rating"
                                       value="{{ $mentorData['rating'] ?? '' }}"
                                       step="0.1"
                                       min="0"
                                       max="5"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="0.0 - 5.0">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Siswa</label>
                                <input type="number"
                                       name="students"
                                       value="{{ $mentorData['students'] ?? '' }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="0">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Kursus</label>
                                <input type="number"
                                       name="courses"
                                       value="{{ $mentorData['courses'] ?? '' }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="0">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Bootcamp</label>
                                <input type="number"
                                       name="bootcamps"
                                       value="{{ $mentorData['bootcamps'] ?? '' }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="0">
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="pt-4">
                        <div class="flex flex-col space-y-3">
                            <button type="submit" class="w-full bg-orange hover:bg-orange-dark text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                {{ isset($mentor) ? 'Update Mentor' : 'Simpan Mentor' }}
                            </button>
                            <a href="/admin/mentors" class="w-full bg-white hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded-lg border border-gray-300 text-center transition-colors duration-200">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
