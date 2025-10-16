@php
    $data = json_decode(file_get_contents(resource_path('json/data.json')), true);
    $site = $data['site'];
    $bootcamps = $data['bootcamps'];
    $bootcamp = null;

    // Find the bootcamp by ID
    foreach($bootcamps as $b) {
        if($b['id'] == $id) {
            $bootcamp = $b;
            break;
        }
    }

    // Get related bootcamps (same category, excluding current bootcamp)
    $relatedBootcamps = array_filter($bootcamps, function($b) use ($bootcamp) {
        return $b['category'] === $bootcamp['category'] && $b['id'] != $bootcamp['id'];
    });
    $relatedBootcamps = array_slice($relatedBootcamps, 0, 2);
@endphp

@if(!$bootcamp)
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Bootcamp Not Found</h1>
            <p class="text-gray-600 mb-8">The bootcamp you're looking for doesn't exist.</p>
            <a href="/bootcamp" class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300">
                Browse All Bootcamps
            </a>
        </div>
    </div>
@else
    @include('components.header', ['title' => $bootcamp['title']])

    <!-- Bootcamp Hero Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Bootcamp Image -->
                <div class="lg:w-2/5">
                    <img src="{{ $bootcamp['image'] }}" alt="{{ $bootcamp['title'] }}" class="w-full rounded-lg shadow-lg">
                    <div class="mt-6 bg-gray-100 rounded-lg p-6">
                        <h3 class="font-semibold text-lg mb-4">Key Information</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-clock text-secondary mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Duration</p>
                                    <p class="font-medium">{{ $bootcamp['duration'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-signal text-secondary mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Level</p>
                                    <p class="font-medium">{{ $bootcamp['level'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-secondary mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Start Date</p>
                                    <p class="font-medium">{{ $bootcamp['start_date'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock text-secondary mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Schedule</p>
                                    <p class="font-medium">{{ $bootcamp['schedule'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bootcamp Details -->
                <div class="lg:w-3/5">
                    <div class="mb-2">
                        <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $bootcamp['category'] }}</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $bootcamp['title'] }}</h1>

                    <div class="flex items-center mb-6">
                        <div class="flex items-center mr-6">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < floor($bootcamp['rating']))
                                    <i class="fas fa-star text-yellow-400"></i>
                                @else
                                    <i class="far fa-star text-yellow-400"></i>
                                @endif
                            @endfor
                            <span class="ml-2 font-medium">{{ $bootcamp['rating'] }}</span>
                            <span class="ml-1 text-gray-500">({{ $bootcamp['students'] }} students)</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-user-tie mr-2"></i>
                            <span>{{ $bootcamp['instructor'] }}</span>
                        </div>
                    </div>

                    <p class="text-lg text-gray-600 mb-8">{{ $bootcamp['description'] }}</p>

                    <div class="bg-gray-100 rounded-lg p-6 mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-3xl font-bold text-secondary">Rp {{ number_format($bootcamp['price'], 0, ',', '.') }}</span>
                                @if($bootcamp['price'] < $bootcamp['original_price'])
                                    <span class="text-lg text-gray-500 line-through ml-2">Rp {{ number_format($bootcamp['original_price'], 0, ',', '.') }}</span>
                                    <span class="ml-2 text-red-500 font-semibold">Save {{ round((1 - $bootcamp['price'] / $bootcamp['original_price']) * 100) }}%</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105 flex-1">
                                <i class="fas fa-shopping-cart mr-2"></i> Enroll Now
                            </button>
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-8 rounded-lg transition duration-300">
                                <i class="fas fa-calendar mr-2"></i> Schedule a Call
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What You'll Learn Section -->
    <section class="py-16 bg-light">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">What You'll Learn</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg p-6 shadow-md">
                    <h3 class="font-semibold text-lg mb-4">Curriculum Overview</h3>
                    <ul class="space-y-3">
                        @foreach($bootcamp['curriculum'] as $item)
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-md">
                    <h3 class="font-semibold text-lg mb-4">Skills You'll Gain</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>Technical proficiency in {{ $bootcamp['category'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>Problem-solving and critical thinking</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>Project management and collaboration</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>Industry best practices and standards</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>Portfolio development</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>Interview preparation techniques</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootcamp Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Bootcamp Features</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($bootcamp['features'] as $feature)
                    <div class="text-center">
                        <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-award text-2xl"></i>
                        </div>
                        <p class="text-gray-700">{{ $feature }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Instructor Section -->
    <section class="py-16 bg-light">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Meet Your Instructor</h2>
            <div class="bg-white rounded-lg p-8">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="{{ $bootcamp['instructor'] }}" class="w-32 h-32 rounded-full object-cover">
                    <div>
                        <h3 class="text-2xl font-semibold mb-2">{{ $bootcamp['instructor'] }}</h3>
                        <p class="text-gray-600 mb-4">Expert {{ $bootcamp['category'] }} with over 15 years of industry experience. Passionate about teaching and mentoring the next generation of professionals.</p>
                        <div class="flex items-center gap-6 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <span>{{ $bootcamp['rating'] }} Rating</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users mr-2"></i>
                                <span>{{ $bootcamp['students'] }} Students</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-briefcase mr-2"></i>
                                <span>15+ Years Experience</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Career Support Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Career Support & Outcomes</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">What's Included</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>Resume and portfolio review</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>Mock interviews and feedback</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>Networking events with employers</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>Job placement assistance</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>Alumni network access</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Career Outcomes</h3>
                    <div class="bg-gray-100 rounded-lg p-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-secondary mb-2">85%</div>
                                <div class="text-sm text-gray-600">Job Placement Rate</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-secondary mb-2">3 months</div>
                                <div class="text-sm text-gray-600">Average Job Search Time</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-secondary mb-2">40%</div>
                                <div class="text-sm text-gray-600">Average Salary Increase</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-secondary mb-2">500+</div>
                                <div class="text-sm text-gray-600">Hiring Partners</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Bootcamps Section -->
    @if(count($relatedBootcamps) > 0)
    <section class="py-16 bg-light">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Related Bootcamps</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($relatedBootcamps as $relatedBootcamp)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                        <div class="md:flex">
                            <div class="md:w-2/5">
                                <img src="{{ $relatedBootcamp['image'] }}" alt="{{ $relatedBootcamp['title'] }}" class="w-full h-48 md:h-full object-cover">
                            </div>
                            <div class="md:w-3/5 p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $relatedBootcamp['category'] }}</span>
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <span class="ml-1 text-sm font-medium">{{ $relatedBootcamp['rating'] }}</span>
                                    </div>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">{{ $relatedBootcamp['title'] }}</h3>
                                <p class="text-gray-600 mb-4">{{ $relatedBootcamp['description'] }}</p>
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span class="mr-4">{{ $relatedBootcamp['duration'] }}</span>
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>{{ $relatedBootcamp['start_date'] }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-xl font-bold text-secondary">Rp {{ number_format($relatedBootcamp['price'], 0, ',', '.') }}</span>
                                        @if($relatedBootcamp['price'] < $relatedBootcamp['original_price'])
                                            <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($relatedBootcamp['original_price'], 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <a href="/bootcamp/{{ $relatedBootcamp['id'] }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                        Learn More
                                    </a>
                                </div>
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
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Transform Your Career?</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">Take the first step towards a new career in {{ $bootcamp['category'] }}. Apply now and join our next cohort!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-shopping-cart mr-2"></i> Enroll in This Bootcamp
                </button>
                <a href="/contact" class="bg-transparent border-2 border-white hover:bg-white hover:text-primary text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                    Schedule a Consultation
                </a>
            </div>
        </div>
    </section>

    @include('components.footer')
@endif
