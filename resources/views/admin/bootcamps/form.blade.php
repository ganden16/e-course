@extends('admin.layouts.app')

@section('title', isset($bootcamp) ? 'Edit Bootcamp' : 'Create New Bootcamp')
@section('header', isset($bootcamp) ? 'Edit Bootcamp' : 'Create New Bootcamp')

@php
    // Load language file for bootcamp page
    $translations = include lang_path('id/bootcamp.php');
    $bootcamps = $translations['bootcamps'];

    // Create a simple mentors array from the bootcamps data
    $mentors = [];
    foreach ($bootcamps as $camp) {
        $mentors[] = [
            'name' => $camp['instructor'],
            'specialization' => $camp['category']
        ];
    }
    // Remove duplicates
    $mentors = array_unique($mentors, SORT_REGULAR);
    $mentors = array_values($mentors);

    // If editing, get the bootcamp data
    if (isset($bootcamp)) {
        $bootcampData = collect($bootcamps)->firstWhere('id', $bootcamp);
    }
@endphp

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">{{ isset($bootcamp) ? 'Edit Bootcamp' : 'Tambah Bootcamp Baru' }}</h2>
        </div>

        <form class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Informasi Dasar</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Judul Bootcamp</label>
                                <input type="text"
                                       name="title"
                                       value="{{ $bootcampData['title'] ?? '' }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="Masukkan judul bootcamp">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <textarea rows="4"
                                          name="description"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan deskripsi bootcamp">{{ $bootcampData['description'] ?? '' }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                    <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                                        <option value="">Pilih Kategori</option>
                                        <option value="Web Development" {{ ($bootcampData['category'] ?? '') === 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                        <option value="Data Science" {{ ($bootcampData['category'] ?? '') === 'Data Science' ? 'selected' : '' }}>Data Science</option>
                                        <option value="Design" {{ ($bootcampData['category'] ?? '') === 'Design' ? 'selected' : '' }}>Design</option>
                                        <option value="Marketing" {{ ($bootcampData['category'] ?? '') === 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                        <option value="Mobile Development" {{ ($bootcampData['category'] ?? '') === 'Mobile Development' ? 'selected' : '' }}>Mobile Development</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                                    <select name="level" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                                        <option value="">Pilih Level</option>
                                        <option value="Beginner" {{ ($bootcampData['level'] ?? '') === 'Beginner' ? 'selected' : '' }}>Pemula</option>
                                        <option value="Intermediate" {{ ($bootcampData['level'] ?? '') === 'Intermediate' ? 'selected' : '' }}>Menengah</option>
                                        <option value="Advanced" {{ ($bootcampData['level'] ?? '') === 'Advanced' ? 'selected' : '' }}>Lanjutan</option>
                                        <option value="Beginner to Advanced" {{ ($bootcampData['level'] ?? '') === 'Beginner to Advanced' ? 'selected' : '' }}>Pemula hingga Lanjutan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Durasi</label>
                                    <input type="text"
                                           name="duration"
                                           value="{{ $bootcampData['duration'] ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                           placeholder="Contoh: 12 weeks">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                                    <input type="date"
                                           name="start_date"
                                           value="{{ $bootcampData['start_date'] ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jadwal</label>
                                    <input type="text"
                                           name="schedule"
                                           value="{{ $bootcampData['schedule'] ?? '' }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                           placeholder="Contoh: Senin - Jumat, 09:00 - 17:00">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mentor</label>
                                <select name="mentor" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                                    <option value="">Pilih Mentor</option>
                                    @foreach($mentors as $mentor)
                                        <option value="{{ $mentor['name'] }}" {{ ($bootcampData['mentor'] ?? '') === $mentor['name'] ? 'selected' : '' }}>
                                            {{ $mentor['name'] }} - {{ $mentor['specialization'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Bootcamp Features -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Fitur Bootcamp</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Fitur (satu per baris)</label>
                                <textarea rows="6"
                                          name="features"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan fitur bootcamp, satu per baris">{{ implode("\n", $bootcampData['features'] ?? []) }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Masukkan setiap fitur pada baris baru</p>
                            </div>
                        </div>
                    </div>

                    <!-- Curriculum -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Kurikulum</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kurikulum (satu per baris)</label>
                                <textarea rows="6"
                                          name="curriculum"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan kurikulum, satu per baris">{{ implode("\n", $bootcampData['curriculum'] ?? []) }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Masukkan setiap topik kurikulum pada baris baru</p>
                            </div>
                        </div>
                    </div>

                    <!-- Learning Outcomes -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Hasil Pembelajaran</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Hasil pembelajaran (satu per baris)</label>
                                <textarea rows="6"
                                          name="learning_outcomes"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan hasil pembelajaran, satu per baris">{{ implode("\n", $bootcampData['learning_outcomes'] ?? []) }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Masukkan setiap hasil pembelajaran pada baris baru</p>
                            </div>
                        </div>
                    </div>

                    <!-- Career Support -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Dukungan Karir</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Dukungan karir (satu per baris)</label>
                                <textarea rows="6"
                                          name="career_support"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan dukungan karir, satu per baris">{{ implode("\n", $bootcampData['career_support'] ?? []) }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Masukkan setiap dukungan karir pada baris baru</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Bootcamp Image -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Gambar Bootcamp</h3>
                        <div class="space-y-4">
                            <div>
                                <img class="w-full h-48 object-cover rounded-lg"
                                     src="{{ $bootcampData['image'] ?? 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80' }}"
                                     alt="Bootcamp image">
                            </div>
                            <div>
                                <button type="button" class="w-full bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange">
                                    Upload Image
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Harga</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp)</label>
                                <input type="number"
                                       name="price"
                                       value="{{ $bootcampData['price'] ?? '' }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="0">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Harga Asli (Rp)</label>
                                <input type="number"
                                       name="original_price"
                                       value="{{ $bootcampData['original_price'] ?? '' }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="0">
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Status</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status Bootcamp</label>
                                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                                    <option value="active" {{ ($bootcampData['status'] ?? '') === 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="upcoming" {{ ($bootcampData['status'] ?? '') === 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                                    <option value="inactive" {{ ($bootcampData['status'] ?? '') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="pt-4">
                        <div class="flex flex-col space-y-3">
                            <button type="submit" class="w-full bg-orange hover:bg-orange-dark text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                {{ isset($bootcamp) ? 'Update Bootcamp' : 'Simpan Bootcamp' }}
                            </button>
                            <a href="/admin/bootcamps" class="w-full bg-white hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded-lg border border-gray-300 text-center transition-colors duration-200">
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
