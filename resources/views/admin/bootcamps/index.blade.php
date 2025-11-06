@extends('admin.layouts.app')

@section('title', 'Bootcamps Management')
@section('header', 'Bootcamps Management')

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
                <a href="{{ route('admin.bootcamps.create') }}" class="inline-flex items-center px-4 py-2 bg-orange border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:bg-orange-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange transition-colors duration-200">
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
                        <div class="w-12 h-12 bg-gradient-to-br from-orange to-orange-dark rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-campground text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Bootcamps</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $bootcamps->total() }}</p>
                    </div>
                </div>
                {{-- <div class="mt-4">
                    <div class="flex items-center text-sm">
                        <span class="font-medium text-green-600">15%</span>
                        <span class="text-gray-500 ml-2">from last month</span>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-xl border-0 border-gray-200">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary to-primary-dark rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Active</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $bootcamps->where('is_active', true)->count() }}</p>
                    </div>
                </div>
                {{-- <div class="mt-4">
                    <div class="flex items-center text-sm">
                        <span class="font-medium text-green-600">10%</span>
                        <span class="text-gray-500 ml-2">from last month</span>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-xl border-0 border-gray-200">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange to-orange-dark rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Students</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($bootcamps->sum('students'), 0, ',', '.') }}</p>
                    </div>
                </div>
                {{-- <div class="mt-4">
                    <div class="flex items-center text-sm">
                        <span class="font-medium text-yellow-600">5%</span>
                        <span class="text-gray-500 ml-2">from last month</span>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-xl border-0 border-gray-200">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary to-primary-dark rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-star text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Avg Rating</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($bootcamps->avg('rating') ?? 0, 1) }}</p>
                    </div>
                </div>
                {{-- <div class="mt-4">
                    <div class="flex items-center text-sm">
                        <span class="font-medium text-green-600">22%</span>
                        <span class="text-gray-500 ml-2">from last month</span>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    {{-- <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border-0">
        <form action="{{ route('admin.bootcamps') }}" method="GET" class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 w-full lg:w-auto">
                <div class="relative">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search bootcamps..."
                           class="w-full md:w-64 pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent bg-gray-50">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
                <select name="status" class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent bg-gray-50">
                    <option value="">All Status</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                <select name="category" class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent bg-gray-50">
                    <option value="">All Categories</option>
                    <option value="web-development" {{ request('category') == 'web-development' ? 'selected' : '' }}>Web Development</option>
                    <option value="data-science" {{ request('category') == 'data-science' ? 'selected' : '' }}>Data Science</option>
                    <option value="design" {{ request('category') == 'design' ? 'selected' : '' }}>Design</option>
                    <option value="marketing" {{ request('category') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                    <option value="mobile-development" {{ request('category') == 'mobile-development' ? 'selected' : '' }}>Mobile Development</option>
                </select>
            </div>
            <div class="flex space-x-3">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange">
                    <i class="fas fa-filter mr-2"></i>
                    Filter
                </button>
                <a href="{{ route('admin.bootcamps') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange">
                    <i class="fas fa-times mr-2"></i>
                    Clear
                </a>
            </div>
        </form>
    </div> --}}

    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg shadow-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

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
                            Mentors
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
                            Students
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
                    @forelse($bootcamps as $bootcamp)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if($bootcamp->image)
                                        <img class="h-10 w-10 rounded-lg object-cover" src="{{ $bootcamp->image}}" alt="{{ $bootcamp->title }}">
                                    @else
                                        <div class="h-10 w-10 rounded-lg bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $bootcamp->title }}</div>
                                    <div class="text-sm text-gray-500">{{ $bootcamp->level }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @if($bootcamp->mentors->count() > 0)
                                    {{ $bootcamp->mentors->pluck('name')->take(2)->join(', ') }}
                                    @if($bootcamp->mentors->count() > 2)
                                        <span class="text-gray-500">+{{ $bootcamp->mentors->count() - 2 }} more</span>
                                    @endif
                                @else
                                    <span class="text-gray-400">No mentors</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                {{ $bootcamp->category?->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $bootcamp->duration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $bootcamp->start_date ? $bootcamp->start_date->format('M d, Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $bootcamp->formatted_price }}
                            @if($bootcamp->discount_percentage > 0)
                                <div class="text-xs text-red-600 line-through">{{ $bootcamp->formatted_original_price }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $bootcamp->students ?? 0 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.bootcamps.toggle-active', $bootcamp) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center">
                                    @if($bootcamp->is_active)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 hover:bg-green-200 cursor-pointer">
                                            Active
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 hover:bg-red-200 cursor-pointer">
                                            Inactive
                                        </span>
                                    @endif
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.bootcamps.edit', $bootcamp) }}" class="text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.bootcamps.destroy', $bootcamp) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this bootcamp?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                            No bootcamps found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($bootcamps->hasPages())
    <div class="mt-6 bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 rounded-lg shadow-lg">
        <div class="flex-1 flex justify-between sm:hidden">
            {{ $bootcamps->links() }}
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing <span class="font-medium">{{ $bootcamps->firstItem() }}</span> to <span class="font-medium">{{ $bootcamps->lastItem() }}</span> of <span class="font-medium">{{ $bootcamps->total() }}</span> results
                </p>
            </div>
            <div>
                {{ $bootcamps->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
