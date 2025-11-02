@extends('admin.layouts.app')

@section('title', 'Bootcamps Management')
@section('header', 'Bootcamps Management')

@php
    // Load language file for bootcamp page
    $translations = include lang_path('id/bootcamp.php');
    $bootcamps = $translations['bootcamps'];
@endphp

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Bootcamps Management</h1>
                <p class="mt-2 text-sm text-gray-600">Manage and monitor all intensive bootcamp programs</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="/admin/bootcamps/create" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-200">
                    <i class="fas fa-plus mr-2 -ml-1"></i>
                    Add New Bootcamp
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
                            <i class="fas fa-campground text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Bootcamps</p>
                        <p class="text-2xl font-bold text-gray-900">{{ count($bootcamps) }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-sm">
                        <span class="font-medium text-green-600">15%</span>
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
                        <p class="text-2xl font-bold text-gray-900">{{ collect($bootcamps)->where('status', 'active')->count() }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-sm">
                        <span class="font-medium text-green-600">10%</span>
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
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Upcoming</p>
                        <p class="text-2xl font-bold text-gray-900">{{ collect($bootcamps)->where('status', 'upcoming')->count() }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-sm">
                        <span class="font-medium text-yellow-600">5%</span>
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
                        <p class="text-sm font-medium text-gray-500">Total Participants</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format(collect($bootcamps)->sum('enrolled'), 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center text-sm">
                        <span class="font-medium text-green-600">22%</span>
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
                           placeholder="Search bootcamps..."
                           class="w-full md:w-64 pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent bg-gray-50">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
                <select class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent bg-gray-50">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="upcoming">Upcoming</option>
                </select>
                <select class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent bg-gray-50">
                    <option value="">All Categories</option>
                    <option value="web-development">Web Development</option>
                    <option value="data-science">Data Science</option>
                    <option value="design">Design</option>
                    <option value="marketing">Marketing</option>
                    <option value="mobile-development">Mobile Development</option>
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

    <!-- Bootcamps Table -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden border-0">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Bootcamp
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Mentor
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Duration
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Start Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Enrolled
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($bootcamps as $bootcamp)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-lg object-cover" src="{{ $bootcamp['image'] }}" alt="{{ $bootcamp['title'] }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $bootcamp['title'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="{{ $bootcamp['mentor'] }}">
                                </div>
                                <div class="ml-2">
                                    <div class="text-sm font-medium text-gray-900">{{ $bootcamp['mentor'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $bootcamp['category'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $bootcamp['duration'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $bootcamp['start_date'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($bootcamp['price'], 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $bootcamp['enrolled'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($bootcamp['status'] === 'active')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Active
                                </span>
                            @elseif($bootcamp['status'] === 'upcoming')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Upcoming
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="/admin/bootcamps/{{ $bootcamp['id'] }}/edit" class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6 bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 rounded-lg shadow-lg">
        <div class="flex-1 flex justify-between sm:hidden">
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous
            </a>
            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next
            </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">{{ count($bootcamps) }}</span> of <span class="font-medium">{{ count($bootcamps) }}</span> results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <a href="#" aria-current="page" class="relative inline-flex items-center px-4 py-2 border border-primary bg-primary text-sm font-medium text-white">
                        1
                    </a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        2
                    </a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        3
                    </a>
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
