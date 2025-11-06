@extends('admin.layouts.app')

@section('title', 'Edit Profile')

@section('header', 'Edit Profile')

@section('content')

<div class="container-fluid px-6 py-4">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Profile</h1>
            <p class="text-gray-600 mt-1">Perbarui informasi profile Anda</p>
        </div>
        <a href="{{ route('admin.admins') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors duration-200">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Informasi Profile</h2>
        </div>

        <form action="{{ route('admin.profile.update') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name', $admin->name) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Masukkan nama lengkap"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="username"
                               name="username"
                               value="{{ old('username', $admin->username) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Masukkan username"
                               required>
                        @error('username')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email', $admin->email) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Masukkan email"
                               required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password <span class="text-gray-500">(kosongkan jika tidak ingin mengubah)</span>
                        </label>
                        <input type="password"
                               id="password"
                               name="password"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Masukkan password baru">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password
                        </label>
                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Konfirmasi password">
                    </div>

                    <!-- Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            Foto Profil
                        </label>
                        <div class="flex items-center space-x-4">
                            <!-- Current Image Preview -->
                            @if($admin->image)
                                <img src="{{ $admin->image }}"
                                     alt="{{ $admin->name }}"
                                     class="h-20 w-20 rounded-full object-cover border-2 border-gray-200"
                                     id="current-image">
                            @else
                                <div class="h-20 w-20 rounded-full bg-gray-200 flex items-center justify-center"
                                     id="current-image">
                                    <i class="fas fa-user text-gray-400 text-2xl"></i>
                                </div>
                            @endif

                            <!-- Upload Button -->
                            <div class="flex-1">
                                <input type="file"
                                       id="image"
                                       name="image"
                                       accept="image/*"
                                       class="hidden"
                                       onchange="previewImage(event)">
                                <label for="image"
                                       class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg inline-block transition-colors duration-200">
                                    <i class="fas fa-upload mr-2"></i>
                                    Pilih Foto
                                </label>
                                <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF (Max: 2MB)</p>

                                <!-- Preview for new image -->
                                <div id="image-preview" class="mt-3" style="display: none;">
                                    <p class="text-sm text-gray-600 mb-2">New image preview:</p>
                                    <img id="preview-img" src="#" alt="Image preview" class="h-20 w-20 rounded-full object-cover border-2 border-gray-200">
                                </div>
                            </div>
                        </div>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.admins') }}"
                        class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-block bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Update preview image
            const previewContainer = document.getElementById('current-image');
            if (previewContainer.tagName === 'IMG') {
                previewContainer.src = e.target.result;
            } else {
                // Replace placeholder with an image
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Preview';
                img.className = 'h-20 w-20 rounded-full object-cover border-2 border-gray-200';
                img.id = 'current-image';
                previewContainer.parentNode.replaceChild(img, previewContainer);
            }
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
