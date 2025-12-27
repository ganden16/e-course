@php
    use Illuminate\Support\Facades\Storage;

    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for product page
    $translations = include lang_path("{$locale}/product.php");
    $hero = $translations['hero'];
    $product_details = $translations['product_details'];
    $course_details = $translations['course_details'];
    $instructor = $translations['instructor'];
    $related_courses = $translations['related_courses'];
    $cta = $translations['cta'];
    $detail = $translations['detail'];

    // Build URLs with current locale
    $baseUrl = '/' . $locale;
@endphp

@if(!$product)
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $product_details['not_found'] }}</h1>
            <p class="text-gray-600 mb-8">{{ $product_details['not_exist'] }}</p>
            <a href="{{ $baseUrl }}/product" class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300">
                {{ $product_details['browse_all'] }}
            </a>
        </div>
    </div>
@else
    @include('components.header', ['title' => $product->title])

    <!-- Course Hero Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Course Image -->
                <div class="lg:w-2/5">
                    <img src="{{ $product->image }}" alt="{{ $product->title }}" class="w-full rounded-lg shadow-lg">
                    <div class="mt-6 bg-gray-100 rounded-lg p-6">
                        <h3 class="font-semibold text-lg mb-4">{{ $product_details['course_includes'] }}:</h3>
                        <ul class="space-y-2">
                            @foreach($product->features as $feature)
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Course Details -->
                <div class="lg:w-3/5">
                    <div class="mb-2">
                        <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $product->productCategory->name }}</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $product->title }}</h1>

                    <div class="flex items-center mb-6">
                        <div class="flex items-center mr-6">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < floor($product->rating))
                                    <i class="fas fa-star text-secondary"></i>
                                @else
                                    <i class="far fa-star text-secondary"></i>
                                @endif
                            @endfor
                            <span class="ml-2 font-medium">{{ $product->rating }}</span>
                            <span class="ml-1 text-gray-500">({{ $product->students }} {{ $course_details['students'] }})</span>
                        </div>
                        {{-- <div class="flex items-center text-gray-600">
                            <i class="fas fa-user-tie mr-2"></i>
                            <span>{{ $product->instructor }}</span>
                        </div> --}}
                    </div>

                    <p class="text-lg text-gray-600 mb-8">{{ $product->description }}</p>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-gray-100 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-clock text-secondary text-xl mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">{{ $product_details['duration'] }}</p>
                                    <p class="font-semibold">{{ $product->duration }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-100 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-signal text-secondary text-xl mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">{{ $product_details['level'] }}</p>
                                    <p class="font-semibold">{{ $product->level }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-100 rounded-lg p-6 mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-3xl font-bold text-secondary">{{ $product->formatted_price }}</span>
                                @if($product->price < $product->original_price)
                                    <span class="text-lg text-gray-500 line-through ml-2">{{ $product->formatted_original_price }}</span>
                                    <span class="ml-2 text-red-500 font-semibold">{{ $product_details['save'] }} {{ $product->discount_percentage }}%</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <button class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-3 rounded-lg transition duration-300 transform hover:scale-105 flex-1">
                                <i class="fas fa-shopping-cart mr-2"></i> {{ $product_details['enroll_now'] }}
                            </button>
                            {{-- <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-8 rounded-lg transition duration-300">
                                <i class="fas fa-heart mr-2"></i> {{ $product_details['add_to_wishlist'] }}
                            </button> --}}
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
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>{{ $detail['master_fundamentals'] }} {{ $product->productCategory->name }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>{{ $detail['build_projects'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>{{ $detail['learn_practices'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>{{ $detail['develop_skills'] }}</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-md">
                    <h3 class="font-semibold text-lg mb-4">{{ $product_details['career_benefits'] }}</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>{{ $detail['enhance_resume'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>{{ $detail['increase_earning'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>{{ $detail['access_opportunities'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>{{ $detail['join_community'] }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Instructor Section -->
    {{-- <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ $instructor['title'] }}</h2>
            <div class="bg-gray-100 rounded-lg p-8">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="{{ $product->instructor }}" class="w-32 h-32 rounded-full object-cover">
                    <div>
                        <h3 class="text-2xl font-semibold mb-2">{{ $product->instructor }}</h3>
                        <p class="text-gray-600 mb-4">{{ str_replace('{category}', $product->productCategory->name, $detail['instructor_bio']) }}</p>
                        <div class="flex items-center gap-6 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <span>{{ $product->rating }} {{ $instructor['rating'] }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users mr-2"></i>
                                <span>{{ $product->students }} {{ $instructor['students'] }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-play-circle mr-2"></i>
                                <span>{{ $product->duration }} {{ $instructor['content'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Related Courses Section -->
    @if(count($relatedProducts) > 0)
    <section class="py-16 bg-light">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ $locale == 'en' ? 'Related Products' : 'Produk Terkait' }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                        <img src="{{ $relatedProduct->image }}" alt="{{ $relatedProduct->title }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $relatedProduct->productCategory->name }}</span>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-secondary"></i>
                                    <span class="ml-1 text-sm font-medium">{{ $relatedProduct->rating }}</span>
                                </div>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">{{ $relatedProduct->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ $relatedProduct->description }}</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-xl font-bold text-secondary">{{ $relatedProduct->formatted_price }}</span>
                                    @if($relatedProduct->price < $relatedProduct->original_price)
                                        <span class="text-sm text-gray-500 line-through ml-2">{{ $relatedProduct->formatted_original_price }}</span>
                                    @endif
                                </div>
                                <a href="{{ $baseUrl }}/product/{{ $relatedProduct->id }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
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

    <!-- Other Products Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ $locale == 'en' ? 'Other Products' : 'Produk Lainnya' }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($otherProducts as $otherProduct)
                    <div class="bg-gray-50 rounded-xl shadow-md overflow-hidden card-hover">
                        <div class="relative">
                            <img src="{{ $otherProduct->image }}" alt="{{ $otherProduct->title }}" class="w-full h-48 object-cover">
                            @if($otherProduct->price < $otherProduct->original_price)
                                <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $otherProduct->discount_percentage }}% {{ $course_details['off'] }}
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $otherProduct->productCategory->name }}</span>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-secondary"></i>
                                    <span class="ml-1 text-sm font-medium">{{ $otherProduct->rating }}</span>
                                </div>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">{{ $otherProduct->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ $otherProduct->description }}</p>
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <i class="fas fa-user-tie mr-2"></i>
                                <span class="mr-4">{{ $course_details['instructor'] }}: {{ $otherProduct->instructor }}</span>
                                <i class="fas fa-clock mr-2"></i>
                                <span>{{ $product_details['duration'] }}: {{ $otherProduct->duration }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-xl font-bold text-secondary">{{ $otherProduct->formatted_price }}</span>
                                    @if($otherProduct->price < $otherProduct->original_price)
                                        <span class="text-sm text-gray-500 line-through ml-2">{{ $otherProduct->formatted_original_price }}</span>
                                    @endif
                                </div>
                                <a href="{{ $baseUrl }}/product/{{ $otherProduct->id }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ $baseUrl }}/product" class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300">
                    Lihat Semua Product <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary text-white relative overflow-hidden">
        <!-- Animated Background with Secondary-Dark Diamond Ribbon Pattern -->
        {{-- <div class="absolute inset-0 z-10">
            <!-- Diamond Ribbon 1 - Top Left -->
            <svg class="absolute top-0 left-0 w-80 h-80" viewBox="0 0 300 300">
                <path d="M150,50 L200,100 L150,150 L100,100 Z"
                      fill="currentColor"
                      class="text-secondary-dark"/>
                <path d="M150,150 L200,200 L150,250 L100,200 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
                <path d="M50,100 L100,150 L50,200 L0,150 Z"
                      fill="currentColor"
                      class="text-secondary-dark"/>
                <path d="M250,100 L300,150 L250,200 L200,150 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
            </svg>

            <!-- Diamond Ribbon 2 - Top Right -->
            <svg class="absolute top-0 right-0 w-80 h-80" viewBox="0 0 300 300">
                <path d="M150,50 L100,100 L150,150 L200,100 Z"
                      fill="currentColor"
                      class="text-secondary-dark"/>
                <path d="M150,150 L100,200 L150,250 L200,200 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
                <path d="M250,100 L200,150 L250,200 L300,150 Z"
                      fill="currentColor"
                      class="text-secondary-dark"/>
                <path d="M50,100 L100,150 L50,200 L0,150 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
            </svg>

            <!-- Diamond Ribbon 3 - Bottom Left -->
            <svg class="absolute bottom-0 left-0 w-80 h-80" viewBox="0 0 300 300">
                <path d="M150,250 L200,200 L150,150 L100,200 Z"
                      fill="currentColor"
                      class="text-secondary-dark"/>
                <path d="M150,150 L200,100 L150,50 L100,100 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
                <path d="M50,200 L100,150 L50,100 L0,150 Z"
                      fill="currentColor"
                      class="text-secondary-dark"/>
                <path d="M250,200 L200,150 L250,100 L200,150 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
            </svg>

            <!-- Diamond Ribbon 4 - Bottom Right -->
            <svg class="absolute bottom-0 right-0 w-80 h-80" viewBox="0 0 300 300">
                <path d="M150,250 L100,200 L150,150 L200,200 Z"
                      fill="currentColor"
                      class="text-secondary-dark"/>
                <path d="M150,150 L100,200 L150,50 L200,100 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
                <path d="M250,200 L200,150 L250,100 L300,150 Z"
                      fill="currentColor"
                      class="text-secondary-dark"/>
                <path d="M50,200 L100,150 L50,100 L0,150 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
            </svg>
        </div> --}}

        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $cta['title'] }}</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $cta['subtitle'] }}</p>
            <button class="bg-secondary border-2 border-white hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                <i class="fas fa-shopping-cart mr-2"></i> {{ $cta['enroll_now'] }}
            </button>
        </div>
    </section>

    @include('components.footer')
@endif
