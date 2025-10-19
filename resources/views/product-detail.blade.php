@php
    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for product page
    $translations = include lang_path("{$locale}/product.php");
    $hero = $translations['hero'];
    $product_details = $translations['product_details'];
    $instructor = $translations['instructor'];
    $related_courses = $translations['related_courses'];
    $cta = $translations['cta'];

    // Load data from JSON for dynamic content
    $data = json_decode(file_get_contents(resource_path('json/data.json')), true);
    $site = $data['site'];
    $products = $data['products'];
    $product = null;

    // Extract the product ID from the current URL
    $currentPath = request()->path();
    $pathParts = explode('/', $currentPath);
    $productId = end($pathParts); // Get the last part of the URL

    // Find the product by ID
    foreach($products as $p) {
        if($p['id'] == intval($productId)) {
            $product = $p;
            break;
        }
    }

    // Get related products (same category, excluding current product)
    $relatedProducts = [];
    if($product) {
        $relatedProducts = array_filter($products, function($p) use ($product) {
            return $p['category'] === $product['category'] && $p['id'] != $product['id'];
        });
        $relatedProducts = array_slice($relatedProducts, 0, 3);
    }

    // Build URLs with current locale
    $baseUrl = '/' . $locale;
@endphp

@if(!$product)
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $product_details['not_found'] }}</h1>
            <p class="text-gray-600 mb-8">{{ $product_details['not_exist'] }}</p>
            <a href="{{ $baseUrl }}/product" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300">
                {{ $product_details['browse_all'] }}
            </a>
        </div>
    </div>
@else
    @include('components.header', ['title' => $product['title']])

    <!-- Course Hero Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Course Image -->
                <div class="lg:w-2/5">
                    <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" class="w-full rounded-lg shadow-lg">
                    <div class="mt-6 bg-gray-100 rounded-lg p-6">
                        <h3 class="font-semibold text-lg mb-4">{{ $product_details['course_includes'] }}:</h3>
                        <ul class="space-y-2">
                            @foreach($product['features'] as $feature)
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Course Details -->
                <div class="lg:w-3/5">
                    <div class="mb-2">
                        <span class="text-sm font-medium text-primary bg-primary/10 px-3 py-1 rounded-full">{{ $product['category'] }}</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $product['title'] }}</h1>

                    <div class="flex items-center mb-6">
                        <div class="flex items-center mr-6">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < floor($product['rating']))
                                    <i class="fas fa-star text-yellow-400"></i>
                                @else
                                    <i class="far fa-star text-yellow-400"></i>
                                @endif
                            @endfor
                            <span class="ml-2 font-medium">{{ $product['rating'] }}</span>
                            <span class="ml-1 text-gray-500">({{ $product['students'] }} students)</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-user-tie mr-2"></i>
                            <span>{{ $product['instructor'] }}</span>
                        </div>
                    </div>

                    <p class="text-lg text-gray-600 mb-8">{{ $product['description'] }}</p>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-gray-100 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-clock text-primary text-xl mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">{{ $product_details['duration'] }}</p>
                                    <p class="font-semibold">{{ $product['duration'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-100 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-signal text-primary text-xl mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">{{ $product_details['level'] }}</p>
                                    <p class="font-semibold">{{ $product['level'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-100 rounded-lg p-6 mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-3xl font-bold text-primary">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                                @if($product['price'] < $product['original_price'])
                                    <span class="text-lg text-gray-500 line-through ml-2">Rp {{ number_format($product['original_price'], 0, ',', '.') }}</span>
                                    <span class="ml-2 text-red-500 font-semibold">{{ $product_details['save'] }} {{ round((1 - $product['price'] / $product['original_price']) * 100) }}%</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105 flex-1">
                                <i class="fas fa-shopping-cart mr-2"></i> {{ $product_details['enroll_now'] }}
                            </button>
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-8 rounded-lg transition duration-300">
                                <i class="fas fa-heart mr-2"></i> {{ $product_details['add_to_wishlist'] }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Content Section -->
    <section class="py-16 bg-light">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ $product_details['what_youll_learn'] }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg p-6 shadow-md">
                    <h3 class="font-semibold text-lg mb-4">{{ $product_details['key_skills'] }}</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                            <span>Master the fundamentals of {{ $product['category'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                            <span>Build real-world projects and portfolio pieces</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                            <span>Learn industry best practices and standards</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                            <span>Develop problem-solving and critical thinking skills</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-md">
                    <h3 class="font-semibold text-lg mb-4">{{ $product_details['career_benefits'] }}</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                            <span>Enhance your resume with in-demand skills</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                            <span>Increase your earning potential</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                            <span>Access new job opportunities</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                            <span>Join a community of professionals</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Instructor Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ $instructor['title'] }}</h2>
            <div class="bg-gray-100 rounded-lg p-8">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="{{ $product['instructor'] }}" class="w-32 h-32 rounded-full object-cover">
                    <div>
                        <h3 class="text-2xl font-semibold mb-2">{{ $product['instructor'] }}</h3>
                        <p class="text-gray-600 mb-4">Expert {{ $product['category'] }} with over 10 years of industry experience. Passionate about teaching and helping students achieve their career goals.</p>
                        <div class="flex items-center gap-6 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <span>{{ $product['rating'] }} {{ $instructor['rating'] }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users mr-2"></i>
                                <span>{{ $product['students'] }} {{ $instructor['students'] }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-play-circle mr-2"></i>
                                <span>{{ $product['duration'] }} {{ $instructor['content'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Courses Section -->
    @if(count($relatedProducts) > 0)
    <section class="py-16 bg-light">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ $related_courses['title'] }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                        <img src="{{ $relatedProduct['image'] }}" alt="{{ $relatedProduct['title'] }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-primary bg-primary/10 px-3 py-1 rounded-full">{{ $relatedProduct['category'] }}</span>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400"></i>
                                    <span class="ml-1 text-sm font-medium">{{ $relatedProduct['rating'] }}</span>
                                </div>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">{{ $relatedProduct['title'] }}</h3>
                            <p class="text-gray-600 mb-4">{{ $relatedProduct['description'] }}</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-xl font-bold text-primary">Rp {{ number_format($relatedProduct['price'], 0, ',', '.') }}</span>
                                    @if($relatedProduct['price'] < $relatedProduct['original_price'])
                                        <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($relatedProduct['original_price'], 0, ',', '.') }}</span>
                                    @endif
                                </div>
                                <a href="{{ $baseUrl }}/product/{{ $relatedProduct['id'] }}" class="bg-primary hover:bg-primary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                    {{ $related_courses['view_details'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="py-16 gradient-bg text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $cta['title'] }}</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $cta['subtitle'] }}</p>
            <button class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                <i class="fas fa-shopping-cart mr-2"></i> {{ $cta['enroll_now'] }}
            </button>
        </div>
    </section>

    @include('components.footer')
@endif
