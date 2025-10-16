@php
    $data = json_decode(file_get_contents(resource_path('json/data.json')), true);
    $site = $data['site'];
    $navigation = $data['navigation'];
@endphp

<!DOCTYPE html>
<html lang="en">
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
                        'primary': '#3b82f6',
                        'primary-dark': '#1e40af',
                        'primary-light': '#dbeafe',
                        'secondary': '#10b981',
                        'secondary-dark': '#065f46',
                        'accent': '#f59e0b',
                        'dark': '#1f2937',
                        'light': '#f9fafb',
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
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
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
                    <a href="/" class="text-2xl font-bold text-primary flex items-center">
                        <i class="{{ $site['logo'] }} mr-2"></i>{{ $site['name'] }}
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    @foreach($navigation as $item)
                        <a href="{{ $item['url'] }}"
                           class="text-gray-700 hover:text-primary transition-colors duration-200 font-medium {{ $item['active'] ? 'text-primary' : '' }}">
                            {{ $item['name'] }}
                        </a>
                    @endforeach
                </div>

                <!-- CTA Button -->
                <div class="hidden md:block">
                    <a href="/product" class="bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-6 rounded-full transition duration-300 transform hover:scale-105 shadow-md">
                        Browse Courses
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu" class="md:hidden text-gray-700 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <div x-show="mobileMenu" x-transition class="md:hidden mt-4 pb-4">
                @foreach($navigation as $item)
                    <a href="{{ $item['url'] }}"
                       class="block py-2 text-gray-700 hover:text-primary transition-colors duration-200 font-medium {{ $item['active'] ? 'text-primary' : '' }}">
                        {{ $item['name'] }}
                    </a>
                @endforeach
                <div class="mt-4">
                    <a href="/product" class="block w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-6 rounded-full transition duration-300 text-center">
                        Browse Courses
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main>
