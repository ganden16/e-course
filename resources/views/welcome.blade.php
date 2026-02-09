@php
    use Illuminate\Support\Str;

    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for landing page
    $translations = include lang_path("{$locale}/landingPage.php");
    $hero = $translations['hero'];
    $stats = $translations['stats'];
    $features = $translations['features'];
    $featured_courses = $translations['featured_courses'];
    $upcoming_bootcamps = $translations['upcoming_bootcamps'];
    $latest_blog = $translations['latest_blog'];
    $testimonials = $translations['testimonials'];
    $cta = $translations['cta'];

    // Get data from language files
    $statsData = $stats['data'];
    $featuresData = $features['data'];
    $testimonialsData = $testimonials['data'];

    // Build URLs with current locale
    $baseUrl = '/' . $locale;
@endphp

@include('components.header', ['title' => 'Home'])

<style>
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
</style>

<!-- Hero Section -->
    <section class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <!-- Use original hero image -->
            <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ $hero['image'] }}');">
                <!-- Dark Overlay -->
                <div class="absolute inset-0 bg-black/50"></div>
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
            </div>
        </div>

        <!-- Hero Content -->
        <div class="container mx-auto px-6 py-20 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Headline - Keep original content -->
                <h1 class="text-4xl lg:text-5xl font-bold leading-tight mb-4 text-white tracking-wide">
                    {{ $hero['title'] }}
                </h1>

                <!-- Subheadline - Keep original content -->
                <p class="text-xl lg:text-2xl mb-8 font-light text-gray-200">
                    {{ $hero['subtitle'] }}
                </p>

                <!-- Description - Keep original content -->
                <p class="text-base mb-8 opacity-90 text-gray-300">
                    {{ $hero['description'] }}
                </p>

                <!-- CTA Buttons - Keep original content and links -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <!-- Primary Button - Keep original text and link -->
                    <a href="{{ $baseUrl }}/bootcamp" class="bg-primary hover:bg-primary-dark text-white font-bold py-4 px-10 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                        {{ $hero['cta_text'] }}
                    </a>

                    <!-- Secondary Button - Keep original text and link -->
                    <a href="{{ $baseUrl }}/community" class="hover:bg-white hover:text-primary border border-white text-white font-bold py-4 px-10 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                        {{ $hero['cta_secondary'] }}
                    </a>
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
                    <div class="text-3xl md:text-4xl font-bold text-secondary mb-2 pulse-animation">{{ $stat['number'] }}</div>
                    <div class="text-gray-600">{{ $stat['label'] }}</div>
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
            @foreach($features['data'] as $feature)
                <div class="text-center bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="text-secondary text-600 mb-4">
                        <i class="{{ $feature['emoji'] }} text-4xl text-secondary"></i>
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
                    <img src="{{ $product->image }}" alt="{{ $product->title }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $product->productCategory->name ?? 'Uncategorized' }}</span>
                            <div class="flex items-center">
                                <i class="fas fa-star text-secondary"></i>
                                <span class="ml-1 text-sm font-medium">{{ $product->rating }}</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $product->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-secondary">{{ $product->formatted_price }}</span>
                                <span class="text-sm text-gray-500 line-through ml-2">{{ $product->formatted_original_price }}</span>
                            </div>
                            <a href="{{ $baseUrl }}/product/{{ $product->id }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                {{ $featured_courses['view_details'] }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ $baseUrl }}/product" class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
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
                            <img src="{{ $bootcamp->image }}" alt="{{ $bootcamp->title }}" class="w-full h-48 md:h-full object-cover">
                        </div>
                        <div class="md:w-2/3 p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $bootcamp->category->name ?? 'Uncategorized' }}</span>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-secondary"></i>
                                    <span class="ml-1 text-sm font-medium">{{ $bootcamp->rating }}</span>
                                </div>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">{{ $bootcamp->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($bootcamp->description, 100) }}</p>
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <i class="fas fa-clock mr-2"></i>
                                <span class="mr-4">{{ $bootcamp->duration }}</span>
                                <i class="fas fa-calendar mr-2"></i>
                                <span>{{ $bootcamp->start_date ? $bootcamp->start_date->format('M d, Y') : 'Coming Soon' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-2xl font-bold text-secondary">{{ $bootcamp->formatted_price }}</span>
                                    <span class="text-sm text-gray-500 line-through ml-2">{{ $bootcamp->formatted_original_price }}</span>
                                </div>
                                <a href="{{ $baseUrl }}/bootcamp/{{ $bootcamp->id }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
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
                    <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            @if($blog->tags->count() > 0)
                                <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $blog->tags->first()->name }}</span>
                            @else
                                <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">Blog</span>
                            @endif
                            <span class="text-sm text-gray-500">{{ $blog->read_time ?? '5 min read' }}</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $blog->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $blog->excerpt }}</p>
                        <div class="flex items-center justify-between">
                            <a href="{{ $baseUrl }}/blog/{{ $blog->slug }}" class="text-secondary hover:text-secondary-dark font-medium">
                                {{ $latest_blog['read_more'] }} <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ $baseUrl }}/blog" class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
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
                        <img src="{{ asset('assets/images/users/avatar.jpg') }}" alt="{{ $testimonial['name'] }}" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold">{{ $testimonial['name'] }}</h4>
                            {{-- <p class="text-sm text-gray-500">{{ $testimonial['role'] }}</p> --}}
                        </div>
                    </div>
                    <div class="flex mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <i class="fas fa-star text-secondary"></i>
                        @endfor
                    </div>
                    <p class="text-gray-600 italic">"{{ $testimonial['content'] }}"</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-primary text-white relative overflow-hidden">
    <!-- Animated Background with Secondary-Dark Corner Ribbon Spiral Pattern -->
    {{-- <div class="absolute inset-0 z-10">
        <!-- Top Left Corner Ribbon Spiral -->
        <svg class="absolute top-0 left-0 w-80 h-80" viewBox="0 0 300 300">
            <path d="M0,0 Q150,0 150,150 T0,300 Q75,300 75,225 T0,150 Q75,150 75,75 T0,0"
                  stroke="currentColor"
                  stroke-width="25"
                  fill="none"
                  stroke-linecap="round"
                  class="text-secondary-dark"/>
            <path d="M0,0 Q150,0 150,150 T0,300 Q75,300 75,225 T0,150 Q75,150 75,75 T0,0"
                  stroke="currentColor"
                  stroke-width="15"
                  fill="none"
                  stroke-linecap="round"
                  class="text-secondary-dark"/>
        </svg>

        <!-- Top Right Corner Ribbon Spiral -->
        <svg class="absolute top-0 right-0 w-80 h-80" viewBox="0 0 300 300">
            <path d="M300,0 Q150,0 150,150 T300,300 Q225,300 225,225 T300,150 Q225,150 225,75 T300,0"
                  stroke="currentColor"
                  stroke-width="25"
                  fill="none"
                  stroke-linecap="round"
                  class="text-secondary-dark"/>
            <path d="M300,0 Q150,0 150,150 T300,300 Q225,300 225,225 T300,150 Q225,150 225,75 T300,0"
                  stroke="currentColor"
                  stroke-width="15"
                  fill="none"
                  stroke-linecap="round"
                  class="text-secondary-dark"/>
        </svg>

        <!-- Bottom Left Corner Ribbon Spiral -->
        <svg class="absolute bottom-0 left-0 w-80 h-80" viewBox="0 0 300 300">
            <path d="M0,300 Q150,300 150,150 T0,0 Q75,0 75,75 T0,150 Q75,150 75,225 T0,300"
                  stroke="currentColor"
                  stroke-width="25"
                  fill="none"
                  stroke-linecap="round"
                  class="text-secondary-dark"/>
            <path d="M0,300 Q150,300 150,150 T0,0 Q75,0 75,75 T0,150 Q75,150 75,225 T0,300"
                  stroke="currentColor"
                  stroke-width="15"
                  fill="none"
                  stroke-linecap="round"
                  class="text-secondary-dark"/>
        </svg>

        <!-- Bottom Right Corner Ribbon Spiral -->
        <svg class="absolute bottom-0 right-0 w-80 h-80" viewBox="0 0 300 300">
            <path d="M300,300 Q150,300 150,150 T300,0 Q225,0 225,75 T300,150 Q225,150 225,225 T300,300"
                  stroke="currentColor"
                  stroke-width="25"
                  fill="none"
                  stroke-linecap="round"
                  class="text-secondary-dark"/>
            <path d="M300,300 Q150,300 150,150 T300,0 Q225,0 225,75 T300,150 Q225,150 225,225 T300,300"
                  stroke="currentColor"
                  stroke-width="15"
                  fill="none"
                  stroke-linecap="round"
                  class="text-secondary-dark"/>
        </svg>
    </div> --}}

    <div class="container mx-auto px-6 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $cta['title'] }}</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $cta['subtitle'] }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ $baseUrl }}/bootcamp" class="bg-secondary border-2 border-white hover:text-white hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                {{ $cta['browse_courses'] }}
            </a>
            <a href="{{ $baseUrl }}/contact" class="bg-transparent border-2 border-white hover:bg-white hover:text-secondary text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                {{ $cta['contact_us'] }}
            </a>
        </div>
    </div>
</section>

@include('components.footer')
