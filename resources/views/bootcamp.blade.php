@php
    $data = json_decode(file_get_contents(resource_path('json/data.json')), true);
    $site = $data['site'];
    $bootcamps = $data['bootcamps'];
    $categories = array_unique(array_column($bootcamps, 'category'));
@endphp

@include('components.header', ['title' => 'Bootcamps'])

<!-- Hero Section -->
<section class="gradient-bg text-white py-16">
    <div class="container mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Intensive Bootcamps</h1>
            <p class="text-xl max-w-3xl mx-auto">Accelerate your career with our comprehensive bootcamps. Learn from industry experts and build real-world projects in a structured, immersive environment.</p>
        </div>
    </div>
</section>

<!-- Why Bootcamp Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Why Choose Our Bootcamps?</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Our bootcamps are designed to transform your career through intensive, hands-on learning.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-rocket text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Fast-Track Learning</h3>
                <p class="text-gray-600">Master new skills in weeks, not years</p>
            </div>
            <div class="text-center">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-briefcase text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Career Support</h3>
                <p class="text-gray-600">Job placement assistance and interview prep</p>
            </div>
            <div class="text-center">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Expert Mentors</h3>
                <p class="text-gray-600">Learn from industry professionals</p>
            </div>
            <div class="text-center">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-project-diagram text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Real Projects</h3>
                <p class="text-gray-600">Build a portfolio of real-world projects</p>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-8 bg-light border-b">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl font-semibold text-gray-800">All Bootcamps</h2>
                <p class="text-gray-600">{{ count($bootcamps) }} bootcamps available</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary" id="categoryFilter">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary" id="sortFilter">
                    <option value="default">Sort by</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="rating">Highest Rated</option>
                    <option value="duration">Shortest First</option>
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
                                {{ round((1 - $bootcamp['price'] / $bootcamp['original_price']) * 100) }}% OFF
                            </div>
                        @endif
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-white bg-secondary/80 px-3 py-1 rounded-full">{{ $bootcamp['category'] }}</span>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400"></i>
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
                            <h4 class="font-semibold mb-2">What You'll Learn:</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach(array_slice($bootcamp['curriculum'], 0, 3) as $item)
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">{{ $item }}</span>
                                @endforeach
                                @if(count($bootcamp['curriculum']) > 3)
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">+{{ count($bootcamp['curriculum']) - 3 }} more</span>
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
                            <a href="/bootcamp/{{ $bootcamp['id'] }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                Load More Bootcamps
            </button>
        </div>
    </div>
</section>

<!-- Success Stories Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Success Stories</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Hear from our graduates who have transformed their careers through our bootcamps.</p>
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
                <p class="text-gray-600 italic">"The bootcamp gave me both the skills and confidence to pursue my passion. I'm now working on products used by millions!"</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-light" x-data="{ open: 0 }">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Frequently Asked Questions</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Got questions about our bootcamps? We've got answers.</p>
        </div>
        <div class="max-w-3xl mx-auto">
            <div class="mb-4">
                <button @click="open = 0" class="w-full text-left bg-white p-4 rounded-lg shadow-md flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-semibold">How long are the bootcamps?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 0 }"></i>
                </button>
                <div x-show="open === 0" x-transition class="bg-white p-4 rounded-b-lg shadow-md">
                    <p class="text-gray-600">Our bootcamps range from 8 to 14 weeks, depending on the program. Each bootcamp includes intensive training, projects, and career support.</p>
                </div>
            </div>
            <div class="mb-4">
                <button @click="open = 1" class="w-full text-left bg-white p-4 rounded-lg shadow-md flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-semibold">Do I need prior experience?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 1 }"></i>
                </button>
                <div x-show="open === 1" x-transition class="bg-white p-4 rounded-b-lg shadow-md">
                    <p class="text-gray-600">It depends on the bootcamp. We offer beginner-friendly programs as well as intermediate-level bootcamps. Check the requirements for each specific program.</p>
                </div>
            </div>
            <div class="mb-4">
                <button @click="open = 2" class="w-full text-left bg-white p-4 rounded-lg shadow-md flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-semibold">Is job placement guaranteed?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 2 }"></i>
                </button>
                <div x-show="open === 2" x-transition class="bg-white p-4 rounded-b-lg shadow-md">
                    <p class="text-gray-600">While we can't guarantee job placement, we provide comprehensive career support including resume building, interview preparation, and networking opportunities. Our job placement rate is over 85%.</p>
                </div>
            </div>
            <div class="mb-4">
                <button @click="open = 3" class="w-full text-left bg-white p-4 rounded-lg shadow-md flex justify-between items-center hover:bg-gray-50 transition">
                    <span class="font-semibold">Are payment plans available?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 3 }"></i>
                </button>
                <div x-show="open === 3" x-transition class="bg-white p-4 rounded-b-lg shadow-md">
                    <p class="text-gray-600">Yes, we offer flexible payment plans and financing options to make our bootcamps accessible. Contact our admissions team for more information.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 gradient-bg text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Transform Your Career?</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">Take the first step towards a new career in tech. Apply now and join our next cohort!</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/contact" class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                Apply Now
            </a>
            <a href="/contact" class="bg-transparent border-2 border-white hover:bg-white hover:text-primary text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                Schedule a Consultation
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

    categoryFilter.addEventListener('change', function() {
        filterBootcamps();
        sortBootcamps();
    });

    sortFilter.addEventListener('change', function() {
        sortBootcamps();
    });
});
</script>
