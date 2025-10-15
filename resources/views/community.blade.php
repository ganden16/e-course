<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Community - Healthcare Remote Circle</title>
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
                    <a href="{{ route('community') }}" class="text-hc-green font-semibold">Our Community</a>
                    <a href="#" class="text-gray-700 hover:text-hc-green transition">Program</a>
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
                <a href="{{ route('community') }}" class="block py-2 text-hc-green font-semibold">Our Community</a>
                <a href="#" class="block py-2 text-gray-700 hover:text-hc-green">Program</a>
                <a href="#" class="block py-2 text-gray-700 hover:text-hc-green">FAQ</a>
            </div>
        </nav>
    </header>

    <main x-data="{ mobileMenuOpen: false }">
        <!-- Hero Section: Our Community (Berdasarkan Gambar) -->
        <section class="bg-white py-16 lg:py-24">
            <div class="container mx-auto px-6">
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <!-- Left Side: Visual (Improvisasi) -->
                    <div class="lg:w-1/2">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-hc-green to-hc-dark rounded-full opacity-20 blur-3xl"></div>
                            <img src="https://placehold.co/600x500/E2E8F0/10B981?text=Connected+Professionals" alt="HRC Community Network" class="relative w-full h-auto rounded-2xl shadow-2xl">
                        </div>
                    </div>
                    <!-- Right Side: Content -->
                    <div class="lg:w-1/2">
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-6">Our Community</h1>
                        <p class="text-lg text-gray-600 leading-relaxed mb-6">
                            Komunitas HRC adalah kelompok saling mendukung bagi para profesional medis. Kami menyediakan wadah untuk pelatihan, berbagi pengetahuan, dan menjalin koneksi yang membawa dampak positif pada karir Anda.
                        </p>
                        <p class="text-lg text-gray-600 leading-relaxed mb-8">
                            Sebagai anggota, Anda dapat memanfaatkan <strong>HRC Academy</strong> untuk pembelajaran terstruktur dan berpartisipasi dalam berbagai aktivitas komunitas yang dirancang untuk pertumbuhan Anda.
                        </p>
                        
                        <!-- Community Features List -->
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <i class="fas fa-microphone-alt text-hc-green text-xl mt-1 mr-4"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-800">RemoteCare Talks</h4>
                                    <p class="text-sm text-gray-600">Sesi webinar dengan pakar industri kesehatan digital.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-question-circle text-hc-green text-xl mt-1 mr-4"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Q&A Live Sessions</h4>
                                    <p class="text-sm text-gray-600">Tanya jawab langsung dengan mentor dan para ahli.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-comments text-hc-green text-xl mt-1 mr-4"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-800">MVA Discussion Room</h4>
                                    <p class="text-sm text-gray-600">Forum diskusi eksklusif untuk anggota program Medical Virtual Assistant.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-handshake text-hc-green text-xl mt-1 mr-4"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Networking & Job Opportunities</h4>
                                    <p class="text-sm text-gray-600">Akses ke jaringan profesional dan lowongan pekerjaan remote.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Community Highlights Section (Improvisasi) -->
        <section class="py-16 bg-gray-50" x-data="{ activeTab: 'events' }">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Aktivitas Komunitas Terkini</h2>
                <p class="text-center text-gray-600 mb-12">Lihat apa yang sedang ramai dibicarakan di HRC</p>
                
                <!-- Tab Navigation -->
                <div class="flex justify-center mb-8">
                    <div class="bg-white rounded-lg shadow-md p-1 inline-flex">
                        <button @click="activeTab = 'events'" :class="activeTab === 'events' ? 'bg-hc-green text-white' : 'text-gray-700'" class="px-6 py-2 rounded-md font-semibold transition">
                            <i class="fas fa-calendar-alt mr-2"></i>Acara
                        </button>
                        <button @click="activeTab = 'discussions'" :class="activeTab === 'discussions' ? 'bg-hc-green text-white' : 'text-gray-700'" class="px-6 py-2 rounded-md font-semibold transition">
                            <i class="fas fa-comments mr-2"></i>Diskusi
                        </button>
                        <button @click="activeTab = 'opportunities'" :class="activeTab === 'opportunities' ? 'bg-hc-green text-white' : 'text-gray-700'" class="px-6 py-2 rounded-md font-semibold transition">
                            <i class="fas fa-briefcase mr-2"></i>Peluang
                        </button>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="max-w-5xl mx-auto">
                    <!-- Events Tab -->
                    <div x-show="activeTab === 'events'" x-transition class="grid md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <span class="text-xs font-semibold text-hc-green bg-hc-green bg-opacity-10 px-3 py-1 rounded-full">Webinar</span>
                            <h3 class="text-xl font-bold mt-3 mb-2">RemoteCare Talks: Future of Telehealth</h3>
                            <p class="text-gray-600 text-sm mb-4">Bergabunglah dengan dr. Reza Wibowo membahas tren terbaru dalam telemedicine.</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-clock mr-2"></i> 15 Des 2023, 19:00 WIB
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <span class="text-xs font-semibold text-hc-green bg-hc-green bg-opacity-10 px-3 py-1 rounded-full">Workshop</span>
                            <h3 class="text-xl font-bold mt-3 mb-2">CV Building for Healthcare Professionals</h3>
                            <p class="text-gray-600 text-sm mb-4">Pelajari cara membuat CV yang menonjol untuk posisi remote.</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-clock mr-2"></i> 20 Des 2023, 10:00 WIB
                            </div>
                        </div>
                    </div>

                    <!-- Discussions Tab -->
                    <div x-show="activeTab === 'discussions'" x-transition class="space-y-4">
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <h3 class="text-lg font-bold mb-2">Tips mengatasi "Zoom Fatigue" bagi perawat remote?</h3>
                            <p class="text-gray-600 text-sm mb-3">Hai teman-teman, saya baru 2 bulan bekerja sebagai perawat virtual assistan dan sering sekali merasa lelah...</p>
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span><i class="fas fa-user mr-2"></i> Dimas A.</span>
                                <span><i class="fas fa-comment mr-1"></i> 23 balasan</span>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <h3 class="text-lg font-bold mb-2">Sharing: Software EHR yang paling user-friendly?</h3>
                            <p class="text-gray-600 text-sm mb-3">Mau tanya pendapat suhu-suhu di sini, dari pengalaman kalian, software Electronic Health Record...</p>
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span><i class="fas fa-user mr-2"></i> Sarah L.</span>
                                <span><i class="fas fa-comment mr-1"></i> 45 balasan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Opportunities Tab -->
                    <div x-show="activeTab === 'opportunities'" x-transition class="grid md:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <span class="text-xs font-semibold text-orange-600 bg-orange-100 px-3 py-1 rounded-full">NEW</span>
                            <h3 class="text-xl font-bold mt-3 mb-2">Medical Virtual Assistant</h3>
                            <p class="text-gray-600 text-sm mb-4">Perusahaan startup kesehatan di Jakarta mencari MVA berpengalaman.</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt mr-2"></i> Remote (Full-time)
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <h3 class="text-xl font-bold mt-3 mb-2">Freelance Health Content Writer</h3>
                            <p class="text-gray-600 text-sm mb-4">Butuh penulis lepas untuk artikel seputar kesehatan mental.</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt mr-2"></i> Remote (Freelance)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How to Join Section (Improvisasi) -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Cara Bergabung</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div class="relative">
                        <div class="bg-hc-green text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-2xl font-bold">1</div>
                        <h3 class="text-xl font-semibold mb-2">Daftar</h3>
                        <p class="text-gray-600">Buat akun Anda secara gratis di platform HRC untuk mulai menjelajahi.</p>
                    </div>
                    <div class="relative">
                        <div class="bg-hc-green text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-2xl font-bold">2</div>
                        <h3 class="text-xl font-semibold mb-2">Verifikasi & Lengkapi Profil</h3>
                        <p class="text-gray-600">Verifikasi email Anda dan lengkapi profil untuk terhubung dengan anggota lain.</p>
                    </div>
                    <div class="relative">
                        <div class="bg-hc-green text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 text-2xl font-bold">3</div>
                        <h3 class="text-xl font-semibold mb-2">Terlibat & Berkembang</h3>
                        <p class="text-gray-600">Ikuti pelatihan, join diskusi, dan manfaatkan semua sumber daya yang ada.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-hc-green text-white py-16">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-4">Menjadi Bagian dari Komunitas Kami</h2>
                <p class="text-xl mb-8 opacity-90">Bersama kita tumbuh lebih kuat. Bergabunglah hari ini!</p>
                <a href="#" class="bg-white text-hc-green font-bold py-3 px-8 rounded-full hover:bg-gray-100 transition duration-300 transform hover:scale-105 shadow-lg">
                    Gabung Sekarang Gratis
                </a>
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
                        <li><a href="{{ route('community') }}" class="hover:text-hc-green transition">Komunitas</a></li>
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