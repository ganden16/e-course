<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Healthcare Remote Circle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js untuk Interaktivitas -->
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
                    <a href="{{ route('contact') }}" class="text-hc-green font-semibold">Contact</a>
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
                <a href="{{ route('contact') }}" class="block py-2 text-hc-green font-semibold">Contact</a>
            </div>
        </nav>
    </header>

    <main x-data="{ mobileMenuOpen: false }">
        <!-- Hero Section: Contact (Berdasarkan Gambar) -->
        <section class="bg-hc-green text-white py-16 lg:py-24">
            <div class="container mx-auto px-6 text-center">
                <div class="bg-white bg-opacity-20 rounded-full w-64 h-64 mx-auto mb-8 flex items-center justify-center">
                    <i class="fas fa-envelope text-white text-7xl"></i>
                </div>
                <h1 class="text-5xl font-bold">Contact</h1>
            </div>
        </section>

        <!-- Contact Form & Info Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Left Side: Contact Form -->
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Get In Touch</h2>
                        <p class="text-lg text-gray-600 mb-8">Ready To Grow With Us? Let's Talk.</p>
                        
                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                                <input type="text" id="name" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hc-green" placeholder="John Doe">
                            </div>
                            <div>
                                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                                <input type="email" id="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hc-green" placeholder="john.doe@example.com">
                            </div>
                            <div>
                                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hc-green" placeholder="+62 812-3456-7890">
                            </div>
                            <div>
                                <label for="message" class="block text-gray-700 text-sm font-bold mb-2">How Can We Help You?</label>
                                <textarea id="message" name="message" rows="5" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-hc-green" placeholder="Tell us more about your inquiry..."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-hc-green hover:bg-hc-dark text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105">
                                Send Message
                            </button>
                        </form>
                    </div>

                    <!-- Right Side: Contact Information (Improvisasi) -->
                    <div class="space-y-8">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-6">Informasi Kontak Lainnya</h3>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="bg-hc-green text-white rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Email</h4>
                                        <p class="text-gray-600">info@healthcarerc.com</p>
                                        <p class="text-gray-600">support@healthcarerc.com</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-hc-green text-white rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Telepon</h4>
                                        <p class="text-gray-600">+62 812-3456-7890 (WhatsApp)</p>
                                        <p class="text-gray-600">(021) 1234-5678</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-hc-green text-white rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Alamat</h4>
                                        <p class="text-gray-600">Jl. Medika No. 123, Jakarta Selatan, 12345, Indonesia</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-4">Ikuti Kami di Media Sosial</h4>
                            <div class="flex space-x-4">
                                <a href="#" class="bg-gray-200 text-gray-700 hover:bg-hc-green hover:text-white rounded-full w-10 h-10 flex items-center justify-center transition">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="bg-gray-200 text-gray-700 hover:bg-hc-green hover:text-white rounded-full w-10 h-10 flex items-center justify-center transition">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="bg-gray-200 text-gray-700 hover:bg-hc-green hover:text-white rounded-full w-10 h-10 flex items-center justify-center transition">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="bg-gray-200 text-gray-700 hover:bg-hc-green hover:text-white rounded-full w-10 h-10 flex items-center justify-center transition">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section (Improvisasi) -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Temui Kami</h2>
                <div class="rounded-lg overflow-hidden shadow-xl">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613507864!3d-6.194741395493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5390917b759%3A0x6b45e67356080477!2sMonas!5e0!3m2!1sen!2sid!4v1678886367264!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>

        <!-- FAQ Section (Improvisasi) -->
        <section class="py-16 bg-white" x-data="{ open: 0 }">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Pertanyaan Umum</h2>
                <div class="max-w-3xl mx-auto space-y-4">
                    <div class="border border-gray-200 rounded-lg">
                        <button @click="open = 0" class="w-full text-left p-4 flex justify-between items-center hover:bg-gray-50">
                            <span class="font-semibold">Bagaimana cara mendaftar program di HRC Academy?</span>
                            <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 0 }"></i>
                        </button>
                        <div x-show="open === 0" x-transition class="px-4 pb-4">
                            <p class="text-gray-600">Anda bisa mendaftar melalui halaman "Program" di website kami. Pilih program yang Anda inginkan, klik "Daftar Sekarang", dan ikuti langkah-langkah pendaftaran yang tersedia.</p>
                        </div>
                    </div>
                    <div class="border border-gray-200 rounded-lg">
                        <button @click="open = 1" class="w-full text-left p-4 flex justify-between items-center hover:bg-gray-50">
                            <span class="font-semibold">Apakah ada syarat khusus untuk bergabung dengan komunitas?</span>
                            <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 1 }"></i>
                        </button>
                        <div x-show="open === 1" x-transition class="px-4 pb-4">
                            <p class="text-gray-600">Komunitas kami terbuka untuk semua profesional di bidang kesehatan (mahasiswa, fresh graduate, hingga praktisi berpengalaman) yang ingin berkembang di era digital.</p>
                        </div>
                    </div>
                    <div class="border border-gray-200 rounded-lg">
                        <button @click="open = 2" class="w-full text-left p-4 flex justify-between items-center hover:bg-gray-50">
                            <span class="font-semibold">Bisakah saya berkonsultasi langsung dengan mentor?</span>
                            <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 2 }"></i>
                        </button>
                        <div x-show="open === 2" x-transition class="px-4 pb-4">
                            <p class="text-gray-600">Tentu! Anggota komunitas memiliki akses ke sesi Q&A Live dan dapat mengajukan pertanyaan di forum diskusi. Untuk konsultasi privat, tersedia pada program-program premium tertentu.</p>
                        </div>
                    </div>
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
                        <li><a href="{{ route('contact') }}" class="hover:text-hc-green transition">Kontak</a></li>
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