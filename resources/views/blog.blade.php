<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Healthcare Remote Circle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
                    <a href="{{ route('blog') }}" class="text-hc-green font-semibold">Blog</a>
                    <a href="#" class="text-gray-700 hover:text-hc-green transition">FAQ</a>
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
                <a href="{{ route('blog') }}" class="block py-2 text-hc-green font-semibold">Blog</a>
                <a href="#" class="block py-2 text-gray-700 hover:text-hc-green">FAQ</a>
            </div>
        </nav>
    </header>

    <main x-data="{ mobileMenuOpen: false }">
        <!-- Hero Section: Blog (Berdasarkan Gambar) -->
        <section class="bg-hc-green text-white py-16">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-4xl md:text-5xl font-bold">
                    <span class="border-b-4 border-white pb-2">Blog</span>
                </h1>
            </div>
        </section>

        <!-- Blog List & Sidebar Section -->
        <section class="py-16">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content: Blog List -->
                    <div class="lg:col-span-2 space-y-8">
                        @php
                            // Simulasi data blog post dari controller
                            $posts = [
                                [
                                    'id' => 1,
                                    'title' => '5 Tren Telemedicine yang Akan Mendominasi 2024',
                                    'excerpt' => 'Telemedicine telah mengubah lanskap layanan kesehatan. Artikel ini mengulas lima tren terkini yang akan membentuk masa depan konsultasi medis jarak jauh, mulai dari AI hingga perangkat wearable.',
                                    'author' => 'dr. Aditya Kusuma',
                                    'date' => '15 November 2023',
                                    'image' => 'telemedicine-trends'
                                ],
                                [
                                    'id' => 2,
                                    'title' => 'Panduan Lengkap Menjadi Medical Virtual Assistant',
                                    'excerpt' => 'Tertarik berkarir sebagai Medical Virtual Assistant (MVA)? Panduan ini akan memandu Anda langkah demi langkah, dari skill yang dibutuhkan hingga cara mendapatkan klien pertama Anda.',
                                    'author' => 'Siti Permata, S.Kep.',
                                    'date' => '10 November 2023',
                                    'image' => 'mva-guide'
                                ],
                                [
                                    'id' => 3,
                                    'title' => 'Menjaga Kesehatan Mental saat Bekerja dari Rumah',
                                    'excerpt' => 'Bekerja remote menawarkan fleksibilitas, tetapi juga bisa menimbulkan tantangan bagi kesehatan mental. Pelajari strategi efektif untuk menjaga keseimbangan dan kesehatan mental Anda.',
                                    'author' => 'Reza Wibowo, S.Psi.',
                                    'date' => '5 November 2023',
                                    'image' => 'mental-health'
                                ],
                                [
                                    'id' => 4,
                                    'title' => 'Teknologi Terbaru dalam Pencatatan Kesehatan Elektronik (EHR)',
                                    'excerpt' => 'Evolusi Electronic Health Record (EHR) terus berlanjut. Mari kita lihat teknologi-teknologi terbaru yang membuat pencatatan medis lebih aman, cepat, dan efisien.',
                                    'author' => 'Budi Santoso, S.Kom.',
                                    'date' => '1 November 2023',
                                    'image' => 'ehr-tech'
                                ],
                            ];
                        @endphp

                        @foreach ($posts as $post)
                        <article class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="flex flex-col md:flex-row gap-6">
                                <a href="#" class="block shrink-0">
                                    <img src="https://placehold.co/400x250/E2E8F0/10B981?text={{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full md:w-48 h-48 object-cover rounded-lg">
                                </a>
                                <div class="flex-1">
                                    <div class="text-sm text-gray-500 mb-2">
                                        <span><i class="fas fa-user mr-1"></i> {{ $post['author'] }}</span> • <span><i class="fas fa-calendar mr-1"></i> {{ $post['date'] }}</span>
                                    </div>
                                    <h2 class="text-2xl font-bold text-gray-800 mb-3 hover:text-hc-green transition-colors">
                                        <a href="#">{{ $post['title'] }}</a>
                                    </h2>
                                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $post['excerpt'] }}</p>
                                    <a href="#" class="inline-flex items-center text-hc-green font-semibold hover:underline">
                                        Read More... <i class="fas fa-arrow-right ml-2 text-sm"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>

                    <!-- Sidebar -->
                    <aside class="lg:col-span-1 space-y-8">
                        <!-- Search Widget -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Cari Artikel</h3>
                            <form>
                                <div class="relative">
                                    <input type="text" placeholder="Kata kunci..." class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hc-green">
                                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-hc-green hover:text-hc-dark">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Categories Widget -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Kategori</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-600 hover:text-hc-green transition"><i class="fas fa-angle-right mr-2"></i> Karir (12)</a></li>
                                <li><a href="#" class="text-gray-600 hover:text-hc-green transition"><i class="fas fa-angle-right mr-2"></i> Teknologi (8)</a></li>
                                <li><a href="#" class="text-gray-600 hover:text-hc-green transition"><i class="fas fa-angle-right mr-2"></i> Kesehatan Mental (5)</a></li>
                                <li><a href="#" class="text-gray-600 hover:text-hc-green transition"><i class="fas fa-angle-right mr-2"></i> Tips & Trik (15)</a></li>
                                <li><a href="#" class="text-gray-600 hover:text-hc-green transition"><i class="fas fa-angle-right mr-2"></i> Berita Industri (7)</a></li>
                            </ul>
                        </div>

                        <!-- Recent Posts Widget -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Postingan Terbaru</h3>
                            <ul class="space-y-4">
                                <li class="flex gap-3">
                                    <img src="https://placehold.co/80x80/E2E8F0/10B981?text=thumb1" alt="Thumbnail" class="w-20 h-20 object-cover rounded-lg">
                                    <div>
                                        <a href="#" class="text-sm font-semibold text-gray-800 hover:text-hc-green line-clamp-2">5 Tren Telemedicine yang Akan Mendominasi 2024</a>
                                    </div>
                                </li>
                                <li class="flex gap-3">
                                    <img src="https://placehold.co/80x80/E2E8F0/10B981?text=thumb2" alt="Thumbnail" class="w-20 h-20 object-cover rounded-lg">
                                    <div>
                                        <a href="#" class="text-sm font-semibold text-gray-800 hover:text-hc-green line-clamp-2">Panduan Lengkap Menjadi Medical Virtual Assistant</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </aside>
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
                        <span class="px-2 text-gray-500">...</span>
                        <a href="#" class="px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md transition">10</a>
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
                        <li><a href="{{ route('blog') }}" class="hover:text-hc-green transition">Blog</a></li>
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