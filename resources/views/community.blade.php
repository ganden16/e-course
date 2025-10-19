@php
    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for community page
    $translations = include lang_path("{$locale}/community.php");
    $hero = $translations['hero'];
    $membership = $translations['benefits'];
    $guidelines = $translations['guidelines'];
    $testimonials = $translations['testimonials'];
    $cta = $translations['cta'];

    // Load data from JSON for dynamic content
    $data = json_decode(file_get_contents(resource_path('json/data.json')), true);
    $site = $data['site'];
    $community = $data['community'];

    // Build URLs with current locale
    $baseUrl = '/' . $locale;
@endphp

@include('components.header', ['title' => 'Our Community'])

<!-- Hero Section -->
<section class="gradient-bg text-white py-16">
    <div class="container mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $hero['title'] }}</h1>
            <p class="text-xl max-w-3xl mx-auto">{{ $hero['subtitle'] }}</p>
        </div>
    </div>
</section>

<!-- Community Stats Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $hero['stats_title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $hero['stats_subtitle'] }}</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach($community['stats'] as $stat)
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-primary mb-2 pulse-animation">{{ $stat['number'] }}</div>
                    <div class="text-gray-600">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Community Image Section -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <img src="{{ $community['image'] }}" alt="Community" class="w-full rounded-lg shadow-lg">
        </div>
    </div>
</section>

<!-- Social Media Platforms Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $hero['connect_title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $hero['connect_subtitle'] }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($community['social_links'] as $social)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    <div class="p-8 text-center">
                        <div class="bg-gradient-to-br from-{{ $social['name'] == 'Facebook' ? 'blue-500 to-blue-600' : ($social['name'] == 'Twitter' ? 'blue-400 to-blue-500' : ($social['name'] == 'LinkedIn' ? 'blue-600 to-blue-700' : ($social['name'] == 'Instagram' ? 'purple-500 to-pink-500' : ($social['name'] == 'YouTube' ? 'red-500 to-red-600' : 'indigo-500 to-indigo-600')))) }} text-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                            <i class="{{ $social['icon'] }} text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-3">{{ $social['name'] }}</h3>
                        <p class="text-gray-600 mb-6">{{ $social['description'] }}</p>
                        <a href="{{ $social['url'] }}" target="_blank" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105">
                            {{ $hero['join_now'] }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Community Benefits Section -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $membership['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $membership['subtitle'] }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $membership['network_peers']['title'] }}</h3>
                <p class="text-gray-600">{{ $membership['network_peers']['description'] }}</p>
            </div>
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="fas fa-chalkboard-teacher text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $membership['learn_experts']['title'] }}</h3>
                <p class="text-gray-600">{{ $membership['learn_experts']['description'] }}</p>
            </div>
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="fas fa-briefcase text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $membership['career_opportunities']['title'] }}</h3>
                <p class="text-gray-600">{{ $membership['career_opportunities']['description'] }}</p>
            </div>
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="fas fa-lightbulb text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $membership['share_knowledge']['title'] }}</h3>
                <p class="text-gray-600">{{ $membership['share_knowledge']['description'] }}</p>
            </div>
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="fas fa-calendar-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $membership['events_workshops']['title'] }}</h3>
                <p class="text-gray-600">{{ $membership['events_workshops']['description'] }}</p>
            </div>
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="fas fa-trophy text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $membership['achievements']['title'] }}</h3>
                <p class="text-gray-600">{{ $membership['achievements']['description'] }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Community Guidelines Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $guidelines['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $guidelines['subtitle'] }}</p>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-check-circle text-primary mr-3"></i> {{ $guidelines['be_respectful']['title'] }}
                    </h3>
                    <p class="text-gray-600">{{ $guidelines['be_respectful']['description'] }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-check-circle text-primary mr-3"></i> {{ $guidelines['stay_relevant']['title'] }}
                    </h3>
                    <p class="text-gray-600">{{ $guidelines['stay_relevant']['description'] }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-check-circle text-primary mr-3"></i> {{ $guidelines['help_others']['title'] }}
                    </h3>
                    <p class="text-gray-600">{{ $guidelines['help_others']['description'] }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4 flex items-center">
                        <i class="fas fa-check-circle text-primary mr-3"></i> {{ $guidelines['no_spam']['title'] }}
                    </h3>
                    <p class="text-gray-600">{{ $guidelines['no_spam']['description'] }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $testimonials['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $testimonials['subtitle'] }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="flex items-center mb-4">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Community Member" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-semibold">Michael Chen</h4>
                        <p class="text-sm text-gray-500">Web Developer</p>
                    </div>
                </div>
                <p class="text-gray-600 italic">"The community has been invaluable for my career growth. I've connected with mentors and peers who have helped me navigate challenges and find new opportunities."</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="flex items-center mb-4">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Community Member" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-semibold">Sarah Johnson</h4>
                        <p class="text-sm text-gray-500">Data Scientist</p>
                    </div>
                </div>
                <p class="text-gray-600 italic">"Being part of this community has opened doors I never expected. The support and knowledge sharing here is unmatched anywhere else."</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="flex items-center mb-4">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Community Member" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-semibold">Alex Rodriguez</h4>
                        <p class="text-sm text-gray-500">UX Designer</p>
                    </div>
                </div>
                <p class="text-gray-600 italic">"I've made lasting connections and found collaborators for projects through this community. It's more than just learning—it's about growing together."</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 gradient-bg text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $cta['title'] }}</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $cta['subtitle'] }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ $baseUrl }}/product" class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                {{ $cta['start_learning'] }}
            </a>
            <a href="https://discord.gg/edutechacademy" target="_blank" class="bg-transparent border-2 border-white hover:bg-white hover:text-primary text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                {{ $cta['join_discord'] }}
            </a>
        </div>
    </div>
</section>

@include('components.footer')
