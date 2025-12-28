@php
    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for landing page (header/footer are part of landing page)
    $translations = include lang_path("{$locale}/landingPage.php");
    $site = $translations['site'];
    $navigation = $translations['navigation'];

    // Build navigation URLs with current locale
    $baseUrl = '/' . $locale;
    $navItems = [
        ['name' => $navigation['home'], 'url' => $baseUrl, 'active' => request()->is($baseUrl . '/*') && !request()->is($baseUrl . '/about-us', $baseUrl . '/product', $baseUrl . '/blog', $baseUrl . '/contact', $baseUrl . '/bootcamp', $baseUrl . '/community')],
        ['name' => $navigation['about'], 'url' => $baseUrl . '/about-us', 'active' => request()->is($baseUrl . '/about-us')],
        ['name' => $navigation['product'], 'url' => $baseUrl . '/product', 'active' => request()->is($baseUrl . '/product*')],
        ['name' => $navigation['blog'], 'url' => $baseUrl . '/blog', 'active' => request()->is($baseUrl . '/blog*')],
        ['name' => $navigation['contact'], 'url' => $baseUrl . '/contact', 'active' => request()->is($baseUrl . '/contact')],
        ['name' => $navigation['bootcamp'], 'url' => $baseUrl . '/bootcamp', 'active' => request()->is($baseUrl . '/bootcamp*')],
        ['name' => $navigation['community'], 'url' => $baseUrl . '/community', 'active' => request()->is($baseUrl . '/community')]
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? $site['name'] }} - {{ $site['tagline'] }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo1.png') }}">
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#009b77',
                        'primary-dark': '#174e47',
                        'primary-light': '#d1fae5',
                        // 'secondary': '#ffb433',
                        'secondary-two': '#ffb433',
                        'secondary': '#009b77',
                        // 'secondary-dark': '#ff9500',
                        'secondary-dark': '#174e47',
                        'accent': '#ffb433',
                        'dark': '#064e3b',
                        'light': '#fcf8ef',
                        'orange': '#ffb433',
                        'orange-dark': '#ff9500',
                    }
                }
            }
        }
    </script>

    <style>
        /* @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .pulse-animation {
            animation: pulse 2s ease-in-out infinite;
        } */
        .gradient-bg {
            background: linear-gradient(135deg, #ffb433 0%, #ff9500 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="font-sans antialiased bg-light">
    <!-- Navigation -->
    <header class="bg-primary shadow-sm sticky top-0 z-50" x-data="{ mobileMenu: false }">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="{{ $baseUrl }}" class="flex items-center">
                        <!-- Logo dengan background lingkaran putih -->
                        <div class="bg-white rounded-full p-2 mr-3">
                            <img src="{{ asset($site['logo']) }}" alt="{{ $site['name'] }}" class="w-8 h-8">
                        </div>

                        <!-- Text "Health Care Remote Circle" dengan warna putih -->
                        <span class="text-xl font-bold text-white">
                            Health Care Remote Circle
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    @foreach($navItems as $item)
                        <a href="{{ $item['url'] }}"
                           class="text-gray-200 hover:text-white transition-colors duration-200 font-medium {{ $item['active'] ? 'text-white' : '' }}">
                            {{ $item['name'] }}
                        </a>
                    @endforeach
                </div>

                <!-- Language Switcher & CTA Button -->
                <div class="hidden md:flex items-center space-x-6">
                    @php
                        $availableLangs = [
                            'id' => ['name' => 'Indonesia', 'flag' => '🇮🇩', 'code' => 'ID'],
                            'en' => ['name' => 'English', 'flag' => '🇺🇸', 'code' => 'EN']
                        ];
                    @endphp

                    <!-- Language Switcher -->
                    <div class="relative" x-data="{ open: false }">
                        <!-- Current Language Display -->
                        <button
                            @click="open = !open"
                            @click.outside="open = false"
                            class="flex items-center space-x-2 px-4 py-2.5 rounded-xl transition-all duration-300 hover:bg-white/10 active:scale-95 group"
                            :class="open ? 'bg-white/15 backdrop-blur-sm' : ''"
                        >
                            <div class="flex items-center space-x-2">
                                <!-- Flag with animated background -->
                                <div class="relative">
                                    <div class="absolute -inset-1 bg-gradient-to-r from-accent to-orange-dark rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300 blur-sm"></div>
                                    <span class="text-lg relative z-10">{{ $availableLangs[$locale]['flag'] }}</span>
                                </div>

                                <!-- Language Code -->
                                <span class="text-white font-medium tracking-wide">
                                    {{ $availableLangs[$locale]['code'] }}
                                </span>

                                <!-- Animated Chevron -->
                                <i
                                    class="fas fa-chevron-down text-xs text-white/70 transition-transform duration-300"
                                    :class="open ? 'rotate-180' : ''"
                                ></i>
                            </div>
                        </button>

                        <!-- Dropdown Menu -->
                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-3 w-56 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 overflow-hidden z-50"
                        >
                            <div class="p-2">
                                <!-- Dropdown Header -->
                                <div class="px-4 py-3 mb-1 border-b border-gray-100">
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        {{ $locale == 'id' ? 'Pilih Bahasa' : 'Select Language' }}
                                    </p>
                                </div>

                                <!-- Language Options -->
                                @foreach($availableLangs as $code => $lang)
                                    <a
                                        href="/lang/{{ $code }}"
                                        class="flex items-center justify-between px-4 py-3.5 rounded-xl transition-all duration-300 group/language hover:bg-primary/5 active:scale-[0.98]"
                                        :class="{{ $code === $locale ? "'bg-primary/10 cursor-default'" : "'hover:bg-gradient-to-r hover:from-primary/5 hover:to-accent/5'" }}"
                                    >
                                        <div class="flex items-center space-x-3">
                                            <!-- Flag with gradient border when active -->
                                            <div class="relative">
                                                @if($code === $locale)
                                                    <div class="absolute -inset-0.5 bg-gradient-to-r from-primary to-accent rounded-full opacity-30 blur-xs"></div>
                                                @endif
                                                <span class="text-xl relative z-10">{{ $lang['flag'] }}</span>
                                            </div>

                                            <!-- Language Details -->
                                            <div class="flex flex-col">
                                                <span class="font-medium text-gray-800 group-hover/language:text-primary-dark transition-colors">
                                                    {{ $lang['name'] }}
                                                </span>
                                                <span class="text-xs text-gray-500 mt-0.5">
                                                    {{ $lang['code'] }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Active Indicator / Chevron -->
                                        @if($code === $locale)
                                            <div class="flex items-center space-x-2">
                                                <div class="w-2 h-2 bg-gradient-to-r from-primary to-accent rounded-full animate-pulse"></div>
                                                <span class="text-xs font-medium text-primary bg-primary/10 px-2 py-1 rounded-full">
                                                    {{ $locale == 'id' ? 'Aktif' : 'Active' }}
                                                </span>
                                            </div>
                                        @else
                                            <i class="fas fa-chevron-right text-xs text-gray-400 group-hover/language:text-primary group-hover/language:translate-x-1 transition-all duration-300"></i>
                                        @endif
                                    </a>
                                @endforeach
                            </div>

                            <!-- Dropdown Footer -->
                            <div class="px-4 py-3 bg-gradient-to-r from-primary-light/20 to-accent/10 border-t border-gray-100">
                                <p class="text-xs text-gray-600 text-center">
                                    {{ $locale == 'id' ? 'Website tersedia dalam 2 bahasa' : 'Website available in 2 languages' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Optional: CTA Button (uncomment if needed) -->
                    <!--
                    <a
                        href="{{ $baseUrl }}/product"
                        class="relative group"
                    >
                        <div class="absolute -inset-1 bg-gradient-to-r from-secondary to-accent rounded-2xl blur opacity-30 group-hover:opacity-50 transition duration-300"></div>
                        <button class="relative px-8 py-3 bg-gradient-to-r from-secondary to-accent text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0 group-hover:scale-[1.02]">
                            {{ $navigation['browse_courses'] }}
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                        </button>
                    </a>
                    -->
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu" class="md:hidden text-white focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <div x-show="mobileMenu" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                class="md:hidden mt-6 pb-6">

                <!-- Navigation Items -->
                <div class="space-y-1 mb-8">
                    @foreach($navItems as $item)
                        <a href="{{ $item['url'] }}"
                        class="flex items-center py-3 px-4 rounded-xl transition-all duration-300 {{ $item['active'] ? 'bg-white/10 text-white border-l-4 border-accent' : 'text-gray-200 hover:bg-white/5 hover:text-white' }}">
                            <span class="font-medium">{{ $item['name'] }}</span>
                            @if($item['active'])
                                <span class="ml-2 w-2 h-2 bg-accent rounded-full animate-pulse"></span>
                            @endif
                            <i class="fas fa-chevron-right ml-auto text-xs opacity-70"></i>
                        </a>
                    @endforeach
                </div>

                <!-- Language Switcher -->
                <div class="mt-6 pt-6 border-t border-white/20">
                    <div class="flex items-center justify-between px-4 mb-4">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-globe text-accent"></i>
                            <span class="text-sm font-medium text-gray-100">{{ $locale == 'id' ? 'Bahasa Indonesia' : 'English' }}</span>
                        </div>
                        <span class="text-xs text-gray-300">{{ $locale == 'id' ? 'Pilih bahasa' : 'Select language' }}</span>
                    </div>

                    <div class="flex space-x-3">
                        @foreach($availableLangs as $code => $lang)
                            <a href="/lang/{{ $code }}"
                            class="flex-1 flex flex-col items-center justify-center p-3 rounded-xl transition-all duration-300 transform hover:scale-105 {{ $code === $locale ? 'bg-gradient-to-br from-accent to-orange-dark shadow-lg' : 'bg-white/5 hover:bg-white/10' }}">
                                <span class="text-2xl mb-1">{{ $lang['flag'] }}</span>
                                <span class="text-sm font-medium {{ $code === $locale ? 'text-white' : 'text-gray-200' }}">
                                    {{ $lang['name'] }}
                                </span>
                                @if($code === $locale)
                                    <span class="mt-1 w-1.5 h-1.5 bg-white rounded-full"></span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </nav>
    </header>

    <main>
