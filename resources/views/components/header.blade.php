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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
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
    <header class="backdrop-blur-sm fixed top-0 left-0 right-0 z-50 transition-all duration-300"
            :class="scrolled ? 'bg-primary-dark/80 shadow-sm' : 'bg-transparent'"
            x-data="{
                mobileMenu: false,
                scrolled: false,
                lastScrollY: 0,
                isScrollingDown: false,
                scrollTimeout: null,
                showHeader: true
            }"
            @scroll.window="
                const currentScrollY = window.pageYOffset;
                scrolled = (currentScrollY > 20);
                isScrollingDown = currentScrollY > lastScrollY;

                // Hide header when scrolling down
                if (isScrollingDown && currentScrollY > 100) {
                    showHeader = false;
                } else {
                    showHeader = true;
                }

                lastScrollY = currentScrollY;

                // Clear existing timeout
                if (scrollTimeout) clearTimeout(scrollTimeout);

                // Show header when scrolling stops (after 100ms)
                scrollTimeout = setTimeout(() => {
                    showHeader = true;
                }, 100);
            "
            :class="showHeader ? 'translate-y-0' : '-translate-y-full'">
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
                           class="text-white hover:text-primary transition-colors duration-200 font-semibold text-lg {{ $item['active'] ? 'text-primary font-bold' : '' }}">
                            {{ $item['name'] }}
                        </a>
                    @endforeach
                </div>

                <!-- Language Switcher & CTA Button -->
                <div class="hidden md:flex items-center space-x-4">
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
                            class="flex items-center space-x-2 px-4 py-2.5 rounded-xl transition-all duration-300 hover:bg-white/20 active:scale-95 group"
                            :class="open ? 'bg-white/20 text-white' : ''"
                        >
                            <div class="flex items-center space-x-2">
                                <!-- Language Code -->
                                <span class="text-white font-semibold tracking-wide group-hover:text-primary transition-colors duration-300">
                                    {{ $availableLangs[$locale]['code'] }}
                                </span>

                                <!-- Animated Chevron -->
                                <i
                                    class="fas fa-chevron-down text-xs text-white group-hover:text-primary transition-all duration-300"
                                    :class="open ? 'rotate-180 text-primary' : ''"
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
                            class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden z-50"
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
                                        class="flex items-center justify-between px-4 py-3.5 rounded-xl transition-all duration-300 group/language active:scale-[0.98]"
                                        :class="{{ $code === $locale ? "'bg-primary cursor-default'" : "'hover:bg-primary/10 hover:text-primary'" }}"
                                    >
                                        <div class="flex items-center space-x-3">
                                            <!-- Flag -->
                                            <span class="text-xl">{{ $lang['flag'] }}</span>

                                            <!-- Language Details -->
                                            <div class="flex flex-col">
                                                <span class="font-semibold {{ $code === $locale ? 'text-white' : 'text-gray-800 group-hover/language:text-primary' }} transition-colors">
                                                    {{ $lang['name'] }}
                                                </span>
                                                <span class="text-xs {{ $code === $locale ? 'text-white/80' : 'text-gray-500 group-hover/language:text-primary/70' }} mt-0.5 transition-colors">
                                                    {{ $lang['code'] }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Active Indicator / Chevron -->
                                        @if($code === $locale)
                                            <div class="flex items-center space-x-2">
                                                <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                                                <span class="text-xs font-semibold text-white bg-white/20 px-2 py-1 rounded-full">
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
                            <div class="px-4 py-3 bg-gray-50 border-t border-gray-100">
                                <p class="text-xs text-gray-600 text-center">
                                    {{ $locale == 'id' ? 'Website tersedia dalam 2 bahasa' : 'Website available in 2 languages' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Book Now Button -->
                    <a
                        href="{{ $baseUrl }}/product"
                        class="px-6 py-2.5 border-2 border-white text-white font-bold rounded-full transition-all duration-300 hover:bg-white hover:text-primary active:scale-95"
                    >
                        {{ $navigation['browse_courses'] }}
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu" class="md:hidden text-primary-dark focus:outline-none">
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
                        class="flex items-center py-3 px-4 rounded-xl transition-all duration-300 {{ $item['active'] ? 'bg-primary/10 text-primary border-l-4 border-accent' : 'text-gray-700 hover:bg-gray-100 hover:text-primary' }}">
                            <span class="font-medium">{{ $item['name'] }}</span>
                            @if($item['active'])
                                <span class="ml-2 w-2 h-2 bg-accent rounded-full animate-pulse"></span>
                            @endif
                            <i class="fas fa-chevron-right ml-auto text-xs opacity-70"></i>
                        </a>
                    @endforeach
                </div>

                <!-- Language Switcher -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-between px-4 mb-4">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-globe text-primary"></i>
                            <span class="text-sm font-medium text-gray-700">{{ $locale == 'id' ? 'Bahasa Indonesia' : 'English' }}</span>
                        </div>
                        <span class="text-xs text-gray-500">{{ $locale == 'id' ? 'Pilih bahasa' : 'Select language' }}</span>
                    </div>

                    <div class="flex space-x-3">
                        @foreach($availableLangs as $code => $lang)
                            <a href="/lang/{{ $code }}"
                            class="flex-1 flex flex-col items-center justify-center p-3 rounded-xl transition-all duration-300 transform hover:scale-105 {{ $code === $locale ? 'bg-primary shadow-lg' : 'bg-gray-100 hover:bg-primary/20 hover:text-primary' }}">
                                <span class="text-2xl mb-1">{{ $lang['flag'] }}</span>
                                <span class="text-sm font-semibold {{ $code === $locale ? 'text-white' : 'text-gray-700' }}">
                                    {{ $lang['name'] }}
                                </span>
                                @if($code === $locale)
                                    <span class="mt-1 w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </nav>
    </header>

    <main>
