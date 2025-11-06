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
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo1.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
             class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-primary to-primary-dark text-white lg:static lg:inset-0 transform lg:transform-none shadow-2xl flex flex-col">

            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-6 bg-gradient-to-r from-primary to-primary-dark border-b border-gray-700">
                <a href="{{ route('home', app()->getLocale()) }}" class="flex items-center">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-graduation-cap text-2xl text-primary"></i>
                    </div>
                    <div>
                        <span class="text-xl font-bold">HRC</span>
                        <p class="text-xs text-gray-300">Admin Panel</p>
                    </div>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- User Profile in Sidebar -->
            <div class="px-6 py-4 border-b border-gray-700">
                <div class="flex items-center">
                    <img class="h-10 w-10 rounded-full border-2 border-gray-600"
                         src="{{ auth()->user()->image ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=7F9CF5&background=EBF4FF' }}"
                         alt="{{ auth()->user()->name }}">
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6 px-3 overflow-y-auto flex-1">
                <div class="space-y-1 whitespace-nowrap">
                    <a href="/admin/dashboard" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/dashboard') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-tachometer-alt mr-3 {{ request()->is('admin/dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Dashboard</span>
                    </a>

                    <!-- Content Management Section -->
                    <div class="pt-4 pb-2">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Content Management</p>
                    </div>

                    <a href="/admin/bootcamps" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/bootcamps*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-campground mr-3 {{ request()->is('admin/bootcamps*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Bootcamps</span>
                    </a>

                    <a href="/admin/categories" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/categories*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-folder mr-3 {{ request()->is('admin/categories*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Bootcamp Categories</span>
                    </a>

                    <a href="/admin/products" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/products*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-book mr-3 {{ request()->is('admin/products*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Products</span>
                    </a>

                    <a href="/admin/product-categories" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/product-categories*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-tags mr-3 {{ request()->is('admin/product-categories*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Product Categories</span>
                    </a>

                    <a href="/admin/blogs" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/blogs*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-blog mr-3 {{ request()->is('admin/blogs*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Blogs</span>
                    </a>

                    <a href="/admin/blog-tags" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/blog-tags*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-tags mr-3 {{ request()->is('admin/blog-tags*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Blog Tags</span>
                    </a>


                    <!-- People Management Section -->
                    <div class="pt-4 pb-2">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">People Management</p>
                    </div>

                    <a href="/admin/admins" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/admins*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-users mr-3 {{ request()->is('admin/admins*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Admins</span>
                    </a>

                    <a href="/admin/mentors" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/mentors*') ? 'bg-orange text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-all duration-200 group">
                        <i class="fas fa-chalkboard-teacher mr-3 {{ request()->is('admin/mentors*') ? 'text-white' : 'text-gray-400 group-hover:text-white' }} transition-colors duration-200"></i>
                        <span>Mentors</span>
                    </a>

                </div>

                <div class="mt-auto pt-6 border-t border-gray-700">
                    <button onclick="showLogoutModal()" class="w-full flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:bg-orange hover:text-white transition-all duration-200 group">
                        <i class="fas fa-sign-out-alt mr-3 text-gray-400 group-hover:text-white transition-colors duration-200"></i>
                        <span>Logout</span>
                    </button>
                </div>
            </nav>

            <!-- Sidebar Footer -->
            {{-- <div class="absolute bottom-0 left-32 right-0 p-4">
                <div class="flex items-center justify-center text-xs text-gray-400">
                    <span class="mr-2">Version 1.0.0</span>
                    <span>© 2025 Healthcare Remote Circle</span>
                </div>
            </div> --}}
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

                        <!-- User Profile -->
                        <div class="relative" x-data="{ profileOpen: false }">
                            <button @click="profileOpen = !profileOpen"
                                    class="flex items-center space-x-3 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange">
                                <img class="h-8 w-8 rounded-full"
                                     src="{{ auth()->user()->image ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=7F9CF5&background=EBF4FF' }}"
                                     alt="{{ auth()->user()->name }}">
                                <span class="hidden md:block font-medium text-gray-700">{{ auth()->user()->name }}</span>
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
                                <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <i class="fas fa-user mr-2"></i> Profile
                                </a>
                                <div class="border-t border-gray-200 mt-2 pt-2">
                                    <button onclick="showLogoutModal()" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-beige">
                <!-- Flash Messages -->
                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('info'))
                    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm">{{ session('info') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="fixed inset-0 z-[9999] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="hideLogoutModal()"></div>

        <!-- Modal container - centered -->
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full transform transition-all">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900" id="modal-title">
                                Konfirmasi Logout
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin keluar dari sistem?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-3 flex flex-row-reverse gap-3">
                    <form action="{{ route('logout') }}" method="POST" class="inline-flex">
                        @csrf
                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Ya, Logout
                        </button>
                    </form>
                    <button type="button" onclick="hideLogoutModal()" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function hideLogoutModal() {
            const modal = document.getElementById('logoutModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    </script>

    @stack('scripts')
</body>
</html>
