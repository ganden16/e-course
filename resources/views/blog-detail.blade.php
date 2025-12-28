@php
    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for blog page
    $translations = include lang_path("{$locale}/blog.php");
@endphp

@include('components.header', ['title' => $blog->title])

<!-- Article Hero Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">{{ $blog->title }}</h1>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 pb-8 border-b">
                <div class="mb-4 sm:mb-0">
                    <p class="font-semibold">{{ $blog->author }}</p>
                    <p class="text-sm text-gray-500">{{ $blog->formatted_date }} • {{ $blog->read_time }}</p>
                </div>
            </div>

            <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full h-64 md:h-96 object-cover rounded-lg mb-8">

            <div class="prose prose-lg max-w-none">
                <div class="text-lg text-gray-600 mb-6 leading-relaxed">
                    @php
                        $content = str_replace('\n', "\n", $blog->content);
                    @endphp
                    {!! nl2br(e($content)) !!}
                </div>
            </div>

            <!-- Tags -->
            <div class="mt-8 pt-8 border-t">
                <div class="flex flex-wrap gap-2 mb-8">
                    @foreach($blog->tags as $tag)
                        <a href="#" class="bg-gray-100 hover:bg-primary hover:text-white text-gray-700 font-medium py-2 px-4 rounded-full transition duration-300">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Other Blogs Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Blog Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($otherBlogs as $otherBlog)
                    <div class="bg-gray-50 rounded-xl shadow-md overflow-hidden card-hover">
                        <img src="{{ $otherBlog->image }}" alt="{{ $otherBlog->title }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-500">{{ $otherBlog->read_time }}</span>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">{{ $otherBlog->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ $otherBlog->excerpt }}</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium">{{ $otherBlog->author }}</p>
                                    <p class="text-xs text-gray-500">{{ $otherBlog->formatted_date }}</p>
                                </div>
                                <a href="{{ route('blog.detail', [$locale, $otherBlog->slug]) }}" class="text-secondary hover:text-secondary-dark font-medium">
                                    {{ __('blog.blog_details.read_more') }} <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('blog', $locale) }}" class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300">
                    Lihat Semua Blog <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

@include('components.footer')
