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

    // Initialize SEO Service
    $seo = app(\App\Services\SeoService::class);

    // SEO Data Preparation
    $seoTitle = $seo->generateTitle($title ?? null);
    $seoDescription = $seo->generateDescription($description ?? null);
    $seoKeywords = $seo->generateKeywords($keywords ?? null);
    $seoImage = $image ?? asset('assets/images/logo1.png');
    $seoType = $type ?? 'website';
    $canonicalUrl = $seo->getCanonicalUrl();
    $hreflangUrls = $seo->getHreflangUrls();
    $currentUrl = url()->current();

    // Open Graph Data
    $ogData = $seo->getOpenGraphData($seoTitle, $seoDescription, $seoImage, $seoType, $canonicalUrl);

    // Twitter Card Data
    $twitterData = $seo->getTwitterCardData($seoTitle, $seoDescription, $seoImage);

    // Structured Data (JSON-LD)
    $structuredData = [];

    // Always add Organization and Website structured data
    $structuredData[] = $seo->getOrganizationStructuredData();
    $structuredData[] = $seo->getWebsiteStructuredData();

    // Add article structured data if available
    if (isset($articleStructuredData)) {
        $structuredData[] = $articleStructuredData;
    }

    // Add course structured data if available
    if (isset($courseStructuredData)) {
        $structuredData[] = $courseStructuredData;
    }

    // Add product structured data if available
    if (isset($productStructuredData)) {
        $structuredData[] = $productStructuredData;
    }

    // Add breadcrumb structured data if available
    if (isset($breadcrumbStructuredData)) {
        $structuredData[] = $breadcrumbStructuredData;
    }

    // Add FAQ structured data if available
    if (isset($faqStructuredData)) {
        $structuredData[] = $faqStructuredData;
    }
@endphp

<!DOCTYPE html>
<html lang="{{ $locale }}" dir="ltr">
<head>
    <!-- Google Analytics -->
    @include('components.google-analytics')

    <!-- Basic Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Primary SEO Meta Tags -->
    <title>{!! strip_tags($seoTitle) !!}</title>
    <meta name="title" content="{!! strip_tags($seoTitle) !!}">
    <meta name="description" content="{!! strip_tags($seoDescription) !!}">
    <meta name="keywords" content="{!! strip_tags($seoKeywords) !!}">
    <meta name="author" content="{{ $site['name'] }}">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="bingbot" content="index, follow">

    <!-- Language and Locale -->
    <meta name="language" content="{{ $locale === 'id' ? 'Indonesian' : 'English' }}">
    <meta name="content-language" content="{{ $locale }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $canonicalUrl }}">

    <!-- Hreflang Tags for Multilingual SEO -->
    @foreach($hreflangUrls as $hreflangLocale => $hreflangUrl)
        <link rel="alternate" hreflang="{{ $hreflangLocale }}" href="{{ $hreflangUrl }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ $hreflangUrls['en'] ?? url('/en') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo1.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/logo1.png') }}">

    <!-- Open Graph / Facebook Meta Tags -->
    <meta property="og:type" content="{{ $ogData['type'] }}">
    <meta property="og:url" content="{{ $ogData['url'] }}">
    <meta property="og:title" content="{!! strip_tags($ogData['title']) !!}">
    <meta property="og:description" content="{!! strip_tags($ogData['description']) !!}">
    <meta property="og:image" content="{{ $ogData['image'] }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{!! strip_tags($seoTitle) !!}">
    <meta property="og:site_name" content="{{ $ogData['site_name'] }}">
    <meta property="og:locale" content="{{ $ogData['locale'] }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="{{ $twitterData['card'] }}">
    <meta name="twitter:site" content="{{ $twitterData['site'] }}">
    <meta name="twitter:title" content="{!! strip_tags($twitterData['title']) !!}">
    <meta name="twitter:description" content="{!! strip_tags($twitterData['description']) !!}">
    <meta name="twitter:image" content="{{ $twitterData['image'] }}">
    <meta name="twitter:image:alt" content="{!! strip_tags($seoTitle) !!}">

    <!-- Geo Tags -->
    <meta name="geo.region" content="ID-JI">
    <meta name="geo.placename" content="Surabaya">
    <meta name="geo.position" content="-7.2575;112.7521">
    <meta name="ICBM" content="-7.2575, 112.7521">

    <!-- Mobile Optimization -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="theme-color" content="#009b77">

    <!-- Structured Data (JSON-LD) -->
    @foreach($structuredData as $data)
        <script type="application/ld+json">
            {!! json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
    @endforeach

    <!-- Vite CSS -->
    @vite('resources/css/app.css')

    <!-- External CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#009b77',
                        'primary-dark': '#174e47',
                        'primary-light': '#d1fae5',
                        'secondary': '#009b77',
                        'secondary-dark': '#174e47',
                        'secondary-two': '#ffb433',
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

    <!-- Custom Styles -->
    <style>
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

    <!-- Preconnect to external domains for performance -->
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://images.unsplash.com">

    <!-- Google Search Console Verification -->
    @if(config('google.site_verification'))
        <meta name="google-site-verification" content="{{ config('google.site_verification') }}">
    @endif
</head>
<body class="font-sans antialiased bg-light">
    <!-- Navigation -->
    <header class="backdrop-blur-sm fixed top-0 left-0 right-0 z-50 transition-transform duration-300"
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

                if (currentScrollY > 100) {
                    showHeader = false;
                } else if (currentScrollY <= 100) {
                    showHeader = true;
                }

                lastScrollY = currentScrollY;

                if (scrollTimeout) clearTimeout(scrollTimeout);

                scrollTimeout = setTimeout(() => {
                    showHeader = true;
                }, 600);
            "
            :class="[
                scrolled ? 'bg-primary-dark/80 shadow-sm' : 'bg-transparent',
                showHeader ? 'translate-y-0' : '-translate-y-full'
            ]">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="{{ $baseUrl }}" class="flex items-center" title="{{ $site['name'] }} - {{ $site['tagline'] }}">
                        <!-- Logo dengan background lingkaran putih -->
                        <div class="bg-white rounded-full p-2 mr-3">
                            <img src="{{ asset($site['logo']) }}" alt="{{ $site['name'] }} Logo" class="w-8 h-8" loading="lazy" width="32" height="32">
                        </div>

                        <!-- Text "Health Care Remote Circle" dengan warna putih -->
                        <span class="text-lg font-bold text-white">
                            Healthcare Remote Circle
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    @foreach($navItems as $item)
                        <a href="{{ $item['url'] }}"
                           class="text-white hover:text-primary transition-colors duration-200 font-semibold text-sm {{ $item['active'] ? 'text-primary font-bold' : '' }}">
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
                            aria-label="{{ $locale == 'id' ? 'Pilih Bahasa' : 'Select Language' }}"
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
                            role="menu"
                            aria-orientation="vertical"
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
                                        role="menuitem"
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
                        href="{{ $baseUrl }}/bootcamp"
                        class="px-6 py-2.5 border-2 border-white text-white font-bold rounded-full transition-all duration-300 hover:bg-white hover:text-primary active:scale-95"
                        title="{{ $navigation['browse_courses'] }}"
                    >
                        {{ $navigation['browse_courses'] }}
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu" class="md:hidden text-primary-dark focus:outline-none" aria-label="Toggle Menu">
                    <i class="fas fa-bars text-2xl text-white"></i>
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
                        class="flex items-center py-3 px-4 rounded-xl transition-all duration-300 {{ $item['active'] ? 'bg-primary/10 text-primary border-l-4 border-accent text-white hover:text-primary' : 'text-white hover:bg-gray-100 hover:text-primary' }}">
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
                            <i class="fas fa-globe text-primary text-white"></i>
                            <span class="text-sm font-medium text-white">{{ $locale == 'id' ? 'Bahasa Indonesia' : 'English' }}</span>
                        </div>
                        <span class="text-xs text-white">{{ $locale == 'id' ? 'Pilih bahasa' : 'Select language' }}</span>
                    </div>

                    <div class="flex space-x-3">
                        @foreach($availableLangs as $code => $lang)
                            <a href="/lang/{{ $code }}"
                            class="flex-1 flex flex-col items-center justify-center p-3 rounded-xl transition-all duration-300 transform hover:scale-105 {{ $code === $locale ? 'bg-primary shadow-lg hover:text-white' : 'bg-gray-100 hover:bg-primary/20 hover:text-white' }}">
                                <span class="text-2xl mb-1">{{ $lang['flag'] }}</span>
                                <span class="text-sm font-semibold hover:text-white ">
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
        {{ $slot ?? '' }}
    </main>
