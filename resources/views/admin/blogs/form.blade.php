@extends('admin.layouts.app')

@section('title', isset($blog) ? 'Edit Blog' : 'Create New Blog')
@section('header', isset($blog) ? 'Edit Blog' : 'Create New Blog')

@section('content')
<!-- Success Message -->
{{-- @if(session('success'))
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
@endif --}}

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
        <h2 class="text-lg font-medium text-gray-900">{{ isset($blog) ? 'Edit Blog' : 'Create New Blog' }}</h2>
    </div>

    <form action="{{ isset($blog) ? route('admin.blogs.update', $blog) : route('admin.blogs.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="p-6">
        @csrf
        @if(isset($blog))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                    <input type="text"
                           id="title"
                           name="title"
                           value="{{ old('title', $blog->title ?? '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                           placeholder="Enter blog title"
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div>
                    <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt <span class="text-red-500">*</span></label>
                    <textarea id="excerpt"
                              name="excerpt"
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                              placeholder="Brief description of the blog"
                              required>{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content <span class="text-red-500">*</span></label>
                    <textarea id="content"
                              name="content"
                              rows="10"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                              placeholder="Full blog content"
                              required>{{ old('content', $blog->content ?? '') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Meta Title -->
                {{-- <div>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                    <input type="text"
                           id="meta_title"
                           name="meta_title"
                           value="{{ old('meta_title', $blog->meta_title ?? '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                           placeholder="SEO title (optional)">
                    @error('meta_title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div> --}}

                <!-- Meta Description -->
                {{-- <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                    <textarea id="meta_description"
                              name="meta_description"
                              rows="2"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                              placeholder="SEO description (optional)">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                    @error('meta_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div> --}}

            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Featured Image -->
                <div>
                    <h3 class="text-md font-medium text-gray-900 mb-4">Featured Image</h3>
                    <div class="space-y-4">
                        <div>
                            @if(isset($blog) && $blog->image)
                                <img class="w-full h-48 object-cover rounded-lg"
                                     src="{{ $blog->image }}"
                                     alt="Blog image">
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

                <!-- Author -->
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Author <span class="text-red-500">*</span></label>
                    <input type="text"
                           id="author"
                           name="author"
                           value="{{ old('author', $blog->author ?? '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                           placeholder="Author name"
                           required>
                    @error('author')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Published Date -->
                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Published Date <span class="text-red-500">*</span></label>
                    <input type="datetime-local"
                           id="published_at"
                           name="published_at"
                           value="{{ old('published_at', isset($blog) && $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                           required>
                    @error('published_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Read Time -->
                <div>
                    <label for="read_time" class="block text-sm font-medium text-gray-700 mb-2">Read Time <span class="text-red-500">*</span></label>
                    <input type="text"
                           id="read_time"
                           name="read_time"
                           value="{{ old('read_time', $blog->read_time ?? '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent"
                           placeholder="e.g., 5 min read"
                           required>
                    @error('read_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags -->
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                    <select id="tags" name="tags[]" multiple class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}"
                                {{ in_array($tag->id, old('tags', $blogTags ?? [])) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl/Cmd to select multiple tags</p>
                    @error('tags')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                @if(isset($blog))
                <div>
                    <h3 class="text-md font-medium text-gray-900 mb-4">Status</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox"
                                    name="is_active"
                                    value="1"
                                     {{ old('is_active', $blog->is_active ?? true) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-orange focus:ring-orange">
                                <span class="ml-2 text-sm text-gray-700">Active</span>
                            </label>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Actions -->
                <div class="pt-4">
                    <div class="flex flex-col space-y-3">
                        <button type="submit" class="w-full bg-orange hover:bg-orange-dark text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                            {{ isset($blog) ? 'Update Blog' : 'Create Blog' }}
                        </button>
                        <a href="{{ route('admin.blogs') }}" class="w-full bg-white hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded-lg border border-gray-300 text-center transition-colors duration-200">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
<script>
$(document).ready(function() {
    $('#tags').select2({
        placeholder: 'Select tags',
        allowClear: true,
        closeOnSelect: false,
        width: '100%'
    });

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
