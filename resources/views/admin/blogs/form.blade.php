@extends('admin.layouts.app')

@php
    // Sample blog data for editing
    if (isset($blog)) {
        $blogData = [
            1 => [
                'id' => 1,
                'title' => 'Panduan Lengkap Belajar Web Development',
                'excerpt' => 'Pelajari langkah demi langkah cara menjadi web developer profesional dengan panduan komprehensif ini.',
                'author' => 'John Doe',
                'category' => 'Web Development',
                'status' => 'published',
                'views' => 1250,
                'date' => '2024-01-15',
                'image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
            ],
            2 => [
                'id' => 2,
                'title' => 'Tren Data Science di Indonesia 2024',
                'excerpt' => 'Analisis mendalam tentang perkembangan dan peluang karir di bidang data science di Indonesia.',
                'author' => 'Jane Smith',
                'category' => 'Data Science',
                'status' => 'published',
                'views' => 980,
                'date' => '2024-01-12',
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
            ],
            3 => [
                'id' => 3,
                'title' => 'Strategi Digital Marketing untuk Startup',
                'excerpt' => 'Tips dan trik efektif untuk membangun strategi digital marketing yang sukses untuk startup Anda.',
                'author' => 'Mike Johnson',
                'category' => 'Marketing',
                'status' => 'draft',
                'views' => 0,
                'date' => '2024-01-10',
                'image' => 'https://images.unsplash.com/photo-1557838923-2985c318be48?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
            ],
            4 => [
                'id' => 4,
                'title' => 'Prinsip Desain UI/UX Modern',
                'excerpt' => 'Pahami prinsip fundamental desain UI/UX yang akan membuat aplikasi Anda menonjol.',
                'author' => 'Sarah Williams',
                'category' => 'Design',
                'status' => 'published',
                'views' => 756,
                'date' => '2024-01-08',
                'image' => 'https://images.unsplash.com/photo-1559028006-44a26fcd9aee?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
            ]
        ];

        $currentBlog = $blogData[$blog] ?? null;
    }
@endphp

@section('title', isset($blog) ? 'Edit Blog' : 'Create New Blog')
@section('header', isset($blog) ? 'Edit Blog' : 'Create New Blog')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center">
            <a href="/admin/blogs" class="mr-4 text-gray-500 hover:text-gray-700 transition-colors duration-200">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ isset($blog) ? 'Edit Blog' : 'Create New Blog' }}</h1>
                <p class="mt-2 text-sm text-gray-600">{{ isset($blog) ? 'Update blog information and content' : 'Fill in the information to create a new blog post' }}</p>
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
                    Content & SEO
                </button>
                <button class="py-4 px-6 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Media & Images
                </button>
                <button class="py-4 px-6 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Publishing
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
                                <label class="block text-sm font-medium text-gray-700 mb-2">Blog Title</label>
                                <input type="text"
                                       name="title"
                                       value="{{ $currentBlog['title'] ?? '' }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200"
                                       placeholder="Enter an engaging title for your blog">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                                <textarea rows="3"
                                          name="excerpt"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200"
                                          placeholder="Write a brief summary of your blog post">{{ $currentBlog['excerpt'] ?? '' }}</textarea>
                                <p class="text-xs text-gray-500 mt-2">This will be displayed in blog listings and search results</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                    <select name="category" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200">
                                        <option value="">Select Category</option>
                                        <option value="Web Development" {{ ($currentBlog['category'] ?? '') === 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                        <option value="Data Science" {{ ($currentBlog['category'] ?? '') === 'Data Science' ? 'selected' : '' }}>Data Science</option>
                                        <option value="Marketing" {{ ($currentBlog['category'] ?? '') === 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                        <option value="Design" {{ ($currentBlog['category'] ?? '') === 'Design' ? 'selected' : '' }}>Design</option>
                                        <option value="Mobile Development" {{ ($currentBlog['category'] ?? '') === 'Mobile Development' ? 'selected' : '' }}>Mobile Development</option>
                                        <option value="Security" {{ ($currentBlog['category'] ?? '') === 'Security' ? 'selected' : '' }}>Security</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Author</label>
                                    <input type="text"
                                           name="author"
                                           value="{{ $currentBlog['author'] ?? '' }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200"
                                           placeholder="Author name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Editor -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <span class="flex items-center justify-center w-8 h-8 bg-gray-400 text-white rounded-full mr-3 text-sm">2</span>
                            Content Editor
                        </h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Blog Content</label>
                                <div class="border border-gray-300 rounded-lg overflow-hidden">
                                    <!-- Editor Toolbar -->
                                    <div class="bg-gray-50 border-b border-gray-300 px-4 py-2 flex items-center space-x-2">
                                        <button type="button" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-200 rounded">
                                            <i class="fas fa-bold"></i>
                                        </button>
                                        <button type="button" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-200 rounded">
                                            <i class="fas fa-italic"></i>
                                        </button>
                                        <button type="button" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-200 rounded">
                                            <i class="fas fa-underline"></i>
                                        </button>
                                        <div class="w-px h-6 bg-gray-300"></div>
                                        <button type="button" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-200 rounded">
                                            <i class="fas fa-list-ul"></i>
                                        </button>
                                        <button type="button" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-200 rounded">
                                            <i class="fas fa-list-ol"></i>
                                        </button>
                                        <div class="w-px h-6 bg-gray-300"></div>
                                        <button type="button" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-200 rounded">
                                            <i class="fas fa-link"></i>
                                        </button>
                                        <button type="button" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-200 rounded">
                                            <i class="fas fa-image"></i>
                                        </button>
                                        <button type="button" class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-200 rounded">
                                            <i class="fas fa-code"></i>
                                        </button>
                                    </div>
                                    <!-- Editor Content Area -->
                                    <textarea rows="12"
                                              name="content"
                                              class="w-full px-4 py-3 border-0 focus:outline-none focus:ring-0 resize-none"
                                              placeholder="Start writing your blog content here...">{{ $currentBlog['content'] ?? '' }}</textarea>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Use the toolbar to format your content or write in Markdown</p>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Settings -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <span class="flex items-center justify-center w-8 h-8 bg-gray-400 text-white rounded-full mr-3 text-sm">3</span>
                            SEO Settings
                        </h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">SEO Title</label>
                                <input type="text"
                                       name="seo_title"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200"
                                       placeholder="Enter SEO title (max 60 characters)"
                                       maxlength="60">
                                <p class="text-xs text-gray-500 mt-2">Optimal length: 50-60 characters</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                                <textarea rows="3"
                                          name="meta_description"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200"
                                          placeholder="Enter meta description (max 160 characters)"
                                          maxlength="160"></textarea>
                                <p class="text-xs text-gray-500 mt-2">Optimal length: 150-160 characters</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                                <input type="text"
                                       name="tags"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200"
                                       placeholder="Enter tags separated by commas">
                                <p class="text-xs text-gray-500 mt-2">Example: web development, tutorial, javascript</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Featured Image -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Featured Image</h3>
                        <div class="space-y-4">
                            <div class="relative group">
                                <img class="w-full h-48 object-cover rounded-lg"
                                     src="{{ $currentBlog['image'] ?? 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80' }}"
                                     alt="Featured image">
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

                    <!-- Publishing Options -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Publishing Options</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200">
                                    <option value="draft" {{ ($currentBlog['status'] ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ ($currentBlog['status'] ?? '') === 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="scheduled">Scheduled</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Publish Date</label>
                                <input type="datetime-local"
                                       name="publish_date"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Visibility</label>
                                <select name="visibility" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-colors duration-200">
                                    <option value="public">Public</option>
                                    <option value="private">Private</option>
                                    <option value="password">Password Protected</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Categories</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" name="categories[]" value="web-development">
                                <span class="ml-2 text-sm text-gray-700">Web Development</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" name="categories[]" value="data-science">
                                <span class="ml-2 text-sm text-gray-700">Data Science</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" name="categories[]" value="marketing">
                                <span class="ml-2 text-sm text-gray-700">Marketing</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary" name="categories[]" value="design">
                                <span class="ml-2 text-sm text-gray-700">Design</span>
                            </label>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <div class="flex flex-col space-y-3">
                            <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 shadow-lg">
                                {{ isset($blog) ? 'Update Blog' : 'Publish Blog' }}
                            </button>
                            <button type="button" class="w-full bg-white hover:bg-gray-50 text-gray-700 font-medium py-3 px-4 rounded-lg border border-gray-300 transition-colors duration-200">
                                Save as Draft
                            </button>
                            <a href="/admin/blogs" class="w-full bg-white hover:bg-gray-50 text-gray-700 font-medium py-3 px-4 rounded-lg border border-gray-300 text-center transition-colors duration-200">
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
