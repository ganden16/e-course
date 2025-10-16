@php
    $data = json_decode(file_get_contents(resource_path('json/data.json')), true);
    $site = $data['site'];
    $products = $data['products'];
    $categories = array_unique(array_column($products, 'category'));
@endphp

@include('components.header', ['title' => 'Courses'])

<!-- Hero Section -->
<section class="gradient-bg text-white py-16">
    <div class="container mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Our Courses</h1>
            <p class="text-xl max-w-3xl mx-auto">Explore our comprehensive range of courses designed to help you master new skills and advance your career.</p>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-8 bg-white border-b">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl font-semibold text-gray-800">All Courses</h2>
                <p class="text-gray-600">{{ count($products) }} courses available</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" id="categoryFilter">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" id="sortFilter">
                    <option value="default">Sort by</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="rating">Highest Rated</option>
                    <option value="students">Most Popular</option>
                </select>
            </div>
        </div>
    </div>
</section>

<!-- Courses Grid -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="coursesGrid">
            @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover course-item" data-category="{{ $product['category'] }}" data-price="{{ $product['price'] }}" data-rating="{{ $product['rating'] }}" data-students="{{ $product['students'] }}">
                    <div class="relative">
                        <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" class="w-full h-48 object-cover">
                        @if($product['price'] < $product['original_price'])
                            <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ round((1 - $product['price'] / $product['original_price']) * 100) }}% OFF
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-primary bg-primary/10 px-3 py-1 rounded-full">{{ $product['category'] }}</span>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400"></i>
                                <span class="ml-1 text-sm font-medium">{{ $product['rating'] }}</span>
                                <span class="ml-1 text-sm text-gray-500">({{ $product['students'] }})</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $product['title'] }}</h3>
                        <p class="text-gray-600 mb-4">{{ $product['description'] }}</p>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="fas fa-user-tie mr-2"></i>
                            <span class="mr-4">{{ $product['instructor'] }}</span>
                            <i class="fas fa-clock mr-2"></i>
                            <span>{{ $product['duration'] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-primary">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                                @if($product['price'] < $product['original_price'])
                                    <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($product['original_price'], 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <a href="/product/{{ $product['id'] }}" class="bg-primary hover:bg-primary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                Load More Courses
            </button>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Why Learn With Us?</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">We provide the best learning experience with comprehensive features.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-certificate text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Certificate</h3>
                <p class="text-gray-600">Receive industry-recognized certificates upon completion</p>
            </div>
            <div class="text-center">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-infinity text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Lifetime Access</h3>
                <p class="text-gray-600">Get lifetime access to course materials and updates</p>
            </div>
            <div class="text-center">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-mobile-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Mobile Access</h3>
                <p class="text-gray-600">Learn on the go with our mobile app</p>
            </div>
            <div class="text-center">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">24/7 Support</h3>
                <p class="text-gray-600">Get help whenever you need it</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 gradient-bg text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Can't Find What You're Looking For?</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">We're constantly adding new courses. Let us know what you'd like to learn!</p>
        <a href="/contact" class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
            Request a Course
        </a>
    </div>
</section>

@include('components.footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryFilter = document.getElementById('categoryFilter');
    const sortFilter = document.getElementById('sortFilter');
    const coursesGrid = document.getElementById('coursesGrid');
    const courseItems = Array.from(coursesGrid.querySelectorAll('.course-item'));

    function filterCourses() {
        const selectedCategory = categoryFilter.value;

        courseItems.forEach(item => {
            const itemCategory = item.getAttribute('data-category');

            if (selectedCategory === '' || itemCategory === selectedCategory) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function sortCourses() {
        const sortValue = sortFilter.value;
        let sortedItems = [...courseItems];

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
            case 'students':
                sortedItems.sort((a, b) => {
                    return parseInt(b.getAttribute('data-students')) - parseInt(a.getAttribute('data-students'));
                });
                break;
            default:
                // Default order
                sortedItems = courseItems;
        }

        // Clear and re-append sorted items
        coursesGrid.innerHTML = '';
        sortedItems.forEach(item => {
            if (item.style.display !== 'none') {
                coursesGrid.appendChild(item);
            }
        });
    }

    categoryFilter.addEventListener('change', function() {
        filterCourses();
        sortCourses();
    });

    sortFilter.addEventListener('change', function() {
        sortCourses();
    });
});
</script>
