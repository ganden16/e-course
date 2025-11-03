@php
    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for bootcamp page
    $translations = include lang_path("{$locale}/bootcamp-new.php");
    $hero = $translations['hero'];
    $filter = $translations['filter'];
    $bootcamp_details = $translations['bootcamp_details'];
    $load_more = $translations['load_more'];
    $benefits = $translations['benefits'];
    $success_stories = $translations['success_stories'];
    $faq = $translations['faq'];
    $cta = $translations['cta'];

    // Get bootcamps from language file
    $bootcamps = $translations['bootcamps'];
    $categories = array_unique(array_column($bootcamps, 'category'));

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
            @foreach($benefits['items'] as $key => $item)
                <div class="text-center">
                    <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <i class="{{ $item['icon'] }} text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ $item['title'] }}</h3>
                    <p class="text-gray-600">{{ $item['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-8 bg-light border-b">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl font-semibold text-gray-800">{{ $filter['all_bootcamps'] }}</h2>
                <p class="text-gray-600">{{ count($bootcamps) }} {{ $filter['bootcamps_available'] }}</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary" id="categoryFilter">
                    <option value="">{{ $filter['all_categories'] }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary" id="sortFilter">
                    @foreach($filter['options'] as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</section>

<!-- Bootcamps Grid -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8" id="bootcampsGrid">
            @foreach($bootcamps as $bootcamp)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover bootcamp-item" data-category="{{ $bootcamp['category'] }}" data-price="{{ $bootcamp['price'] }}" data-rating="{{ $bootcamp['rating'] }}" data-duration="{{ $bootcamp['duration'] }}">
                    <div class="relative">
                        <img src="{{ $bootcamp['image'] }}" alt="{{ $bootcamp['title'] }}" class="w-full h-64 object-cover">
                        @if($bootcamp['price'] < $bootcamp['original_price'])
                            <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ round((1 - $bootcamp['price'] / $bootcamp['original_price']) * 100) }}% {{ $bootcamp_details['off'] }}
                            </div>
                        @endif
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-white bg-secondary/80 px-3 py-1 rounded-full">{{ $bootcamp['category'] }}</span>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-secondary"></i>
                                    <span class="ml-1 text-sm font-medium text-white">{{ $bootcamp['rating'] }}</span>
                                    <span class="ml-1 text-sm text-white">({{ $bootcamp['students'] }})</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $bootcamp['title'] }}</h3>
                        <p class="text-gray-600 mb-4">{{ $bootcamp['description'] }}</p>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-clock mr-2 text-secondary"></i>
                                <span>{{ $bootcamp['duration'] }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-signal mr-2 text-secondary"></i>
                                <span>{{ $bootcamp['level'] }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-calendar mr-2 text-secondary"></i>
                                <span>{{ $bootcamp['start_date'] }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-user-tie mr-2 text-secondary"></i>
                                <span>{{ $bootcamp['instructor'] }}</span>
                            </div>
                        </div>

                        <div class="border-t pt-4 mb-4">
                            <h4 class="font-semibold mb-2">{{ $bootcamp_details['what_youll_learn'] }}:</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach(array_slice($bootcamp['curriculum'], 0, 3) as $item)
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">{{ $item }}</span>
                                @endforeach
                                @if(count($bootcamp['curriculum']) > 3)
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">+{{ count($bootcamp['curriculum']) - 3 }} {{ $bootcamp_details['more'] }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-secondary">Rp {{ number_format($bootcamp['price'], 0, ',', '.') }}</span>
                                @if($bootcamp['price'] < $bootcamp['original_price'])
                                    <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($bootcamp['original_price'], 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <a href="{{ $baseUrl }}/bootcamp/{{ $bootcamp['id'] }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                {{ $bootcamp_details['learn_more'] }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                {{ $load_more['bootcamps'] }}
            </button>
        </div>
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
            @foreach($success_stories['stories'] as $story)
                <div class="bg-gray-100 rounded-xl p-6 text-center">
                    <img src="{{ $story['image'] }}" alt="{{ $story['name'] }}" class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="text-xl font-semibold mb-2">{{ $story['name'] }}</h3>
                    <p class="text-gray-600 mb-2">{{ $story['position'] }}</p>
                    <p class="text-sm text-gray-500 mb-4">{{ $success_stories['graduated'] }} {{ $story['graduated'] }}</p>
                    <p class="text-gray-600 italic">{{ $story['testimonial'] }}</p>
                </div>
            @endforeach
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
            @foreach($faq['items'] as $index => $item)
                <div class="mb-4">
                    <button @click="open = {{ $index }}" class="w-full text-left bg-white p-4 rounded-lg shadow-md flex justify-between items-center hover:bg-gray-50 transition">
                        <span class="font-semibold">{{ $item['question'] }}</span>
                        <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === {{ $index}} }"></i>
                    </button>
                    <div x-show="open === {{ $index }}" x-transition class="bg-white p-4 rounded-b-lg shadow-md">
                        <p class="text-gray-600">{{ $item['answer'] }}</p>
                    </div>
                </div>
            @endforeach
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
    const bootcampItems = Array.from(bootcampsGrid.querySelectorAll('.bootcamp-item'));

    function filterBootcamps() {
        const selectedCategory = categoryFilter.value;

        bootcampItems.forEach(item => {
            const itemCategory = item.getAttribute('data-category');

            if (selectedCategory === '' || itemCategory === selectedCategory) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function sortBootcamps() {
        const sortValue = sortFilter.value;
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
            case 'highest_rated':
                sortedItems.sort((a, b) => {
                    return parseFloat(b.getAttribute('data-rating')) - parseFloat(a.getAttribute('data-rating'));
                });
                break;
            case 'shortest_first':
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

    categoryFilter.addEventListener('change', function() {
        filterBootcamps();
        sortBootcamps();
    });

    sortFilter.addEventListener('change', function() {
        sortBootcamps();
    });
});
</script>
