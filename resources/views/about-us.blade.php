<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Healthcare Remote Circle</title>
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
                    <a href="{{ route('about') }}" class="text-hc-green font-semibold">About Us</a>
                    <a href="#" class="text-gray-700 hover:text-hc-green transition">Program</a>
                    <a href="#" class="text-gray-700 hover:text-hc-green transition">Mentor</a>
                    <a href="#" class="text-gray-700 hover:text-hc-green transition">Testimoni</a>
                    <a href="#" class="text-gray-700 hover:text-hc-green transition">FAQ</a>
                </div>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-700">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" x-transition class="md:hidden mt-4 pb-4">
                <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-hc-green">Home</a>
                <a href="{{ route('about') }}" class="block py-2 text-hc-green font-semibold">About Us</a>
                <a href="#" class="block py-2 text-gray-700 hover:text-hc-green">Program</a>
                <a href="#" class="block py-2 text-gray-700 hover:text-hc-green">Mentor</a>
                <a href="#" class="block py-2 text-gray-700 hover:text-hc-green">Testimoni</a>
                <a href="#" class="block py-2 text-gray-700 hover:text-hc-green">FAQ</a>
            </div>
        </nav>
    </header>

    <main x-data="{ mobileMenuOpen: false }">
        <!-- Hero Section: About Us (Berdasarkan Gambar) -->
        <section class="bg-white py-16 lg:py-24">
            <div class="container mx-auto px-6">
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <!-- Left Side: Visual -->
                    <div class="lg:w-1/2">
                        <div class="relative">
                            <div class="absolute inset-0 bg-hc-green rounded-full opacity-20 blur-3xl"></div>
                            <img src="https://placehold.co/600x500/E2E8F0/10B981?text=HRC+Community" alt="HRC Community" class="relative w-full h-auto rounded-2xl shadow-2xl">
                        </div>
                    </div>
                    <!-- Right Side: Content -->
                    <div class="lg:w-1/2">
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-4">About Us</h1>
                        <h2 class="text-2xl font-semibold text-hc-green mb-6">Healthcare Remote Circle (HRC)</h2>
                        <p class="text-lg text-gray-600 leading-relaxed mb-4">
                            Didirikan oleh <strong>CV Medivra Global</strong>, Healthcare Remote Circle (HRC) adalah sebuah komunitas global dan pusat pelatihan yang berdedikasi untuk memberdayakan para profesional medis agar dapat berkembang pesat di era digital.
                        </p>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            Melalui <strong>HRC Academy</strong>, kami menyediakan program pelatihan intensif seperti *Medical Virtual Assistant (MVA) Training Program*. Sebagai komunitas yang suportif, kami menjadi wadah untuk pertumbuhan karir, menggabungkan pelatihan praktis, mentorship internasional, dan menjembatani kebutuhan talenta antara layanan kesehatan tradisional dan digital.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Mission & Vision Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-white p-8 rounded-xl shadow-lg text-center">
                        <div class="bg-hc-green text-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-bullseye text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Misi Kami</h3>
                        <p class="text-gray-600">
                            Memberdayakan profesional medis dengan keterampilan digital dan komunitas yang kuat, memungkinkan mereka untuk unggul dalam karir remote dan memberikan dampak positif pada kesehatan global.
                        </p>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-lg text-center">
                        <div class="bg-hc-green text-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-eye text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Visi Kami</h3>
                        <p class="text-gray-600">
                            Menjadi ekosistem terdepan yang menghubungkan, mengedukasi, dan menginspirasi generasi baru profesional kesehatan digital di seluruh dunia.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Story Section (Improvisasi) -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <div class="flex flex-col lg:flex-row-reverse items-center gap-12">
                    <div class="lg:w-1/2">
                        <img src="https://placehold.co/600x400/10B981/FFFFFF?text=Our+Journey" alt="Our Journey" class="w-full h-auto rounded-2xl shadow-xl">
                    </div>
                    <div class="lg:w-1/2">
                        <h2 class="text-3xl font-bold text-gray-800 mb-6">Cerita Kami</h2>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Semuanya dimulai dari sebuah pertanyaan sederhana: "Bagaimana caranya para profesional kesehatan yang berkompeten dapat terus berkontribusi tanpa terbatas oleh geografi?"
                        </p>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Didirikan pada tahun 2020, di tengah perubahan drastis yang dibawa oleh pandemi, HRC lahir dari kebutuhan akan adaptasi. Para pendiri kami di CV Medivra Global melihat adanya kesenjangan besar antara talenta medis yang luar biasa dan akses terhadap peluang karir modern yang fleksibel.
                        </p>
                        <p class="text-gray-600 leading-relaxed">
                            Hari ini, HRC telah berkembang menjadi lebih dari sekadar pelatihan; kami adalah sebuah gerakan, sebuah keluarga, dan sebuah jembatan menuju masa depan kesehatan yang lebih inklusif dan terhubung.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Values Section (Improvisasi) -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Nilai-Nilai Kami</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-xl transition-shadow">
                        <i class="fas fa-users text-3xl text-hc-green mb-4"></i>
                        <h4 class="font-semibold text-lg mb-2">Komunitas Utama</h4>
                        <p class="text-sm text-gray-600">Kami percaya bahwa pertumbuhan terbaik terjadi dalam lingkungan yang suportif.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-xl transition-shadow">
                        <i class="fas fa-laptop-code text-3xl text-hc-green mb-4"></i>
                        <h4 class="font-semibold text-lg mb-2">Pembelajaran Praktis</h4>
                        <p class="text-sm text-gray-600">Kurikulum kami dirancang untuk aplikasi dunia nyata, bukan sekadar teori.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-xl transition-shadow">
                        <i class="fas fa-globe-americas text-3xl text-hc-green mb-4"></i>
                        <h4 class="font-semibold text-lg mb-2">Jangkauan Global</h4>
                        <p class="text-sm text-gray-600">Mentor dan anggota kami berasal dari berbagai belahan dunia.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-xl transition-shadow">
                        <i class="fas fa-heart text-3xl text-hc-green mb-4"></i>
                        <h4 class="font-semibold text-lg mb-2">Integritas</h4>
                        <p class="text-sm text-gray-600">Kami menjunjung tinggi kejujuran dan etika dalam setiap aspek.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Meet Our Leadership Section (Improvisasi) -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Kenali Pemimpin Kami</h2>
                <p class="text-center text-gray-600 mb-12">Orang-orang di balik visi Healthcare Remote Circle</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <img src="https://placehold.co/250x250/065F46/FFFFFF?text=DR.A" alt="Founder" class="w-40 h-40 rounded-full mx-auto mb-4 object-cover shadow-lg">
                        <h4 class="text-xl font-semibold">dr. Aditya Kusuma, M.K.K.</h4>
                        <p class="text-hc-green mb-2">Founder & CEO</p>
                        <p class="text-sm text-gray-600">Dengan pengalaman lebih dari 15 tahun di bidang kesehatan publik dan telemedicine, dr. Aditya adalah arsitek di balik visi HRC.</p>
                    </div>
                    <div class="text-center">
                        <img src="https://placehold.co/250x250/065F46/FFFFFF?text=S.P" alt="COO" class="w-40 h-40 rounded-full mx-auto mb-4 object-cover shadow-lg">
                        <h4 class="text-xl font-semibold">Siti Permata, S.Kep., Ns.</h4>
                        <p class="text-hc-green mb-2">Chief Operating Officer</p>
                        <p class="text-sm text-gray-600">Seorang perawat praktisi yang beralih ke manajemen, Siti memastikan setiap program HRC berjalan dengan efektif dan berdampak.</p>
                    </div>
                    <div class="text-center">
                        <img src="https://placehold.co/250x250/065F46/FFFFFF?text=B.S" alt="Head of Academy" class="w-40 h-40 rounded-full mx-auto mb-4 object-cover shadow-lg">
                        <h4 class="text-xl font-semibold">Budi Santoso, S.Kom.</h4>
                        <p class="text-hc-green mb-2">Head of Academy</p>
                        <p class="text-sm text-gray-600">Ahli dalam pengembangan kurikulum digital, Budi bertanggung jawab atas kualitas dan relevansi materi pelatihan di HRC Academy.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-hc-green text-white py-16">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-4">Bergabunglah dengan Perjalanan Kami</h2>
                <p class="text-xl mb-8 opacity-90">Apakah Anda siap untuk mengambil langkah berikutnya dalam karir kesehatan Anda?</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#" class="bg-white text-hc-green font-bold py-3 px-8 rounded-full hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                        Jadi Anggota
                    </a>
                    <a href="#" class="bg-transparent border-2 border-white text-white font-bold py-3 px-8 rounded-full hover:bg-white hover:text-hc-green transition duration-300">
                        Lihat Program
                    </a>
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
                        <li><a href="#" class="hover:text-hc-green transition">Program</a></li>
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