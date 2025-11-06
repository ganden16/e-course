@extends('admin.layouts.app')

@section('title', isset($mentor) ? 'Edit Mentor' : 'Create New Mentor')
@section('header', isset($mentor) ? 'Edit Mentor' : 'Create New Mentor')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg shadow-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Error Message -->
    @if($errors->any())
    <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg shadow-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700">There were some errors with your submission:</p>
                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">{{ isset($mentor) ? 'Edit Mentor' : 'Tambah Mentor Baru' }}</h2>
        </div>

        <form action="{{ isset($mentor) ? route('admin.mentors.update', $mentor) : route('admin.mentors.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6">
            @csrf
            @if(isset($mentor))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Informasi Dasar</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $mentor->name ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="Masukkan nama lengkap mentor"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', $mentor->email ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="Masukkan email mentor"
                                       required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="text"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone', $mentor->phone ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="Masukkan nomor telepon">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                                <textarea id="bio"
                                          name="bio"
                                          rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan bio mentor">{{ old('bio', $mentor->bio ?? '') }}</textarea>
                                @error('bio')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="specialization" class="block text-sm font-medium text-gray-700 mb-2">Spesialisasi <span class="text-red-500">*</span></label>
                                <input type="text"
                                       id="specialization"
                                       name="specialization"
                                       value="{{ old('specialization', $mentor->specialization ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="Contoh: Web Development, Data Science, UI/UX Design"
                                       required>
                                @error('specialization')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">Pengalaman</label>
                                <input type="text"
                                       id="experience"
                                       name="experience"
                                       value="{{ old('experience', $mentor->experience ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="Contoh: 5+ years in web development">
                                @error('experience')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
                                @if(isset($mentor) && $mentor->image)
                                    <img class="w-full h-48 object-cover rounded-lg"
                                         src="{{ $mentor->image }}"
                                         alt="Mentor image">
                                @else
                                    <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400 text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    Upload Image
                                </label>
                                <input type="file"
                                       id="image"
                                       name="image"
                                       accept="image/*"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">Allowed formats: JPEG, PNG, JPG, GIF. Max size: 2MB</p>

                                <!-- Preview for new image -->
                                <div id="image-preview" class="mt-3" style="display: none;">
                                    <p class="text-sm text-gray-600 mb-2">New image preview:</p>
                                    <img id="preview-img" src="#" alt="Image preview" class="w-full h-48 object-cover rounded-lg">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Statistik</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                <input type="number"
                                       id="rating"
                                       name="rating"
                                       value="{{ old('rating', $mentor->rating ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="0.0"
                                       step="0.1"
                                       min="0"
                                       max="5">
                                @error('rating')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="students_taught" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Siswa</label>
                                <input type="number"
                                       id="students_taught"
                                       name="students_taught"
                                       value="{{ old('students_taught', $mentor->students_taught ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="0"
                                       min="0">
                                @error('students_taught')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Status</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox"
                                           name="is_active"
                                           value="1"
                                           {{ old('is_active', isset($mentor) && $mentor->is_active ? 'checked' : '') }}
                                           class="rounded border-gray-300 text-orange focus:ring-orange">
                                    <span class="ml-2 text-sm text-gray-700">Aktif</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="pt-4">
                        <div class="flex flex-col space-y-3">
                            <button type="submit" class="w-full bg-orange hover:bg-orange-dark text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                {{ isset($mentor) ? 'Update Mentor' : 'Simpan Mentor' }}
                            </button>
                            <a href="{{ route('admin.mentors') }}" class="w-full bg-white hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded-lg border border-gray-300 text-center transition-colors duration-200">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Image preview functionality
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');

    if (imageInput && imagePreview && previewImg) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.style.display = 'block';
                    previewImg.src = e.target.result;
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
            }
        });
    }
});
</script>
@endsection
