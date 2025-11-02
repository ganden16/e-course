@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@php
    $data = json_decode(file_get_contents(resource_path('json/admin-data.json')), true);
    $dashboard = $data['dashboard'];
    $stats = $dashboard['stats'];
    $recentActivities = $dashboard['recentActivities'];
@endphp

@section('content')
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
                    <span class="text-xl font-bold">HealthCare Admin</span>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <nav class="mt-6 px-3">
                <div class="space-y-1">
                    <a href="/admin/dashboard" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg bg-primary text-white">
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
                    <a href="/admin/blogs" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:bg-sidebar-hover hover:text-white transition-colors duration-200">
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
                        <h1 class="ml-4 lg:ml-0 text-2xl font-semibold text-gray-800">Dashboard</h1>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Search -->
                        <div class="hidden md:block">
                            <div class="relative">
                                <input type="text"
                                       placeholder="Search..."
                                       class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
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
                                    class="flex items-center space-x-3 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
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
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                <div class="container mx-auto px-6 py-8">
                    <!-- Welcome Section -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-800">Selamat datang kembali, Admin!</h2>
                        <p class="text-gray-600">Berikut adalah ringkasan aktivitas platform e-learning Anda.</p>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                        @foreach($stats as $stat)
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">{{ $stat['title'] }}</p>
                                    <p class="text-2xl font-bold text-gray-900 mt-2">{{ $stat['value'] }}</p>
                                    <div class="flex items-center mt-2">
                                        @if($stat['changeType'] === 'increase')
                                            <i class="fas fa-arrow-up text-green-500 text-xs mr-1"></i>
                                            <span class="text-xs font-medium text-green-500">{{ $stat['change'] }}</span>
                                        @else
                                            <i class="fas fa-arrow-down text-red-500 text-xs mr-1"></i>
                                            <span class="text-xs font-medium text-red-500">{{ $stat['change'] }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-lg bg-{{ $stat['color'] }}-100 flex items-center justify-center">
                                        <i class="{{ $stat['icon'] }} text-{{ $stat['color'] }}-600 text-xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Charts Row -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <!-- Revenue Chart -->
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pendapatan Bulanan</h3>
                            <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                                <div class="text-center">
                                    <i class="fas fa-chart-line text-4xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-500">Grafik pendapatan akan ditampilkan di sini</p>
                                </div>
                            </div>
                        </div>

                        <!-- User Growth Chart -->
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pertumbuhan User</h3>
                            <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                                <div class="text-center">
                                    <i class="fas fa-chart-bar text-4xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-500">Grafik pertumbuhan user akan ditampilkan di sini</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activities & Quick Actions -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Recent Activities -->
                        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terkini</h3>
                            <div class="space-y-4">
                                @foreach($recentActivities as $activity)
                                <div class="flex items-start space-x-3">
                                    <img class="h-8 w-8 rounded-full"
                                         src="{{ $activity['avatar'] }}"
                                         alt="{{ $activity['user'] }}">
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-800">
                                            <span class="font-medium">{{ $activity['user'] }}</span>
                                            <span class="text-gray-600"> {{ $activity['action'] }} </span>
                                            <span class="font-medium">{{ $activity['target'] }}</span>
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $activity['time'] }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-4 text-center">
                                <a href="/admin/activities" class="text-sm font-medium text-primary hover:text-primary-dark transition-colors duration-200">
                                    Lihat semua aktivitas <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                            <div class="space-y-3">
                                <a href="/admin/products/create" class="flex items-center justify-between p-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors duration-200">
                                    <div class="flex items-center">
                                        <i class="fas fa-plus mr-3"></i>
                                        <span class="text-sm font-medium">Tambah Produk</span>
                                    </div>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <a href="/admin/bootcamps/create" class="flex items-center justify-between p-3 bg-secondary text-white rounded-lg hover:bg-secondary-dark transition-colors duration-200">
                                    <div class="flex items-center">
                                        <i class="fas fa-plus mr-3"></i>
                                        <span class="text-sm font-medium">Tambah Bootcamp</span>
                                    </div>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <a href="/admin/mentors/create" class="flex items-center justify-between p-3 bg-accent text-white rounded-lg hover:bg-orange-600 transition-colors duration-200">
                                    <div class="flex items-center">
                                        <i class="fas fa-user-plus mr-3"></i>
                                        <span class="text-sm font-medium">Tambah Mentor</span>
                                    </div>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <a href="/admin/blogs/create" class="flex items-center justify-between p-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200">
                                    <div class="flex items-center">
                                        <i class="fas fa-pen mr-3"></i>
                                        <span class="text-sm font-medium">Tulis Blog</span>
                                    </div>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
