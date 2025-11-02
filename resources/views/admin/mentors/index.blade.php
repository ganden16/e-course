@extends('admin.layouts.app')

@section('title', 'Mentors Management')
@section('header', 'Mentors Management')

@php
    // Load language files for products and bootcamps
    $productData = include lang_path('id/product.php');
    $bootcampData = include lang_path('id/bootcamp.php');

    $mentors = [];

    // Extract mentors from products
    foreach ($productData['products'] as $product) {
        $mentors[] = [
            'id' => count($mentors) + 1,
            'name' => $product['instructor'],
            'email' => strtolower(str_replace(' ', '.', $product['instructor'])) . '@healthcare.com',
            'specialization' => $product['category'],
            'rating' => $product['rating'],
            'students' => $product['enrolled'],
            'courses' => 1,
            'bootcamps' => 0,
            'status' => $product['status'],
            'joined_date' => '2023-01-15',
            'avatar' => 'https://images.unsplash.com/photo-' . rand(1472099645, 1579076445) . '?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80'
        ];
    }

    // Extract mentors from bootcamps
    foreach ($bootcampData['bootcamps'] as $bootcamp) {
        if ($bootcamp['mentor'] !== 'Not Assigned') {
            $existingMentor = null;
            foreach ($mentors as $index => $mentor) {
                if ($mentor['name'] === $bootcamp['mentor']) {
                    $existingMentor = $index;
                    break;
                }
            }

            if ($existingMentor !== null) {
                $mentors[$existingMentor]['bootcamps']++;
                $mentors[$existingMentor]['students'] += $bootcamp['enrolled'];
            } else {
                $mentors[] = [
                    'id' => count($mentors) + 1,
                    'name' => $bootcamp['mentor'],
                    'email' => strtolower(str_replace(' ', '.', $bootcamp['mentor'])) . '@healthcare.com',
                    'specialization' => $bootcamp['category'],
                    'rating' => 4.5 + (rand(0, 10) / 10),
                    'students' => $bootcamp['enrolled'],
                    'courses' => 0,
                    'bootcamps' => 1,
                    'status' => $bootcamp['status'],
                    'joined_date' => '2023-01-15',
                    'avatar' => 'https://images.unsplash.com/photo-' . rand(1472099645, 1579076445) . '?ixlib=rb-4.0.3&auto=format&fit=crop&w=1170&q=80'
                ];
            }
        }
    }

@endphp

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Mentors Management</h1>
                <p class="mt-2 text-sm text-gray-600">Manage and monitor all expert mentors and instructors</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="/admin/mentors/create" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-200">
                    <i class="fas fa-plus mr-2 -ml-1"></i>
                    Add New Mentor
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white overflow-hidden shadow-lg rounded-xl border-0 border-gray-200">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Mentors</p>
                        <p class="text-2xl font-bold text-gray-900">{{ count($mentors) }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-sm">
                        <span class="font-medium text-green-600">8%</span>
                        <span class="text-gray-500 ml-2">from last month</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-xl border-0 border-gray-200">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Active</p>
                        <p class="text-2xl font-bold text-gray-900">{{ collect($mentors)->where('status', 'active')->count() }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-sm">
                        <span class="font-medium text-green-600">12%</span>
                        <span class="text-gray-500 ml-2">from last month</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-xl border-0 border-gray-200">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-pause-circle text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Inactive</p>
                        <p class="text-2xl font-bold text-gray-900">{{ collect($mentors)->where('status', 'inactive')->count() }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-sm">
                        <span class="font-medium text-red-600">2%</span>
                        <span class="text-gray-500 ml-2">from last month</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-xl border-0 border-gray-200">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-users text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Students</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format(collect($mentors)->sum('students'), 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-sm">
                        <span class="font-medium text-green-600">25%</span>
                        <span class="text-gray-500 ml-2">from last month</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border-0">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 w-full lg:w-auto">
                <div class="relative">
                    <input type="text"
                           placeholder="Search mentors..."
                           class="w-full md:w-64 pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent bg-gray-50">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
                <select class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent bg-gray-50">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <select class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent bg-gray-50">
                    <option value="">All Specializations</option>
                    <option value="web-development">Web Development</option>
                    <option value="data-science">Data Science</option>
                    <option value="marketing">Marketing</option>
                    <option value="ui-ux-design">UI/UX Design</option>
                </select>
            </div>
            <div class="flex space-x-3">
                <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <i class="fas fa-filter mr-2"></i>
                    More Filters
                </button>
            </div>
        </div>
    </div>

    <!-- Mentors Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($mentors as $mentor)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border-0 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="relative">
                <img class="h-48 w-full object-cover" src="{{ $mentor['avatar'] }}" alt="{{ $mentor['name'] }}">
                <div class="absolute top-0 right-0 m-3">
                    @if($mentor['status'] === 'active')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Inactive
                        </span>
                    @endif
                </div>
                <div class="absolute top-0 left-0 m-3">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $mentor['specialization'] }}
                    </span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $mentor['name'] }}</h3>
                <div class="flex items-center text-sm text-gray-500 mb-2">
                    <i class="fas fa-envelope mr-2"></i>
                    <span class="truncate">{{ $mentor['email'] }}</span>
                </div>
                <div class="flex items-center text-sm text-gray-500 mb-4">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <span>Joined: {{ $mentor['joined_date'] }}</span>
                </div>
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400 mr-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($mentor['rating']))
                                <i class="fas fa-star text-sm"></i>
                            @elseif($i - 0.5 <= $mentor['rating'])
                                <i class="fas fa-star-half-alt text-sm"></i>
                            @else
                                <i class="far fa-star text-sm"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="text-sm text-gray-600">{{ $mentor['rating'] }} rating</span>
                </div>
                <div class="grid grid-cols-3 gap-2 mb-4 text-center">
                    <div class="bg-gray-50 rounded-lg p-2">
                        <p class="text-xs text-gray-500">Students</p>
                        <p class="text-sm font-semibold">{{ $mentor['students'] }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-2">
                        <p class="text-xs text-gray-500">Courses</p>
                        <p class="text-sm font-semibold">{{ $mentor['courses'] }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-2">
                        <p class="text-xs text-gray-500">Bootcamps</p>
                        <p class="text-sm font-semibold">{{ $mentor['bootcamps'] }}</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="/admin/mentors/{{ $mentor['id'] }}/edit" class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        <i class="fas fa-edit mr-1"></i>
                        Edit
                    </a>
                    <button class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="fas fa-trash mr-1"></i>
                        Delete
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Showing <span class="font-medium">1</span> to <span class="font-medium">{{ count($mentors) }}</span> of <span class="font-medium">{{ count($mentors) }}</span> results
        </div>
        <div class="flex items-center space-x-2">
            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous
            </button>
            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next
            </button>
        </div>
    </div>
</div>
@endsection
