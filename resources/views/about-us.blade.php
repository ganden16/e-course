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
<section class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <!-- Use hero image from about page -->
        <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ $about['image'] ?? asset('assets/images/logo1.png') }}');">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/50"></div>
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
        </div>
    </div>

    <!-- Hero Content -->
    <div class="container mx-auto px-6 py-20 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <!-- Headline -->
            <h1 class="text-4xl lg:text-5xl font-bold leading-tight mb-4 text-white tracking-wide">
                {{ $hero['title'] }}
            </h1>

            <!-- Subheadline -->
            <p class="text-xl lg:text-2xl mb-8 font-light text-gray-200">
                {{ $hero['subtitle'] }}
            </p>

            <!-- CTA Button -->
            {{-- <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ $baseUrl }}/product" class="bg-primary hover:bg-primary-dark text-white font-bold py-4 px-10 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                    {{ $story['explore_courses'] }}
                </a>
            </div> --}}
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
                <a href="{{ $baseUrl }}/product" class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105">
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
                <div class="bg-secondary text-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-bullseye text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $mission_vision['mission']['title'] }}</h2>
                <p class="text-lg text-gray-600">{{ $mission_vision['mission']['description'] }}</p>
            </div>
            <div class="text-center">
                <div class="bg-secondary text-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
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
                    <div class="text-3xl md:text-4xl font-bold text-secondary mb-2 pulse-animation">{{ $stat['number'] }}</div>
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
                    <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
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
<!-- Team Section -->
<section class="py-20 bg-gradient-to-b from-white to-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center mb-4">
                <div class="w-16 h-1 bg-secondary rounded-full"></div>
                <span class="mx-4 text-secondary font-semibold uppercase tracking-wider">Our Team</span>
                <div class="w-16 h-1 bg-secondary rounded-full"></div>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">{{ $team['title'] }}</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">{{ $team['subtitle'] }}</p>
        </div>

        <!-- Dynamic Grid Container -->
        <div class="flex justify-center">
            <div class="
                @if(count($about['team']) == 1)
                    grid grid-cols-1 max-w-md mx-auto
                @elseif(count($about['team']) == 2)
                    grid grid-cols-1 sm:grid-cols-2 max-w-3xl gap-8 lg:gap-10
                @elseif(count($about['team']) == 3)
                    grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 max-w-5xl gap-8 lg:gap-10
                @else
                    grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 lg:gap-10 w-full
                @endif
            ">
                @foreach($about['team'] as $member)
                    <div class="
                        @if(count($about['team']) == 1)
                            w-full max-w-md mx-auto
                        @elseif(count($about['team']) == 2)
                            flex justify-center
                        @endif
                    ">
                        <div class="
                            group relative flex flex-col items-center text-center bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 w-full
                            @if(count($about['team']) == 1) max-w-md
                            @elseif(count($about['team']) == 2) max-w-sm
                            @else max-w-xs sm:max-w-sm @endif
                        ">
                            <!-- Avatar Container with Gradient Border -->
                            <div class="relative mb-6">
                                <div class="absolute -inset-3 bg-gradient-to-r from-secondary to-accent rounded-full opacity-0 group-hover:opacity-100 blur-xl transition-opacity duration-500"></div>
                                <div class="relative w-40 h-40 mx-auto">
                                    <img
                                        src="{{ asset($member['avatar']) }}"
                                        alt="{{ $member['name'] }}"
                                        class="w-full h-full rounded-full object-cover border-4 border-white shadow-xl"
                                    >
                                    <!-- Hover Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-secondary/20 to-transparent rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                            </div>

                            <!-- Team Member Info -->
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-secondary transition-colors duration-300">
                                    {{ $member['name'] }}
                                </h3>
                                <div class="inline-flex items-center gap-2 mb-4">
                                    <span class="px-4 py-1 bg-secondary/10 text-secondary text-sm font-medium rounded-full">
                                        {{ $member['role'] }}
                                    </span>
                                </div>
                                <p class="text-gray-600 leading-relaxed mb-6 line-clamp-5">
                                    {{ $member['bio'] }}
                                </p>
                            </div>

                            <!-- Social Links (Uncomment if needed) -->
                            {{-- <div class="flex justify-center space-x-4 pt-4 border-t border-gray-100">
                                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-gray-500 hover:bg-secondary hover:text-white transition-all duration-300 transform hover:scale-110">
                                    <i class="fab fa-linkedin text-lg"></i>
                                </a>
                                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-gray-500 hover:bg-blue-400 hover:text-white transition-all duration-300 transform hover:scale-110">
                                    <i class="fab fa-twitter text-lg"></i>
                                </a>
                                <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-gray-500 hover:bg-pink-500 hover:text-white transition-all duration-300 transform hover:scale-110">
                                    <i class="fab fa-instagram text-lg"></i>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="relative mt-12">
            <div class="absolute top-0 left-1/4 w-64 h-64 bg-secondary/5 rounded-full blur-3xl -z-10"></div>
            <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-accent/5 rounded-full blur-3xl -z-10"></div>
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
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trophy text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $achievements['best_platform']['title'] }}</h3>
                <p class="text-gray-600">{{ $achievements['best_platform']['description'] }}</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg text-center card-hover">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-globe text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $achievements['global_reach']['title'] }}</h3>
                <p class="text-gray-600">{{ $achievements['global_reach']['description'] }}</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg text-center card-hover">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
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
<section class="py-16 bg-primary text-white relative overflow-hidden">
    <!-- Animated Background with Secondary-Dark Wave Ribbon Pattern -->
    {{-- <div class="absolute inset-0 z-10">
        <!-- Wave Ribbon 1 - Top Left -->
        <svg class="absolute top-0 left-0 w-80 h-80" viewBox="0 0 300 300">
            <path d="M0,50 Q75,0 150,50 T300,50 L300,100 Q225,150 150,100 T0,100 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
            <path d="M0,150 Q75,100 150,150 T300,150 L300,200 Q225,250 150,200 T0,200 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
        </svg>

        <!-- Wave Ribbon 2 - Top Right -->
        <svg class="absolute top-0 right-0 w-80 h-80" viewBox="0 0 300 300">
            <path d="M300,50 Q225,0 150,50 T0,50 L0,100 Q75,150 150,100 T300,100 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
            <path d="M300,150 Q225,100 150,150 T0,150 L0,200 Q75,250 150,200 T300,200 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
        </svg>

        <!-- Wave Ribbon 3 - Bottom Left -->
        <svg class="absolute bottom-0 left-0 w-80 h-80" viewBox="0 0 300 300">
            <path d="M0,250 Q75,300 150,250 T300,250 L300,200 Q225,150 150,200 T0,200 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
            <path d="M0,150 Q75,200 150,150 T300,150 L300,100 Q225,50 150,100 T0,100 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
        </svg>

        <!-- Wave Ribbon 4 - Bottom Right -->
        <svg class="absolute bottom-0 right-0 w-80 h-80" viewBox="0 0 300 300">
            <path d="M300,250 Q225,300 150,250 T0,250 L0,200 Q75,150 150,200 T300,200 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
            <path d="M300,150 Q225,200 150,150 T0,150 L0,100 Q75,50 150,100 T300,100 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
        </svg>
    </div> --}}

    <div class="container mx-auto px-6 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $cta['title'] }}</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $cta['subtitle'] }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ $baseUrl }}/bootcamp" class="bg-secondary border-2 border-white hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                {{ $cta['start_learning'] }}
            </a>
            <a href="{{ $baseUrl }}/contact" class="bg-transparent border-2 border-white hover:bg-white hover:text-secondary text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                {{ $cta['contact_us'] }}
            </a>
        </div>
    </div>
</section>

@include('components.footer')
