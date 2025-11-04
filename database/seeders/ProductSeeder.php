<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $webDevCategory = ProductCategory::where('slug', 'pengembangan-web')->first();
        $dataScienceCategory = ProductCategory::where('slug', 'ilmu-data')->first();
        $marketingCategory = ProductCategory::where('slug', 'pemasaran')->first();
        $designCategory = ProductCategory::where('slug', 'desain')->first();
        $mobileDevCategory = ProductCategory::where('slug', 'pengembangan-mobile')->first();
        $securityCategory = ProductCategory::where('slug', 'keamanan')->first();

        $products = [
            [
                'title' => 'Bootcamp Pengembangan Web Lengkap: Dari Nol Hingga Profesional',
                'slug' => 'bootcamp-pengembangan-web-lengkap',
                'product_category_id' => $webDevCategory->id,
                'instructor' => 'David Anderson',
                'price' => 899000,
                'original_price' => 1499000,
                'image' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80',
                'rating' => 4.8,
                'students' => 3420,
                'duration' => '42 hours',
                'level' => 'Pemula hingga Lanjutan',
                'description' => 'Pelajari pengembangan web dari nol dengan HTML, CSS, JavaScript, React, Node.js, dan lainnya. Kursus komprehensif ini dirancang untuk membawa Anda dari pemula absolut menjadi pengembang web profesional dengan portofolio proyek dunia nyata.',
                'features' => [
                    "42 jam konten video berkualitas tinggi",
                    "100+ latihan coding dengan solusi",
                    "5 proyek dunia nyata untuk portofolio",
                    "Sertifikat penyelesaian yang diakui industri",
                    "Akses seumur hidup ke semua materi dan pembaruan",
                    "Akses aplikasi mobile untuk belajar di mana saja",
                    "Komunitas Discord eksklusif untuk bantuan 24/7",
                    "Sesi Q&A langsung dengan instruktur setiap minggu"
                ],
                'curriculum' => [
                    "HTML5 & CSS3: Dasar hingga Lanjutan",
                    "JavaScript ES6+: Konsep Fundamental hingga Lanjutan",
                    "React.js: Komponen, State, Hooks, dan Redux",
                    "Node.js & Express.js: Backend Development",
                    "MongoDB: Database NoSQL",
                    "RESTful API Design & Implementation",
                    "Authentication & Authorization",
                    "Deployment & DevOps Basics"
                ],
                'requirements' => [
                    "Tidak ada pengalaman coding sebelumnya diperlukan",
                    "Komputer dengan akses internet",
                    "Motivasi untuk belajar dan berlatih"
                ],
                'what_you_will_build' => [
                    "Website Portfolio Responsif",
                    "Aplikasi Todo List dengan React",
                    "Blog Platform dengan Node.js dan MongoDB",
                    "E-commerce Frontend dengan React",
                    "API RESTful untuk Aplikasi Mobile"
                ],
                'is_active' => true,
            ],
            [
                'title' => 'Python untuk Ilmu Data: Analisis & Visualisasi Data',
                'slug' => 'python-untuk-ilmu-data',
                'product_category_id' => $dataScienceCategory->id,
                'instructor' => 'Dr. Sarah Mitchell',
                'price' => 799000,
                'original_price' => 1299000,
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'rating' => 4.9,
                'students' => 2850,
                'duration' => '36 hours',
                'level' => 'Menengah',
                'description' => 'Kuasai pemrograman Python untuk ilmu data, machine learning, dan analisis data. Kursus ini dirancang untuk memberikan Anda keterampilan praktis dalam mengumpulkan, membersihkan, menganalisis, dan memvisualisasikan data menggunakan Python.',
                'features' => [
                    "36 jam konten video berkualitas tinggi",
                    "80+ latihan coding dengan dataset nyata",
                    "10 proyek analisis data dunia nyata",
                    "Sertifikat penyelesaian yang diakui industri",
                    "Akses seumur hidup ke semua materi dan pembaruan",
                    "Sumber daya yang dapat diunduh (notebook Jupyter)",
                    "Akses ke komunitas Discord eksklusif",
                    "Proyek akhir untuk portofolio"
                ],
                'curriculum' => [
                    "Python Fundamentals: Syntax, Data Structures, Functions",
                    "NumPy: Arrays, Vectorized Operations, Linear Algebra",
                    "Pandas: DataFrames, Data Cleaning, Manipulation",
                    "Matplotlib & Seaborn: Data Visualization Techniques",
                    "Web Scraping with BeautifulSoup & Requests",
                    "API Integration for Data Collection",
                    "Statistical Analysis with Python",
                    "Introduction to Machine Learning with Scikit-learn"
                ],
                'requirements' => [
                    "Pemahaman dasar pemrograman (Python diutamakan)",
                    "Pengetahuan dasar statistik",
                    "Komputer dengan spesifikasi minimal (4GB RAM)",
                    "Instalasi Anaconda (dibimbing dalam kursus)"
                ],
                'what_you_will_build' => [
                    "Dashboard Analisis Penjualan Interaktif",
                    "Sistem Rekomendasi Film",
                    "Analisis Sentimen Media Sosial",
                    "Visualisasi Data COVID-19",
                    "Prediksi Harga Saham dengan Time Series"
                ],
                'is_active' => true,
            ],
            [
                'title' => 'Penguasaan Pemasaran Digital: Strategi & Implementasi',
                'slug' => 'penguasaan-pemasaran-digital',
                'product_category_id' => $marketingCategory->id,
                'instructor' => 'Emma Thompson',
                'price' => 699000,
                'original_price' => 1199000,
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1415&q=80',
                'rating' => 4.7,
                'students' => 1980,
                'duration' => '28 hours',
                'level' => 'Pemula',
                'description' => 'Pelajari strategi pemasaran digital termasuk SEO, media sosial, pemasaran konten, dan lainnya. Kursus komprehensif ini mengajarkan Anda cara membuat, mengelola, dan mengoptimalkan kampanye pemasaran digital yang efektif.',
                'features' => [
                    "28 jam konten video berkualitas tinggi",
                    "50+ tugas praktis dengan feedback",
                    "8 proyek kampanye pemasaran dunia nyata",
                    "Sertifikat penyelesaian yang diakui industri",
                    "Akses seumur hidup ke semua materi dan pembaruan",
                    "Template kampanye yang dapat diunduh",
                    "Dukungan komunitas dan networking",
                    "Akses ke tools pemasaran digital gratis"
                ],
                'curriculum' => [
                    "Fundamental Pemasaran Digital",
                    "SEO: On-Page, Off-Page, Technical SEO",
                    "Content Marketing: Strategy, Creation, Distribution",
                    "Social Media Marketing: Platforms, Strategies, Analytics",
                    "Email Marketing: Campaigns, Automation, Analytics",
                    "PPC Advertising: Google Ads, Facebook Ads",
                    "Analytics & Reporting: Google Analytics, KPIs",
                    "Marketing Automation: Tools, Workflows, Best Practices"
                ],
                'requirements' => [
                    "Tidak ada pengalaman pemasaran sebelumnya diperlukan",
                    "Pemahaman dasar media sosial",
                    "Komputer dengan akses internet",
                    "Akun Google dan media sosial (untuk latihan praktis)"
                ],
                'what_you_will_build' => [
                    "Strategi Konten untuk Bisnis E-commerce",
                    "Kampanye Google Ads untuk Startup",
                    "Kalendar Konten Media Sosial 3 Bulan",
                    "Email Marketing Automation Funnel",
                    "Dashboard Analytics Pemasaran"
                ],
                'is_active' => true,
            ],
            [
                'title' => 'Dasar-dasar Desain UI/UX: Prinsip & Praktik',
                'slug' => 'dasar-dasar-desain-ui-ux',
                'product_category_id' => $designCategory->id,
                'instructor' => 'Alex Rodriguez',
                'price' => 749000,
                'original_price' => 1249000,
                'image' => 'https://images.unsplash.com/photo-1559028006-44a26f024d6d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'rating' => 4.8,
                'students' => 2150,
                'duration' => '32 hours',
                'level' => 'Pemula hingga Menengah',
                'description' => 'Kuasai prinsip-prinsip desain antarmuka pengguna dan pengalaman pengguna. Kursus ini mengajarkan Anda cara membuat desain yang intuitif, menarik, dan berpusat pada pengguna untuk aplikasi web dan mobile.',
                'features' => [
                    "32 jam konten video berkualitas tinggi",
                    "60+ latihan desain dengan feedback",
                    "6 proyek portofolio untuk ditampilkan ke employer",
                    "Sertifikat penyelesaian yang diakui industri",
                    "Akses seumur hidup ke semua materi dan pembaruan",
                    "Akses alat desain (Figma, Adobe XD)",
                    "Komunitas Discord untuk feedback dan kolaborasi",
                    "Template desain yang dapat diunduh"
                ],
                'curriculum' => [
                    "Introduction to UI/UX Design",
                    "Design Thinking Process",
                    "User Research & Personas",
                    "Information Architecture & Wireframing",
                    "Visual Design Principles: Color, Typography, Layout",
                    "Prototyping: Low-Fidelity to High-Fidelity",
                    "Usability Testing & Iteration",
                    "Design Systems & Component Libraries"
                ],
                'requirements' => [
                    "Tidak ada pengalaman desain sebelumnya diperlukan",
                    "Komputer dengan spesifikasi minimal (4GB RAM)",
                    "Akses ke Figma (versi gratis tersedia)",
                    "Kreativitas dan perhatian pada detail"
                ],
                'what_you_will_build' => [
                    "Aplikasi Mobile Banking Wireframe",
                    "Website E-commerce User Flow",
                    "Dashboard Analytics High-Fidelity Prototype",
                    "Aplikasi Fitness Mobile Design System",
                    "Website Travel Booking Complete UI Design"
                ],
                'is_active' => true,
            ],
            [
                'title' => 'Pengembangan Aplikasi Mobile dengan Flutter: Dari Nol Hingga Expert',
                'slug' => 'pengembangan-aplikasi-mobile-dengan-flutter',
                'product_category_id' => $mobileDevCategory->id,
                'instructor' => 'James Wilson',
                'price' => 849000,
                'original_price' => 1399000,
                'image' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'rating' => 4.6,
                'students' => 1680,
                'duration' => '38 hours',
                'level' => 'Menengah',
                'description' => 'Bangun aplikasi mobile yang indah untuk iOS dan Android menggunakan Flutter dan Dart. Kursus ini mengajarkan Anda cara membuat aplikasi mobile performa tinggi dengan UI yang menarik untuk kedua platform menggunakan satu codebase.',
                'features' => [
                    "38 jam konten video berkualitas tinggi",
                    "70+ latihan coding dengan solusi",
                    "8 aplikasi mobile lengkap untuk portofolio",
                    "Sertifikat penyelesaian yang diakui industri",
                    "Akses seumur hidup ke semua materi dan pembaruan",
                    "Kode sumber lengkap untuk semua proyek",
                    "Komunitas Discord untuk bantuan 24/7",
                    "Template aplikasi yang dapat diunduh"
                ],
                'curriculum' => [
                    "Dart Programming Fundamentals",
                    "Flutter Widgets & UI Components",
                    "State Management: Provider, BLoC, Riverpod",
                    "Navigation & Routing",
                    "Networking & API Integration",
                    "Local Data Persistence (SQLite, Hive)",
                    "Push Notifications & Firebase Integration",
                    "App Deployment: Google Play Store & Apple App Store"
                ],
                'requirements' => [
                    "Pemahaman dasar pemrograman OOP",
                    "Familiaritas dengan konsep dasar mobile apps",
                    "Komputer dengan spesifikasi minimal (8GB RAM)",
                    "Android Studio atau VS Code dengan Flutter SDK"
                ],
                'what_you_will_build' => [
                    "Aplikasi Weather dengan API Integration",
                    "Aplikasi Todo List dengan Local Storage",
                    "Aplikasi E-commerce dengan State Management",
                    "Aplikasi Social Media dengan Firebase",
                    "Aplikasi Music Streaming dengan Offline Support"
                ],
                'is_active' => true,
            ],
            [
                'title' => 'Dasar-dasar Keamanan Siber: Pertahanan & Serangan',
                'slug' => 'dasar-dasar-keamanan-siber',
                'product_category_id' => $securityCategory->id,
                'instructor' => 'Robert Chang',
                'price' => 899000,
                'original_price' => 1499000,
                'image' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80',
                'rating' => 4.9,
                'students' => 1230,
                'duration' => '40 hours',
                'level' => 'Menengah',
                'description' => 'Pelajari dasar-dasar keamanan siber, peretasan etis, dan keamanan jaringan. Kursus ini memberikan pemahaman mendalam tentang ancaman keamanan siber dan cara melindungi sistem dari serangan.',
                'features' => [
                    "40 jam konten video berkualitas tinggi",
                    "90+ latihan praktis di lingkungan virtual",
                    "10 proyek keamanan dunia nyata",
                    "Sertifikat penyelesaian yang diakui industri",
                    "Akses seumur hidup ke semua materi dan pembaruan",
                    "Akses lab virtual untuk praktik hands-on",
                    "Tools keamanan yang dapat diunduh",
                    "Komunitas Discord untuk diskusi keamanan"
                ],
                'curriculum' => [
                    "Introduction to Cybersecurity",
                    "Network Security Fundamentals",
                    "Cryptography & Encryption",
                    "Ethical Hacking Methodologies",
                    "Web Application Security (OWASP Top 10)",
                    "System Security & Hardening",
                    "Incident Response & Forensics",
                    "Compliance & Legal Frameworks"
                ],
                'requirements' => [
                    "Pemahaman dasar jaringan komputer",
                    "Familiaritas dengan sistem operasi (Windows/Linux)",
                    "Komputer dengan spesifikasi minimal (8GB RAM)",
                    "Akses internet untuk lab virtual"
                ],
                'what_you_will_build' => [
                    "Network Security Monitoring System",
                    "Vulnerability Assessment Scanner",
                    "Secure Web Application",
                    "Incident Response Plan",
                    "Security Policy Framework"
                ],
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
