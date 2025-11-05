@foreach($bootcamps as $bootcamp)
    <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover bootcamp-item" data-category="{{ $bootcamp->category_id }}" data-price="{{ $bootcamp->price }}" data-rating="{{ $bootcamp->rating }}" data-duration="{{ $bootcamp->duration }}">
        <div class="relative">
            <img src="{{ $bootcamp->image ? Storage::url('bootcamps/' . $bootcamp->image) : 'https://images.unsplash.com/photo-1523240795611-d4d5ec7a66?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80' }}" alt="{{ $bootcamp->title }}" class="w-full h-64 object-cover">
            @if($bootcamp->price < $bootcamp->original_price)
                <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                    {{ round((1 - $bootcamp->price / $bootcamp->original_price) * 100) }}% {{ $bootcamp_details['off'] }}
                </div>
            @endif
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-white bg-secondary/80 px-3 py-1 rounded-full">{{ $bootcamp->category->name ?? 'Uncategorized' }}</span>
                    <div class="flex items-center">
                        <i class="fas fa-star text-secondary"></i>
                        <span class="ml-1 text-sm font-medium text-white">{{ $bootcamp->rating ?? 0 }}</span>
                        <span class="ml-1 text-sm text-white">({{ $bootcamp->students ?? 0 }})</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">{{ $bootcamp->title }}</h3>
            <p class="text-gray-600 mb-4">{{ $bootcamp->description }}</p>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-clock mr-2 text-secondary"></i>
                    <span>{{ $bootcamp->duration }}</span>
                </div>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-signal mr-2 text-secondary"></i>
                    <span>{{ $bootcamp->level }}</span>
                </div>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-calendar mr-2 text-secondary"></i>
                    <span>{{ $bootcamp->start_date ? $bootcamp->start_date->format('M d, Y') : '-' }}</span>
                </div>
                <div class="flex items-center text-sm text-gray-500">
                    <i class="fas fa-user-tie mr-2 text-secondary"></i>
                    <span>{{ $bootcamp->mentors->pluck('name')->take(2)->join(', ') ?? 'No mentors' }}</span>
                </div>
            </div>

            <div class="border-t pt-4 mb-4">
                <h4 class="font-semibold mb-2">{{ $bootcamp_details['what_youll_learn'] }}:</h4>
                <div class="flex flex-wrap gap-2">
                    @foreach(array_slice($bootcamp->curriculum ?? [], 0, 3) as $item)
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">{{ $item }}</span>
                    @endforeach
                    @if(count($bootcamp->curriculum ?? []) > 3)
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">+{{ count($bootcamp->curriculum) - 3 }} {{ $bootcamp_details['more'] }}</span>
                    @endif
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <span class="text-2xl font-bold text-secondary">Rp {{ number_format($bootcamp->price, 0, ',', '.') }}</span>
                    @if($bootcamp->price < $bootcamp->original_price)
                        <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($bootcamp->original_price, 0, ',', '.') }}</span>
                    @endif
                </div>
                <a href="{{ app()->getLocale() }}/bootcamp/{{ $bootcamp->id }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                    {{ $bootcamp_details['learn_more'] }}
                </a>
            </div>
        </div>
    </div>
@endforeach
