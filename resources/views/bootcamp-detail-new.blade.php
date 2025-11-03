@php
    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for bootcamp page
    $translations = include lang_path("{$locale}/bootcamp-new.php");
    $detail = $translations['detail'];
    $bootcamp_details = $translations['bootcamp_details'];
    $training_modules = $translations['training_modules'];
    $what_youll_get = $translations['what_youll_get'];

    // Get bootcamps from language file
    $bootcamps = $translations['bootcamps'];
    $bootcamp = null;

    // Extract the bootcamp ID from the current URL
    $currentPath = request()->path();
    $pathParts = explode('/', $currentPath);
    $bootcampId = end($pathParts); // Get the last part of the URL

    // Find the bootcamp by ID
    foreach($bootcamps as $b) {
        if($b['id'] == intval($bootcampId)) {
            $bootcamp = $b;
            break;
        }
    }

    // Get related bootcamps (same category, excluding current bootcamp)
    $relatedBootcamps = [];
    if($bootcamp) {
        $relatedBootcamps = array_filter($bootcamps, function($b) use ($bootcamp) {
            return $b['category'] === $bootcamp['category'] && $b['id'] != $bootcamp['id'];
        });
        $relatedBootcamps = array_slice($relatedBootcamps, 0, 2);
    }
@endphp

@if(!$bootcamp)
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $detail['not_found'] }}</h1>
            <p class="text-gray-600 mb-8">{{ $detail['not_exist'] }}</p>
            <a href="/{{ $locale }}/bootcamp" class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300">
                {{ $detail['browse_all'] }}
            </a>
        </div>
    </div>
@else
    @include('components.header', ['title' => $bootcamp['title']])

    <!-- Bootcamp Hero Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Bootcamp Image -->
                <div class="lg:w-2/5">
                    <img src="{{ $bootcamp['image'] }}" alt="{{ $bootcamp['title'] }}" class="w-full rounded-lg shadow-lg">
                    <div class="mt-6 bg-gray-100 rounded-lg p-6">
                        <h3 class="font-semibold text-lg mb-4">{{ $detail['key_information'] }}</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-clock text-secondary mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">{{ $bootcamp_details['duration'] }}</p>
                                    <p class="font-medium">{{ $bootcamp['duration'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-signal text-secondary mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">{{ $bootcamp_details['level'] }}</p>
                                    <p class="font-medium">{{ $bootcamp['level'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-secondary mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">{{ $bootcamp_details['start_date'] }}</p>
                                    <p class="font-medium">{{ $bootcamp['start_date'] }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock text-secondary mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">{{ $bootcamp_details['schedule'] }}</p>
                                    <p class="font-medium">{{ $bootcamp['schedule'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bootcamp Details -->
                <div class="lg:w-3/5">
                    <div class="mb-2">
                        <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $bootcamp['category'] }}</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $bootcamp['title'] }}</h1>

                    <div class="flex items-center mb-6">
                        <div class="flex items-center mr-6">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < floor($bootcamp['rating']))
                                    <i class="fas fa-star text-yellow-400"></i>
                                @else
                                    <i class="far fa-star text-yellow-400"></i>
                                @endif
                            @endfor
                            <span class="ml-2 font-medium">{{ $bootcamp['rating'] }}</span>
                            <span class="ml-1 text-gray-500">({{ $bootcamp['students'] }} {{ $bootcamp_details['students'] }})</span>
                        </div>
                    </div>

                    <p class="text-lg text-gray-600 mb-8">{{ $bootcamp['description'] }}</p>

                    <div class="bg-gray-100 rounded-lg p-6 mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-3xl font-bold text-secondary">Rp {{ number_format($bootcamp['price'], 0, ',', '.') }}</span>
                                @if($bootcamp['price'] < $bootcamp['original_price'])
                                    <span class="text-lg text-gray-500 line-through ml-2">Rp {{ number_format($bootcamp['original_price'], 0, ',', '.') }}</span>
                                    <span class="ml-2 text-red-500 font-semibold">{{ $detail['save'] }} {{ round((1 - $bootcamp['price'] / $bootcamp['original_price']) * 100) }}%</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105 flex-1">
                                <i class="fas fa-shopping-cart mr-2"></i> {{ $detail['enroll_now'] }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Training Modules Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $training_modules['title'] }}</h2>
                <p class="text-lg text-gray-600 max-w-4xl mx-auto">{{ $training_modules['subtitle'] }}</p>
            </div>

            <!-- Weeks Training Modules -->
            <div class="mb-16">
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-2xl p-8 shadow-lg">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[600px]">
                            <thead>
                                <tr class="border-b-2 border-indigo-200">
                                    <th class="text-left py-4 px-4 font-semibold text-indigo-700">{{ $training_modules['week'] }}</th>
                                    <th class="text-left py-4 px-4 font-semibold text-indigo-700">{{ $training_modules['module'] }}</th>
                                    <th class="text-left py-4 px-4 font-semibold text-indigo-700">{{ $training_modules['objective'] }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($training_modules['weeks'] as $week)
                                    @if(isset($week['module']))
                                        <tr class="border-b border-gray-200 hover:bg-indigo-50 transition-colors">
                                            <td class="py-4 px-4">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                                        {{ $week['week_number'] }}
                                                    </div>
                                                    <span class="font-medium text-gray-700">{{ $training_modules['week'] }} {{ $week['week_number'] }}</span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="font-medium text-gray-800">{{ $week['module'] }}</div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="text-gray-600">{{ $week['objective'] }}</div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What You'll Get After Completing Bootcamp Section -->
    <section class="py-16 bg-light">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $what_youll_get['title'] }}</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Certificates -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="text-center mb-6">
                        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white mx-auto mb-4">
                            <i class="fa-solid fa-certificate text-secondary text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">{{ $what_youll_get['certificates']['title'] }}</h3>
                    </div>
                    <ul class="space-y-4">
                        @foreach($what_youll_get['certificates']['items'] as $key => $item)
                            <li class="flex items-start">
                                <i class="fas fa-award text-blue-500 mt-1 mr-3"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Career Support -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="text-center mb-6">
                        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white mx-auto mb-4">
                            <i class="text-secondary fas fa-users text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">{{ $what_youll_get['career_support']['title'] }}</h3>
                    </div>
                    <ul class="space-y-4">
                        @foreach($what_youll_get['career_support']['items'] as $key => $item)
                            <li class="flex items-start">
                                <i class="fas fa-network-wired text-green-500 mt-1 mr-3"></i>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Unlimited Mentoring -->
                <div class="bg-white rounded-2xl p-8 shadow-lg">
                    <div class="text-center mb-6">
                        <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white mx-auto mb-4">
                            <i class="text-secondary fas fa-comments text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">{{ $what_youll_get['unlimited_mentoring']['title'] }}</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">{{ $what_youll_get['unlimited_mentoring']['description'] }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Instructor Section -->
    <section class="py-16 bg-light">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ count($bootcamp['instructors']) > 1 ? ($locale === 'id' ? 'Tim Instruktur' : 'Meet Our Instructors') : $detail['meet_instructor'] }}</h2>

            @foreach($bootcamp['instructors'] as $index => $instructor)
                <div class="bg-white rounded-lg p-8 mb-8 {{ $index > 0 ? 'border-t-4 border-secondary' : '' }}">
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <img src="{{ $instructor['image'] }}" alt="{{ $instructor['name'] }}" class="w-32 h-32 rounded-full object-cover">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <h3 class="text-2xl font-semibold mr-3">{{ $instructor['name'] }}</h3>
                                <span class="bg-secondary/10 text-secondary px-3 py-1 rounded-full text-sm font-medium">{{ $instructor['specialization'] }}</span>
                            </div>
                            <p class="text-gray-600 mb-4">{{ $instructor['bio'] }}</p>
                            <div class="flex items-center gap-6 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <i class="fas fa-briefcase text-secondary mr-2"></i>
                                    <span>{{ $instructor['experience'] }} {{ $detail['experience'] }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span>{{ $instructor['rating'] }} {{ $detail['rating'] }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-users mr-2"></i>
                                    <span>{{ $instructor['students_taught'] }} {{ $locale === 'id' ? 'siswa' : 'students' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </section>

    <!-- HRC Mentor Team Section -->
    <section class="py-16 bg-light relative overflow-hidden">
        <!-- Premium Background Pattern -->
        {{-- <div class="absolute inset-0 z-0">
            <div class="absolute top-0 left-0 w-full h-full opacity-5">
                <div class="absolute top-0 left-0 w-64 h-64 bg-gradient-to-br from-indigo-200 to-purple-200 rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute top-20 right-0 w-48 h-48 bg-gradient-to-br from-purple-200 to-pink-200 rounded-full blur-2xl transform translate-x-1/4"></div>
                <div class="absolute bottom-20 left-1/4 w-56 h-56 bg-gradient-to-br from-pink-200 to-indigo-200 rounded-full blur-2xl transform -translate-x-1/3"></div>
            </div>
        </div> --}}

        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-12">
                <div class="inline-flex items-center mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-secondary mr-4 shadow-lg">
                        <i class="fas fa-graduation-cap text-3xl "></i>
                    </div>
                    <div class="text-left">
                        <h2 class="text-4xl font-bold text-gray-800 mb-2">{{ $locale === 'id' ? 'Tim Mentor HRC' : 'HRC Mentor Team' }}</h2>
                        <div class="h-1 w-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full"></div>
                    </div>
                </div>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto">{{ $locale === 'id' ? 'Bergabunglah dengan tim mentor berpengalaman kami yang berkomitmen untuk kesuksesan Anda' : 'Join our experienced mentor team committed to your success' }}</p>
            </div>

            <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 relative overflow-hidden">
                <!-- Premium Card Header -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full opacity-10 transform translate-x-1/2 -translate-y-1/2"></div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Left Column - Text Content -->
                    <div>
                        <p class="text-gray-700 leading-relaxed text-lg mb-6">{{ $training_modules['hrc_mentors'] }}</p>

                        <!-- Premium Features -->
                        <div class="space-y-4">
                            <div class="flex items-start bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg p-4 border-l-4 border-indigo-500">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-secondary">
                                        <i class="fas fa-users text-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-indigo-800 mb-1">{{ $locale === 'id' ? '500+ Mentor Berpengalaman' : '500+ Expert Mentors' }}</h4>
                                    <p class="text-sm text-gray-600">{{ $locale === 'id' ? 'Tim mentor profesional dengan pengalaman industri lebih dari 10 tahun' : 'Professional mentor team with over 10 years of industry experience' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-4 border-l-4 border-purple-500">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-secondary">
                                        <i class="fas fa-globe text-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-purple-800 mb-1">{{ $locale === 'id' ? 'Jaringan Global' : 'Global Network' }}</h4>
                                    <p class="text-sm text-gray-600">{{ $locale === 'id' ? 'Koneksi dengan mentor dan alumni di seluruh dunia' : 'Connections with mentors and alumni worldwide' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start bg-gradient-to-r from-pink-50 to-indigo-50 rounded-lg p-4 border-l-4 border-pink-500">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-indigo-600 rounded-full flex items-center justify-center text-secondary">
                                        <i class="fas fa-certificate text-lg"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-pink-800 mb-1">{{ $locale === 'id' ? 'Sertifikasi Industri' : 'Industry Certification' }}</h4>
                                    <p class="text-sm text-gray-600">{{ $locale === 'id' ? 'Sertifikat yang diakui industri dan dapat meningkatkan karir Anda' : 'Industry-recognized certificates that can boost your career' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Visual Elements -->
                    <div class="flex flex-col items-center justify-center">
                        <!-- Premium Badge -->
                        <div class="bg-gradient-to-br from-yellow-400 to-orange-500 text-white rounded-full p-6 shadow-xl mb-6 transform hover:scale-105 transition-all duration-300">
                            <div class="text-center text-secondary">
                                <i class="fas fa-award text-4xl mb-2"></i>
                                <h3 class="text-2xl font-bold">{{ $locale === 'id' ? 'Mentor Terbaik' : 'Top Mentors' }}</h3>
                                {{-- <p class="text-sm">{{ $locale === 'id' ? 'Dipilih dengan ketat' : 'Handpicked with care' }}</p> --}}
                            </div>
                        </div>

                        <!-- Premium Stats -->
                        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
                            <h4 class="text-lg font-bold text-gray-800 mb-4 text-center">{{ $locale === 'id' ? 'Statistik Mentor Kami' : 'Our Mentor Statistics' }}</h4>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <span class="text-gray-600">{{ $locale === 'id' ? 'Rata-rata Pengalaman' : 'Average Experience' }}</span>
                                    <span class="text-2xl font-bold text-indigo-600">12+ {{ $locale === 'id' ? 'Tahun' : 'Years' }}</span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <span class="text-gray-600">{{ $locale === 'id' ? 'Tingkat Kepuasan' : 'Success Rate' }}</span>
                                    <span class="text-2xl font-bold text-green-600">98%</span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <span class="text-gray-600">{{ $locale === 'id' ? 'Jumlah Siswa' : 'Students Taught' }}</span>
                                    <span class="text-2xl font-bold text-purple-600">10,000+</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootcamp Highlights Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $locale === 'id' ? 'Keunggulan Bootcamp' : 'Bootcamp Highlights' }}</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $locale === 'id' ? 'Temukan apa yang membuat bootcamp kami istimewa dan mengapa peserta memilih kami' : 'Discover what makes our bootcamp exceptional and why participants choose us' }}</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 shadow-lg">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-secondary mx-auto mb-4">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $locale === 'id' ? 'Program Intensif' : 'Intensive Program' }}</h3>
                    </div>
                    <p class="text-gray-600">{{ $locale === 'id' ? 'Pelatihan tatap muka dengan proyek dunia nyata dan bimbingan personal' : 'Face-to-face training with real-world projects and personal mentoring' }}</p>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-6 shadow-lg">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-secondary mx-auto mb-4">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $locale === 'id' ? 'Kelas Kecil' : 'Small Classes' }}</h3>
                    </div>
                    <p class="text-gray-600">{{ $locale === 'id' ? 'Rasio instruktur-siswa maksimal 1:10 untuk pembelajaran yang efektif' : 'Maximum 1:10 instructor-student ratio for effective learning' }}</p>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 shadow-lg">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-secondary mx-auto mb-4">
                            <i class="fas fa-certificate text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $locale === 'id' ? 'Sertifikasi Industri' : 'Industry Certification' }}</h3>
                    </div>
                    <p class="text-gray-600">{{ $locale === 'id' ? 'Sertifikat yang diakui industri dan dapat meningkatkan karir Anda' : 'Industry-recognized certificates that can boost your career' }}</p>
                </div>

                <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-xl p-6 shadow-lg">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center text-secondary mx-auto mb-4">
                            <i class="fas fa-briefcase text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $locale === 'id' ? 'Jaminan Karir' : 'Career Guarantee' }}</h3>
                    </div>
                    <p class="text-gray-600">{{ $locale === 'id' ? 'Dukungan karir pasca-lulus dan jaminan penempatan kerja' : 'Post-graduation career support and job placement guarantee' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Career Support Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ $detail['career_support'] }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">{{ $detail['whats_included'] }}</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>{{ $detail['resume_review'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>{{ $detail['mock_interviews'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>{{ $detail['networking_events'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>{{ $detail['job_placement'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                            <span>{{ $detail['alumni_network'] }}</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">{{ $detail['career_outcomes'] }}</h3>
                    <div class="bg-gray-100 rounded-lg p-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-secondary mb-2">85%</div>
                                <div class="text-sm text-gray-600">{{ $detail['job_placement_rate'] }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-secondary mb-2">3 months</div>
                                <div class="text-sm text-gray-600">{{ $detail['avg_search_time'] }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-secondary mb-2">40%</div>
                                <div class="text-sm text-gray-600">{{ $detail['salary_increase'] }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-secondary mb-2">500+</div>
                                <div class="text-sm text-gray-600">{{ $detail['hiring_partners'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Bootcamps Section -->
    @if(count($relatedBootcamps) > 0)
    <section class="py-16 bg-light">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ $detail['related_bootcamps'] }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($relatedBootcamps as $relatedBootcamp)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                        <div class="md:flex">
                            <div class="md:w-2/5">
                                <img src="{{ $relatedBootcamp['image'] }}" alt="{{ $relatedBootcamp['title'] }}" class="w-full h-48 md:h-full object-cover">
                            </div>
                            <div class="md:w-3/5 p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $relatedBootcamp['category'] }}</span>
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <span class="ml-1 text-sm font-medium">{{ $relatedBootcamp['rating'] }}</span>
                                    </div>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">{{ $relatedBootcamp['title'] }}</h3>
                                <p class="text-gray-600 mb-4">{{ $relatedBootcamp['description'] }}</p>
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span class="mr-4">{{ $relatedBootcamp['duration'] }}</span>
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>{{ $relatedBootcamp['start_date'] }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-xl font-bold text-secondary">Rp {{ number_format($relatedBootcamp['price'], 0, ',', '.') }}</span>
                                        @if($relatedBootcamp['price'] < $relatedBootcamp['original_price'])
                                            <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($relatedBootcamp['original_price'], 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <a href="/{{ $locale }}/bootcamp/{{ $relatedBootcamp['id'] }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                        {{ $detail['learn_more'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Other Bootcamps Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">{{ $detail['other_bootcamps'] }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php
                // Get other bootcamps (excluding current bootcamp and related bootcamps)
                $otherBootcamps = [];
                $excludedIds = [$bootcamp['id']];
                foreach($relatedBootcamps as $relatedBootcamp) {
                    $excludedIds[] = $relatedBootcamp['id'];
                }

                foreach($bootcamps as $b) {
                    if(!in_array($b['id'], $excludedIds)) {
                        $otherBootcamps[] = $b;
                    }
                }

                // Randomly select 2 bootcamps or take first 2 if less than 2
                if(count($otherBootcamps) > 2) {
                    shuffle($otherBootcamps);
                    $otherBootcamps = array_slice($otherBootcamps, 0, 2);
                }
                ?>
                @foreach($otherBootcamps as $otherBootcamp)
                    <div class="bg-gray-50 rounded-xl shadow-md overflow-hidden card-hover">
                        <div class="md:flex">
                            <div class="md:w-2/5">
                                <img src="{{ $otherBootcamp['image'] }}" alt="{{ $otherBootcamp['title'] }}" class="w-full h-48 md:h-full object-cover">
                            </div>
                            <div class="md:w-3/5 p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $otherBootcamp['category'] }}</span>
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <span class="ml-1 text-sm font-medium">{{ $otherBootcamp['rating'] }}</span>
                                    </div>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">{{ $otherBootcamp['title'] }}</h3>
                                <p class="text-gray-600 mb-4">{{ $otherBootcamp['description'] }}</p>
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span class="mr-4">{{ $otherBootcamp['duration'] }}</span>
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>{{ $otherBootcamp['start_date'] }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-xl font-bold text-secondary">Rp {{ number_format($otherBootcamp['price'], 0, ',', '.') }}</span>
                                        @if($otherBootcamp['price'] < $otherBootcamp['original_price'])
                                            <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($otherBootcamp['original_price'], 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <a href="/{{ $locale }}/bootcamp/{{ $otherBootcamp['id'] }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                        {{ $detail['learn_more'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="/{{ $locale }}/bootcamp" class="bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full transition duration-300">
                    {{ $detail['view_all_bootcamps'] }} <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary text-white relative overflow-hidden">
        <!-- Animated Background with Secondary-Dark Hexagon Ribbon Pattern -->
        <div class="absolute inset-0 z-10">
            <!-- Hexagon Ribbon 1 - Top Left -->
            <svg class="absolute top-0 left-0 w-80 h-80" viewBox="0 0 300 300">
                <path d="M150,50 L200,87.5 L200,162.5 L150,200 L100,162.5 L100,87.5 Z"
                      fill="currentColor"
                      class="text-secondary-dark"/>
                <path d="M50,100 L100,137.5 L100,202.5 L50,240 L0,202.5 L0,137.5 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
                <path d="M250,100 L300,137.5 L300,202.5 L250,240 L200,202.5 L200,137.5 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
            </svg>

            <!-- Hexagon Ribbon 2 - Top Right -->
            <svg class="absolute top-0 right-0 w-80 h-80" viewBox="0 0 300 300">
                <path d="M150,50 L100,87.5 L100,162.5 L150,200 L200,162.5 L200,87.5 Z"
                      fill="currentColor"
                      class="text-secondary-dark"/>
                <path d="M250,100 L200,137.5 L200,202.5 L250,240 L300,202.5 L300,137.5 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
                <path d="M50,100 L100,137.5 L100,202.5 L50,240 L0,202.5 L0,137.5 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
            </svg>

            <!-- Hexagon Ribbon 3 - Bottom Left -->
            <svg class="absolute bottom-0 left-0 w-80 h-80" viewBox="0 0 300 300">
                <path d="M150,250 L100,212.5 L100,147.5 L150,100 L200,147.5 L200,212.5 Z"
                      fill="currentColor"
                      class="text-secondary-dark"/>
                <path d="M50,200 L100,162.5 L100,97.5 L50,60 L0,97.5 L0,162.5 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
                <path d="M250,200 L200,162.5 L200,97.5 L250,60 L300,97.5 L300,162.5 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
            </svg>

            <!-- Hexagon Ribbon 4 - Bottom Right -->
            <svg class="absolute bottom-0 right-0 w-80 h-80" viewBox="0 0 300 300">
                <path d="M150,250 L200,212.5 L200,147.5 L150,100 L100,147.5 L100,212.5 Z"
                      fill="currentColor"
                      class="text-secondary-dark"/>
                <path d="M250,200 L200,162.5 L200,97.5 L250,60 L300,97.5 L300,162.5 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
                <path d="M50,200 L100,162.5 L100,97.5 L50,60 L0,97.5 L0,162.5 Z"
                      fill="currentColor"
                      class="text-secondary-dark opacity-80"/>
            </svg>
        </div>

        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $detail['ready_transform'] }}</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">{{ str_replace('{category}', $bootcamp['category'], $detail['transform_subtitle']) }}</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-shopping-cart mr-2"></i> {{ $detail['enroll_bootcamp'] }}
                </button>
            </div>
        </div>
    </section>

    @include('components.footer')
@endif
