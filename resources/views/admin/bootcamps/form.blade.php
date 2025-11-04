@extends('admin.layouts.app')

@section('title', isset($bootcamp) ? 'Edit Bootcamp' : 'Create New Bootcamp')
@section('header', isset($bootcamp) ? 'Edit Bootcamp' : 'Create New Bootcamp')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
/* Select2 container styling */
.select2-container {
    width: 100% !important;
}

/* Multiple select styling */
.select2-container .select2-selection--multiple {
    min-height: 42px;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    background-color: white;
    padding: 6px 8px;
    transition: all 0.2s ease;
}

.select2-container .select2-selection--multiple:hover {
    border-color: #b3b3b3;
}

/* Focus state */
.select2-container--focus .select2-selection--multiple {
    border-color: #ffb433;
    box-shadow: 0 0 0 3px rgba(255, 180, 51, 0.1);
    outline: none;
}

/* Selected choices styling */
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #ffb433;
    border: 1px solid #ff9500;
    border-radius: 0.375rem;
    color: white;
    font-size: 0.875rem;
    font-weight: 500;
    margin: 3px 6px 3px 0;
    padding: 4px 8px;
    display: inline-flex;
    align-items: center;
}

/* Remove button styling */
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: white;
    margin-right: 6px;
    font-weight: bold;
    font-size: 1rem;
    line-height: 1;
    opacity: 0.8;
    transition: opacity 0.2s ease;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: white;
    opacity: 1;
}

/* Search field styling */
.select2-search--inline .select2-search__field {
    margin-top: 0;
    margin-bottom: 0;
    padding: 0;
    font-family: inherit;
    font-size: 0.875rem;
    line-height: 1.5;
    color: #374151;
    background-color: transparent;
    border: none;
    outline: none;
}

/* Dropdown styling */
.select2-dropdown {
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    background-color: white;
}

.select2-results__option {
    padding: 10px 16px;
    font-size: 0.875rem;
    color: #374151;
}

.select2-results__option--highlighted {
    background-color: #fef3c7;
    color: #92400e;
}

.select2-results__option[aria-selected="true"] {
    background-color: #fed7aa;
    color: #92400e;
}

/* Placeholder styling */
.select2-container--default .select2-selection--multiple .select2-selection__placeholder {
    color: #9ca3af;
    font-size: 0.875rem;
}

/* Clear button styling */
.select2-selection__clear {
    color: #6b7280 !important;
    margin-right: 8px !important;
}

.select2-selection__clear:hover {
    color: #374151 !important;
}
</style>
@endpush

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
            <h2 class="text-lg font-medium text-gray-900">{{ isset($bootcamp) ? 'Edit Bootcamp' : 'Tambah Bootcamp Baru' }}</h2>
        </div>

        <form action="{{ isset($bootcamp) ? route('admin.bootcamps.update', $bootcamp) : route('admin.bootcamps.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-6">
            @csrf
            @if(isset($bootcamp))
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
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Bootcamp <span class="text-red-500">*</span></label>
                                <input type="text"
                                       id="title"
                                       name="title"
                                       value="{{ old('title', $bootcamp->title ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="Masukkan judul bootcamp"
                                       required>
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                                <textarea id="description"
                                          name="description"
                                          rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan deskripsi bootcamp"
                                          required>{{ old('description', $bootcamp->description ?? '') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                                    <select id="category_id" name="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', isset($bootcamp) && $bootcamp->category_id ? $bootcamp->category_id : '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="level" class="block text-sm font-medium text-gray-700 mb-2">Level <span class="text-red-500">*</span></label>
                                    <select id="level" name="level" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent" required>
                                        <option value="">Pilih Level</option>
                                        <option value="beginner" {{ old('level', $bootcamp->level ?? '') === 'beginner' ? 'selected' : '' }}>Pemula</option>
                                        <option value="intermediate" {{ old('level', $bootcamp->level ?? '') === 'intermediate' ? 'selected' : '' }}>Menengah</option>
                                        <option value="advanced" {{ old('level', $bootcamp->level ?? '') === 'advanced' ? 'selected' : '' }}>Lanjutan</option>
                                    </select>
                                    @error('level')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Durasi <span class="text-red-500">*</span></label>
                                    <input type="text"
                                           id="duration"
                                           name="duration"
                                           value="{{ old('duration', $bootcamp->duration ?? '') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                           placeholder="Contoh: 12 weeks"
                                           required>
                                    @error('duration')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                                    <input type="date"
                                           id="start_date"
                                           name="start_date"
                                           value="{{ old('start_date', isset($bootcamp) && $bootcamp->start_date ? $bootcamp->start_date->format('Y-m-d') : '') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                                    @error('start_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="schedule" class="block text-sm font-medium text-gray-700 mb-2">Jadwal <span class="text-red-500">*</span></label>
                                    <input type="text"
                                           id="schedule"
                                           name="schedule"
                                           value="{{ old('schedule', $bootcamp->schedule ?? '') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                           placeholder="Contoh: Senin - Jumat, 09:00 - 17:00"
                                           required>
                                    @error('schedule')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="mentors" class="block text-sm font-medium text-gray-700 mb-2">Mentors</label>
                                <select id="mentors" name="mentors[]" multiple class="form-control">
                                    @foreach($mentors as $mentor)
                                        <option value="{{ $mentor->id }}" {{ isset($bootcamp) && $bootcamp->mentors && $bootcamp->mentors->contains($mentor->id) ? 'selected' : '' }}>
                                            {{ $mentor->name }} - {{ $mentor->specialization }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Pilih satu atau lebih mentor</p>
                                @error('mentors')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Bootcamp Features -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Fitur Bootcamp</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="features" class="block text-sm font-medium text-gray-700 mb-2">Fitur (satu per baris)</label>
                                <textarea id="features"
                                          name="features"
                                          rows="6"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan fitur bootcamp, satu per baris">{{ old('features', isset($bootcamp) && $bootcamp->features ? implode("\n", $bootcamp->features) : '') }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Masukkan setiap fitur pada baris baru</p>
                                @error('features')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Curriculum -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Kurikulum</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="curriculum" class="block text-sm font-medium text-gray-700 mb-2">Kurikulum (satu per baris)</label>
                                <textarea id="curriculum"
                                          name="curriculum"
                                          rows="6"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan kurikulum, satu per baris">{{ old('curriculum', isset($bootcamp) && $bootcamp->curriculum ? implode("\n", $bootcamp->curriculum) : '') }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Masukkan setiap topik kurikulum pada baris baru</p>
                                @error('curriculum')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Learning Outcomes -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Hasil Pembelajaran</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="learning_outcomes" class="block text-sm font-medium text-gray-700 mb-2">Hasil pembelajaran (satu per baris)</label>
                                <textarea id="learning_outcomes"
                                          name="learning_outcomes"
                                          rows="6"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan hasil pembelajaran, satu per baris">{{ old('learning_outcomes', isset($bootcamp) && $bootcamp->learning_outcomes ? implode("\n", $bootcamp->learning_outcomes) : '') }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Masukkan setiap hasil pembelajaran pada baris baru</p>
                                @error('learning_outcomes')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Career Support -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Dukungan Karir</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="career_support" class="block text-sm font-medium text-gray-700 mb-2">Dukungan karir (satu per baris)</label>
                                <textarea id="career_support"
                                          name="career_support"
                                          rows="6"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan dukungan karir, satu per baris">{{ old('career_support', isset($bootcamp) && $bootcamp->career_support ? implode("\n", $bootcamp->career_support) : '') }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Masukkan setiap dukungan karir pada baris baru</p>
                                @error('career_support')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Requirements -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Persyaratan</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">Persyaratan (satu per baris)</label>
                                <textarea id="requirements"
                                          name="requirements"
                                          rows="6"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                          placeholder="Masukkan persyaratan, satu per baris">{{ old('requirements', isset($bootcamp) && $bootcamp->requirements ? implode("\n", $bootcamp->requirements) : '') }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Masukkan setiap persyaratan pada baris baru</p>
                                @error('requirements')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
                                @if(isset($bootcamp) && $bootcamp->image)
                                    <img class="w-full h-48 object-cover rounded-lg"
                                         src="{{ Storage::url('bootcamps/' . $bootcamp->image) }}"
                                         alt="Bootcamp image">
                                @else
                                    <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    Upload Image {{ !isset($bootcamp) ? '<span class="text-red-500">*</span>' : '' }}
                                </label>
                                <input type="file"
                                       id="image"
                                       name="image"
                                       accept="image/*"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       @if(!isset($bootcamp)) required @endif>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">Allowed formats: JPEG, PNG, JPG, GIF. Max size: 2MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Harga</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                                <input type="number"
                                       id="price"
                                       name="price"
                                       value="{{ old('price', $bootcamp->price ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="0"
                                       step="0.01"
                                       min="0"
                                       required>
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="original_price" class="block text-sm font-medium text-gray-700 mb-2">Harga Asli (Rp)</label>
                                <input type="number"
                                       id="original_price"
                                       name="original_price"
                                       value="{{ old('original_price', $bootcamp->original_price ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="0"
                                       step="0.01"
                                       min="0">
                                @error('original_price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                <input type="number"
                                       id="rating"
                                       name="rating"
                                       value="{{ old('rating', $bootcamp->rating ?? '') }}"
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
                                <label for="students" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Siswa</label>
                                <input type="number"
                                       id="students"
                                       name="students"
                                       value="{{ old('students', $bootcamp->students ?? '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       placeholder="0"
                                       min="0">
                                @error('students')
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
                                           {{ old('is_active', isset($bootcamp) && $bootcamp->is_active ? 'checked' : '') }}
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
                                {{ isset($bootcamp) ? 'Update Bootcamp' : 'Simpan Bootcamp' }}
                            </button>
                            <a href="{{ route('admin.bootcamps') }}" class="w-full bg-white hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded-lg border border-gray-300 text-center transition-colors duration-200">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#mentors').select2({
        placeholder: 'Pilih satu atau lebih mentor',
        allowClear: true,
        closeOnSelect: false,
        width: '100%',
        language: {
            noResults: function() {
                return "Tidak ada mentor yang ditemukan";
            },
            searching: function() {
                return "Mencari...";
            },
            removeAllItems: function() {
                return "Hapus semua";
            }
        },
        templateResult: function(mentor) {
            if (!mentor.id) {
                return mentor.text;
            }

            var $container = $(
                '<div class="select2-result-mentor">' +
                    '<div class="select2-result-mentor__name">' + mentor.text + '</div>' +
                '</div>'
            );

            return $container;
        },
        templateSelection: function(mentor) {
            if (!mentor.id) {
                return mentor.text;
            }

            var $selection = $(
                '<span class="select2-selection-mentor">' + mentor.text + '</span>'
            );

            return $selection;
        },
        escapeMarkup: function(markup) {
            return markup;
        }
    });
});
</script>
@endpush

@endsection
