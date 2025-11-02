@extends('admin.layouts.app')

@section('title', isset($product) ? 'Edit Product' : 'Create New Product')
@section('header', isset($product) ? 'Edit Product' : 'Create New Product')

@php
    // Load language file for product page
    $translations = include lang_path('id/product.php');
    $products = $translations['products'];

    // Create a simple mentors array from the products data
    $mentors = [];
    foreach ($products as $prod) {
        $mentors[] = [
            'name' => $prod['instructor'],
            'specialization' => $prod['category']
        ];
    }
    // Remove duplicates
    $mentors = array_unique($mentors, SORT_REGULAR);
    $mentors = array_values($mentors);

    // If editing, get the product data
    if (isset($product)) {
        $productData = collect($products)->firstWhere('id', $product);
    }
@endphp

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center">
            <a href="/admin/products" class="mr-4 text-gray-500 hover:text-gray-700 transition-colors duration-200">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ isset($product) ? 'Edit Product' : 'Create New Product' }}</h1>
                <p class="mt-2 text-sm text-gray-600">{{ isset($product) ? 'Update product information and settings' : 'Fill in the information to create a new product' }}</p>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
        <!-- Progress Bar -->
        <div class="bg-gray-200 h-1">
            <div class="bg-primary h-1 w-3/5"></div>
        </div>

        <!-- Tab Navigation -->
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
                <button class="py-4 px-6 text-center border-b-2 border-primary font-medium text-sm text-primary">
                    Basic Information
                </button>
                <button class="py-4 px-6 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Content & Curriculum
                </button>
                <button class="py-4 px-6 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Media & Assets
                </button>
                <button class="py-4 px-6 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Pricing & Settings
                </button>
            </nav>
        </div>

        <form class="p-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Basic Information -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <span class="flex items-center justify-center w-8 h-8 bg-primary text-white rounded-full mr-3 text-sm">1</span>
                            Basic Information
                        </h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Product Title</label>
                                <input type="text"
                                       name="title"
                                       value="{{ $productData['title'] ?? '' }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200"
                                       placeholder="Enter product title">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea rows="5"
                                          name="description"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200"
                                          placeholder="Describe your product">{{ $productData['description'] ?? '' }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                    <select name="category" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200">
                                        <option value="">Select Category</option>
                                        <option value="Web Development" {{ ($productData['category'] ?? '') === 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                        <option value="Data Science" {{ ($productData['category'] ?? '') === 'Data Science' ? 'selected' : '' }}>Data Science</option>
                                        <option value="Marketing" {{ ($productData['category'] ?? '') === 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                        <option value="Design" {{ ($productData['category'] ?? '') === 'Design' ? 'selected' : '' }}>Design</option>
                                        <option value="Mobile Development" {{ ($productData['category'] ?? '') === 'Mobile Development' ? 'selected' : '' }}>Mobile Development</option>
                                        <option value="Security" {{ ($productData['category'] ?? '') === 'Security' ? 'selected' : '' }}>Security</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                                    <select name="level" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200">
                                        <option value="">Select Level</option>
                                        <option value="Beginner" {{ ($productData['level'] ?? '') === 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="Intermediate" {{ ($productData['level'] ?? '') === 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="Advanced" {{ ($productData['level'] ?? '') === 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                        <option value="Beginner to Advanced" {{ ($productData['level'] ?? '') === 'Beginner to Advanced' ? 'selected' : '' }}>Beginner to Advanced</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Duration</label>
                                    <input type="text"
                                           name="duration"
                                           value="{{ $productData['duration'] ?? '' }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200"
                                           placeholder="e.g. 42 hours">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Instructor</label>
                                    <select name="instructor" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200">
                                        <option value="">Select Instructor</option>
                                        @foreach($mentors as $mentor)
                                            <option value="{{ $mentor['name'] }}" {{ ($productData['instructor'] ?? '') === $mentor['name'] ? 'selected' : '' }}>
                                                {{ $mentor['name'] }} - {{ $mentor['specialization'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Features -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <span class="flex items-center justify-center w-8 h-8 bg-gray-400 text-white rounded-full mr-3 text-sm">2</span>
                            Product Features
                        </h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Features (one per line)</label>
                                <textarea rows="6"
                                          name="features"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200"
                                          placeholder="Enter product features, one per line">{{ implode("\n", $productData['features'] ?? []) }}</textarea>
                                <p class="text-xs text-gray-500 mt-2">Enter each feature on a new line</p>
                            </div>
                        </div>
                    </div>

                    <!-- Curriculum -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <span class="flex items-center justify-center w-8 h-8 bg-gray-400 text-white rounded-full mr-3 text-sm">3</span>
                            Curriculum
                        </h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Curriculum (one per line)</label>
                                <textarea rows="6"
                                          name="curriculum"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200"
                                          placeholder="Enter curriculum topics, one per line">{{ implode("\n", $productData['curriculum'] ?? []) }}</textarea>
                                <p class="text-xs text-gray-500 mt-2">Enter each curriculum topic on a new line</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Product Image -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Product Image</h3>
                        <div class="space-y-4">
                            <div class="relative group">
                                <img class="w-full h-48 object-cover rounded-lg"
                                     src="{{ $productData['image'] ?? 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80' }}"
                                     alt="Product image">
                                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-lg">
                                    <button type="button" class="bg-white text-gray-800 py-2 px-4 rounded-lg text-sm font-medium">
                                        <i class="fas fa-camera mr-2"></i>
                                        Change Image
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="w-full bg-white border border-gray-300 rounded-lg py-3 px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-200">
                                <i class="fas fa-upload mr-2"></i>
                                Upload New Image
                            </button>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Pricing</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Price (Rp)</label>
                                <input type="number"
                                       name="price"
                                       value="{{ $productData['price'] ?? '' }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200"
                                       placeholder="0">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Original Price (Rp)</label>
                                <input type="number"
                                       name="original_price"
                                       value="{{ $productData['original_price'] ?? '' }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200"
                                       placeholder="0">
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Status</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Product Status</label>
                                <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200">
                                    <option value="active" {{ ($productData['status'] ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ ($productData['status'] ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <div class="flex flex-col space-y-3">
                            <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 shadow-lg">
                                {{ isset($product) ? 'Update Product' : 'Create Product' }}
                            </button>
                            <a href="/admin/products" class="w-full bg-white hover:bg-gray-50 text-gray-700 font-medium py-3 px-4 rounded-lg border border-gray-300 text-center transition-colors duration-200">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
