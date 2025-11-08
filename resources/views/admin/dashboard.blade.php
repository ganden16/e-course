@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Welcome Section with Gradient -->
    <div class="bg-gradient-to-r from-primary to-primary-dark rounded-2xl p-8 text-white shadow-xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Selamat Datang Kembali! 👋</h1>
                <p class="text-primary-100 text-lg">Dashboard Overview Healthcare Remote Circle</p>
                <p class="text-primary-200 text-sm mt-2">{{ now()->format('l, d F Y') }}</p>
            </div>
            <div class="hidden lg:block">
                <div class="bg-white/20 backdrop-blur-sm rounded-xl p-6">
                    <i class="fas fa-chart-line text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        @foreach($stats as $index => $stat)
        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-{{ $stat['color'] }}-400 to-{{ $stat['color'] }}-600 flex items-center justify-center shadow-lg">
                        <i class="{{ $stat['icon'] }} text-white text-xl"></i>
                    </div>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-medium mb-1">{{ $stat['title'] }}</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stat['value']) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Recent Activities & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Products -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800">Recent Products</h3>
                <a href="/admin/products" class="text-primary hover:text-primary-dark text-sm font-medium transition-colors">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="space-y-4">
                @foreach($recentProducts as $product)
                <a href="/admin/products/{{ $product->id }}/edit" class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors block">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-book text-white"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800">{{ $product->title }}</h4>
                        <p class="text-sm text-gray-600">{{ $product->productCategory->name ?? 'No Category' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold text-primary">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500">{{ $product->created_at->diffForHumans() }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-gradient-to-br from-orange to-orange-dark rounded-xl shadow-lg p-6 text-white border-2 border-orange/30">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold">Quick Actions</h3>
                <div class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1">
                    <i class="fas fa-bolt text-yellow-300"></i>
                </div>
            </div>
            <div class="space-y-4">
                <a href="/admin/products/create" class="flex items-center justify-between p-4 bg-white/25 backdrop-blur-sm rounded-xl hover:bg-white/40 transition-all duration-300 group border border-white/20 hover:border-white/40">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white/30 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-plus text-white text-lg"></i>
                        </div>
                        <span class="font-semibold text-white">Add Product</span>
                    </div>
                    <div class="bg-white/20 rounded-full p-2 group-hover:bg-white/30 transition-colors">
                        <i class="fas fa-arrow-right text-white text-sm"></i>
                    </div>
                </a>
                <a href="/admin/bootcamps/create" class="flex items-center justify-between p-4 bg-white/25 backdrop-blur-sm rounded-xl hover:bg-white/40 transition-all duration-300 group border border-white/20 hover:border-white/40">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white/30 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-graduation-cap text-white text-lg"></i>
                        </div>
                        <span class="font-semibold text-white">Create Bootcamp</span>
                    </div>
                    <div class="bg-white/20 rounded-full p-2 group-hover:bg-white/30 transition-colors">
                        <i class="fas fa-arrow-right text-white text-sm"></i>
                    </div>
                </a>
                <a href="/admin/blogs/create" class="flex items-center justify-between p-4 bg-white/25 backdrop-blur-sm rounded-xl hover:bg-white/40 transition-all duration-300 group border border-white/20 hover:border-white/40">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white/30 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-pen-to-square text-white text-lg"></i>
                        </div>
                        <span class="font-semibold text-white">Write Blog</span>
                    </div>
                    <div class="bg-white/20 rounded-full p-2 group-hover:bg-white/30 transition-colors">
                        <i class="fas fa-arrow-right text-white text-sm"></i>
                    </div>
                </a>
                <a href="/admin/mentors/create" class="flex items-center justify-between p-4 bg-white/25 backdrop-blur-sm rounded-xl hover:bg-white/40 transition-all duration-300 group border border-white/20 hover:border-white/40">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white/30 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-user-plus text-white text-lg"></i>
                        </div>
                        <span class="font-semibold text-white">Add Mentor</span>
                    </div>
                    <div class="bg-white/20 rounded-full p-2 group-hover:bg-white/30 transition-colors">
                        <i class="fas fa-arrow-right text-white text-sm"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Bootcamps & Blogs -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Bootcamps -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800">Recent Bootcamps</h3>
                <a href="/admin/bootcamps" class="text-primary hover:text-primary-dark text-sm font-medium transition-colors">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="space-y-4">
                @foreach($recentBootcamps as $bootcamp)
                <a href="/admin/bootcamps/{{ $bootcamp->id }}/edit" class="flex items-center space-x-4 p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors block">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-campground text-white"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800">{{ $bootcamp->title }}</h4>
                        <p class="text-sm text-gray-600">{{ $bootcamp->category->name ?? 'No Category' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-purple-600">{{ $bootcamp->duration ?? 'N/A' }} days</p>
                        <p class="text-xs text-gray-500">{{ $bootcamp->created_at->diffForHumans() }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Recent Blogs -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800">Recent Blogs</h3>
                <a href="/admin/blogs" class="text-primary hover:text-primary-dark text-sm font-medium transition-colors">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="space-y-4">
                @foreach($recentBlogs as $blog)
                <a href="/admin/blogs/{{ $blog->id }}/edit" class="flex items-start space-x-4 p-4 bg-pink-50 rounded-lg hover:bg-pink-100 transition-colors block">
                    <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-pink-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-blog text-white"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 line-clamp-2">{{ $blog->title }}</h4>
                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ Str::limit($blog->content, 100) }}</p>
                        <div class="flex items-center mt-2 text-xs text-gray-500">
                            <i class="fas fa-clock mr-1"></i>
                            {{ $blog->created_at->diffForHumans() }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
