@foreach($blogs as $blog)
    <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover blog-item" data-date="{{ $blog->published_at->format('Y-m-d') }}">
        <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
        <div class="p-6">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm text-gray-500">{{ $blog->read_time }}</span>
            </div>
            <h3 class="text-xl font-semibold mb-2">{{ $blog->title }}</h3>
            <p class="text-gray-600 mb-4">{{ $blog->excerpt }}</p>
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach($blog->tags->take(3) as $tag)
                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">#{{ $tag->name }}</span>
                @endforeach
            </div>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium">{{ $blog->author }}</p>
                    <p class="text-xs text-gray-500">{{ $blog->formatted_date }}</p>
                </div>
                <a href="{{ route('blog.detail', [app()->getLocale(), $blog->slug]) }}" class="text-secondary hover:text-secondary-dark font-medium">
                    {{ $blog_details['read_more'] }} <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
@endforeach
