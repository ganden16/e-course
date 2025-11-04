@extends('admin.layouts.app')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('title', isset($product) ? 'Edit Product' : 'Create Product')

@section('page-title', isset($product) ? 'Edit Product' : 'Create Product')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.products') }}" class="text-purple-600 hover:text-purple-800 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i>
        Back to Products
    </a>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="p-6 border-b">
        <h2 class="text-xl font-semibold text-gray-800">{{ isset($product) ? 'Edit Product' : 'Create New Product' }}</h2>
        <p class="text-gray-600 mt-1">{{ isset($product) ? 'Update product information' : 'Fill in the product details below' }}</p>
    </div>

    <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @if(isset($product))
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
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Product Title *</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $product->title ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                            <textarea id="description" name="description" rows="4"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>{{ old('description', $product->description ?? '') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="instructor" class="block text-sm font-medium text-gray-700 mb-1">Instructor *</label>
                                <input type="text" id="instructor" name="instructor" value="{{ old('instructor', $product->instructor ?? '') }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                                @error('instructor')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="product_category_id" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                                <select id="product_category_id" name="product_category_id"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('product_category_id', $product->product_category_id ?? '') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration *</label>
                                <input type="text" id="duration" name="duration" value="{{ old('duration', $product->duration ?? '') }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                                @error('duration')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Level *</label>
                                <select id="level" name="level"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                                    <option value="">Select level</option>
                                    <option value="Beginner" {{ old('level', $product->level ?? '') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                    <option value="Intermediate" {{ old('level', $product->level ?? '') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="Advanced" {{ old('level', $product->level ?? '') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                </select>
                                @error('level')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating *</label>
                                <input type="number" id="rating" name="rating" value="{{ old('rating', $product->rating ?? '') }}"
                                       step="0.1" min="0" max="5"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                                @error('rating')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pricing -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pricing</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Current Price ($) *</label>
                            <input type="number" id="price" name="price" value="{{ old('price', $product->price ?? '') }}"
                                   step="0.01" min="0"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="original_price" class="block text-sm font-medium text-gray-700 mb-1">Original Price ($) *</label>
                            <input type="number" id="original_price" name="original_price" value="{{ old('original_price', $product->original_price ?? '') }}"
                                   step="0.01" min="0"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                            @error('original_price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="students" class="block text-sm font-medium text-gray-700 mb-1">Number of Students *</label>
                        <input type="number" id="students" name="students" value="{{ old('students', $product->students ?? '') }}"
                               min="0"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                        @error('students')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Features -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Features</h3>

                    <div id="features-container" class="space-y-2">
                        @php
                            $features = isset($product) ? $product->features : [];
                            if (empty($features)) $features = [''];
                        @endphp
                        @foreach($features as $index => $feature)
                            <div class="flex items-center space-x-2 feature-item">
                                <input type="text" name="features[]" value="{{ $feature }}"
                                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                       placeholder="Enter feature">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-feature">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="add-feature" class="mt-3 text-purple-600 hover:text-purple-800 font-medium">
                        <i class="fas fa-plus mr-1"></i> Add Feature
                    </button>
                </div>

                <!-- Curriculum -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Curriculum</h3>

                    <div id="curriculum-container" class="space-y-2">
                        @php
                            $curriculum = isset($product) ? $product->curriculum : [];
                            if (empty($curriculum)) $curriculum = [''];
                        @endphp
                        @foreach($curriculum as $index => $item)
                            <div class="flex items-center space-x-2 curriculum-item">
                                <input type="text" name="curriculum[]" value="{{ $item }}"
                                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                       placeholder="Enter curriculum item">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-curriculum">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="add-curriculum" class="mt-3 text-purple-600 hover:text-purple-800 font-medium">
                        <i class="fas fa-plus mr-1"></i> Add Curriculum Item
                    </button>
                </div>

                <!-- Requirements -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Requirements</h3>

                    <div id="requirements-container" class="space-y-2">
                        @php
                            $requirements = isset($product) ? $product->requirements : [];
                            if (empty($requirements)) $requirements = [''];
                        @endphp
                        @foreach($requirements as $index => $requirement)
                            <div class="flex items-center space-x-2 requirement-item">
                                <input type="text" name="requirements[]" value="{{ $requirement }}"
                                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                       placeholder="Enter requirement">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-requirement">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="add-requirement" class="mt-3 text-purple-600 hover:text-purple-800 font-medium">
                        <i class="fas fa-plus mr-1"></i> Add Requirement
                    </button>
                </div>

                <!-- What You Will Build -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">What You Will Build</h3>

                    <div id="what-you-will-build-container" class="space-y-2">
                        @php
                            $whatYouWillBuild = isset($product) ? $product->what_you_will_build : [];
                            if (empty($whatYouWillBuild)) $whatYouWillBuild = [''];
                        @endphp
                        @foreach($whatYouWillBuild as $index => $item)
                            <div class="flex items-center space-x-2 what-you-will-build-item">
                                <input type="text" name="what_you_will_build[]" value="{{ $item }}"
                                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                       placeholder="Enter what you will build">
                                <button type="button" class="text-red-600 hover:text-red-800 remove-what-you-will-build">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" id="add-what-you-will-build" class="mt-3 text-purple-600 hover:text-purple-800 font-medium">
                        <i class="fas fa-plus mr-1"></i> Add Item
                    </button>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Product Image -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Product Image</h3>

                    <div class="space-y-4">
                        @if(isset($product) && $product->image)
                            <div class="mb-4">
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}"
                                     class="w-full h-48 object-cover rounded-lg">
                                <p class="text-sm text-gray-500 mt-2">Current image</p>
                            </div>
                        @endif

                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ isset($product) ? 'Change Image' : 'Product Image' }} {{ !isset($product) ? '*' : '' }}
                            </label>
                            <input type="file" id="image" name="image" accept="image/*"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   {{ !isset($product) ? 'required' : '' }}>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="text-sm text-gray-500 mt-1">Allowed formats: JPEG, PNG, JPG, GIF (Max: 2MB)</p>
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
                                   {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 block text-sm text-gray-700">
                                Active
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="space-y-3">
                        <button type="submit" class="w-full gradient-bg text-white py-3 rounded-lg hover:opacity-90 transition font-medium">
                            {{ isset($product) ? 'Update Product' : 'Create Product' }}
                        </button>
                        <a href="{{ route('admin.products') }}" class="w-full block text-center bg-gray-200 text-gray-800 py-3 rounded-lg hover:bg-gray-300 transition font-medium">
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
    // Features management
    const featuresContainer = document.getElementById('features-container');
    const addFeatureBtn = document.getElementById('add-feature');

    addFeatureBtn.addEventListener('click', function() {
        const newFeature = document.createElement('div');
        newFeature.className = 'flex items-center space-x-2 feature-item';
        newFeature.innerHTML = `
            <input type="text" name="features[]" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter feature">
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
            <input type="text" name="curriculum[]" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter curriculum item">
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

    // Requirements management
    const requirementsContainer = document.getElementById('requirements-container');
    const addRequirementBtn = document.getElementById('add-requirement');

    addRequirementBtn.addEventListener('click', function() {
        const newRequirement = document.createElement('div');
        newRequirement.className = 'flex items-center space-x-2 requirement-item';
        newRequirement.innerHTML = `
            <input type="text" name="requirements[]" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter requirement">
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

    // What You Will Build management
    const whatYouWillBuildContainer = document.getElementById('what-you-will-build-container');
    const addWhatYouWillBuildBtn = document.getElementById('add-what-you-will-build');

    addWhatYouWillBuildBtn.addEventListener('click', function() {
        const newWhatYouWillBuild = document.createElement('div');
        newWhatYouWillBuild.className = 'flex items-center space-x-2 what-you-will-build-item';
        newWhatYouWillBuild.innerHTML = `
            <input type="text" name="what_you_will_build[]" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Enter what you will build">
            <button type="button" class="text-red-600 hover:text-red-800 remove-what-you-will-build">
                <i class="fas fa-trash"></i>
            </button>
        `;
        whatYouWillBuildContainer.appendChild(newWhatYouWillBuild);
    });

    // Remove what you will build
    whatYouWillBuildContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-what-you-will-build')) {
            const whatYouWillBuildItem = e.target.closest('.what-you-will-build-item');
            if (whatYouWillBuildContainer.children.length > 1) {
                whatYouWillBuildItem.remove();
            }
        }
    });
});
</script>
@endsection
