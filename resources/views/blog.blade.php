@php
    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for blog page
    $translations = include lang_path("{$locale}/blog.php");
    $hero = $translations['hero'];
    $filter = $translations['filter'];
    $featured_post = $translations['featured_post'];
    $latest_posts = $translations['latest_posts'];
    $blog_details = $translations['blog_details'];
    $load_more = $translations['load_more'];
    $popular_tags = $translations['popular_tags'];
    $newsletter = $translations['newsletter'];

    // Build URLs with current locale
    $baseUrl = '/' . $locale;
@endphp

@include('components.header', ['title' => 'Blog'])

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

<!-- Featured Post -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ $latest_posts['featured_article'] }}</h2>
        @if($blogs->count() > 0)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-2/5">
                        <img src="{{ $blogs->first()->image }}" alt="{{ $blogs->first()->title }}" class="w-full h-64 md:h-full object-cover">
                    </div>
                    <div class="md:w-3/5 p-8">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm text-gray-500">{{ $blogs->first()->read_time }}</span>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-4">{{ $blogs->first()->title }}</h3>
                        <p class="text-gray-600 mb-6 text-lg">{{ $blogs->first()->excerpt }}</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium">{{ $blogs->first()->author }}</p>
                                <p class="text-sm text-gray-500">{{ $blogs->first()->formatted_date }}</p>
                            </div>
                            <a href="{{ route('blog.detail', [$locale, $blogs->first()->slug]) }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                                {{ $featured_post['read_article'] }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Filter Section -->
<section class="py-12 bg-gradient-to-b from-gray-50 to-white border-b border-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row justify-between items-center gap-6">
            <!-- Left: Title & Stats -->
            <div class="text-center lg:text-left">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                    {{ $filter['all_articles'] }}
                </h2>
                <div class="flex items-center justify-center lg:justify-start gap-2 text-gray-600">
                    <span class="inline-flex items-center">
                        <svg class="w-5 h-5 mr-1.5 text-secondary" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-lg font-semibold">{{ $totalBlogs ?? count($blogs) }}</span>
                    </span>
                    <span>{{ $filter['articles_available'] }}</span>
                </div>
            </div>

            <!-- Right: Filter Controls -->
            <div class="w-full lg:w-auto">
                <div class="flex flex-col sm:flex-row items-center gap-4 bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-3">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">{{ $filter['sort_by'] ?? 'Sort by' }}</span>
                    </div>

                    <div class="relative">
                        <select class="appearance-none bg-white border border-gray-300 rounded-lg pl-4 pr-10 py-2.5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-secondary/50 focus:border-secondary transition-all duration-200 cursor-pointer hover:border-gray-400 min-w-[180px]" id="sortFilter">
                            <option value="latest" class="py-2">{{ $filter['latest_first'] }}</option>
                            <option value="oldest" class="py-2">{{ $filter['oldest_first'] }}</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Grid -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="blogGrid">
            @include('partials.blog-items', ['blogs' => $blogs])
        </div>

        <!-- Load More Button -->
        @if(($totalBlogs ?? count($blogs)) > 6)
            <div class="flex justify-center mt-12">
                <button id="loadMoreBtn" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-3 px-8 rounded-lg transition duration-300">
                    {{ $load_more['articles'] }}
                </button>
            </div>
        @endif
    </div>
</section>

<!-- Popular Tags Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $popular_tags['title'] }}</h2>
            <p class="text-lg text-gray-600">{{ $popular_tags['subtitle'] }}</p>
        </div>
        <div class="flex flex-wrap justify-center gap-3">
            @foreach($tags as $tag)
                <a href="#" class="bg-gray-100 hover:bg-secondary hover:text-white text-gray-700 font-medium py-2 px-4 rounded-full transition duration-300">
                    #{{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter Section -->
{{-- <section class="py-16 gradient-bg text-white">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $newsletter['title'] }}</h2>
            <p class="text-xl mb-8">{{ $newsletter['subtitle'] }}</p>
            <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="{{ $newsletter['email_placeholder'] }}" class="flex-1 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
                <button class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                    {{ $newsletter['subscribe'] }}
                </button>
            </div>
        </div>
    </div>
</section> --}}

@include('components.footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortFilter = document.getElementById('sortFilter');
    const blogGrid = document.getElementById('blogGrid');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    let currentPage = 2; // Start from page 2 since page 1 is already loaded
    let currentSort = 'latest';
    let currentTag = '';

    // Sort functionality
    function sortBlogs() {
        const blogItems = Array.from(blogGrid.querySelectorAll('.blog-item'));
        const sortValue = sortFilter.value;
        currentSort = sortValue;
        let sortedItems = [...blogItems];

        if (sortValue === 'latest') {
            sortedItems.sort((a, b) => {
                const dateA = new Date(a.getAttribute('data-date'));
                const dateB = new Date(b.getAttribute('data-date'));
                return dateB - dateA;
            });
        } else if (sortValue === 'oldest') {
            sortedItems.sort((a, b) => {
                const dateA = new Date(a.getAttribute('data-date'));
                const dateB = new Date(b.getAttribute('data-date'));
                return dateA - dateB;
            });
        }

        // Clear and re-append sorted items
        blogGrid.innerHTML = '';
        sortedItems.forEach(item => {
            blogGrid.appendChild(item);
        });
    }

    sortFilter.addEventListener('change', function() {
        sortBlogs();
    });

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
            if (currentTag) {
                params.set('tag', currentTag);
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

                    // Get all blog items from the response
                    const newBlogItems = tempDiv.querySelectorAll('.blog-item');

                    // Append each new blog item to the grid
                    newBlogItems.forEach(item => {
                        blogGrid.appendChild(item);
                    });

                    // Reapply sorting if needed
                    if (currentSort !== 'latest') {
                        sortBlogs();
                    }

                    currentPage++;

                    // Hide button if no more items
                    if (!data.hasMore) {
                        loadMoreBtn.style.display = 'none';
                    }
                }

                loadMoreBtn.disabled = false;
                loadMoreBtn.innerHTML = '{{ $load_more["articles"] }}';
            })
            .catch(error => {
                console.error('Error loading more blogs:', error);
                loadMoreBtn.disabled = false;
                loadMoreBtn.innerHTML = '{{ $load_more["articles"] }}';
            });
        });
    }
});
</script>
