@php
    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for bootcamp page
    $translations = include lang_path("{$locale}/bootcamp.php");
    $hero = $translations['hero'];
    $filter = $translations['filter'];
    $bootcamp_details = $translations['bootcamp_details'];
    $load_more = $translations['load_more'];
    $benefits = $translations['benefits'];
    $success_stories = $translations['success_stories'];
    $faq = $translations['faq'];
    $cta = $translations['cta'];

    // Build URLs with current locale
    $baseUrl = '/' . $locale;
@endphp

@include('components.header', ['title' => 'Bootcamps'])

<!-- Hero Section -->
<section class="bg-primary-dark text-white relative overflow-hidden py-16">
    <!-- Animated Background with Orange Spiral Pattern -->
    <div class="absolute inset-0 opacity-40 z-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-secondary rounded-full filter blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute top-0 left-0 w-96 h-40 bg-secondary rounded-full filter blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute top-20 right-0 w-64 h-64 bg-secondary/80 rounded-full filter blur-2xl transform translate-x-1/3 translate-y-1/3"></div>
        <div class="absolute bottom-20 left-1/4 w-80 h-80 bg-secondary/60 rounded-full filter blur-xl transform translate-x-1/4 translate-y-1/4"></div>
        <div class="absolute bottom-0 right-1/3 w-72 h-72 bg-secondary/40 rounded-full filter blur-lg transform translate-x-1/3 translate-y-1/3"></div>
        <div class="absolute top-1/2 left-1/2 w-32 h-32 bg-accent rounded-full filter blur-md transform rotate-45"></div>
        <div class="absolute bottom-1/4 right-1/4 w-40 h-40 bg-accent/80 rounded-full filter blur-md transform -rotate-12"></div>
        <div class="absolute top-1/3 right-1/2 w-24 h-24 bg-accent/60 rounded-full filter blur-sm transform rotate-12"></div>
        <div class="absolute top-1/4 left-1/3 w-16 h-16 bg-secondary rounded-full"></div>
        <div class="absolute top-1/2 right-1/3 w-20 h-20 bg-secondary/90 rounded-full"></div>
        <div class="absolute bottom-1/3 left-1/2 w-24 h-24 bg-secondary/70 rounded-full"></div>
        <div class="absolute bottom-1/4 right-1/2 w-32 h-32 bg-secondary/50 rounded-full"></div>
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $hero['title'] }}</h1>
            <p class="text-xl max-w-3xl mx-auto">{{ $hero['subtitle'] }}</p>
        </div>
    </div>
</section>

<!-- Why Bootcamp Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $benefits['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $benefits['subtitle'] }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-rocket text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $benefits['fast_track_learning']['title'] }}</h3>
                <p class="text-gray-600">{{ $benefits['fast_track_learning']['description'] }}</p>
            </div>
            <div class="text-center">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-briefcase text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $benefits['career_support']['title'] }}</h3>
                <p class="text-gray-600">{{ $benefits['career_support']['description'] }}</p>
            </div>
            <div class="text-center">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $benefits['expert_mentors']['title'] }}</h3>
                <p class="text-gray-600">{{ $benefits['expert_mentors']['description'] }}</p>
            </div>
            <div class="text-center">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-project-diagram text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $benefits['real_projects']['title'] }}</h3>
                <p class="text-gray-600">{{ $benefits['real_projects']['description'] }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-10 bg-gradient-to-br from-white via-gray-50 to-gray-100 border-b border-gray-200/50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 lg:gap-8">
            <!-- Title & Stats -->
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2 tracking-tight">
                    {{ $filter['all_bootcamps'] }}
                </h1>
                <div class="flex items-center gap-3 text-gray-700">
                    <div class="flex items-center gap-1.5 bg-white/80 backdrop-blur-sm px-3 py-1.5 rounded-full border border-gray-200 shadow-sm">
                        <svg class="w-4 h-4 text-secondary" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm font-semibold">{{ $totalBootcamps ?? count($bootcamps) }}</span>
                        <span class="text-sm text-gray-600">{{ $filter['bootcamps_available'] }}</span>
                    </div>
                    @if($selectedCategory ?? false)
                    <div class="flex items-center gap-1.5 bg-secondary/10 px-3 py-1.5 rounded-full border border-secondary/20">
                        <span class="text-sm font-medium text-secondary">{{ $selectedCategory->name }}</span>
                        <button class="text-secondary/70 hover:text-secondary">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Filter Controls -->
            <div class="w-full lg:w-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:flex gap-3 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-200 shadow-sm p-4">
                    <!-- Category Filter -->
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-secondary/20 to-primary/20 rounded-lg blur opacity-0 group-hover:opacity-50 transition duration-300"></div>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-secondary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <select class="pl-10 pr-8 py-2.5 text-sm text-gray-800 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary/50 focus:border-secondary transition-all duration-200 hover:border-gray-400 cursor-pointer appearance-none w-full min-w-[180px]" id="categoryFilter">
                                <option value="" class="py-2 text-gray-600">{{ $filter['all_categories'] }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" class="py-2">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-secondary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Sort Filter -->
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-secondary/20 to-primary/20 rounded-lg blur opacity-0 group-hover:opacity-50 transition duration-300"></div>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-secondary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path>
                                </svg>
                            </div>
                            <select class="pl-10 pr-8 py-2.5 text-sm text-gray-800 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary/50 focus:border-secondary transition-all duration-200 hover:border-gray-400 cursor-pointer appearance-none w-full min-w-[200px]" id="sortFilter">
                                <option value="default" class="py-2 text-gray-600">{{ $filter['sort_by'] }}</option>
                                <option value="price-low" class="py-2">{{ $filter['price_low_high'] }}</option>
                                <option value="price-high" class="py-2">{{ $filter['price_high_low'] }}</option>
                                <option value="rating" class="py-2">{{ $filter['highest_rated'] }}</option>
                                <option value="duration" class="py-2">{{ $filter['shortest_first'] }}</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-secondary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Clear Filters Button (Optional) -->
                    <button id="clearFilters" class="hidden lg:flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 rounded-lg border border-gray-300 transition-all duration-200 group">
                        <svg class="w-4 h-4 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        {{ $filter['clear_filters'] ?? 'Clear All' }}
                    </button>
                </div>

                <!-- Active Filters Indicator (Mobile) -->
                <div class="mt-3 flex items-center justify-between text-sm text-gray-500">
                    <span id="activeFiltersCount" class="hidden">
                        <span class="font-medium">2</span> filters active
                    </span>
                    <button id="mobileClearFilters" class="text-secondary hover:text-secondary-dark font-medium hidden">
                        {{ $filter['clear'] ?? 'Clear' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootcamps Grid -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8" id="bootcampsGrid">
            @include('partials.bootcamp-items', ['bootcamps' => $bootcamps])
        </div>

        <!-- Load More Button -->
        @if(($totalBootcamps ?? count($bootcamps)) > 6)
            <div class="flex justify-center text-center mt-12">
                <button id="loadMoreBtn" class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                    {{ $load_more['bootcamps'] }}
                </button>
            </div>
        @endif
    </div>
</section>

<!-- Success Stories Section -->
{{-- <section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $success_stories['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $success_stories['subtitle'] }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-100 rounded-xl p-6 text-center">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Graduate" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
                <h3 class="text-xl font-semibold mb-2">Michael Chen</h3>
                <p class="text-gray-600 mb-2">Full Stack Developer</p>
                <p class="text-sm text-gray-500 mb-4">Graduated: Web Development Bootcamp</p>
                <p class="text-gray-600 italic">"The bootcamp completely transformed my career. I went from zero coding knowledge to landing my dream job in just 3 months!"</p>
            </div>
            <div class="bg-gray-100 rounded-xl p-6 text-center">
                <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Graduate" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
                <h3 class="text-xl font-semibold mb-2">Sarah Johnson</h3>
                <p class="text-gray-600 mb-2">Data Scientist</p>
                <p class="text-sm text-gray-500 mb-4">Graduated: Data Science Bootcamp</p>
                <p class="text-gray-600 italic">"The hands-on projects and mentorship were invaluable. I now work as a data scientist at a leading tech company."</p>
            </div>
            <div class="bg-gray-100 rounded-xl p-6 text-center">
                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Graduate" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
                <h3 class="text-xl font-semibold mb-2">Alex Rodriguez</h3>
                <p class="text-gray-600 mb-2">UX Designer</p>
                <p class="text-sm text-gray-500 mb-4">Graduated: UX/UI Design Bootcamp</p>
                <p class="text-gray-600 italic">"The bootcamp gave me both skills and confidence to pursue my passion. I'm now working on products used by millions!"</p>
            </div>
        </div>
    </div>
</section> --}}

<!-- FAQ Section -->
<section class="py-16 bg-light" x-data="{ open: 0 }">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $faq['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $faq['subtitle'] }}</p>
        </div>
        <div class="max-w-3xl mx-auto">
            <div class="mb-4">
                <button @click="open = 0" class="w-full text-left bg-white p-4 rounded-lg shadow-md flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-semibold">{{ $faq['how_long']['question'] }}</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 0 }"></i>
                </button>
                <div x-show="open === 0" x-transition class="bg-white p-4 rounded-b-lg shadow-md">
                    <p class="text-gray-600">{{ $faq['how_long']['answer'] }}</p>
                </div>
            </div>
            <div class="mb-4">
                <button @click="open = 1" class="w-full text-left bg-white p-4 rounded-lg shadow-md flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-semibold">{{ $faq['prior_experience']['question'] }}</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 1 }"></i>
                </button>
                <div x-show="open === 1" x-transition class="bg-white p-4 rounded-b-lg shadow-md">
                    <p class="text-gray-600">{{ $faq['prior_experience']['answer'] }}</p>
                </div>
            </div>
            <div class="mb-4">
                <button @click="open = 2" class="w-full text-left bg-white p-4 rounded-lg shadow-md flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-semibold">{{ $faq['job_placement']['question'] }}</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 2 }"></i>
                </button>
                <div x-show="open === 2" x-transition class="bg-white p-4 rounded-b-lg shadow-md">
                    <p class="text-gray-600">{{ $faq['job_placement']['answer'] }}</p>
                </div>
            </div>
            <div class="mb-4">
                <button @click="open = 3" class="w-full text-left bg-white p-4 rounded-lg shadow-md flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-semibold">{{ $faq['payment_plans']['question'] }}</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 3 }"></i>
                </button>
                <div x-show="open === 3" x-transition class="bg-white p-4 rounded-b-lg shadow-md">
                    <p class="text-gray-600">{{ $faq['payment_plans']['answer'] }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-primary text-white relative overflow-hidden">
    <!-- Animated Background with Secondary-Dark Zigzag Ribbon Pattern -->
    {{-- <div class="absolute inset-0 z-10">
        <!-- Zigzag Ribbon 1 - Top -->
        <svg class="absolute top-0 left-0 w-full h-32" viewBox="0 0 1200 128">
            <path d="M0,64 L150,0 L300,64 L450,0 L600,64 L750,0 L900,64 L1050,0 L1200,64 L1200,128 L1050,128 L900,64 L750,128 L600,64 L450,128 L300,64 L150,128 L0,64 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
        </svg>

        <!-- Zigzag Ribbon 2 - Middle -->
        <svg class="absolute top-1/3 left-0 w-full h-32 transform -translate-y-1/2" viewBox="0 0 1200 128">
            <path d="M0,64 L150,0 L300,64 L450,0 L600,64 L750,0 L900,64 L1050,0 L1200,64 L1200,128 L1050,128 L900,64 L750,128 L600,64 L450,128 L300,64 L150,128 L0,64 Z"
                  fill="currentColor"
                  class="text-secondary-dark opacity-80"/>
        </svg>

        <!-- Zigzag Ribbon 3 - Bottom -->
        <svg class="absolute bottom-0 left-0 w-full h-32" viewBox="0 0 1200 128">
            <path d="M0,64 L150,0 L300,64 L450,0 L600,64 L750,0 L900,64 L1050,0 L1200,64 L1200,128 L1050,128 L900,64 L750,128 L600,64 L450,128 L300,64 L150,128 L0,64 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
        </svg>
    </div> --}}

    <div class="container mx-auto px-6 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $cta['title'] }}</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $cta['subtitle'] }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            {{-- <a href="{{ $baseUrl }}/contact" class="bg-secondary border-2 border-white hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                {{ $cta['apply_now'] }}
            </a> --}}
            <a href="{{ $baseUrl }}/contact" class="bg-transparent border-2 border-white hover:bg-white hover:text-secondary text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                {{ $cta['schedule_consultation'] }}
            </a>
        </div>
    </div>
</section>

@include('components.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const categoryFilter = document.getElementById('categoryFilter');
    const sortFilter = document.getElementById('sortFilter');
    const bootcampsGrid = document.getElementById('bootcampsGrid');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const clearFiltersBtn = document.getElementById('clearFilters');
    const mobileClearBtn = document.getElementById('mobileClearFilters');
    const activeFiltersCount = document.getElementById('activeFiltersCount');

    let currentPage = 1;
    let isLoading = false;
    let currentCategory = categoryFilter.value;
    let currentSort = sortFilter.value;

    // Update active filters counter
    function updateActiveFilters() {
        const activeFilters = [];
        if (categoryFilter.value) activeFilters.push('category');
        if (sortFilter.value !== 'default') activeFilters.push('sort');

        const count = activeFilters.length;

        if (count > 0) {
            activeFiltersCount.innerHTML = `<span class="font-medium">${count}</span> ${count === 1 ? 'filter' : 'filters'} active`;
            activeFiltersCount.classList.remove('hidden');
            if (clearFiltersBtn) clearFiltersBtn.classList.remove('hidden');
            if (mobileClearBtn) mobileClearBtn.classList.remove('hidden');
        } else {
            activeFiltersCount.classList.add('hidden');
            if (clearFiltersBtn) clearFiltersBtn.classList.add('hidden');
            if (mobileClearBtn) mobileClearBtn.classList.add('hidden');
        }
    }

    // Update stats badge
    function updateStatsBadge(count) {
        const countElement = document.querySelector('.flex.items-center.gap-1.5 .text-sm.font-semibold');
        if (countElement) {
            countElement.textContent = count;
        }
    }

    // Show loading state
    function showLoading() {
        if (loadMoreBtn) {
            loadMoreBtn.disabled = true;
            loadMoreBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Loading...
                `;
            }
        }

        // Hide loading state
        function hideLoading() {
            if (loadMoreBtn) {
                loadMoreBtn.disabled = false;
                loadMoreBtn.innerHTML = 'Load More';
            }
        }

        // Clear all filters
        function clearAllFilters() {
            categoryFilter.value = '';
            sortFilter.value = 'default';
            updateActiveFilters();
            fetchBootcamps(true);
        }

        // Ambil bootcamp dari server berdasarkan filter & sort
        function fetchBootcamps(reset = true, updateStats = true) {
            if (isLoading) return;
            isLoading = true;

            if (reset) {
                currentPage = 1;
                if (loadMoreBtn) {
                    loadMoreBtn.style.display = 'block';
                    loadMoreBtn.classList.remove('hidden');
                }
            }

            // Update filter tracking
            currentCategory = categoryFilter.value;
            currentSort = sortFilter.value;

            const url = new URL(window.location.pathname, window.location.origin);
            const params = new URLSearchParams();
            params.set('category', currentCategory || '');
            params.set('sort', currentSort || 'default');
            params.set('page', currentPage);

            // Show loading state
            if (reset) {
                bootcampsGrid.innerHTML = `
                    <div class="col-span-full flex justify-center items-center py-12">
                        <div class="text-center">
                            <svg class="animate-spin h-8 w-8 text-secondary mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <p class="text-gray-600">Loading bootcamps...</p>
                        </div>
                    </div>
                `;
            } else {
                showLoading();
            }

            fetch(`${url.pathname}?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (reset) {
                    bootcampsGrid.innerHTML = '';
                }

                if (data.html) {
                    const temp = document.createElement('div');
                    temp.innerHTML = data.html;
                    const items = temp.querySelectorAll('.bootcamp-item');

                    items.forEach(item => {
                        // Add fade-in animation
                        item.classList.add('animate-fadeIn');
                        bootcampsGrid.appendChild(item);
                    });

                    // Update load more button
                    if (loadMoreBtn) {
                        if (!data.hasMore) {
                            loadMoreBtn.style.display = 'none';
                        } else {
                            loadMoreBtn.style.display = 'block';
                            loadMoreBtn.classList.remove('hidden');
                        }
                    }

                    // Update stats if available
                    if (updateStats && data.total !== undefined) {
                        updateStatsBadge(data.total);
                    }
                } else if (reset) {
                    // No results
                    bootcampsGrid.innerHTML = `
                        <div class="col-span-full text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No bootcamps found</h3>
                            <p class="text-gray-600">Try adjusting your filters to find what you're looking for.</p>
                        </div>
                    `;
                }

                // Update active filters
                updateActiveFilters();
                isLoading = false;
                hideLoading();
            })
            .catch(error => {
                console.error('Error fetching bootcamps:', error);

                if (reset) {
                    bootcampsGrid.innerHTML = `
                        <div class="col-span-full text-center py-12">
                            <svg class="w-16 h-16 text-red-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Error loading bootcamps</h3>
                            <p class="text-gray-600">Please try again in a moment.</p>
                            <button onclick="fetchBootcamps(true)" class="mt-4 bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                Retry
                            </button>
                        </div>
                    `;
                }

                isLoading = false;
                hideLoading();
            });
        }

        // Event listeners dengan debounce
        let filterTimeout;
        function debouncedFilter() {
            clearTimeout(filterTimeout);
            filterTimeout = setTimeout(() => fetchBootcamps(true), 300);
        }

        categoryFilter.addEventListener('change', () => {
            updateActiveFilters();
            debouncedFilter();
        });

        sortFilter.addEventListener('change', () => {
            updateActiveFilters();
            debouncedFilter();
        });

        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', clearAllFilters);
        }

        if (mobileClearBtn) {
            mobileClearBtn.addEventListener('click', clearAllFilters);
        }

        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', () => {
                currentPage++;
                fetchBootcamps(false, false);
            });
        }

        // Initialize active filters
        updateActiveFilters();

        // Add CSS animation for fade-in
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fadeIn {
                animation: fadeIn 0.3s ease-out forwards;
            }
        `;
        document.head.appendChild(style);
    });
</script>
