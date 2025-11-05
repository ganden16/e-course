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
<section class="py-8 bg-light border-b">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl font-semibold text-gray-800">{{ $filter['all_bootcamps'] }}</h2>
                <p class="text-gray-600">{{ $totalBootcamps ?? count($bootcamps) }} {{ $filter['bootcamps_available'] }}</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary" id="categoryFilter">
                    <option value="">{{ $filter['all_categories'] }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary" id="sortFilter">
                    <option value="default">{{ $filter['sort_by'] }}</option>
                    <option value="price-low">{{ $filter['price_low_high'] }}</option>
                    <option value="price-high">{{ $filter['price_high_low'] }}</option>
                    <option value="rating">{{ $filter['highest_rated'] }}</option>
                    <option value="duration">{{ $filter['shortest_first'] }}</option>
                </select>
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
            <div class="text-center mt-12">
                <button id="loadMoreBtn" class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                    {{ $load_more['bootcamps'] }}
                </button>
            </div>
        @endif
    </div>
</section>

<!-- Success Stories Section -->
<section class="py-16 bg-white">
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
</section>

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
    <div class="absolute inset-0 z-10">
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
    </div>

    <div class="container mx-auto px-6 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $cta['title'] }}</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $cta['subtitle'] }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ $baseUrl }}/contact" class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                {{ $cta['apply_now'] }}
            </a>
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
    let currentPage = 2; // Start from page 2 since page 1 is already loaded
    let currentSort = 'default';
    let currentCategory = '';

    // Filter functionality
    function filterBootcamps() {
        const selectedCategory = categoryFilter.value;
        currentCategory = selectedCategory;
        const bootcampItems = Array.from(bootcampsGrid.querySelectorAll('.bootcamp-item'));

        bootcampItems.forEach(item => {
            const itemCategory = item.getAttribute('data-category');

            if (selectedCategory === '' || itemCategory === selectedCategory) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Sort functionality
    function sortBootcamps() {
        const sortValue = sortFilter.value;
        currentSort = sortValue;
        const bootcampItems = Array.from(bootcampsGrid.querySelectorAll('.bootcamp-item'));
        let sortedItems = [...bootcampItems];

        switch(sortValue) {
            case 'price-low':
                sortedItems.sort((a, b) => {
                    return parseInt(a.getAttribute('data-price')) - parseInt(b.getAttribute('data-price'));
                });
                break;
            case 'price-high':
                sortedItems.sort((a, b) => {
                    return parseInt(b.getAttribute('data-price')) - parseInt(a.getAttribute('data-price'));
                });
                break;
            case 'rating':
                sortedItems.sort((a, b) => {
                    return parseFloat(b.getAttribute('data-rating')) - parseFloat(a.getAttribute('data-rating'));
                });
                break;
            case 'duration':
                sortedItems.sort((a, b) => {
                    const durationA = parseInt(a.getAttribute('data-duration'));
                    const durationB = parseInt(b.getAttribute('data-duration'));
                    return durationA - durationB;
                });
                break;
            default:
                // Default order
                sortedItems = bootcampItems;
        }

        // Clear and re-append sorted items
        bootcampsGrid.innerHTML = '';
        sortedItems.forEach(item => {
            if (item.style.display !== 'none') {
                bootcampsGrid.appendChild(item);
            }
        });
    }

    // Load more functionality
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            loadMoreBtn.disabled = true;
            loadMoreBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';

            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);

            // Add AJAX parameters
            params.set('page', currentPage);
            params.set('sort', currentSort);
            if (currentCategory) {
                params.set('category', currentCategory);
            }

            fetch(`${window.location.pathname}?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.html) {
                    // Create a temporary div to parse the HTML
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data.html;

                    // Get all bootcamp items from the response
                    const newBootcampItems = tempDiv.querySelectorAll('.bootcamp-item');

                    // Append each new bootcamp item to the grid
                    newBootcampItems.forEach(item => {
                        bootcampsGrid.appendChild(item);
                    });

                    // Reapply sorting if needed
                    if (currentSort !== 'default') {
                        sortBootcamps();
                    }

                    currentPage++;

                    // Hide button if no more items
                    if (!data.hasMore) {
                        loadMoreBtn.style.display = 'none';
                    }
                }

                loadMoreBtn.disabled = false;
                loadMoreBtn.innerHTML = '{{ $load_more["bootcamps"] }}';
            })
            .catch(error => {
                console.error('Error loading more bootcamps:', error);
                loadMoreBtn.disabled = false;
                loadMoreBtn.innerHTML = '{{ $load_more["bootcamps"] }}';
            });
        });
    }

    categoryFilter.addEventListener('change', function() {
        filterBootcamps();
        sortBootcamps();
    });

    sortFilter.addEventListener('change', function() {
        sortBootcamps();
    });
});
</script>
