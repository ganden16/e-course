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
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#10b981',
                        'primary-dark': '#065f46',
                        'primary-light': '#d1fae5',
                        'secondary': '#059669',
                        'secondary-dark': '#047857',
                        'accent': '#059669',
                        'dark': '#064e3b',
                        'light': '#f0fdf4',
                    }
                }
            }
        }
    </script>

    <style>
        @keyframes float {
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
        }
        .gradient-bg {
            background: linear-gradient(135deg, #10b981 0%, #065f46 100%);
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
    <header class="bg-white shadow-sm sticky top-0 z-50" x-data="{ mobileMenu: false }">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="{{ $baseUrl }}" class="text-2xl font-bold text-primary flex items-center">
                        <img src="{{ asset($site['logo']) }}" alt="{{ $site['name'] }}" class="w-8 h-8 mr-2 float-animation"> {{ $site['name'] }}
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    @foreach($navItems as $item)
                        <a href="{{ $item['url'] }}"
                           class="text-gray-700 hover:text-primary transition-colors duration-200 font-medium {{ $item['active'] ? 'text-primary' : '' }}">
                            {{ $item['name'] }}
                        </a>
                    @endforeach
                </div>

                <!-- Language Switcher & CTA Button -->
                <div class="hidden md:flex items-center space-x-4">
                    @php
                        $availableLangs = [
                            'id' => ['name' => 'ID', 'flag' => '🇮🇩'],
                            'en' => ['name' => 'EN', 'flag' => '🇺🇸']
                        ];
                    @endphp

                    <!-- Language Switcher -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-1 bg-white border border-gray-300 rounded-lg px-3 py-2 text-sm hover:bg-gray-50 transition-colors">
                            <span>{{ $availableLangs[$locale]['flag'] }}</span>
                            <span class="hidden sm:inline">{{ $availableLangs[$locale]['name'] }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                            @foreach($availableLangs as $code => $lang)
                                @if($code !== $locale)
                                    <a href="/lang/{{ $code }}" class="flex items-center space-x-2 px-4 py-2 text-sm hover:bg-gray-50 transition-colors">
                                        <span>{{ $lang['flag'] }}</span>
                                        <span>{{ $lang['name'] }}</span>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ $baseUrl }}/product" class="bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-6 rounded-full transition duration-300 transform hover:scale-105 shadow-md">
                        {{ $navigation['browse_courses'] }}
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu" class="md:hidden text-gray-700 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <div x-show="mobileMenu" x-transition class="md:hidden mt-4 pb-4">
                @foreach($navItems as $item)
                    <a href="{{ $item['url'] }}"
                       class="block py-2 text-gray-700 hover:text-primary transition-colors duration-200 font-medium {{ $item['active'] ? 'text-primary' : '' }}">
                        {{ $item['name'] }}
                    </a>
                @endforeach

                <!-- Mobile Language Switcher -->
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="text-sm text-gray-600 mb-2">Language:</div>
                    <div class="flex space-x-2">
                        @foreach($availableLangs as $code => $lang)
                            <a href="/lang/{{ $code }}" class="flex items-center space-x-1 px-3 py-2 text-sm rounded-lg {{ $code === $locale ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-colors">
                                <span>{{ $lang['flag'] }}</span>
                                <span>{{ $lang['name'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ $baseUrl }}/product" class="block w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-6 rounded-full transition duration-300 text-center">
                        {{ $navigation['browse_courses'] }}
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main>
