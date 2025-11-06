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
                            <div id="features-container" class="space-y-2">
                                @php
                                    $features = isset($bootcamp) ? $bootcamp->features : [];
                                    if (empty($features)) $features = [''];
                                @endphp
                                @foreach($features as $index => $feature)
                                    <div class="flex items-center space-x-2 feature-item">
                                        <input type="text" name="features[]" value="{{ $feature }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                               placeholder="Masukkan fitur">
                                        <button type="button" class="text-red-600 hover:text-red-800 remove-feature">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" id="add-feature" class="text-orange-600 hover:text-orange-800 font-medium">
                                <i class="fas fa-plus mr-1"></i> Tambah Fitur
                            </button>
                            @error('features')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Curriculum -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Kurikulum</h3>
                        <div class="space-y-4">
                            <div id="curriculum-container" class="space-y-2">
                                @php
                                    $curriculum = isset($bootcamp) ? $bootcamp->curriculum : [];
                                    if (empty($curriculum)) $curriculum = [''];
                                @endphp
                                @foreach($curriculum as $index => $item)
                                    <div class="flex items-center space-x-2 curriculum-item">
                                        <input type="text" name="curriculum[]" value="{{ $item }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                               placeholder="Masukkan topik kurikulum">
                                        <button type="button" class="text-red-600 hover:text-red-800 remove-curriculum">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" id="add-curriculum" class="text-orange-600 hover:text-orange-800 font-medium">
                                <i class="fas fa-plus mr-1"></i> Tambah Kurikulum
                            </button>
                            @error('curriculum')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Learning Outcomes -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Hasil Pembelajaran</h3>
                        <div class="space-y-4">
                            <div id="learning-outcomes-container" class="space-y-2">
                                @php
                                    $learningOutcomes = isset($bootcamp) ? $bootcamp->learning_outcomes : [];
                                    if (empty($learningOutcomes)) $learningOutcomes = [''];
                                @endphp
                                @foreach($learningOutcomes as $index => $item)
                                    <div class="flex items-center space-x-2 learning-outcome-item">
                                        <input type="text" name="learning_outcomes[]" value="{{ $item }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                               placeholder="Masukkan hasil pembelajaran">
                                        <button type="button" class="text-red-600 hover:text-red-800 remove-learning-outcome">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" id="add-learning-outcome" class="text-orange-600 hover:text-orange-800 font-medium">
                                <i class="fas fa-plus mr-1"></i> Tambah Hasil Pembelajaran
                            </button>
                            @error('learning_outcomes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Career Support -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Dukungan Karir</h3>
                        <div class="space-y-4">
                            <div id="career-support-container" class="space-y-2">
                                @php
                                    $careerSupport = isset($bootcamp) ? $bootcamp->career_support : [];
                                    if (empty($careerSupport)) $careerSupport = [''];
                                @endphp
                                @foreach($careerSupport as $index => $item)
                                    <div class="flex items-center space-x-2 career-support-item">
                                        <input type="text" name="career_support[]" value="{{ $item }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                               placeholder="Masukkan dukungan karir">
                                        <button type="button" class="text-red-600 hover:text-red-800 remove-career-support">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" id="add-career-support" class="text-orange-600 hover:text-orange-800 font-medium">
                                <i class="fas fa-plus mr-1"></i> Tambah Dukungan Karir
                            </button>
                            @error('career_support')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Requirements -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Persyaratan</h3>
                        <div class="space-y-4">
                            <div id="requirements-container" class="space-y-2">
                                @php
                                    $requirements = isset($bootcamp) ? $bootcamp->requirements : [];
                                    if (empty($requirements)) $requirements = [''];
                                @endphp
                                @foreach($requirements as $index => $requirement)
                                    <div class="flex items-center space-x-2 requirement-item">
                                        <input type="text" name="requirements[]" value="{{ $requirement }}"
                                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                               placeholder="Masukkan persyaratan">
                                        <button type="button" class="text-red-600 hover:text-red-800 remove-requirement">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" id="add-requirement" class="text-orange-600 hover:text-orange-800 font-medium">
                                <i class="fas fa-plus mr-1"></i> Tambah Persyaratan
                            </button>
                            @error('requirements')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Training Modules -->
                    <div>
                        <h3 class="text-md font-medium text-gray-900 mb-4">Modul Pelatihan</h3>
                        <div class="space-y-4">
                            <div id="modules-container" class="space-y-4">
                                @php
                                    $modules = isset($bootcamp) ? $bootcamp->modules : [];
                                    if (empty($modules)) $modules = [new \App\Models\ModuleBootcamp(['week_number' => 1])];
                                @endphp
                                @foreach($modules as $index => $module)
                                    <div class="border border-gray-200 rounded-lg p-4 module-item">
                                        <div class="flex items-center justify-between mb-3">
                                            <h4 class="font-medium text-gray-900">Minggu {{ $module->week_number ?? ($index + 1) }}</h4>
                                            <button type="button" class="text-red-600 hover:text-red-800 remove-module" @if($loop->first) style="display: none;" @endif>
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Minggu</label>
                                                <input type="number" name="modules[{{ $index }}][week_number]" value="{{ $module->week_number ?? ($index + 1) }}"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                                       min="1" placeholder="1">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Durasi (jam)</label>
                                                <input type="number" name="modules[{{ $index }}][duration_hours]" value="{{ $module->duration_hours ?? '' }}"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                                       min="1" placeholder="40">
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Modul</label>
                                            <input type="text" name="modules[{{ $index }}][module]" value="{{ $module->module ?? '' }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                                   placeholder="Contoh: Introduction to Web Development">
                                        </div>
                                        <div class="mt-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan Pembelajaran</label>
                                            <textarea name="modules[{{ $index }}][objective]" rows="3"
                                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                                      placeholder="Contoh: Students will understand the basics of HTML, CSS, and JavaScript">{{ $module->objective ?? '' }}</textarea>
                                        </div>
                                        <div class="mt-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                            <textarea name="modules[{{ $index }}][description]" rows="3"
                                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                                      placeholder="Deskripsi detail dari modul ini">{{ $module->description ?? '' }}</textarea>
                                        </div>
                                        <div class="mt-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Topik (satu per baris)</label>
                                            <textarea name="modules[{{ $index }}][topics]" rows="4"
                                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                                      placeholder="HTML Basics&#10;CSS Fundamentals&#10;JavaScript Introduction">{{ old('modules.'.$index.'.topics', isset($module->topics) ? implode("\n", $module->topics) : '') }}</textarea>
                                            <p class="text-xs text-gray-500 mt-1">Masukkan setiap topik pada baris baru</p>
                                        </div>
                                        <div class="mt-4">
                                            <label class="flex items-center">
                                                <input type="checkbox" name="modules[{{ $index }}][is_active]" value="1"
                                                       {{ old('modules.'.$index.'.is_active', isset($module->is_active) ? $module->is_active : true) ? 'checked' : '' }}
                                                       class="rounded border-gray-300 text-orange focus:ring-orange">
                                                <span class="ml-2 text-sm text-gray-700">Aktif</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" id="add-module" class="text-orange-600 hover:text-orange-800 font-medium">
                                <i class="fas fa-plus mr-1"></i> Tambah Modul
                            </button>
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
                                         src="{{ $bootcamp->image }}"
                                         alt="Bootcamp image">
                                @else
                                    <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-2xl"></i>
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
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                                       @if(!isset($bootcamp)) required @endif>
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

    // Features management
    const featuresContainer = document.getElementById('features-container');
    const addFeatureBtn = document.getElementById('add-feature');

    addFeatureBtn.addEventListener('click', function() {
        const newFeature = document.createElement('div');
        newFeature.className = 'flex items-center space-x-2 feature-item';
        newFeature.innerHTML = `
            <input type="text" name="features[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent" placeholder="Masukkan fitur">
            <button type="button" class="text-red-600 hover:text-red-800 remove-feature">
                <i class="fas fa-trash"></i>
            </button>
        `;
        featuresContainer.appendChild(newFeature);
    });

    // Remove feature
    featuresContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-feature')) {
            const featureItem = e.target.closest('.feature-item');
            if (featuresContainer.children.length > 1) {
                featureItem.remove();
            }
        }
    });

    // Curriculum management
    const curriculumContainer = document.getElementById('curriculum-container');
    const addCurriculumBtn = document.getElementById('add-curriculum');

    addCurriculumBtn.addEventListener('click', function() {
        const newCurriculum = document.createElement('div');
        newCurriculum.className = 'flex items-center space-x-2 curriculum-item';
        newCurriculum.innerHTML = `
            <input type="text" name="curriculum[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent" placeholder="Masukkan topik kurikulum">
            <button type="button" class="text-red-600 hover:text-red-800 remove-curriculum">
                <i class="fas fa-trash"></i>
            </button>
        `;
        curriculumContainer.appendChild(newCurriculum);
    });

    // Remove curriculum
    curriculumContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-curriculum')) {
            const curriculumItem = e.target.closest('.curriculum-item');
            if (curriculumContainer.children.length > 1) {
                curriculumItem.remove();
            }
        }
    });

    // Learning Outcomes management
    const learningOutcomesContainer = document.getElementById('learning-outcomes-container');
    const addLearningOutcomeBtn = document.getElementById('add-learning-outcome');

    addLearningOutcomeBtn.addEventListener('click', function() {
        const newLearningOutcome = document.createElement('div');
        newLearningOutcome.className = 'flex items-center space-x-2 learning-outcome-item';
        newLearningOutcome.innerHTML = `
            <input type="text" name="learning_outcomes[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent" placeholder="Masukkan hasil pembelajaran">
            <button type="button" class="text-red-600 hover:text-red-800 remove-learning-outcome">
                <i class="fas fa-trash"></i>
            </button>
        `;
        learningOutcomesContainer.appendChild(newLearningOutcome);
    });

    // Remove learning outcome
    learningOutcomesContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-learning-outcome')) {
            const learningOutcomeItem = e.target.closest('.learning-outcome-item');
            if (learningOutcomesContainer.children.length > 1) {
                learningOutcomeItem.remove();
            }
        }
    });

    // Career Support management
    const careerSupportContainer = document.getElementById('career-support-container');
    const addCareerSupportBtn = document.getElementById('add-career-support');

    addCareerSupportBtn.addEventListener('click', function() {
        const newCareerSupport = document.createElement('div');
        newCareerSupport.className = 'flex items-center space-x-2 career-support-item';
        newCareerSupport.innerHTML = `
            <input type="text" name="career_support[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent" placeholder="Masukkan dukungan karir">
            <button type="button" class="text-red-600 hover:text-red-800 remove-career-support">
                <i class="fas fa-trash"></i>
            </button>
        `;
        careerSupportContainer.appendChild(newCareerSupport);
    });

    // Remove career support
    careerSupportContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-career-support')) {
            const careerSupportItem = e.target.closest('.career-support-item');
            if (careerSupportContainer.children.length > 1) {
                careerSupportItem.remove();
            }
        }
    });

    // Requirements management
    const requirementsContainer = document.getElementById('requirements-container');
    const addRequirementBtn = document.getElementById('add-requirement');

    addRequirementBtn.addEventListener('click', function() {
        const newRequirement = document.createElement('div');
        newRequirement.className = 'flex items-center space-x-2 requirement-item';
        newRequirement.innerHTML = `
            <input type="text" name="requirements[]" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent" placeholder="Masukkan persyaratan">
            <button type="button" class="text-red-600 hover:text-red-800 remove-requirement">
                <i class="fas fa-trash"></i>
            </button>
        `;
        requirementsContainer.appendChild(newRequirement);
    });

    // Remove requirement
    requirementsContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-requirement')) {
            const requirementItem = e.target.closest('.requirement-item');
            if (requirementsContainer.children.length > 1) {
                requirementItem.remove();
            }
        }
    });

    // Modules management
    const modulesContainer = document.getElementById('modules-container');
    const addModuleBtn = document.getElementById('add-module');
    let moduleCount = {{ isset($bootcamp) ? $bootcamp->modules->count() : 1 }};

    addModuleBtn.addEventListener('click', function() {
        moduleCount++;
        const newModule = document.createElement('div');
        newModule.className = 'border border-gray-200 rounded-lg p-4 module-item';
        newModule.innerHTML = `
            <div class="flex items-center justify-between mb-3">
                <h4 class="font-medium text-gray-900">Minggu ${moduleCount}</h4>
                <button type="button" class="text-red-600 hover:text-red-800 remove-module">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Minggu</label>
                    <input type="number" name="modules[${moduleCount}][week_number]" value="${moduleCount}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                           min="1" placeholder="1">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Durasi (jam)</label>
                    <input type="number" name="modules[${moduleCount}][duration_hours]" value=""
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                           min="1" placeholder="40">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Modul</label>
                <input type="text" name="modules[${moduleCount}][module]" value=""
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                       placeholder="Contoh: Introduction to Web Development">
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan Pembelajaran</label>
                <textarea name="modules[${moduleCount}][objective]" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                          placeholder="Contoh: Students will understand the basics of HTML, CSS, and JavaScript"></textarea>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="modules[${moduleCount}][description]" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                          placeholder="Deskripsi detail dari modul ini"></textarea>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Topik (satu per baris)</label>
                <textarea name="modules[${moduleCount}][topics]" rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                          placeholder="HTML Basics&#10;CSS Fundamentals&#10;JavaScript Introduction"></textarea>
                <p class="text-xs text-gray-500 mt-1">Masukkan setiap topik pada baris baru</p>
            </div>
            <div class="mt-4">
                <label class="flex items-center">
                    <input type="checkbox" name="modules[${moduleCount}][is_active]" value="1" checked
                           class="rounded border-gray-300 text-orange focus:ring-orange">
                    <span class="ml-2 text-sm text-gray-700">Aktif</span>
                </label>
            </div>
        `;
        modulesContainer.appendChild(newModule);
    });

    // Remove module
    modulesContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-module')) {
            const moduleItem = e.target.closest('.module-item');
            if (modulesContainer.children.length > 1) {
                moduleItem.remove();
                updateWeekNumbers();
            }
        }
    });

    function updateWeekNumbers() {
        const moduleItems = modulesContainer.querySelectorAll('.module-item');
        moduleItems.forEach((item, index) => {
            const weekHeader = item.querySelector('h4');
            const weekInput = item.querySelector('input[name*="[week_number]"]');
            if (weekHeader) {
                weekHeader.textContent = `Minggu ${index + 1}`;
            }
            if (weekInput && !weekInput.value) {
                weekInput.value = index + 1;
            }

            // Update remove button visibility
            const removeBtn = item.querySelector('.remove-module');
            if (removeBtn) {
                removeBtn.style.display = index === 0 ? 'none' : 'block';
            }
        });
    }

    // Image preview functionality
    $('#image').change(function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').show();
                $('#preview-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        } else {
            $('#image-preview').hide();
        }
    });
});
</script>
@endpush

@endsection
