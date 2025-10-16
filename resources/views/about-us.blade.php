@php
    $data = json_decode(file_get_contents(resource_path('json/data.json')), true);
    $site = $data['site'];
    $about = $data['about'];
    $stats = $data['stats'];
@endphp

@include('components.header', ['title' => 'About Us'])

<!-- Hero Section -->
<section class="gradient-bg text-white py-16">
    <div class="container mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $about['title'] }}</h1>
            <p class="text-xl max-w-3xl mx-auto">{{ $about['subtitle'] }}</p>
        </div>
    </div>
</section>

<!-- About Story Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2">
                <img src="{{ $about['image'] }}" alt="About Us" class="w-full rounded-lg shadow-lg">
            </div>
            <div class="lg:w-1/2">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Story</h2>
                <p class="text-lg text-gray-600 mb-6">{{ $about['story'] }}</p>
                <p class="text-lg text-gray-600 mb-6">{{ $about['description'] }}</p>
                <p class="text-lg text-gray-600 mb-8">We believe that quality education should be accessible to everyone, regardless of their background or location. That's why we've built a platform that combines cutting-edge technology with proven teaching methodologies to create an engaging and effective learning experience.</p>
                <a href="/product" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105">
                    Explore Our Courses
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Section -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="text-center">
                <div class="bg-primary text-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-bullseye text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Mission</h2>
                <p class="text-lg text-gray-600">{{ $about['mission'] }}</p>
            </div>
            <div class="text-center">
                <div class="bg-primary text-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-eye text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Vision</h2>
                <p class="text-lg text-gray-600">To become the world's leading online learning platform, empowering millions of learners to achieve their full potential and transform their lives through education.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Impact</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Numbers that speak volumes about our commitment to education.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach($stats as $stat)
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-primary mb-2 pulse-animation">{{ $stat['number'] }}</div>
                    <div class="text-gray-600">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Values</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">The principles that guide everything we do.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($about['values'] as $value)
                <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                    <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                        <i class="{{ $value['icon'] }} text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ $value['title'] }}</h3>
                    <p class="text-gray-600">{{ $value['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Meet Our Team</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">The passionate individuals behind {{ $site['name'] }}.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($about['team'] as $member)
                <div class="text-center">
                    <img src="{{ $member['avatar'] }}" alt="{{ $member['name'] }}" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover shadow-lg">
                    <h3 class="text-xl font-semibold mb-1">{{ $member['name'] }}</h3>
                    <p class="text-gray-500 mb-3">{{ $member['role'] }}</p>
                    <p class="text-gray-600 text-sm">{{ $member['bio'] }}</p>
                    <div class="flex justify-center space-x-3 mt-4">
                        <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                            <i class="fas fa-envelope text-xl"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Achievements Section -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Achievements</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Recognition and milestones that mark our journey.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl p-6 shadow-lg text-center card-hover">
                <div class="bg-accent text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trophy text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Best E-Learning Platform 2023</h3>
                <p class="text-gray-600">Awarded by Tech Education Awards for excellence in online learning</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg text-center card-hover">
                <div class="bg-accent text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-globe text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Global Reach</h3>
                <p class="text-gray-600">Serving learners in over 50 countries across 6 continents</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg text-center card-hover">
                <div class="bg-accent text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-certificate text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Industry Recognition</h3>
                <p class="text-gray-600">Certificates recognized by leading companies worldwide</p>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Partners</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Trusted by leading companies and institutions worldwide.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
            <div class="flex items-center justify-center bg-gray-100 rounded-lg p-6 h-24">
                <i class="fab fa-microsoft text-4xl text-gray-400"></i>
            </div>
            <div class="flex items-center justify-center bg-gray-100 rounded-lg p-6 h-24">
                <i class="fab fa-google text-4xl text-gray-400"></i>
            </div>
            <div class="flex items-center justify-center bg-gray-100 rounded-lg p-6 h-24">
                <i class="fab fa-amazon text-4xl text-gray-400"></i>
            </div>
            <div class="flex items-center justify-center bg-gray-100 rounded-lg p-6 h-24">
                <i class="fab fa-apple text-4xl text-gray-400"></i>
            </div>
            <div class="flex items-center justify-center bg-gray-100 rounded-lg p-6 h-24">
                <i class="fab fa-facebook text-4xl text-gray-400"></i>
            </div>
            <div class="flex items-center justify-center bg-gray-100 rounded-lg p-6 h-24">
                <i class="fab fa-linkedin text-4xl text-gray-400"></i>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 gradient-bg text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Join Our Community</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">Be part of a thriving learning community and start your journey towards success today.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/product" class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                Start Learning
            </a>
            <a href="/contact" class="bg-transparent border-2 border-white hover:bg-white hover:text-primary text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                Contact Us
            </a>
        </div>
    </div>
</section>

@include('components.footer')
