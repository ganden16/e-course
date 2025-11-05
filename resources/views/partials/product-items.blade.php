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
                <a href="/{{ app()->getLocale() }}/product/{{ $product->id }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                    {{ $course_details['view_details'] }}
                </a>
            </div>
        </div>
    </div>
@endforeach
