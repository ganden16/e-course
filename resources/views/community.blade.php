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
    $main_join = $translations['main_join'];

    // Get data from language files
    $community = $translations['community'];
    $our_community_program = $translations['our_community_program'];

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

{{-- Main content join our community --}}
<section class="py-16 md:py-24 relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <!-- Animated Elements -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
        <div class="absolute top-40 right-10 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-2000"></div>
        <div class="absolute bottom-20 left-1/2 w-80 h-80 bg-indigo-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-6xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full mb-6 mx-auto shadow-2xl transform rotate-12 hover:rotate-0 transition-transform duration-300">
                    <i class="fas fa-rocket text-3xl text-white"></i>
                </div>
                <h2 class="text-4xl md:text-6xl font-bold mb-6 text-white">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-pink-500">
                        {{ $main_join['title'] }}
                    </span>
                </h2>
                <p class="text-xl md:text-2xl mb-6 max-w-4xl mx-auto text-gray-200 font-light">
                    {{ $main_join['subtitle'] }}
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-yellow-400 to-pink-500 mx-auto rounded-full"></div>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-3xl p-8 md:p-12 shadow-2xl border border-white border-opacity-20">
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <!-- Left Column - Content -->
                    <div class="text-white">
                        <h3 class="text-2xl md:text-3xl font-bold mb-4">
                            {{ $locale === 'id' ? 'Bergabung' : 'Join' }}
                        </h3>
                        <p class="text-lg mb-8 text-gray-200">
                            {{ $main_join['description'] }}
                        </p>

                        <!-- Benefits List -->
                        <div class="space-y-4 mb-8">
                            @foreach($main_join['benefits'] as $benefit)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mt-1">
                                        <i class="fas fa-check text-white text-sm"></i>
                                    </div>
                                    <p class="text-gray-200">{{ $benefit }}</p>
                                </div>
                            @endforeach
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-4 mb-8">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-yellow-400">15K+</div>
                                <div class="text-sm text-gray-300">{{ $locale === 'id' ? 'Anggota' : 'Members' }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-pink-400">50+</div>
                                <div class="text-sm text-gray-300">{{ $locale === 'id' ? 'Negara' : 'Countries' }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-400">24/7</div>
                                <div class="text-sm text-gray-300">{{ $locale === 'id' ? 'Dukungan' : 'Support' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - CTA -->
                    <div class="text-center">
                        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-8 shadow-2xl transform hover:scale-105 transition-transform duration-300">
                            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fab fa-whatsapp text-5xl text-green-500"></i>
                            </div>
                            <h4 class="text-2xl font-bold text-white mb-4">
                                {{ $locale === 'id' ? 'Bergabung Sekarang!' : 'Join Now!' }}
                            </h4>
                            <p class="text-white mb-6 opacity-90">
                                {{ $locale === 'id' ? 'Klik tombol di bawah untuk bergabung melalui WhatsApp' : 'Click the button below to join via WhatsApp' }}
                            </p>
                            <a href="https://wa.link/wi8d3y" target="_blank" class="bg-white text-green-600 hover:bg-gray-100 font-bold py-4 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg inline-flex items-center justify-center w-full">
                                <i class="fab fa-whatsapp text-2xl mr-3"></i>
                                {{ $main_join['button_text'] }}
                            </a>
                            <div class="mt-4 text-white text-sm opacity-75">
                                <i class="fas fa-shield-alt mr-1"></i>
                                {{ $locale === 'id' ? '100% Gratis & Aman' : '100% Free & Secure' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom CTA -->
            <div class="text-center mt-12">
                <div class="inline-flex items-center space-x-4 bg-white bg-opacity-10 backdrop-blur-lg rounded-full px-6 py-3">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full border-2 border-white"></div>
                        <div class="w-8 h-8 bg-gradient-to-br from-pink-400 to-red-500 rounded-full border-2 border-white"></div>
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-full border-2 border-white"></div>
                        <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-teal-500 rounded-full border-2 border-white"></div>
                    </div>
                    <p class="text-white font-medium">
                        <span class="font-bold">99+</span>
                        {{ $locale === 'id' ? 'orang bergabung minggu ini' : 'people joined this week' }}
                    </p>
                </div>
            </div>
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
                        <div class="bg-gradient-to-br from-{{ $social['name'] == 'Facebook' ? 'blue-500 to-blue-600' : ($social['name'] == 'Twitter' ? 'blue-400 to-blue-500' : ($social['name'] == 'LinkedIn' ? 'blue-600 to-blue-700' : ($social['name'] == 'Instagram' ? 'purple-500 to-pink-500' : ($social['name'] == 'YouTube' ? 'red-500 to-red-600' : 'indigo-500 to-indigo-600')))) }} text-orange rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                            <i class="{{ $social['icon'] }} text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-semibold mb-3">{{ $social['name'] }}</h3>
                        <p class="text-gray-600 mb-6">{{ $social['description'] }}</p>
                        <a href="{{ $social['url'] }}" target="_blank" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-6 rounded-xl transition duration-300 transform hover:scale-105">
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

<!-- Our Community Program Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $our_community_program['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $our_community_program['description'] }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="{{ $our_community_program['remote_care_talk']['icon'] }} text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $our_community_program['remote_care_talk']['title'] }}</h3>
                <p class="text-gray-600">{{ $our_community_program['remote_care_talk']['description'] }}</p>
            </div>
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="{{ $our_community_program['remote_care_qa_live']['icon'] }} text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $our_community_program['remote_care_qa_live']['title'] }}</h3>
                <p class="text-gray-600">{{ $our_community_program['remote_care_qa_live']['description'] }}</p>
            </div>
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="{{ $our_community_program['mva_discussion_room']['icon'] }} text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $our_community_program['mva_discussion_room']['title'] }}</h3>
                <p class="text-gray-600">{{ $our_community_program['mva_discussion_room']['description'] }}</p>
            </div>
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="{{ $our_community_program['networking_job_opportunities']['icon'] }} text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $our_community_program['networking_job_opportunities']['title'] }}</h3>
                <p class="text-gray-600">{{ $our_community_program['networking_job_opportunities']['description'] }}</p>
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
            <a href="https://discord.gg/HealthCare" target="_blank" class="bg-transparent border-2 border-white hover:bg-white hover:text-primary text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                {{ $cta['join_discord'] }}
            </a>
        </div>
    </div>
</section>

@include('components.footer')
