@php
    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for blog page
    $translations = include lang_path("{$locale}/blog.php");

    // Get blogs from language file
    $blogs = $translations['blogs'];
    $blog = null;

    // Extract the blog ID from the current URL
    $currentPath = request()->path();
    $pathParts = explode('/', $currentPath);
    $blogId = end($pathParts); // Get the last part of the URL

    // Find the blog by ID
    foreach($blogs as $b) {
        if($b['id'] == intval($blogId)) {
            $blog = $b;
            break;
        }
    }

    // Get related articles (same category, excluding current article)
    $relatedArticles = [];
    if($blog) {
        $relatedArticles = array_filter($blogs, function($b) use ($blog) {
            return $b['category'] === $blog['category'] && $b['id'] != $blog['id'];
        });
        $relatedArticles = array_slice($relatedArticles, 0, 3);
    }
@endphp

@if(!$blog)
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Article Not Found</h1>
            <p class="text-gray-600 mb-8">The article you're looking for doesn't exist.</p>
            <a href="/{{ $locale }}/blog" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300">
                Browse All Articles
            </a>
        </div>
    </div>
@else
    @include('components.header', ['title' => $blog['title']])

    <!-- Article Hero Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <div class="mb-6">
                    <span class="text-sm font-medium text-primary bg-primary/10 px-3 py-1 rounded-full">{{ $blog['category'] }}</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">{{ $blog['title'] }}</h1>

                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 pb-8 border-b">
                    {{-- <div class="flex items-center mb-4 sm:mb-0">
                        <img src="{{ $blog['avatar'] }}" alt="{{ $blog['author'] }}" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <p class="font-semibold">{{ $blog['author'] }}</p>
                            <p class="text-sm text-gray-500">{{ $blog['date'] }} • {{ $blog['read_time'] }}</p>
                        </div>
                    </div> --}}
                    {{-- <div class="flex items-center space-x-4">
                        <button class="text-gray-600 hover:text-primary transition-colors">
                            <i class="fab fa-facebook text-xl"></i>
                        </button>
                        <button class="text-gray-600 hover:text-primary transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </button>
                        <button class="text-gray-600 hover:text-primary transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </button>
                        <button class="text-gray-600 hover:text-primary transition-colors">
                            <i class="fas fa-link text-xl"></i>
                        </button>
                    </div> --}}
                </div>

                <img src="{{ $blog['image'] }}" alt="{{ $blog['title'] }}" class="w-full h-64 md:h-96 object-cover rounded-lg mb-8">

                <div class="prose prose-lg max-w-none">
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">{{ $blog['content'] }}</p>

                    {{-- <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Key Takeaways</h2>
                    <ul class="list-disc pl-6 space-y-2 text-gray-600 mb-8">
                        <li>Understanding the fundamental concepts and best practices in {{ $blog['category'] }}</li>
                        <li>Practical applications and real-world examples you can implement immediately</li>
                        <li>Industry insights from experienced professionals in the field</li>
                        <li>Future trends and developments to watch out for</li>
                    </ul>

                    <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Why This Matters</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        In today's rapidly evolving digital landscape, staying updated with the latest trends and technologies is crucial for professional growth. This article provides valuable insights that can help you make informed decisions and stay ahead of the curve in your career journey.
                    </p>

                    <h2 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Getting Started</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        If you're interested in diving deeper into this topic, consider exploring our comprehensive courses that cover these concepts in detail. Our expert instructors provide hands-on training and real-world projects to help you master these skills.
                    </p> --}}
                </div>

                <!-- Tags -->
                <div class="mt-8 pt-8 border-t">
                    <div class="flex flex-wrap gap-2 mb-8">
                        @foreach($blog['tags'] as $tag)
                            <a href="#" class="bg-gray-100 hover:bg-primary hover:text-white text-gray-700 font-medium py-2 px-4 rounded-full transition duration-300">
                                #{{ $tag }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Author Bio -->
                {{-- <div class="bg-gray-100 rounded-lg p-8 mt-8">
                    <div class="flex items-start gap-6">
                        <img src="{{ $blog['avatar'] }}" alt="{{ $blog['author'] }}" class="w-20 h-20 rounded-full object-cover">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold mb-2">About {{ $blog['author'] }}</h3>
                            <p class="text-gray-600 mb-4">
                                {{ $blog['author'] }} is an experienced professional in {{ $blog['category'] }} with a passion for sharing knowledge and helping others grow in their careers. With years of industry experience, they bring practical insights and expertise to every article.
                            </p>
                            <div class="flex items-center space-x-4">
                                <button class="text-primary hover:text-primary-dark font-medium">
                                    <i class="fas fa-envelope mr-2"></i> Contact
                                </button>
                                <button class="text-primary hover:text-primary-dark font-medium">
                                    <i class="fab fa-twitter mr-2"></i> Follow
                                </button>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Related Articles Section -->
    @if(count($relatedArticles) > 0)
    <section class="py-16 bg-light">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $article)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                            <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-primary bg-primary/10 px-3 py-1 rounded-full">{{ $article['category'] }}</span>
                                    <span class="text-sm text-gray-500">{{ $article['read_time'] }}</span>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">{{ $article['title'] }}</h3>
                                <p class="text-gray-600 mb-4">{{ $article['excerpt'] }}</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img src="{{ $article['avatar'] }}" alt="{{ $article['author'] }}" class="w-8 h-8 rounded-full mr-2">
                                        <div>
                                            <p class="text-sm font-medium">{{ $article['author'] }}</p>
                                            <p class="text-xs text-gray-500">{{ $article['date'] }}</p>
                                        </div>
                                    </div>
                                    <a href="/{{ $locale }}/blog/{{ $article['id'] }}" class="text-primary hover:text-primary-dark font-medium">
                                        Read More <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Other Blogs Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Blog Lainnya</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <?php
                    // Get other blogs (excluding current blog and related articles)
                    $otherBlogs = [];
                    $excludedIds = [$blog['id']];
                    foreach($relatedArticles as $article) {
                        $excludedIds[] = $article['id'];
                    }

                    foreach($blogs as $b) {
                        if(!in_array($b['id'], $excludedIds)) {
                            $otherBlogs[] = $b;
                        }
                    }

                    // Randomly select 3 blogs or take first 3 if less than 3
                    if(count($otherBlogs) > 3) {
                        shuffle($otherBlogs);
                        $otherBlogs = array_slice($otherBlogs, 0, 3);
                    }
                    ?>
                    @foreach($otherBlogs as $otherBlog)
                        <div class="bg-gray-50 rounded-xl shadow-md overflow-hidden card-hover">
                            <img src="{{ $otherBlog['image'] }}" alt="{{ $otherBlog['title'] }}" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-primary bg-primary/10 px-3 py-1 rounded-full">{{ $otherBlog['category'] }}</span>
                                    <span class="text-sm text-gray-500">{{ $otherBlog['read_time'] }}</span>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">{{ $otherBlog['title'] }}</h3>
                                <p class="text-gray-600 mb-4">{{ $otherBlog['excerpt'] }}</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img src="{{ $otherBlog['avatar'] }}" alt="{{ $otherBlog['author'] }}" class="w-8 h-8 rounded-full mr-2">
                                        <div>
                                            <p class="text-sm font-medium">{{ $otherBlog['author'] }}</p>
                                            <p class="text-xs text-gray-500">{{ $otherBlog['date'] }}</p>
                                        </div>
                                    </div>
                                    <a href="/{{ $locale }}/blog/{{ $otherBlog['id'] }}" class="text-primary hover:text-primary-dark font-medium">
                                        Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    <a href="/{{ $locale }}/blog" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300">
                        Lihat Semua Blog <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Comments Section -->
    {{-- <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Comments (3)</h2>

                <!-- Comment Form -->
                <div class="bg-gray-100 rounded-lg p-6 mb-8">
                    <h3 class="text-xl font-semibold mb-4">Leave a Comment</h3>
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <input type="text" placeholder="Your Name" class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            <input type="email" placeholder="Your Email" class="px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <textarea placeholder="Your Comment" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary mb-4"></textarea>
                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-lg transition duration-300">
                            Post Comment
                        </button>
                    </form>
                </div>

                <!-- Comments List -->
                <div class="space-y-6">
                    <div class="bg-white border rounded-lg p-6">
                        <div class="flex items-start gap-4">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Commenter" class="w-12 h-12 rounded-full">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-semibold">John Doe</h4>
                                    <span class="text-sm text-gray-500">2 days ago</span>
                                </div>
                                <p class="text-gray-600">Great article! This really helped me understand the concepts better. Looking forward to more content like this.</p>
                                <button class="text-primary hover:text-primary-dark text-sm font-medium mt-2">
                                    <i class="fas fa-reply mr-1"></i> Reply
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border rounded-lg p-6">
                        <div class="flex items-start gap-4">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Commenter" class="w-12 h-12 rounded-full">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-semibold">Jane Smith</h4>
                                    <span class="text-sm text-gray-500">1 week ago</span>
                                </div>
                                <p class="text-gray-600">Very insightful! I've been looking for resources on this topic. Do you have any recommendations for further reading?</p>
                                <button class="text-primary hover:text-primary-dark text-sm font-medium mt-2">
                                    <i class="fas fa-reply mr-1"></i> Reply
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border rounded-lg p-6">
                        <div class="flex items-start gap-4">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Commenter" class="w-12 h-12 rounded-full">
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="font-semibold">Mike Johnson</h4>
                                    <span class="text-sm text-gray-500">2 weeks ago</span>
                                </div>
                                <p class="text-gray-600">This is exactly what I needed! The examples provided really helped clarify the concepts. Thank you for sharing this valuable information.</p>
                                <button class="text-primary hover:text-primary-dark text-sm font-medium mt-2">
                                    <i class="fas fa-reply mr-1"></i> Reply
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- CTA Section -->
    {{-- <section class="py-16 gradient-bg text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Enjoyed This Article?</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">Subscribe to our newsletter to get the latest articles and insights delivered to your inbox.</p>
            <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Your email address" class="flex-1 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                <button class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                    Subscribe
                </button>
            </div>
        </div>
    </section> --}}

    @include('components.footer')
@endif
