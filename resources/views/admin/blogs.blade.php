@php
    $data = json_decode(file_get_contents(resource_path('json/admin-data.json')), true);
    $blogs = $data['blogs'];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Blog - EduTech Academy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#3b82f6',
                        'primary-dark': '#1e40af',
                        'secondary': '#10b981',
                        'accent': '#f59e0b',
                        'dark': '#1f2937',
                        'sidebar': '#1e293b',
                        'sidebar-hover': '#334155',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50" x-data="{ sidebarOpen: false, showCreateModal: false, showEditModal: false, selectedBlog: null }">
    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 lg:hidden"
         @click="sidebarOpen = false">
        <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
    </div>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-y-0 left-0 z-50 w-64 bg-sidebar text-white lg:static lg:inset-0 lg:transform-none lg:translate-x-0">
            <div class="flex items-center justify-between h-16 px-6 bg-sidebar border-b border-gray-700">
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-2xl text-primary mr-3"></i>
                    <span class="text-xl font-bold">EduTech Admin</span>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <nav class="mt-6 px-3">
                <div class="space-y-1">
                    <a href="/admin/dashboard" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:bg-sidebar-hover hover:text-white transition-colors duration-200">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="/admin/users" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:bg-sidebar-hover hover:text-white transition-colors duration-200">
                        <i class="fas fa-users mr-3"></i>
                        Manajemen User
                    </a>
                    <a href="/admin/products" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:bg-sidebar-hover hover:text-white transition-colors duration-200">
                        <i class="fas fa-book mr-3"></i>
                        Manajemen Produk
                    </a>
                    <a href="/admin/bootcamps" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:bg-sidebar-hover hover:text-white transition-colors duration-200">
                        <i class="fas fa-campground mr-3"></i>
                        Manajemen Bootcamp
                    </a>
                    <a href="/admin/mentors" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:bg-sidebar-hover hover:text-white transition-colors duration-200">
                        <i class="fas fa-chalkboard-teacher mr-3"></i>
                        Manajemen Mentor
                    </a>
                    <a href="/admin/blogs" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg bg-primary text-white">
                        <i class="fas fa-blog mr-3"></i>
                        Manajemen Blog
                    </a>
                    <a href="/admin/settings" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:bg-sidebar-hover hover:text-white transition-colors duration-200">
                        <i class="fas fa-cog mr-3"></i>
                        Pengaturan
                    </a>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-700">
                    <a href="/logout" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:bg-sidebar-hover hover:text-white transition-colors duration-200">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Logout
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true" class="lg:hidden text-gray-500 hover:text-gray-600 focus:outline-none">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="ml-4 lg:ml-0 text-2xl font-semibold text-gray-800">Manajemen Blog</h1>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button @click="showCreateModal = true" 
                                class="bg-primary hover:bg-primary-dark text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Tulis Blog Baru
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                <div class="container mx-auto px-6 py-8">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Blog</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ count($blogs) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Published</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ collect($blogs)->where('status', 'published')->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-lg bg-yellow-100 flex items-center justify-center">
                                        <i class="fas fa-edit text-yellow-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Draft</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ collect($blogs)->where('status', 'draft')->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                                        <i class="fas fa-eye text-purple-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Total Views</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ number_format(collect($blogs)->sum('views'), 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search and Filter -->
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 mb-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                                <div class="relative">
                                    <input type="text" 
                                           placeholder="Cari blog..." 
                                           class="w-full md:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option value="">Semua Status</option>
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option value="">Semua Kategori</option>
                                    <option value="web-development">Web Development</option>
                                    <option value="data-science">Data Science</option>
                                    <option value="marketing">Marketing</option>
                                    <option value="design">Design</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Table -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Blog
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Author
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kategori
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Views
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($blogs as $blog)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-lg object-cover" 
                                                         src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80" 
                                                         alt="{{ $blog['title'] }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $blog['title'] }}</div>
                                                    <div class="text-sm text-gray-500">{{ Str::limit($blog['excerpt'], 50) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <img class="h-8 w-8 rounded-full" 
                                                         src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" 
                                                         alt="{{ $blog['author'] }}">
                                                </div>
                                                <div class="ml-2">
                                                    <div class="text-sm font-medium text-gray-900">{{ $blog['author'] }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $blog['category'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($blog['status'] === 'published')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Published
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Draft
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ number_format($blog['views'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $blog['date'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <button @click="selectedBlog = {{ json_encode($blog) }}; showEditModal = true" 
                                                    class="text-primary hover:text-primary-dark mr-3">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Create Blog Modal -->
    <div x-show="showCreateModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto"
         @click.self="showCreateModal = false">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Tulis Blog Baru</h3>
                    </div>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Blog</label>
                            <input type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                   placeholder="Masukkan judul blog">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option>Web Development</option>
                                    <option>Data Science</option>
                                    <option>Marketing</option>
                                    <option>Design</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                            <textarea rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                      placeholder="Masukkan excerpt blog"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konten</label>
                            <textarea rows="8" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                      placeholder="Masukkan konten blog"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="h-20 w-20 object-cover rounded-lg" 
                                         src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80" 
                                         alt="Featured image">
                                </div>
                                <button type="button" 
                                        class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    Upload Image
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" 
                            @click="showCreateModal = false"
                            class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan
                    </button>
                    <button type="button" 
                            @click="showCreateModal = false"
                            class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Blog Modal -->
    <div x-show="showEditModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto"
         @click.self="showEditModal = false">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Edit Blog</h3>
                    </div>
                    <form class="space-y-4" x-show="selectedBlog">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Blog</label>
                            <input type="text" 
                                   x-model="selectedBlog.title"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option>Web Development</option>
                                    <option>Data Science</option>
                                    <option>Marketing</option>
                                    <option>Design</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                            <textarea rows="3" 
                                      x-model="selectedBlog.excerpt"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konten</label>
                            <textarea rows="8" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                      placeholder="Masukkan konten blog"></textarea>
                        </div>
                    </form>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" 
                            @click="showEditModal = false"
                            class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm">
                        Update
                    </button>
                    <button type="button" 
                            @click="showEditModal = false"
                            class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>