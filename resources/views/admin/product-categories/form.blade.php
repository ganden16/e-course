@extends('admin.layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@section('title', isset($productCategory) ? 'Edit Product Category' : 'Create Product Category')

@section('page-title', isset($productCategory) ? 'Edit Product Category' : 'Create Product Category')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.product-categories') }}" class="text-purple-600 hover:text-purple-800 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i>
        Back to Categories
    </a>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="p-6 border-b">
        <h2 class="text-xl font-semibold text-gray-800">{{ isset($productCategory) ? 'Edit Product Category' : 'Create New Product Category' }}</h2>
        <p class="text-gray-600 mt-1">{{ isset($productCategory) ? 'Update category information' : 'Fill in category details below' }}</p>
    </div>

    <form action="{{ isset($productCategory) ? route('admin.product-categories.update', $productCategory) : route('admin.product-categories.store') }}" method="POST" class="p-6">
        @csrf
        @if(isset($productCategory))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>

                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name *</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $productCategory->name ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                            <input type="text" id="slug" name="slug" value="{{ old('slug', $productCategory->slug ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   readonly>
                            <p class="text-sm text-gray-500 mt-1">Auto-generated from category name</p>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea id="description" name="description" rows="4"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('description', $productCategory->description ?? '') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Display Settings -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Display Settings</h3>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icon Class</label>
                                <input type="text" id="icon" name="icon" value="{{ old('icon', $productCategory->icon ?? '') }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                       placeholder="fas fa-code">
                                @error('icon')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="text-sm text-gray-500 mt-1">Font Awesome icon class (e.g., fas fa-code)</p>
                            </div>

                            <div>
                                <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                                <input type="color" id="color" name="color" value="{{ old('color', $productCategory->color ?? '#6B46C1') }}"
                                       class="w-full h-10 px-2 py-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                @error('color')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="text-sm text-gray-500 mt-1">Category display color</p>
                            </div>
                        </div>

                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $productCategory->sort_order ?? 0) }}"
                                   min="0"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            @error('sort_order')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="text-sm text-gray-500 mt-1">Lower numbers appear first</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Preview -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Preview</h3>

                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                        <div class="flex items-center">
                            <div id="icon-preview" class="flex-shrink-0 h-12 w-12 flex items-center justify-center rounded-lg mr-3" style="background-color: {{ $productCategory->color ?? '#6B46C1' }}20; color: {{ $productCategory->color ?? '#6B46C1' }}">
                                @if(isset($productCategory) && $productCategory->icon)
                                    <i class="{{ $productCategory->icon }}"></i>
                                @else
                                    <i class="fas fa-tag"></i>
                                @endif
                            </div>
                            <div>
                                <div id="name-preview" class="text-sm font-medium text-gray-900">{{ $productCategory->name ?? 'Category Name' }}</div>
                                <div class="text-sm text-gray-500">{{ $productCategory->slug ?? 'category-slug' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Status</h3>

                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1"
                                   class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded"
                                   {{ old('is_active', $productCategory->is_active ?? true) ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 block text-sm text-gray-700">
                                Active
                            </label>
                        </div>
                        <p class="text-sm text-gray-500">Inactive categories won't be displayed on the website</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="space-y-3">
                        <button type="submit" class="w-full gradient-bg text-white py-3 rounded-lg hover:opacity-90 transition font-medium">
                            {{ isset($productCategory) ? 'Update Category' : 'Create Category' }}
                        </button>
                        <a href="{{ route('admin.product-categories') }}" class="w-full block text-center bg-gray-200 text-gray-800 py-3 rounded-lg hover:bg-gray-300 transition font-medium">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    const iconInput = document.getElementById('icon');
    const colorInput = document.getElementById('color');
    const iconPreview = document.getElementById('icon-preview');
    const namePreview = document.getElementById('name-preview');

    // Auto-generate slug from name
    nameInput.addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
            .replace(/[^\w\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .replace(/-+/g, '-') // Replace multiple hyphens with single hyphen
            .trim(); // Trim whitespace

        slugInput.value = slug;
        namePreview.textContent = name || 'Category Name';
    });

    // Update icon preview
    iconInput.addEventListener('input', function() {
        const iconClass = this.value;
        const iconElement = iconPreview.querySelector('i');

        if (iconClass) {
            iconElement.className = iconClass;
        } else {
            iconElement.className = 'fas fa-tag';
        }
    });

    // Update color preview
    colorInput.addEventListener('input', function() {
        const color = this.value;
        iconPreview.style.backgroundColor = color + '20';
        iconPreview.style.color = color;
    });
});
</script>
@endsection
