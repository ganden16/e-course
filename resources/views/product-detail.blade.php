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
                        <h3 class="font-semibold text-lg mb-4">{{ $product_details['course_includes'] }}</h3>
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
                            <a href="{{ $product->lynkid }}" class="w-full" target="_blank">
                                <button class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-3 rounded-lg transition duration-300 transform hover:scale-105 flex-1 w-full">
                                    <i class="fas fa-shopping-cart mr-2"></i> {{ $product_details['enroll_now'] }}
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Curriculum Section -->
    @if(!empty($product->curriculum))
    <section class="py-16 bg-light">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ $locale == 'en' ? 'Curriculum' : 'Kurikulum' }}</h2>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <ul class="space-y-3">
                        @foreach($product->curriculum as $index => $item)
                            @if(!empty($item))
                            <li class="flex items-start border-b border-gray-100 pb-3 last:border-b-0 last:pb-0">
                                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-secondary text-white font-bold mr-4 flex-shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800">{{ $item }}</p>
                                </div>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Requirements Section -->
    @if(!empty($product->requirements))
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ $locale == 'en' ? 'Requirements' : 'Persyaratan' }}</h2>
            <div class="bg-gray-50 rounded-lg p-8">
                <ul class="space-y-3">
                    @foreach($product->requirements as $requirement)
                        @if(!empty($requirement))
                        <li class="flex items-start">
                            <i class="fas fa-check text-secondary mt-1 mr-4"></i>
                            <span class="text-gray-700">{{ $requirement }}</span>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    @endif

    <!-- What You Will Build Section -->
    @if(!empty($product->what_you_will_build))
    <section class="py-16 bg-light">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ $locale == 'en' ? 'What You Will Build' : 'Yang Akan Anda Bangun' }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($product->what_you_will_build as $item)
                    @if(!empty($item))
                    <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center mr-4">
                                <i class="fas fa-cube text-secondary text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $locale == 'en' ? 'Project' : 'Proyek' }} {{ $loop->iteration }}</h3>
                        </div>
                        <p class="text-gray-600">{{ $item }}</p>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Instructor Section -->
    {{-- <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ $locale == 'en' ? 'Instructor' : 'Instruktur' }}</h2>
            <div class="bg-gray-100 rounded-lg p-8">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center">
                        <i class="fas fa-user-tie text-gray-600 text-5xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-semibold mb-2">{{ $product->instructor }}</h3>
                        <p class="text-gray-600 mb-4">
                            {{ $locale == 'en' ? 'Experienced instructor in ' : 'Instruktur berpengalaman dalam bidang ' }}{{ $product->productCategory->name }}
                        </p>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 mr-2"></i>
                                <span>{{ $product->rating }} {{ $instructor['rating'] }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users mr-2"></i>
                                <span>{{ $product->students }} {{ $instructor['students'] }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-2"></i>
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
                                    {{ $locale == 'en' ? 'View Details' : 'Lihat Detail' }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ $baseUrl }}/product" class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300">
                    {{ $locale == 'en' ? 'View All Products' : 'Lihat Semua Product' }} <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary text-white relative overflow-hidden">
        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $cta['title'] }}</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $cta['subtitle'] }}</p>
            <a href="{{ $product->lynkid }}" class="w-full" target="_blank">
                <button class="bg-secondary border-2 border-white hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-shopping-cart mr-2"></i> {{ $cta['enroll_now'] }}
                </button>
            </a>
        </div>
    </section>

    @include('components.footer')
@endif
