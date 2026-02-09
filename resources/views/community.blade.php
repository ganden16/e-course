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
<section class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <!-- Use hero image from community page -->
        <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ $community['image'] ?? asset('assets/images/logo1.png') }}');">
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

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                {{-- <a href="https://t.me/+Pr90XWqdSBsyMTg9" target="_blank" class="bg-primary hover:bg-primary-dark text-white font-bold py-4 px-10 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                    <i class="fab fa-telegram mr-2"></i>
                    {{ $main_join['button_text'] }}
                </a> --}}
                {{-- <a href="#social-platforms" class="hover:bg-white hover:text-primary border border-white text-white font-bold py-4 px-10 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                    {{ $hero['join_now'] }}
                </a> --}}
            </div>
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
        <div class="flex justify-around">
            @foreach($community['stats'] as $stat)
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-secondary mb-2 pulse-animation">{{ $stat['number'] }}</div>
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
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-900 via-teal-800 to-green-800">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <!-- Animated Elements (Green Tones) -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-teal-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
        <div class="absolute top-40 right-10 w-96 h-96 bg-emerald-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-2000"></div>
        <div class="absolute bottom-20 left-1/2 w-80 h-80 bg-green-600 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-6xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-emerald-400 to-green-500 rounded-full mb-6 mx-auto shadow-2xl transform rotate-12 hover:rotate-0 transition-transform duration-300">
                    <i class="fas fa-rocket text-3xl text-white"></i>
                </div>
                <h2 class="text-4xl md:text-6xl font-bold mb-6 text-white">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-emerald-400 to-green-500">
                        {{ $main_join['title'] }}
                    </span>
                </h2>
                <p class="text-xl md:text-2xl mb-6 max-w-4xl mx-auto text-gray-200 font-light">
                    {{ $main_join['subtitle'] }}
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-green-500 mx-auto rounded-full"></div>
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
                                    <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-emerald-500 to-green-600 rounded-full flex items-center justify-center mt-1">
                                        <i class="fas fa-check text-white text-sm"></i>
                                    </div>
                                    <p class="text-gray-200">{{ $benefit }}</p>
                                </div>
                            @endforeach
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-4 mb-8">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-emerald-400">99+</div>
                                <div class="text-sm text-gray-300">{{ $locale === 'id' ? 'Anggota' : 'Members' }}</div>
                            </div>
                            {{-- <div class="text-center">
                                <div class="text-2xl font-bold text-teal-400">50+</div>
                                <div class="text-sm text-gray-300">{{ $locale === 'id' ? 'Negara' : 'Countries' }}</div>
                            </div> --}}
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-400">24/7</div>
                                <div class="text-sm text-gray-300">{{ $locale === 'id' ? 'Dukungan' : 'Support' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - CTA -->
                    <div class="text-center">
                        <div class="bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl p-8 shadow-2xl transform hover:scale-105 transition-transform duration-300">
                            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fab fa-telegram text-5xl text-emerald-600"></i>
                            </div>
                            <h4 class="text-2xl font-bold text-white mb-4">
                                {{ $locale === 'id' ? 'Bergabung Sekarang!' : 'Join Now!' }}
                            </h4>
                            <p class="text-white mb-6 opacity-90">
                                {{ $locale === 'id' ? 'Klik tombol di bawah untuk bergabung melalui Telegram' : 'Click the button below to join via Telegram' }}
                            </p>
                            <a href="https://t.me/+Pr90XWqdSBsyMTg9" target="_blank" class="bg-white text-emerald-600 hover:bg-gray-100 font-bold py-4 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg inline-flex items-center justify-center w-full">
                                <i class="fab fa-telegram text-2xl mr-3"></i>
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
                    {{-- <div class="flex -space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-green-500 rounded-full border-2 border-white"></div>
                        <div class="w-8 h-8 bg-gradient-to-br from-teal-400 to-teal-600 rounded-full border-2 border-white"></div>
                        <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full border-2 border-white"></div>
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-teal-500 rounded-full border-2 border-white"></div>
                    </div> --}}
                    <p class="text-white font-medium">
                        <span class="font-bold">99+</span>
                        {{ $locale === 'id' ? 'orang bergabung' : 'people joined' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Media Platforms Section - Elegant Redesign -->
<section class="py-20 bg-gradient-to-b from-white to-gray-50 relative overflow-hidden">
    <!-- Background Decorative Elements -->
    <div class="absolute inset-0">
        <!-- Floating gradient circles -->
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-secondary/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-secondary/3 rounded-full blur-3xl"></div>

        <!-- Subtle pattern overlay -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%231a1a1a" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Section Header with Animated Underline -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-secondary rounded-2xl mb-6 mx-auto shadow-lg transform rotate-3 hover:rotate-0 transition-transform duration-500">
                <i class="fas fa-share-alt text-2xl text-white"></i>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-secondary to-secondary-dark">
                    {{ $hero['connect_title'] }}
                </span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-8 leading-relaxed">
                {{ $hero['connect_subtitle'] }}
            </p>

            <!-- Animated underline -->
            <div class="relative w-48 h-1 mx-auto">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-secondary/30 to-transparent rounded-full"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-secondary to-secondary-dark rounded-full animate-pulse"></div>
            </div>
        </div>

        <!-- Social Cards Grid - FLEX SOLUTION -->
        @php
            $cardCount = count($community['social_links']);
            $maxCardsPerRow = 3; // Default max cards per row

            // Tentukan max cards per row berdasarkan jumlah card
            if ($cardCount === 1) {
                $maxCardsPerRow = 1;
                $cardWidth = 'max-w-md'; // Lebih lebar untuk 1 card
            } elseif ($cardCount === 2) {
                $maxCardsPerRow = 2;
                $cardWidth = 'w-full max-w-md'; // Medium width untuk 2 cards
            } elseif ($cardCount === 4) {
                $maxCardsPerRow = 4;
                $cardWidth = 'w-full';
            } else {
                // Untuk 3, 5, 6, 7, 8, dst gunakan 3 per row
                $maxCardsPerRow = 3;
                $cardWidth = 'w-full';
            }
        @endphp

        <!-- Flex Container - Pusatkan semua card -->
        <div class="flex flex-wrap justify-center gap-8 max-w-6xl mx-auto">
            @foreach($community['social_links'] as $index => $social)
            <div class="group relative {{ $cardWidth }} {{ $maxCardsPerRow == 1 ? '' : 'md:w-[calc((100%/' . $maxCardsPerRow . ')-2rem)]' }} h-full">
                <!-- Card Container -->
                <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden h-full">

                    <!-- Gradient border effect on hover -->
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-secondary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <!-- Background pattern -->
                    <div class="absolute top-0 right-0 w-32 h-32 -translate-y-1/2 translate-x-1/2 bg-secondary/5 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700"></div>

                    <div class="relative z-10 h-full flex flex-col">
                        <!-- Icon container -->
                        <div class="relative mb-8">
                            <div class="absolute -inset-4 bg-gradient-to-br from-secondary/10 to-secondary/5 rounded-full blur opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative w-20 h-20 bg-gradient-to-br from-secondary to-secondary-dark rounded-2xl flex items-center justify-center mx-auto shadow-md group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                                <div class="absolute inset-0 rounded-2xl border-4 border-secondary"></div>
                                <i class="{{ $social['icon'] }} text-3xl text-secondary"></i>
                            </div>

                            <!-- Floating indicator -->
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-secondary rounded-full border-4 border-secondary flex items-center justify-center shadow-md">
                                <span class="text-secondary text-xs font-bold">{{ $index + 1 }}</span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-grow">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center group-hover:text-secondary transition-colors duration-300">
                                {{ $social['name'] }}
                            </h3>

                            <p class="text-gray-600 text-center mb-8 leading-relaxed min-h-[80px]">
                                {{ $social['description'] }}
                            </p>
                        </div>

                        <!-- Join button -->
                        <div class="mt-auto">
                            <div class="text-center">
                                <a href="{{ $social['url'] }}" target="_blank"
                                   class="relative inline-flex items-center justify-center gap-3 bg-gradient-to-r from-secondary to-secondary-dark hover:from-secondary-dark hover:to-secondary text-white font-semibold py-4 px-8 rounded-xl transition-all duration-300 transform group-hover:scale-105 shadow-lg hover:shadow-xl overflow-hidden">

                                    <!-- Button shine effect -->
                                    <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-700 bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>

                                    <i class="{{ $social['icon'] }} text-xl text-secondary"></i>
                                    <span class="text-secondary">{{ $hero['join_now'] }}</span>

                                    <!-- Arrow icon -->
                                    <i class="fas fa-external-link-alt text-secondary text-sm opacity-80 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform duration-300"></i>
                                </a>

                                <!-- Status indicator -->
                                <div class="mt-4 flex items-center justify-center gap-2 text-sm text-gray-500">
                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                    <span>{{ $locale === 'id' ? 'Online' : 'Online' }}</span>
                                    <span class="text-gray-300">•</span>
                                    <span>{{ $locale === 'id' ? 'Bergabung Gratis' : 'Join Free' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative corner elements -->
                    <div class="absolute top-4 left-4 w-6 h-6 border-t-2 border-l-2 border-secondary/30 rounded-tl-lg"></div>
                    <div class="absolute bottom-4 right-4 w-6 h-6 border-b-2 border-r-2 border-secondary/30 rounded-br-lg"></div>
                </div>

                <!-- Subtle shadow enhancement -->
                <div class="absolute inset-0 bg-gradient-to-br from-secondary/10 to-transparent rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10"></div>
            </div>
            @endforeach
        </div>

        <!-- Spacer untuk jumlah card yang tidak penuh -->
        @if($cardCount % $maxCardsPerRow !== 0)
        <div class="h-8"></div>
        @endif

        <!-- Bottom CTA -->
        <div class="text-center mt-16">
            <div class="inline-flex flex-col sm:flex-row items-center justify-center gap-6 bg-gradient-to-r from-white via-secondary/5 to-white backdrop-blur-sm rounded-2xl px-8 py-6 border border-gray-200 shadow-lg">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-secondary to-secondary-dark rounded-full flex items-center justify-center shadow-md">
                        <i class="fas fa-comments text-secondary text-xl"></i>
                    </div>
                    <div class="text-left">
                        <div class="font-bold text-gray-900">{{ $locale === 'id' ? 'Butuh Bantuan?' : 'Need Help?' }}</div>
                        <div class="text-sm text-gray-600">{{ $locale === 'id' ? 'Tim kami siap membantu' : 'Our team is ready to help' }}</div>
                    </div>
                </div>

                <div class="hidden sm:block w-px h-10 bg-gradient-to-b from-transparent via-gray-300 to-transparent"></div>

                {{-- <div class="flex -space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-secondary to-secondary-dark rounded-full border-2 border-secondary flex items-center justify-center shadow-md">
                        <i class="fas fa-user text-secondary text-sm"></i>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-secondary to-secondary-dark rounded-full border-2 border-secondary flex items-center justify-center shadow-md">
                        <i class="fas fa-user text-secondary text-sm"></i>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-secondary to-secondary-dark rounded-full border-2 border-secondary flex items-center justify-center shadow-md">
                        <i class="fas fa-user text-secondary text-sm"></i>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-secondary to-secondary-dark rounded-full border-2 border-secondary flex items-center justify-center shadow-md">
                        <span class="text-secondary text-xs font-bold">+24/7</span>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>

<!-- Add custom animations -->
<style>
    @keyframes float-card {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .group:hover .group-hover\\:animate-float {
        animation: float-card 3s ease-in-out infinite;
    }

    @keyframes shine {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
</style>

<!-- Community Benefits Section -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $membership['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $membership['subtitle'] }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $membership['network_peers']['title'] }}</h3>
                <p class="text-gray-600">{{ $membership['network_peers']['description'] }}</p>
            </div>
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="fas fa-chalkboard-teacher text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $membership['learn_experts']['title'] }}</h3>
                <p class="text-gray-600">{{ $membership['learn_experts']['description'] }}</p>
            </div>
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="fas fa-briefcase text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $membership['career_opportunities']['title'] }}</h3>
                <p class="text-gray-600">{{ $membership['career_opportunities']['description'] }}</p>
            </div>
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="fas fa-lightbulb text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $membership['share_knowledge']['title'] }}</h3>
                <p class="text-gray-600">{{ $membership['share_knowledge']['description'] }}</p>
            </div>
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="fas fa-calendar-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $membership['events_workshops']['title'] }}</h3>
                <p class="text-gray-600">{{ $membership['events_workshops']['description'] }}</p>
            </div>
            <div class="text-center bg-white rounded-xl p-6 shadow-lg card-hover">
                <div class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                    <i class="fas fa-trophy text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">{{ $membership['achievements']['title'] }}</h3>
                <p class="text-gray-600">{{ $membership['achievements']['description'] }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Community Guidelines Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-100 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-10 left-10 w-72 h-72 bg-secondary/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-primary/5 rounded-full blur-3xl animate-pulse animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/4 w-64 h-64 bg-accent/5 rounded-full blur-2xl animate-pulse animation-delay-1000"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Header with Animated Icon -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-secondary rounded-full mb-6 mx-auto shadow-lg transform hover:scale-110 hover:rotate-12 transition-all duration-500">
                <i class="fas fa-handshake text-3xl text-white"></i>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-secondary to-secondary-dark">
                    {{ $guidelines['title'] }}
                </span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-6 leading-relaxed">
                {{ $guidelines['subtitle'] }}
            </p>
            <div class="w-24 h-1 bg-gradient-to-r from-secondary via-accent to-primary mx-auto rounded-full"></div>
        </div>

        <!-- Guidelines Cards Grid -->
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach(['be_respectful', 'stay_relevant', 'help_others', 'no_spam'] as $key)
                <div class="group relative">
                    <!-- Card Background with Gradient Animation -->
                    <div class="absolute inset-0 bg-gradient-to-br from-white via-gray-50 to-white rounded-2xl shadow-xl transform group-hover:scale-105 group-hover:shadow-2xl transition-all duration-500 ease-out"></div>

                    <!-- Main Card Content -->
                    <div class="relative p-8 rounded-2xl border border-gray-200 group-hover:border-secondary/30 transition-all duration-500 overflow-hidden">
                        <!-- Animated Background Pattern -->
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-10 transition-opacity duration-700">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-secondary rounded-full -translate-y-1/2 translate-x-1/2"></div>
                            <div class="absolute bottom-0 left-0 w-24 h-24 bg-primary rounded-full translate-y-1/2 -translate-x-1/2"></div>
                        </div>

                        <!-- Icon with Floating Animation -->
                        <div class="relative mb-6">
                            <div class="absolute -inset-3 bg-gradient-to-br from-secondary/20 to-primary/10 rounded-full blur opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-secondary to-secondary-dark rounded-xl shadow-md group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                                <i class="fas fa-check-circle text-2xl text-secondary"></i>
                            </div>
                            <div class="absolute -top-1 -right-1 w-6 h-6 bg-accent rounded-full border-4 border-white animate-ping opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>

                        <!-- Content -->
                        <h3 class="text-xl font-bold text-gray-900 mb-4 relative group-hover:text-secondary transition-colors duration-300">
                            <span class="relative z-10">{{ $guidelines[$key]['title'] }}</span>
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-secondary to-primary group-hover:w-full transition-all duration-500 ease-out"></span>
                        </h3>
                        <p class="text-gray-600 leading-relaxed relative z-10 group-hover:text-gray-700 transition-colors duration-300">
                            {{ $guidelines[$key]['description'] }}
                        </p>

                        <!-- Animated Bottom Line -->
                        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-1 bg-gradient-to-r from-secondary via-accent to-primary group-hover:w-3/4 transition-all duration-700 ease-out rounded-full"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Bottom Decoration -->
        <div class="text-center mt-12">
            <div class="inline-flex items-center space-x-3 bg-gradient-to-r from-white via-gray-50 to-white backdrop-blur-sm rounded-full px-6 py-3 border border-gray-200 shadow-sm">
                <i class="fas fa-shield-alt text-secondary text-xl"></i>
                <span class="text-gray-700 font-medium">
                    {{ $locale === 'id' ? 'Komunitas yang aman dan nyaman' : 'Safe and comfortable community' }}
                </span>
                <i class="fas fa-heart text-accent text-xl"></i>
            </div>
        </div>
    </div>
</section>

<!-- Our Community Program Section -->
<section class="py-20 bg-gradient-to-b from-white to-primary/5 relative overflow-hidden">
    <!-- Floating Elements Background -->
    <div class="absolute inset-0">
        <div class="absolute top-20 left-20 w-32 h-32 bg-secondary/10 rounded-full animate-float"></div>
        <div class="absolute top-40 right-32 w-24 h-24 bg-primary/10 rounded-full animate-float animation-delay-1000"></div>
        <div class="absolute bottom-32 left-1/3 w-40 h-40 bg-accent/10 rounded-full animate-float animation-delay-2000"></div>
        <div class="absolute bottom-40 right-40 w-28 h-28 bg-secondary/10 rounded-full animate-float animation-delay-3000"></div>
    </div>

    <!-- Geometric Pattern Overlay -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_1px_1px,rgba(0,0,0,0.05)_1px,transparent_0)] bg-[size:40px_40px] opacity-30"></div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Section Header with Animated Elements -->
        <div class="text-center mb-20">
            <div class="relative inline-block mb-8">
                <!-- Animated Rings -->
                <div class="absolute inset-0">
                    <div class="absolute inset-0 border-4 border-primary/20 rounded-full animate-ping"></div>
                    <div class="absolute inset-4 border-4 border-secondary/20 rounded-full animate-ping animation-delay-500"></div>
                </div>

                <!-- Main Icon -->
                <div class="relative w-24 h-24 bg-gradient-to-br from-primary to-primary-dark rounded-2xl flex items-center justify-center mx-auto shadow-2xl transform rotate-3 hover:rotate-0 transition-all duration-700">
                    <i class="fas fa-calendar-star text-4xl text-secondary"></i>
                </div>

                <!-- Small Decorative Icons -->
                <div class="absolute -top-2 -right-2 w-10 h-10 bg-accent rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-bolt text-secondary text-sm"></i>
                </div>
                <div class="absolute -bottom-2 -left-2 w-10 h-10 bg-secondary rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-rocket text-secondary text-sm"></i>
                </div>
            </div>

            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                <span class="bg-clip-text text-secondary bg-gradient-to-r from-primary via-secondary to-accent">
                    {{ $our_community_program['title'] }}
                </span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-8 leading-relaxed">
                {{ $our_community_program['description'] }}
            </p>

            <!-- Animated Underline -->
            <div class="relative w-48 h-1 mx-auto">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/20 via-secondary/20 to-accent/20 rounded-full"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-primary via-secondary to-accent rounded-full animate-marquee"></div>
            </div>
        </div>

        <!-- Program Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach(['remote_care_talk', 'remote_care_qa_live', 'mva_discussion_room', 'networking_job_opportunities'] as $key)
            <div class="group relative">
                <!-- Card Container with Perspective -->
                <div class="relative transform transition-all duration-700 group-hover:-translate-y-2">
                    <!-- Background Glow Effect -->
                    <div class="absolute -inset-0.5 bg-gradient-to-br from-primary via-secondary to-accent rounded-3xl opacity-0 group-hover:opacity-20 blur transition-opacity duration-500"></div>

                    <!-- Main Card -->
                    <div class="relative bg-gradient-to-b from-white to-gray-50 rounded-3xl p-8 shadow-xl border border-gray-100 group-hover:border-primary/30 transition-all duration-500 overflow-hidden">
                        <!-- Animated Background Pattern -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-primary/5 to-transparent transform translate-x-1/2 -translate-y-1/2 rounded-full group-hover:scale-150 transition-transform duration-1000"></div>

                        <!-- Icon Container with Floating Animation -->
                        <div class="relative mb-8">
                            <div class="absolute -inset-4 bg-gradient-to-br from-primary/10 to-secondary/10 rounded-full blur opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                            <div class="relative w-20 h-20 bg-gradient-to-br from-primary to-primary-dark rounded-2xl flex items-center justify-center mx-auto shadow-lg transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                <i class="{{ $our_community_program[$key]['icon'] }} text-3xl text-secondary"></i>
                            </div>
                            <!-- Small Floating Dot -->
                            <div class="absolute top-0 right-0 w-4 h-4 bg-accent rounded-full animate-bounce opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>

                        <!-- Content -->
                        <h3 class="text-xl font-bold text-gray-900 mb-4 text-center group-hover:text-primary transition-colors duration-300">
                            {{ $our_community_program[$key]['title'] }}
                        </h3>
                        <p class="text-gray-600 text-center mb-6 leading-relaxed group-hover:text-gray-700 transition-colors duration-300">
                            {{ $our_community_program[$key]['description'] }}
                        </p>

                        <!-- Bottom Indicator -->
                        <div class="text-center">
                            <div class="inline-flex items-center space-x-2 text-sm text-primary opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <i class="fas fa-clock text-secondary"></i>
                                <span>{{ $locale === 'id' ? 'Program Rutin' : 'Regular Program' }}</span>
                                <i class="fas fa-users text-secondary"></i>
                            </div>
                        </div>

                        <!-- Hover Effect Border -->
                        <div class="absolute inset-0 rounded-3xl border-2 border-transparent group-hover:border-primary/10 transition-all duration-500"></div>
                    </div>

                    <!-- Shadow Enhancement -->
                    <div class="absolute inset-0 rounded-3xl shadow-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- CTA Bottom Section -->
        <div class="text-center mt-16">
            <div class="inline-flex flex-col md:flex-row items-center justify-center gap-6 bg-gradient-to-r from-white via-primary/5 to-white backdrop-blur-sm rounded-2xl px-8 py-6 border border-gray-200 shadow-lg transform hover:scale-105 transition-all duration-500">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-secondary to-accent rounded-full flex items-center justify-center shadow-md">
                        <i class="fas fa-calendar-check text-secondary text-xl"></i>
                    </div>
                    <div class="text-left">
                        <div class="text-lg font-bold text-gray-900">{{ $locale === 'id' ? 'Jadwal Program' : 'Program Schedule' }}</div>
                        <div class="text-sm text-gray-600">{{ $locale === 'id' ? 'Tersedia mingguan' : 'Available weekly' }}</div>
                    </div>
                </div>

                <div class="hidden md:block w-px h-10 bg-gradient-to-b from-transparent via-gray-300 to-transparent"></div>

                <div class="flex -space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary-dark rounded-full border-2 border-secondary flex items-center justify-center shadow-md">
                        <i class="fas fa-user text-secondary text-sm"></i>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-secondary to-secondary-dark rounded-full border-2 border-secondary flex items-center justify-center shadow-md">
                        <i class="fas fa-user text-secondary text-sm"></i>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-accent to-accent-dark rounded-full border-2 border-secondary flex items-center justify-center shadow-md">
                        <i class="fas fa-user text-secondary text-sm"></i>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-full border-2 border-secondary flex items-center justify-center shadow-md">
                        <span class="text-secondary text-xs font-bold">+99</span>
                    </div>
                </div>

                <a href="https://t.me/+Pr90XWqdSBsyMTg9" target="_blank" class="bg-gradient-to-r border border-secondary from-primary to-secondary hover:from-primary-dark hover:to-secondary-dark text-secondary font-bold py-3 px-6 rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fab fa-telegram mr-2 text-secondary"></i>
                    {{ $locale === 'id' ? 'Lihat Jadwal' : 'View Schedule' }}
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Custom Animation Classes -->
<div class="hidden">
    <!-- Float Animation -->
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes marquee {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        .animate-marquee {
            animation: marquee 3s linear infinite;
        }

        .animation-delay-500 { animation-delay: 500ms; }
        .animation-delay-1000 { animation-delay: 1000ms; }
        .animation-delay-2000 { animation-delay: 2000ms; }
        .animation-delay-3000 { animation-delay: 3000ms; }
    </style>
</div>

<!-- Testimonials Section -->
{{-- <section class="py-16 bg-light">
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
</section> --}}

<!-- CTA Section -->
<section class="py-16 bg-primary text-white relative overflow-hidden">
    <!-- Animated Background with Secondary-Dark Curved Ribbon Pattern -->
    {{-- <div class="absolute inset-0 z-10">
        <!-- Curved Ribbon 1 - Top Left -->
        <svg class="absolute top-0 left-0 w-96 h-96" viewBox="0 0 400 400">
            <path d="M0,100 Q100,0 200,100 T400,100 L400,150 Q300,250 200,150 T0,150 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
            <path d="M0,250 Q100,150 200,250 T400,250 L400,300 Q300,400 200,300 T0,300 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
        </svg>

        <!-- Curved Ribbon 2 - Top Right -->
        <svg class="absolute top-0 right-0 w-96 h-96" viewBox="0 0 400 400">
            <path d="M400,100 Q300,0 200,100 T0,100 L0,150 Q100,250 200,150 T400,150 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
            <path d="M400,250 Q300,150 200,250 T0,250 L0,300 Q100,400 200,300 T400,300 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
        </svg>

        <!-- Curved Ribbon 3 - Bottom Left -->
        <svg class="absolute bottom-0 left-0 w-96 h-96" viewBox="0 0 400 400">
            <path d="M0,300 Q100,400 200,300 T400,300 L400,250 Q300,150 200,250 T0,250 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
            <path d="M0,150 Q100,250 200,150 T400,150 L400,100 Q300,0 200,100 T0,100 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
        </svg>

        <!-- Curved Ribbon 4 - Bottom Right -->
        <svg class="absolute bottom-0 right-0 w-96 h-96" viewBox="0 0 400 400">
            <path d="M400,300 Q300,400 200,300 T0,300 L0,250 Q100,150 200,250 T400,250 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
            <path d="M400,150 Q300,250 200,150 T0,150 L0,100 Q100,0 200,100 T400,100 Z"
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
            {{-- <a href="https://discord.gg/HealthCare" target="_blank" class="bg-transparent border-2 border-white hover:bg-white hover:text-secondary text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                {{ $cta['join_discord'] }}
            </a> --}}
        </div>
    </div>
</section>

@include('components.footer')
