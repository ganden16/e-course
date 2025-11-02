@php
    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for about page
    $translations = include lang_path("{$locale}/aboutUs.php");
    $hero = $translations['hero'];
    $story = $translations['story'];
    $mission_vision = $translations['mission_vision'];
    $stats = $translations['stats'];
    $values = $translations['values'];
    $team = $translations['team'];
    $achievements = $translations['achievements'];
    $partners = $translations['partners'];
    $cta = $translations['cta'];

    // Get data from language files
    $about = $translations['about'];
    $statsData = $stats['data'];

    // Build URLs with current locale
    $baseUrl = '/' . $locale;
@endphp

@include('components.header', ['title' => 'About Us'])

<!-- Hero Section -->
<section class="gradient-bg text-white py-16">
    <div class="container mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $hero['title'] }}</h1>
            <p class="text-xl max-w-3xl mx-auto">{{ $hero['subtitle'] }}</p>
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
                <h2 class="text-3xl font-bold text-gray-800 mb-6">{{ $story['title'] }}</h2>
                <p class="text-lg text-gray-600 mb-6">{{ $about['story'] }}</p>
                <p class="text-lg text-gray-600 mb-6">{{ $about['description'] }}</p>
                <p class="text-lg text-gray-600 mb-8">{{ $story['description'] }}</p>
                <a href="{{ $baseUrl }}/product" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105">
                    {{ $story['explore_courses'] }}
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
                <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $mission_vision['mission']['title'] }}</h2>
                <p class="text-lg text-gray-600">{{ $mission_vision['mission']['description'] }}</p>
            </div>
            <div class="text-center">
                <div class="bg-primary text-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-eye text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $mission_vision['vision']['title'] }}</h2>
                <p class="text-lg text-gray-600">{{ $mission_vision['vision']['description'] }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $stats['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $stats['subtitle'] }}</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach($statsData as $stat)
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
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $values['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $values['subtitle'] }}</p>
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
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $team['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $team['subtitle'] }}</p>
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
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $achievements['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $achievements['subtitle'] }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl p-6 shadow-lg text-center card-hover">
                <div class="bg-accent text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trophy text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $achievements['best_platform']['title'] }}</h3>
                <p class="text-gray-600">{{ $achievements['best_platform']['description'] }}</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg text-center card-hover">
                <div class="bg-accent text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-globe text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $achievements['global_reach']['title'] }}</h3>
                <p class="text-gray-600">{{ $achievements['global_reach']['description'] }}</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg text-center card-hover">
                <div class="bg-accent text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-certificate text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $achievements['industry_recognition']['title'] }}</h3>
                <p class="text-gray-600">{{ $achievements['industry_recognition']['description'] }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
{{-- <section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $partners['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $partners['subtitle'] }}</p>
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
</section> --}}

<!-- CTA Section -->
<section class="py-16 gradient-bg text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $cta['title'] }}</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $cta['subtitle'] }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ $baseUrl }}/product" class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                {{ $cta['start_learning'] }}
            </a>
            <a href="{{ $baseUrl }}/contact" class="bg-transparent border-2 border-white hover:bg-white hover:text-primary text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                {{ $cta['contact_us'] }}
            </a>
        </div>
    </div>
</section>

@include('components.footer')
