@extends('admin.layouts.app')

@section('title', isset($category) ? 'Edit Kategori' : 'Tambah Kategori Baru')
@section('header', isset($category) ? 'Edit Kategori' : 'Tambah Kategori Baru')

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
            <h2 class="text-lg font-medium text-gray-900">{{ isset($category) ? 'Edit Kategori' : 'Tambah Kategori Baru' }}</h2>
        </div>

        <form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
              method="POST"
              class="p-6">
            @csrf
            @if(isset($category))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Basic Information -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">
                            <i class="fas fa-info-circle mr-1"></i> Informasi Dasar
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $category->name ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="Masukkan nama kategori"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                                <input type="text"
                                       id="slug"
                                       name="slug"
                                       value="{{ old('slug', $category->slug ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="nama-kategori"
                                       readonly>
                                <p class="text-xs text-gray-500 mt-1">Slug akan di-generate otomatis dari nama kategori</p>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <textarea id="description"
                                          name="description"
                                          rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan deskripsi kategori">{{ old('description', $category->description ?? '') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-grip-vertical mr-1"></i> Urutan
                                </label>
                                <input type="number"
                                       id="sort_order"
                                       name="sort_order"
                                       value="{{ old('sort_order', $category->sort_order ?? 0) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="0"
                                       min="0">
                                <p class="text-xs text-gray-500 mt-1">Nomor urut untuk mengatur tampilan kategori</p>
                                @error('sort_order')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Appearance -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">
                            <i class="fas fa-eye mr-1"></i> Tampilan
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-icons mr-1"></i> Icon (FontAwesome)
                                </label>
                                <input type="text"
                                       id="icon"
                                       name="icon"
                                       value="{{ old('icon', $category->icon ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="fas fa-code">
                                @error('icon')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">Gunakan class FontAwesome (contoh: fas fa-code, fas fa-folder, dll)</p>
                            </div>

                            <div>
                                <label for="color" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-palette mr-1"></i> Warna
                                </label>
                                <div class="flex items-center space-x-3">
                                    <input type="color"
                                           id="color"
                                           name="color"
                                           value="{{ old('color', $category->color ?? '#3B82F6') }}"
                                           class="h-10 w-20 border border-gray-300 rounded cursor-pointer">
                                    <input type="text"
                                           id="color_text"
                                           value="{{ old('color', $category->color ?? '#3B82F6') }}"
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                           placeholder="#3B82F6"
                                           pattern="^#[0-9A-Fa-f]{6}$">
                                </div>
                                @error('color')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">Pilih warna untuk kategori</p>
                            </div>

                            <!-- Preview -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                                <div class="p-4 border border-gray-200 rounded-lg bg-gray-50">
                                    <div class="flex items-center space-x-3">
                                        <div id="preview_icon" class="h-12 w-12 rounded-lg flex items-center justify-center" style="background-color: {{ $category->color ?? '#3B82F6' }}">
                                            <i class="{{ $category->icon ?? 'fas fa-folder' }} text-white text-xl"></i>
                                        </div>
                                        <div>
                                            <div id="preview_name" class="font-medium text-gray-900">{{ $category->name ?? 'Nama Kategori' }}</div>
                                            <div id="preview_slug" class="text-sm text-gray-500">{{ $category->slug ?? 'nama-kategori' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">
                            <i class="fas fa-toggle-on mr-1"></i> Status
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox"
                                           name="is_active"
                                           value="1"
                                           {{ old('is_active', isset($category) && $category->is_active ? 'checked' : '') }}
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
                                {{ isset($category) ? 'Update Category' : 'Simpan Kategori' }}
                            </button>
                            <a href="{{ route('admin.categories') }}" class="w-full bg-white hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded-lg border border-gray-300 text-center transition-colors duration-200">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    const iconInput = document.getElementById('icon');
    const colorInput = document.getElementById('color');
    const colorTextInput = document.getElementById('color_text');
    const previewIcon = document.getElementById('preview_icon');
    const previewName = document.getElementById('preview_name');
    const previewSlug = document.getElementById('preview_slug');

    // Auto-generate slug from name
    nameInput.addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
        slugInput.value = slug;
        previewName.textContent = name || 'Nama Kategori';
        previewSlug.textContent = slug || 'nama-kategori';
    });

    // Sync color inputs
    colorInput.addEventListener('input', function() {
        colorTextInput.value = this.value;
        updatePreview();
    });

    colorTextInput.addEventListener('input', function() {
        if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
            colorInput.value = this.value;
            updatePreview();
        }
    });

    // Update icon preview
    iconInput.addEventListener('input', function() {
        updatePreview();
    });

    function updatePreview() {
        const icon = iconInput.value || 'fas fa-folder';
        const color = colorInput.value || '#3B82F6';

        previewIcon.style.backgroundColor = color;
        previewIcon.innerHTML = `<i class="${icon} text-white text-xl"></i>`;
    }
});
</script>
@endsection
@endsection
