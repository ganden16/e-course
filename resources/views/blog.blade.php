@php
    $data = json_decode(file_get_contents(resource_path('json/data.json')), true);
    $site = $data['site'];
    $blogs = $data['blogs'];
    $categories = array_unique(array_column($blogs, 'category'));

    // Get all unique tags
    $allTags = [];
    foreach($blogs as $blog) {
        $allTags = array_merge($allTags, $blog['tags']);
    }
    $tags = array_unique($allTags);
@endphp

@include('components.header', ['title' => 'Blog'])

<!-- Hero Section -->
<section class="gradient-bg text-white py-16">
    <div class="container mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Our Blog</h1>
            <p class="text-xl max-w-3xl mx-auto">Stay updated with the latest trends, insights, and news in tech, education, and career development.</p>
        </div>
    </div>
</section>

<!-- Featured Post -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Featured Article</h2>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="md:flex">
                <div class="md:w-2/5">
                    <img src="{{ $blogs[0]['image'] }}" alt="{{ $blogs[0]['title'] }}" class="w-full h-64 md:h-full object-cover">
                </div>
                <div class="md:w-3/5 p-8">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-medium text-primary bg-primary/10 px-3 py-1 rounded-full">{{ $blogs[0]['category'] }}</span>
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
                        <a href="/blog/{{ $blogs[0]['id'] }}" class="bg-primary hover:bg-primary-dark text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                            Read Article
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
                <h2 class="text-2xl font-semibold text-gray-800">All Articles</h2>
                <p class="text-gray-600">{{ count($blogs) }} articles available</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" id="categoryFilter">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" id="sortFilter">
                    <option value="latest">Latest First</option>
                    <option value="oldest">Oldest First</option>
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
                            <span class="text-sm font-medium text-primary bg-primary/10 px-3 py-1 rounded-full">{{ $blog['category'] }}</span>
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
                            <a href="/blog/{{ $blog['id'] }}" class="text-primary hover:text-primary-dark font-medium">
                                Read More <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                Load More Articles
            </button>
        </div>
    </div>
</section>

<!-- Popular Tags Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Popular Tags</h2>
            <p class="text-lg text-gray-600">Discover articles by topics that interest you</p>
        </div>
        <div class="flex flex-wrap justify-center gap-3">
            @foreach($tags as $tag)
                <a href="#" class="bg-gray-100 hover:bg-primary hover:text-white text-gray-700 font-medium py-2 px-4 rounded-full transition duration-300">
                    #{{ $tag }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 gradient-bg text-white">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Subscribe to Our Newsletter</h2>
            <p class="text-xl mb-8">Get the latest articles and insights delivered straight to your inbox.</p>
            <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Your email address" class="flex-1 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <button class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                    Subscribe
                </button>
            </div>
        </div>
    </div>
</section>

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
