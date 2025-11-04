@php
    $data = include lang_path('id/admin.php');
    $dashboard = $data['dashboard'];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Healthcare Remote Circle</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#009b77',
                        'primary-dark': '#174e47',
                        'secondary': '#ffb433',
                        'accent': '#ffb433',
                        'dark': '#1f2937',
                        'sidebar': '#1e293b',
                        'sidebar-hover': '#334155',
                        'orange': '#ffb433',
                        'orange-dark': '#ff9500',
                        'beige': '#fcf8ef',
                    }
                }
            }
        }
    </script>

    <style>
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        .slide-in {
            animation: slideIn 0.3s ease-out;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #009b77 0%, #174e47 100%);
        }
        .gradient-orange {
            background: linear-gradient(135deg, #ffb433 0%, #ff9500 100%);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-beige" x-data="{ sidebarOpen: false }">
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
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-primary to-primary-dark text-white lg:static lg:inset-0 transform lg:transform-none shadow-2xl">

            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-6 bg-gradient-to-r from-primary to-primary-dark border-b border-gray-700">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-graduation-cap text-2xl text-primary"></i>
                    </div>
                    <div>
                        <span class="text-xl font-bold">HRC</span>
                        <p class="text-xs text-gray-300">Admin Panel</p>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- User Profile in Sidebar -->
            <div class="px-6 py-4 border-b border-gray-700">
                <div class="flex items-center">
                    <img class="h-10 w-10 rounded-full border-2 border-gray-600"
                         src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                         alt="Admin">
                    <div class="ml-3">
                        <p class="text-sm font-medium">Admin User</p>
                        <p class="text-xs text-gray-400">admin@healthcare.com</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6 px-3">
                <div class="space-y-1">
                    <a href="/admin/dashboard" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/dashboard') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-tachometer-alt mr-3 {{ request()->is('admin/dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Dashboard</span>
                        @if(request()->is('admin/dashboard'))
                            <span class="ml-auto bg-white text-primary text-xs px-2 py-1 rounded-full">Active</span>
                        @endif
                    </a>

                    <!-- Content Management Section -->
                    <div class="pt-4 pb-2">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Content Management</p>
                    </div>

                    <a href="/admin/products" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/products*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-book mr-3 {{ request()->is('admin/products*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Products</span>
                        @if(request()->is('admin/products*'))
                            <span class="ml-auto bg-white text-primary text-xs px-2 py-1 rounded-full">Active</span>
                        @endif
                    </a>

                    <a href="/admin/product-categories" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/product-categories*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-tags mr-3 {{ request()->is('admin/product-categories*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Product Categories</span>
                        @if(request()->is('admin/product-categories*'))
                            <span class="ml-auto bg-white text-primary text-xs px-2 py-1 rounded-full">Active</span>
                        @endif
                    </a>

                    <a href="/admin/bootcamps" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/bootcamps*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-campground mr-3 {{ request()->is('admin/bootcamps*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Bootcamps</span>
                        @if(request()->is('admin/bootcamps*'))
                            <span class="ml-auto bg-white text-primary text-xs px-2 py-1 rounded-full">Active</span>
                        @endif
                    </a>

                    <a href="/admin/blogs" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/blogs*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-blog mr-3 {{ request()->is('admin/blogs*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Blogs</span>
                        @if(request()->is('admin/blogs*'))
                            <span class="ml-auto bg-white text-primary text-xs px-2 py-1 rounded-full">Active</span>
                        @endif
                    </a>

                    <a href="/admin/categories" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/categories*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-folder mr-3 {{ request()->is('admin/categories*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Categories</span>
                        @if(request()->is('admin/categories*'))
                            <span class="ml-auto bg-white text-primary text-xs px-2 py-1 rounded-full">Active</span>
                        @endif
                    </a>

                    <!-- People Management Section -->
                    <div class="pt-4 pb-2">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">People Management</p>
                    </div>

                    <a href="/admin/users" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/users*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-users mr-3 {{ request()->is('admin/users*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Users</span>
                        @if(request()->is('admin/users*'))
                            <span class="ml-auto bg-white text-primary text-xs px-2 py-1 rounded-full">Active</span>
                        @endif
                    </a>

                    <a href="/admin/mentors" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/mentors*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-chalkboard-teacher mr-3 {{ request()->is('admin/mentors*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Mentors</span>
                        @if(request()->is('admin/mentors*'))
                            <span class="ml-auto bg-white text-primary text-xs px-2 py-1 rounded-full">Active</span>
                        @endif
                    </a>

                    <!-- System Section -->
                    <div class="pt-4 pb-2">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">System</p>
                    </div>

                    <a href="/admin/settings" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/settings*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-cog mr-3 {{ request()->is('admin/settings*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Settings</span>
                        @if(request()->is('admin/settings*'))
                            <span class="ml-auto bg-white text-primary text-xs px-2 py-1 rounded-full">Active</span>
                        @endif
                    </a>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-700">
                    <a href="/logout" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:bg-orange hover:text-white transition-all duration-200 group">
                        <i class="fas fa-sign-out-alt mr-3 text-gray-400 group-hover:text-white transition-colors duration-200"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </nav>

            <!-- Sidebar Footer -->
            <div class="absolute bottom-0 left-0 right-0 p-4">
                <div class="flex items-center justify-between text-xs text-gray-400">
                    <span>Version 1.0.0</span>
                    <span>© 2024 Healthcare Remote Circle</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-md text-gray-500 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="ml-4 lg:ml-0 text-2xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h1>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Search -->
                        <div class="hidden md:block">
                            <div class="relative">
                                <input type="text"
                                       placeholder="Search..."
                                       class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Notifications -->
                        <div class="relative" x-data="{ notificationOpen: false }">
                            <button @click="notificationOpen = !notificationOpen"
                                    class="relative p-2 text-gray-400 hover:text-gray-600 focus:outline-none">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400"></span>
                            </button>

                            <div x-show="notificationOpen"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 @click.away="notificationOpen = false"
                                 class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg py-2 z-50">
                                <div class="px-4 py-2 border-b border-gray-200">
                                    <h3 class="text-sm font-semibold text-gray-800">Notifikasi</h3>
                                </div>
                                <div class="max-h-64 overflow-y-auto">
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 transition-colors duration-200">
                                        <p class="text-sm text-gray-800">User baru mendaftar: John Doe</p>
                                        <p class="text-xs text-gray-500 mt-1">2 menit yang lalu</p>
                                    </a>
                                    <a href="#" class="block px-4 py-3 hover:bg-gray-50 transition-colors duration-200">
                                        <p class="text-sm text-gray-800">Pesanan baru: #12345</p>
                                        <p class="text-xs text-gray-500 mt-1">15 menit yang lalu</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- User Profile -->
                        <div class="relative" x-data="{ profileOpen: false }">
                            <button @click="profileOpen = !profileOpen"
                                    class="flex items-center space-x-3 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange">
                                <img class="h-8 w-8 rounded-full"
                                     src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                     alt="Admin">
                                <span class="hidden md:block font-medium text-gray-700">Admin User</span>
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </button>

                            <div x-show="profileOpen"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 @click.away="profileOpen = false"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                                <a href="/admin/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <i class="fas fa-user mr-2"></i> Profile
                                </a>
                                <a href="/admin/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <i class="fas fa-cog mr-2"></i> Settings
                                </a>
                                <div class="border-t border-gray-200 mt-2 pt-2">
                                    <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-beige">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
