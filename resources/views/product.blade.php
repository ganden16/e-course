@php
    use Illuminate\Support\Facades\Storage;

    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for product page
    $translations = include lang_path("{$locale}/product.php");
    $hero = $translations['hero'];
    $filter = $translations['filter'];
    $features = $translations['features'];
    $course_details = $translations['course_details'];
    $load_more = $translations['load_more'];
    $cta = $translations['cta'];

    // Build URLs with current locale
    $baseUrl = '/' . $locale;
@endphp

@include('components.header', ['title' => 'Courses'])

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

<!-- Filter Section -->
<section class="py-8 bg-white border-b">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl font-semibold text-gray-800">{{ $filter['all_courses'] }}</h2>
                <p class="text-gray-600">{{ count($products) }} {{ $filter['courses_available'] }}</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary" id="categoryFilter">
                    <option value="">{{ $filter['all_categories'] }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary" id="sortFilter">
                    <option value="default">{{ $filter['sort_by'] }}</option>
                    <option value="price-low">{{ $filter['price_low_high'] }}</option>
                    <option value="price-high">{{ $filter['price_high_low'] }}</option>
                    <option value="rating">{{ $filter['highest_rated'] }}</option>
                    <option value="students">{{ $filter['most_popular'] }}</option>
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
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover course-item" data-category="{{ $product->productCategory->slug }}" data-price="{{ $product->price }}" data-rating="{{ $product->rating }}" data-students="{{ $product->students }}">
                    <div class="relative">
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}" class="w-full h-48 object-cover">
                        @if($product->price < $product->original_price)
                            <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $product->discount_percentage }}% {{ $course_details['off'] }}
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $product->productCategory->name }}</span>
                            <div class="flex items-center">
                                <i class="fas fa-star text-secondary"></i>
                                <span class="ml-1 text-sm font-medium">{{ $product->rating }}</span>
                                <span class="ml-1 text-sm text-gray-500">({{ $product->students }})</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $product->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="fas fa-user-tie mr-2"></i>
                            <span class="mr-4">{{ $course_details['instructor'] }}: {{ $product->instructor }}</span>
                            <i class="fas fa-clock mr-2"></i>
                            <span>{{ $course_details['duration'] }}: {{ $product->duration }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-secondary">{{ $product->formatted_price }}</span>
                                @if($product->price < $product->original_price)
                                    <span class="text-sm text-gray-500 line-through ml-2">{{ $product->formatted_original_price }}</span>
                                @endif
                            </div>
                            <a href="{{ $baseUrl }}/product/{{ $product->id }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                {{ $course_details['view_details'] }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                {{ $load_more['courses'] }}
            </button>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $features['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $features['subtitle'] }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-certificate text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $features['certificate']['title'] }}</h3>
                <p class="text-gray-600">{{ $features['certificate']['description'] }}</p>
            </div>
            <div class="text-center">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-infinity text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $features['lifetime_access']['title'] }}</h3>
                <p class="text-gray-600">{{ $features['lifetime_access']['description'] }}</p>
            </div>
            <div class="text-center">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-mobile-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $features['mobile_access']['title'] }}</h3>
                <p class="text-gray-600">{{ $features['mobile_access']['description'] }}</p>
            </div>
            <div class="text-center">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $features['support_24_7']['title'] }}</h3>
                <p class="text-gray-600">{{ $features['support_24_7']['description'] }}</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-primary text-white relative overflow-hidden">
    <!-- Animated Background with Secondary-Dark Diagonal Ribbon Pattern -->
    <div class="absolute inset-0 z-10">
        <!-- Diagonal Ribbon 1 - Top Left to Bottom Right -->
        <svg class="absolute top-0 left-0 w-full h-full" viewBox="0 0 1200 400">
            <path d="M0,0 L300,0 L200,400 L0,400 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
            <path d="M400,0 L700,0 L600,400 L300,400 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
            <path d="M800,0 L1100,0 L1000,400 L700,400 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
        </svg>

        <!-- Diagonal Ribbon 2 - Bottom Left to Top Right -->
        <svg class="absolute top-0 left-0 w-full h-full" viewBox="0 0 1200 400">
            <path d="M0,400 L200,400 L300,0 L0,0 Z"
                  fill="currentColor"
                  class="text-secondary-dark opacity-80"/>
            <path d="M300,400 L500,400 L600,0 L400,0 Z"
                  fill="currentColor"
                  class="text-secondary-dark opacity-80"/>
            <path d="M600,400 L800,400 L900,0 L700,0 Z"
                  fill="currentColor"
                  class="text-secondary-dark opacity-80"/>
            <path d="M900,400 L1100,400 L1200,0 L1000,0 Z"
                  fill="currentColor"
                  class="text-secondary-dark opacity-80"/>
        </svg>
    </div>

    <div class="container mx-auto px-6 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $cta['title'] }}</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $cta['subtitle'] }}</p>
        <a href="{{ $baseUrl }}/contact" class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
            {{ $cta['request_course'] }}
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
