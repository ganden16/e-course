<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - Healthcare Remote Circle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js untuk Interaktivitas Filter -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'hc-green': '#10b981',
                        'hc-dark': '#065f46',
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-gray-50">

    <!-- Navigation (Konsisten dengan halaman lain) -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-hc-green">
                        <i class="fas fa-heartbeat mr-2"></i>HEALTHCARE
                    </a>
                </div>
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-hc-green transition">Home</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-hc-green transition">About Us</a>
                    <a href="{{ route('community') }}" class="text-gray-700 hover:text-hc-green transition">Our Community</a>
                    <a href="{{ route('blog') }}" class="text-gray-700 hover:text-hc-green transition">Blog</a>
                    <a href="{{ route('product') }}" class="text-hc-green font-semibold">Product</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-hc-green transition">Contact</a>
                </div>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-700">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" x-transition class="md:hidden mt-4 pb-4">
                <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-hc-green">Home</a>
                <a href="{{ route('about') }}" class="block py-2 text-gray-700 hover:text-hc-green">About Us</a>
                <a href="{{ route('community') }}" class="block py-2 text-gray-700 hover:text-hc-green">Our Community</a>
                <a href="{{ route('blog') }}" class="block py-2 text-gray-700 hover:text-hc-green">Blog</a>
                <a href="{{ route('product') }}" class="block py-2 text-hc-green font-semibold">Product</a>
                <a href="{{ route('contact') }}" class="block py-2 text-gray-700 hover:text-hc-green">Contact</a>
            </div>
        </nav>
    </header>

    <main x-data="{ mobileMenuOpen: false, activeFilter: 'all' }">
        <!-- Hero Section: Product (Berdasarkan Gambar) -->
        <section class="bg-hc-green text-white py-16 lg:py-24">
            <div class="container mx-auto px-6">
                <div class="flex flex-col lg:flex-row items-center justify-center gap-12">
                    <!-- Gray Circle Element -->
                    <div class="bg-gray-300 rounded-full w-64 h-64 opacity-50 hidden lg:block"></div>
                    <!-- Title -->
                    <h1 class="text-5xl lg:text-6xl font-bold text-center">
                        <span class="border-b-4 border-white pb-2">Product</span>
                    </h1>
                </div>
            </div>
        </section>

        <!-- Search & Filter Section -->
        <section class="py-8 bg-white shadow-sm">
            <div class="container mx-auto px-6">
                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto mb-6">
                    <form>
                        <div class="relative">
                            <input type="text" placeholder="Apa Yang Ingin Kamu Pelajari ?" class="w-full px-6 py-4 pr-12 text-lg border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-hc-green">
                            <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-hc-green text-white rounded-full w-10 h-10 flex items-center justify-center hover:bg-hc-dark transition">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Filter Buttons -->
                <div class="flex flex-wrap justify-center gap-3">
                    <button @click="activeFilter = 'all'" :class="activeFilter === 'all' ? 'bg-hc-green text-white' : 'bg-gray-200 text-gray-700'" class="px-6 py-2 rounded-full font-semibold transition">
                        Semua
                    </button>
                    <button @click="activeFilter = 'Academy'" :class="activeFilter === 'Academy' ? 'bg-hc-green text-white' : 'bg-gray-200 text-gray-700'" class="px-6 py-2 rounded-full font-semibold transition">
                        Academy
                    </button>
                    <button @click="activeFilter = 'Bootcamp'" :class="activeFilter === 'Bootcamp' ? 'bg-hc-green text-white' : 'bg-gray-200 text-gray-700'" class="px-6 py-2 rounded-full font-semibold transition">
                        Bootcamp
                    </button>
                    <button @click="activeFilter = 'Workshop'" :class="activeFilter === 'Workshop' ? 'bg-hc-green text-white' : 'bg-gray-200 text-gray-700'" class="px-6 py-2 rounded-full font-semibold transition">
                        Workshop
                    </button>
                </div>
            </div>
        </section>

        <!-- Product Grid Section -->
        <section class="py-16">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                        // Simulasi data produk dari controller
                        $products = [
                            [
                                'id' => 1,
                                'title' => 'Medical Virtual Assistant (MVA) Training Program',
                                'category' => 'Bootcamp',
                                'price' => 'Rp 2.500.000',
                                'image' => 'mva-bootcamp',
                                'instructor' => 'Siti Permata, S.Kep.',
                                'features' => ['Live Session', 'Sertifikat', 'Job Support', '1-on-1 Mentoring'],
                                'isFeatured' => true
                            ],
                            [
                                'id' => 2,
                                'title' => 'Digital Health Literacy for Professionals',
                                'category' => 'Academy',
                                'price' => 'Rp 750.000',
                                'image' => 'digital-health',
                                'instructor' => 'dr. Aditya Kusuma',
                                'features' => ['Video Module', 'Quiz', 'Forum Diskusi', 'Sertifikat'],
                                'isFeatured' => false
                            ],
                            [
                                'id' => 3,
                                'title' => 'CV & Interview Mastery for Healthcare',
                                'category' => 'Workshop',
                                'price' => 'Rp 350.000',
                                'image' => 'cv-workshop',
                                'instructor' => 'Tim HRC Career',
                                'features' => ['Live Workshop', 'Template CV', 'Simulasi Interview'],
                                'isFeatured' => false
                            ],
                            [
                                'id' => 4,
                                'title' => 'Telehealth Practitioner Certification',
                                'category' => 'Academy',
                                'price' => 'Rp 1.500.000',
                                'image' => 'telehealth-cert',
                                'instructor' => 'dr. Reza Wibowo',
                                'features' => ['Modul Lengkap', 'Case Study', 'Ujian Sertifikasi'],
                                'isFeatured' => true
                            ],
                            [
                                'id' => 5,
                                'title' => 'Basic Medical Coding & Billing',
                                'category' => 'Academy',
                                'price' => 'Rp 900.000',
                                'image' => 'medical-coding',
                                'instructor' => 'Budi Santoso, S.Kom.',
                                'features' => ['Video Tutorial', 'Hands-on Practice', 'Sertifikat'],
                                'isFeatured' => false
                            ],
                            [
                                'id' => 6,
                                'title' => 'Advanced MVA: Specialized Clinics',
                                'category' => 'Bootcamp',
                                'price' => 'Rp 3.000.000',
                                'image' => 'advanced-mva',
                                'instructor' => 'Tim Mentor Senior',
                                'features' => ['Kelas Intensif', 'Project Based', 'Exclusive Network'],
                                'isFeatured' => false
                            ],
                        ];
                    @endphp

                    @foreach ($products as $product)
                    <div x-show="activeFilter === 'all' || '{{ $product['category'] }}' === activeFilter" class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">
                        <!-- Featured Badge -->
                        @if ($product['isFeatured'])
                        <div class="bg-orange-500 text-white text-xs font-bold text-center py-1">
                            <i class="fas fa-star mr-1"></i>FEATURED
                        </div>
                        @endif
                        
                        <div class="p-6 flex-1 flex flex-col">
                            <a href="#" class="block shrink-0 mb-4">
                                <img src="https://placehold.co/400x250/E2E8F0/10B981?text={{ $product['image'] }}" alt="{{ $product['title'] }}" class="w-full h-48 object-cover rounded-lg">
                            </a>
                            
                            <div class="flex-1">
                                <span class="text-xs font-semibold text-hc-green bg-hc-green bg-opacity-10 px-3 py-1 rounded-full">{{ $product['category'] }}</span>
                                <h3 class="text-xl font-bold text-gray-800 mt-3 mb-2 hover:text-hc-green transition-colors">
                                    <a href="#">{{ $product['title'] }}</a>
                                </h3>
                                <p class="text-sm text-gray-500 mb-4">by {{ $product['instructor'] }}</p>
                                
                                <ul class="text-sm text-gray-600 space-y-1 mb-6">
                                    @foreach ($product['features'] as $feature)
                                        <li><i class="fas fa-check text-hc-green mr-2"></i>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="flex items-center justify-between mt-auto pt-4 border-t">
                                <span class="text-2xl font-bold text-hc-dark">{{ $product['price'] }}</span>
                                <a href="#" class="bg-hc-green hover:bg-hc-dark text-white font-bold py-2 px-6 rounded-lg transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <a href="#" class="px-3 py-2 text-gray-500 hover:bg-gray-200 rounded-md transition">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" class="px-4 py-2 bg-hc-green text-white rounded-md">1</a>
                        <a href="#" class="px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md transition">2</a>
                        <a href="#" class="px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md transition">3</a>
                        <a href="#" class="px-3 py-2 text-gray-700 hover:bg-gray-200 rounded-md transition">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer (Konsisten dengan halaman lain) -->
    <footer class="bg-hc-dark text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">
                        <i class="fas fa-heartbeat mr-2"></i>HEALTHCARE
                    </h3>
                    <p class="text-sm">Academy And Community for a better future in healthcare.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-hc-green transition">Home</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-hc-green transition">Tentang Kami</a></li>
                        <li><a href="{{ route('product') }}" class="hover:text-hc-green transition">Produk</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-sm">
                        <li><i class="fas fa-envelope mr-2"></i>info@healthcarerc.com</li>
                        <li><i class="fas fa-phone mr-2"></i>+62 812-3456-7890</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-hc-green transition"><i class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="hover:text-hc-green transition"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="hover:text-hc-green transition"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="hover:text-hc-green transition"><i class="fab fa-linkedin text-xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-sm">
                <p>&copy; {{ date('Y') }} Healthcare Remote Circle. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>