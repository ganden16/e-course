<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare Remote Circle - Academy And Community</title>
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
                        'hc-green': '#009b77',
                        'hc-dark': '#174e47',
                        'hc-orange': '#ffb433',
                        'hc-orange-dark': '#ff9500',
                        'hc-beige': '#fcf8ef',
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-hc-beige">

    <!-- Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="#" class="text-2xl font-bold text-hc-green">
                        <i class="fas fa-heartbeat mr-2 text-hc-orange"></i>HRC
                    </a>
                </div>
                <div class="hidden md:flex space-x-6">
                    <a href="#" class="text-gray-700 hover:text-hc-orange transition">Home</a>
                    <a href="#" class="text-gray-700 hover:text-hc-orange transition">About Us</a>
                    <a href="#" class="text-gray-700 hover:text-hc-orange transition">Program</a>
                    <a href="#" class="text-gray-700 hover:text-hc-orange transition">Mentor</a>
                    <a href="#" class="text-gray-700 hover:text-hc-orange transition">Testimoni</a>
                    <a href="#" class="text-gray-700 hover:text-hc-orange transition">FAQ</a>
                </div>
                <button class="md:hidden text-gray-700">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="bg-hc-green text-white">
            <div class="container mx-auto px-6 py-16 lg:py-24">
                <div class="flex flex-col lg:flex-row items-center">
                    <div class="lg:w-1/2 lg:pr-10">
                        <h1 class="text-4xl lg:text-5xl font-bold leading-tight mb-4">
                            WELCOME Healthcare Remote Circle
                        </h1>
                        <p class="text-xl lg:text-2xl mb-8 font-light">
                            Academy And Community
                        </p>
                        <p class="text-base mb-8 opacity-90">
                            Bergabunglah dengan komunitas profesional kesehatan terdepan yang siap mendukung karir Anda dari mana saja.
                        </p>
                        <button class="bg-hc-orange hover:bg-hc-orange-dark text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                            Ask Now
                        </button>
                    </div>
                    <div class="lg:w-1/2 mt-10 lg:mt-0">
                        <img src="https://placehold.co/600x400/E2E8F0/065F46?text=Community+Image" alt="Healthcare Community" class="w-full h-auto rounded-lg shadow-2xl">
                    </div>
                </div>
            </div>
        </section>

        <!-- Rintis Karir Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2">
                        <img src="https://placehold.co/500x350/F3F4F6/10B981?text=Karir+Image" alt="Karir" class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                    <div class="md:w-1/2 md:pl-12 mt-8 md:mt-0">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">Rintis Karir Bersama Healthcare Remote Circle</h2>
                        <p class="text-gray-600 leading-relaxed">
                            Kami menyediakan platform untuk mengembangkan skill, memperluas jaringan, dan menemukan peluang karir di bidang kesehatan yang dapat diakses secara remote. Dapatkan bimbingan dari mentor berpengalaman dan bergabung dengan ribuan profesional lainnya.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefit Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Benefit Healthcare</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center p-6 bg-white rounded-lg shadow-md">
                        <div class="bg-hc-orange text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Komunitas Luas</h3>
                        <p class="text-gray-600">Terhubung dengan ribuan profesional kesehatan dari seluruh Indonesia.</p>
                    </div>
                    <div class="text-center p-6 bg-white rounded-lg shadow-md">
                        <div class="bg-hc-green text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-graduation-cap text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Kursus Bersertifikat</h3>
                        <p class="text-gray-600">Akses berbagai materi pembelajaran untuk meningkatkan kompetensi Anda.</p>
                    </div>
                    <div class="text-center p-6 bg-white rounded-lg shadow-md">
                        <div class="bg-hc-orange text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-briefcase text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Peluang Karir</h3>
                        <p class="text-gray-600">Dapatkan informasi lowongan kerja remote yang sesuai dengan keahlian Anda.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimoni Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Testimoni</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <p class="text-gray-600 italic mb-4">"Platform yang sangat membantu saya untuk mengembangkan karir sebagai perawat remote. Mentor-mentor di sini sangat berpengalaman."</p>
                        <div class="flex items-center">
                            <img src="https://placehold.co/50x50/10B981/FFFFFF?text=A" alt="Avatar" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold">Andi Pratama</h4>
                                <p class="text-sm text-gray-500">Perawat</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <p class="text-gray-600 italic mb-4">"Komunitasnya sangat supportif. Saya mendapatkan banyak sekali insight dan tips karir yang tidak saya dapatkan di tempat lain."</p>
                        <div class="flex items-center">
                            <img src="https://placehold.co/50x50/10B981/FFFFFF?text=S" alt="Avatar" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold">Siti Nurhaliza</h4>
                                <p class="text-sm text-gray-500">Bidan</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <p class="text-gray-600 italic mb-4">"Berbagai kursus yang disediakan sangat relevan dan up-to-date. Saya jadi lebih percaya diri dengan skill saya."</p>
                        <div class="flex items-center">
                            <img src="https://placehold.co/50x50/10B981/FFFFFF?text=B" alt="Avatar" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold">Budi Santoso</h4>
                                <p class="text-sm text-gray-500">Analis Kesehatan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Program Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Program Healthcare Remote Circle</h2>
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 md:order-2">
                        <img src="https://placehold.co/500x350/E2E8F0/065F46?text=Program+Image" alt="Program" class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                    <div class="md:w-1/2 md:pr-12 mt-8 md:mt-0 md:order-1">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Program Unggulan Kami</h3>
                        <p class="text-gray-600 mb-4">Kami menawarkan berbagai program dirancang khusus untuk meningkatkan kemampuan hard skill dan soft skill Anda di dunia kesehatan modern.</p>
                        <ul class="space-y-2 text-gray-600">
                            <li><i class="fas fa-check-circle text-hc-orange mr-2"></i> Remote Nursing Academy</li>
                            <li><i class="fas fa-check-circle text-hc-green mr-2"></i> Digital Health Literacy</li>
                            <li><i class="fas fa-check-circle text-hc-orange mr-2"></i> Telehealth Practitioner Certification</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mentor Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Belajar Dari Para Mentor</h2>
                <p class="text-center text-gray-600 mb-12 text-lg">Walk The Talk</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <img src="https://placehold.co/200x200/10B981/FFFFFF?text=M1" alt="Mentor 1" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover shadow-lg">
                        <h4 class="text-xl font-semibold">dr. Alika, Sp.PK</h4>
                        <p class="text-gray-500">Konsultan Patologi Klinis</p>
                    </div>
                    <div class="text-center">
                        <img src="https://placehold.co/200x200/10B981/FFFFFF?text=M2" alt="Mentor 2" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover shadow-lg">
                        <h4 class="text-xl font-semibold">Reza Wibowo, S.Kep</h4>
                        <p class="text-gray-500">Head of Remote Nursing</p>
                    </div>
                    <div class="text-center">
                        <img src="https://placehold.co/200x200/10B981/FFFFFF?text=M3" alt="Mentor 3" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover shadow-lg">
                        <h4 class="text-xl font-semibold">Nina Kartika, Amd.Keb</h4>
                        <p class="text-gray-500">Founder Midwife Hub</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-16 bg-gray-50" x-data="{ open: 0 }">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Yang Sering Ditanyakan</h2>
                <div class="max-w-3xl mx-auto">
                    <div class="mb-4">
                        <button @click="open = 0" class="w-full text-left bg-white p-4 rounded-lg shadow-md flex justify-between items-center hover:bg-gray-100 transition">
                            <span class="font-semibold">Bagaimana cara bergabung dengan komunitas?</span>
                            <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 0 }"></i>
                        </button>
                        <div x-show="open === 0" x-transition class="bg-white p-4 rounded-b-lg shadow-md">
                            <p class="text-gray-600">Anda dapat mendaftar melalui halaman pendaftaran di website kami. Ikuti langkah-langkahnya dan verifikasi email Anda untuk mulai bergabung.</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <button @click="open = 1" class="w-full text-left bg-white p-4 rounded-lg shadow-md flex justify-between items-center hover:bg-gray-100 transition">
                            <span class="font-semibold">Apakah ada biaya untuk menjadi anggota?</span>
                            <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 1 }"></i>
                        </button>
                        <div x-show="open === 1" x-transition class="bg-white p-4 rounded-b-lg shadow-md">
                            <p class="text-gray-600">Ada beberapa paket keanggotaan, mulai dari gratis yang memiliki akses terbatas hingga premium dengan akses penuh ke semua kursus dan fitur.</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <button @click="open = 2" class="w-full text-left bg-white p-4 rounded-lg shadow-md flex justify-between items-center hover:bg-gray-100 transition">
                            <span class="font-semibold">Siapa saja yang bisa menjadi mentor?</span>
                            <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 2 }"></i>
                        </button>
                        <div x-show="open === 2" x-transition class="bg-white p-4 rounded-b-lg shadow-md">
                            <p class="text-gray-600">Profesional kesehatan dengan pengalaman minimal 5 tahun dan memiliki passion untuk berbagi ilmu bisa melamar menjadi mentor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-hc-dark text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">
                        <i class="fas fa-heartbeat mr-2"></i>HRC
                    </h3>
                    <p class="text-sm">Remote Circle Academy for a better future in healthcare.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-hc-orange transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-hc-orange transition">Program</a></li>
                        <li><a href="#" class="hover:text-hc-orange transition">Mentor</a></li>
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
                        <a href="#" class="hover:text-hc-orange transition"><i class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="hover:text-hc-orange transition"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="hover:text-hc-orange transition"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="hover:text-hc-orange transition"><i class="fab fa-linkedin text-xl"></i></a>
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
