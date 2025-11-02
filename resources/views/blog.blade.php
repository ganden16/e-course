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

    // Get blogs from language file
    $blogs = $translations['blogs'];
    $categories = array_unique(array_column($blogs, 'category'));

    // Get all unique tags
    $allTags = [];
    foreach($blogs as $blog) {
        $allTags = array_merge($allTags, $blog['tags']);
    }
    $tags = array_unique($allTags);

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
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="md:flex">
                <div class="md:w-2/5">
                    <img src="{{ $blogs[0]['image'] }}" alt="{{ $blogs[0]['title'] }}" class="w-full h-64 md:h-full object-cover">
                </div>
                <div class="md:w-3/5 p-8">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $blogs[0]['category'] }}</span>
                        <span class="text-sm text-gray-500">{{ $blogs[0]['read_time'] }}</span>
                    </div>
                    <h3 class="text-2xl md:text-3xl font-bold mb-4">{{ $blogs[0]['title'] }}</h3>
                    <p class="text-gray-600 mb-6 text-lg">{{ $blogs[0]['excerpt'] }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="{{ $blogs[0]['avatar'] }}" alt="{{ $blogs[0]['author'] }}" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-medium">{{ $blogs[0]['author'] }}</p>
                                <p class="text-sm text-gray-500">{{ $blogs[0]['date'] }}</p>
                            </div>
                        </div>
                        <a href="{{ $baseUrl }}/blog/{{ $blogs[0]['id'] }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                            {{ $featured_post['read_article'] }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-8 bg-light border-b">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl font-semibold text-gray-800">{{ $filter['all_articles'] }}</h2>
                <p class="text-gray-600">{{ count($blogs) }} {{ $filter['articles_available'] }}</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary" id="categoryFilter">
                    <option value="">{{ $filter['all_categories'] }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary" id="sortFilter">
                    <option value="latest">{{ $filter['latest_first'] }}</option>
                    <option value="oldest">{{ $filter['oldest_first'] }}</option>
                </select>
            </div>
        </div>
    </div>
</section>

<!-- Blog Grid -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="blogGrid">
            @foreach($blogs as $blog)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover blog-item" data-category="{{ $blog['category'] }}" data-date="{{ $blog['date'] }}">
                    <img src="{{ $blog['image'] }}" alt="{{ $blog['title'] }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $blog['category'] }}</span>
                            <span class="text-sm text-gray-500">{{ $blog['read_time'] }}</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $blog['title'] }}</h3>
                        <p class="text-gray-600 mb-4">{{ $blog['excerpt'] }}</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach(array_slice($blog['tags'], 0, 3) as $tag)
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">#{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="{{ $blog['avatar'] }}" alt="{{ $blog['author'] }}" class="w-8 h-8 rounded-full mr-2">
                                <div>
                                    <p class="text-sm font-medium">{{ $blog['author'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $blog['date'] }}</p>
                                </div>
                            </div>
                            <a href="{{ $baseUrl }}/blog/{{ $blog['id'] }}" class="text-secondary hover:text-secondary-dark font-medium">
                                {{ $blog_details['read_more'] }} <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                {{ $load_more['articles'] }}
            </button>
        </div>
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
                    #{{ $tag }}
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
    const categoryFilter = document.getElementById('categoryFilter');
    const sortFilter = document.getElementById('sortFilter');
    const blogGrid = document.getElementById('blogGrid');
    const blogItems = Array.from(blogGrid.querySelectorAll('.blog-item'));

    function filterBlogs() {
        const selectedCategory = categoryFilter.value;

        blogItems.forEach(item => {
            const itemCategory = item.getAttribute('data-category');

            if (selectedCategory === '' || itemCategory === selectedCategory) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function sortBlogs() {
        const sortValue = sortFilter.value;
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
            if (item.style.display !== 'none') {
                blogGrid.appendChild(item);
            }
        });
    }

    categoryFilter.addEventListener('change', function() {
        filterBlogs();
        sortBlogs();
    });

    sortFilter.addEventListener('change', function() {
        sortBlogs();
    });
});
</script>
