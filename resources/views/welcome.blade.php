@php
    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for landing page
    $translations = include lang_path("{$locale}/landingPage.php");
    $site = $translations['site'];
    $hero = $translations['hero'];
    $stats = $translations['stats'];
    $features = $translations['features'];
    $featured_courses = $translations['featured_courses'];
    $upcoming_bootcamps = $translations['upcoming_bootcamps'];
    $latest_blog = $translations['latest_blog'];
    $testimonials = $translations['testimonials'];
    $cta = $translations['cta'];

    // Load data from JSON for dynamic content
    $data = json_decode(file_get_contents(resource_path('json/data.json')), true);
    $statsData = $data['stats'];
    $featuresData = $data['features'];
    $testimonialsData = $data['testimonials'];
    $products = array_slice($data['products'], 0, 3); // Get first 3 products
    $blogs = array_slice($data['blogs'], 0, 3); // Get first 3 blogs
    $bootcamps = array_slice($data['bootcamps'], 0, 2); // Get first 2 bootcamps

    // Build URLs with current locale
    $baseUrl = '/' . $locale;
@endphp

@include('components.header', ['title' => 'Home'])

<!-- Hero Section -->
<section class="gradient-bg text-white">
    <div class="container mx-auto px-6 py-16 lg:py-24">
        <div class="flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 lg:pr-10">
                <h1 class="text-4xl lg:text-5xl font-bold leading-tight mb-4 float-animation">
                    {{ $hero['title'] }}
                </h1>
                <p class="text-xl lg:text-2xl mb-8 font-light">
                    {{ $hero['subtitle'] }}
                </p>
                <p class="text-base mb-8 opacity-90">
                    {{ $hero['description'] }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ $baseUrl }}/product" class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg text-center">
                        {{ $hero['cta_text'] }}
                    </a>
                    <a href="{{ $baseUrl }}/community" class="bg-transparent border-2 border-white hover:bg-white hover:text-primary text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 text-center">
                        {{ $hero['cta_secondary'] }}
                    </a>
                </div>
            </div>
            <div class="lg:w-1/2 mt-10 lg:mt-0">
                <img src="{{ $data['hero']['image'] }}" alt="E-Learning Platform" class="w-full h-auto rounded-lg shadow-2xl">
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach($statsData as $index => $stat)
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-primary mb-2 pulse-animation">{{ $stat['number'] }}</div>
                    <div class="text-gray-600">{{ $stats['active_students'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $features['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $features['subtitle'] }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuresData as $index => $feature)
                <div class="text-center bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                        <i class="{{ $feature['icon'] }} text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-gray-600">{{ $feature['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Courses Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $featured_courses['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $featured_courses['subtitle'] }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-primary bg-primary/10 px-3 py-1 rounded-full">{{ $product['category'] }}</span>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400"></i>
                                <span class="ml-1 text-sm font-medium">{{ $product['rating'] }}</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $product['title'] }}</h3>
                        <p class="text-gray-600 mb-4">{{ $product['description'] }}</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-primary">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($product['original_price'], 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ $baseUrl }}/product/{{ $product['id'] }}" class="bg-primary hover:bg-primary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                {{ $featured_courses['view_details'] }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ $baseUrl }}/product" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                {{ $featured_courses['view_all_courses'] }}
            </a>
        </div>
    </div>
</section>

<!-- Upcoming Bootcamps Section -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $upcoming_bootcamps['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $upcoming_bootcamps['subtitle'] }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($bootcamps as $bootcamp)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    <div class="md:flex">
                        <div class="md:w-1/3">
                            <img src="{{ $bootcamp['image'] }}" alt="{{ $bootcamp['title'] }}" class="w-full h-48 md:h-full object-cover">
                        </div>
                        <div class="md:w-2/3 p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $bootcamp['category'] }}</span>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <span class="ml-1 text-sm font-medium">{{ $bootcamp['rating'] }}</span>
                                </div>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">{{ $bootcamp['title'] }}</h3>
                            <p class="text-gray-600 mb-4">{{ $bootcamp['description'] }}</p>
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <i class="fas fa-clock mr-2"></i>
                                <span class="mr-4">{{ $bootcamp['duration'] }}</span>
                                <i class="fas fa-calendar mr-2"></i>
                                <span>{{ $bootcamp['start_date'] }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-2xl font-bold text-primary">Rp {{ number_format($bootcamp['price'], 0, ',', '.') }}</span>
                                    <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($bootcamp['original_price'], 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ $baseUrl }}/bootcamp/{{ $bootcamp['id'] }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                    {{ $upcoming_bootcamps['learn_more'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ $baseUrl }}/bootcamp" class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                {{ $upcoming_bootcamps['view_all_bootcamps'] }}
            </a>
        </div>
    </div>
</section>

<!-- Latest Blog Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $latest_blog['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $latest_blog['subtitle'] }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    <img src="{{ $blog['image'] }}" alt="{{ $blog['title'] }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-primary bg-primary/10 px-3 py-1 rounded-full">{{ $blog['category'] }}</span>
                            <span class="text-sm text-gray-500">{{ $blog['read_time'] }}</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $blog['title'] }}</h3>
                        <p class="text-gray-600 mb-4">{{ $blog['excerpt'] }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="{{ $blog['avatar'] }}" alt="{{ $blog['author'] }}" class="w-8 h-8 rounded-full mr-2">
                                <div>
                                    <p class="text-sm font-medium">{{ $blog['author'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $blog['date'] }}</p>
                                </div>
                            </div>
                            <a href="{{ $baseUrl }}/blog/{{ $blog['id'] }}" class="text-primary hover:text-primary-dark font-medium">
                                {{ $latest_blog['read_more'] }} <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ $baseUrl }}/blog" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                {{ $latest_blog['view_all_articles'] }}
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $testimonials['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $testimonials['subtitle'] }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonialsData as $testimonial)
                <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                    <div class="flex items-center mb-4">
                        <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold">{{ $testimonial['name'] }}</h4>
                            <p class="text-sm text-gray-500">{{ $testimonial['role'] }}</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <i class="fas fa-star text-yellow-400"></i>
                        @endfor
                    </div>
                    <p class="text-gray-600 italic">"{{ $testimonial['content'] }}"</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 gradient-bg text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $cta['title'] }}</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $cta['subtitle'] }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ $baseUrl }}/product" class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                {{ $cta['browse_courses'] }}
            </a>
            <a href="{{ $baseUrl }}/contact" class="bg-transparent border-2 border-white hover:bg-white hover:text-primary text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                {{ $cta['contact_us'] }}
            </a>
        </div>
    </div>
</section>

@include('components.footer')
