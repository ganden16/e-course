@php
    use Illuminate\Support\Facades\Storage;

    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for bootcamp page (only for translations, not data)
    $translations = include lang_path("{$locale}/bootcamp-new.php");
    $detail = $translations['detail'];
    $bootcamp_details = $translations['bootcamp_details'];
    $training_modules = $translations['training_modules'];
    $what_youll_get = $translations['what_youll_get'];
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
    @include('components.header', ['title' => $bootcamp->title])

    <!-- Bootcamp Hero Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Bootcamp Image -->
                <div class="lg:w-2/5">
                    <img src="{{ $bootcamp->image }}" alt="{{ $bootcamp->title }}" class="w-full rounded-lg shadow-lg">
                    <div class="mt-6 bg-gray-100 rounded-lg p-6">
                        <h3 class="font-semibold text-lg mb-4">{{ $detail['key_information'] }}</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-clock text-secondary mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">{{ $bootcamp_details['duration'] }}</p>
                                    <p class="font-medium">{{ $bootcamp->duration }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-signal text-secondary mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">{{ $bootcamp_details['level'] }}</p>
                                    <p class="font-medium">{{ $bootcamp->level }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-secondary mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">{{ $bootcamp_details['start_date'] }}</p>
                                    <p class="font-medium">{{ $bootcamp->start_date->format('Y-m-d') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock text-secondary mr-3"></i>
                                <div>
                                    <p class="text-sm text-gray-500">{{ $bootcamp_details['schedule'] }}</p>
                                    <p class="font-medium">{{ $bootcamp->schedule }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bootcamp Details -->
                <div class="lg:w-3/5">
                    <div class="mb-2">
                        <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $bootcamp->category?->name }}</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $bootcamp->title }}</h1>

                    <div class="flex items-center mb-6">
                        <div class="flex items-center mr-6">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < floor($bootcamp->rating))
                                    <i class="fas fa-star text-green-600"></i>
                                @else
                                    <i class="far fa-star text-green-600"></i>
                                @endif
                            @endfor
                            <span class="ml-2 font-medium">{{ $bootcamp->rating }}</span>
                            <span class="ml-1 text-gray-500">({{ $bootcamp->students }} {{ $bootcamp_details['students'] }})</span>
                        </div>
                    </div>

                    <p class="text-lg text-gray-600 mb-8">{{ $bootcamp->description }}</p>

                    <div class="bg-gray-100 rounded-lg p-6 mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-3xl font-bold text-secondary">Rp {{ number_format($bootcamp->price, 0, ',', '.') }}</span>
                                @if($bootcamp->price < $bootcamp->original_price)
                                    <span class="text-lg text-gray-500 line-through ml-2">Rp {{ number_format($bootcamp->original_price, 0, ',', '.') }}</span>
                                    <span class="ml-2 text-red-500 font-semibold">{{ $detail['save'] }} {{ $bootcamp->discount_percentage }}%</span>
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

    <!-- Training Modules Section (Redesigned with Elegant Timeline Cards) -->
        <section class="py-20 bg-gradient-to-b from-white to-gray-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-secondary rounded-full mb-6 shadow-lg">
                        <i class="fas fa-layer-group text-white text-2xl"></i>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">{{ $training_modules['title'] }}</h2>
                    <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">{{ $training_modules['subtitle'] }}</p>
                </div>

                <div class="relative max-w-6xl mx-auto">
                    <!-- Vertical Timeline Line -->
                    <div class="absolute left-8 md:left-1/2 transform md:-translate-x-1/2 top-0 bottom-0 w-1 bg-secondary rounded-full to-transparent hidden md:block"></div>

                    <div class="md:flex md:flex-col md:gap-4">
                        @foreach($bootcamp->modules as $index => $week)
                            @if(isset($week->module))
                            <div class="relative mb-8 md:mb-4 {{ $index % 2 == 0 ? 'md:pr-1/2 md:pl-4' : 'md:pl-1/2 md:pr-4' }}">
                                <!-- Week Indicator -->
                                <div class="absolute left-6 md:left-1/2 md:-translate-x-1/2 top-6 z-20">
                                    <div class="w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center font-bold text-lg md:text-xl shadow-lg transform hover:scale-110 transition-transform duration-300">
                                        <span class="text-green-700">{{ $week->week_number }}</span>
                                    </div>
                                </div>

                                <!-- Card Content -->
                                <div class="ml-16 md:ml-0 {{ $index % 2 == 0 ? 'md:pr-8' : 'md:pl-8' }}">
                                    <div class="bg-white rounded-2xl p-6 md:p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                                        <div class="flex items-center mb-4">
                                            <span class="inline-flex items-center px-4 py-2 text-secondary font-semibold rounded-full text-sm">
                                                <i class="fas fa-calendar-week mr-2 text-green-700"></i>
                                                {{ $training_modules['week'] }} {{ $week->week_number }}
                                            </span>
                                        </div>
                                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 flex items-center">
                                            <i class="fas fa-book-open  mr-3"></i>
                                            {{ $week->module }}
                                        </h3>
                                        <p class="text-gray-600 leading-relaxed text-base md:text-lg">
                                            <i class="fas fa-bullseye text-secondary mr-2"></i>
                                            {{ $week->objective }}
                                        </p>

                                        <!-- Progress Indicator -->
                                        <div class="mt-6 pt-6 border-t border-gray-100">
                                            <div class="flex items-center text-sm text-gray-500">
                                                <i class="fas fa-clock text-secondary mr-2"></i>
                                                <span>{{ $training_modules['duration'] ?? '4-6 hours/week' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Learning Outcomes Section (Elegant Icon Grid) -->
        <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-secondary rounded-full mb-6 shadow-lg">
                        <i class="fas fa-star text-white text-2xl"></i>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        {{ $locale === 'id' ? 'Hasil Pembelajaran' : 'Learning Outcomes' }}
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        {{ $locale === 'id' ? 'Keterampilan yang akan Anda kuasai setelah menyelesaikan bootcamp' : 'Skills you will master after completing the bootcamp' }}
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                    @if($bootcamp->learning_outcomes)
                        @foreach($bootcamp->learning_outcomes as $index => $outcome)
                        <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                            <div class="flex flex-col items-center text-center">
                                <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center text-secondary mb-6 shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-check-circle text-2xl"></i>
                                </div>
                                <h4 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-emerald-600 transition-colors duration-300">{{ $outcome }}</h4>
                                <p class="text-gray-600">
                                    {{ $locale === 'id' ? 'Skill yang sangat dicari di industri' : 'Highly sought-after industry skill' }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>

        <!-- Career Support Details Section (Refined Two-Column) -->
        <section class="py-20 bg-gradient-to-b from-white to-purple-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full mb-6 shadow-lg">
                        <i class="fas fa-hands-helping text-secondary text-2xl"></i>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        {{ $locale === 'id' ? 'Detail Dukungan Karir' : 'Career Support Details' }}
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        {{ $locale === 'id' ? 'Layanan lengkap untuk mendukung kesuksesan karir Anda' : 'Comprehensive services to support your career success' }}
                    </p>
                </div>

                <div class="max-w-6xl mx-auto">
                    <div class="bg-gradient-to-br from-white to-purple-50 rounded-3xl shadow-2xl border border-purple-100 overflow-hidden">
                        <div class="grid md:grid-cols-2 gap-8 p-10">
                            @if($bootcamp->career_support)
                                @foreach($bootcamp->career_support as $support)
                                <div class="flex items-start p-6 rounded-2xl bg-white hover:bg-gradient-to-r hover:from-purple-50 hover:to-white transition-all duration-300 group">
                                    <div class="flex-shrink-0 mr-5">
                                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white shadow-lg transform group-hover:rotate-12 transition-transform duration-300">
                                            <i class="fas fa-briefcase text-lg text-secondary"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-secondary transition-colors duration-300">{{ $support }}</h4>
                                        {{-- <p class="text-gray-600 text-sm">
                                            {{ $locale === 'id' ? 'Dukungan profesional untuk karir Anda' : 'Professional support for your career' }}
                                        </p> --}}
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Requirements Section (Clean & Modern) -->
        <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-secondary rounded-full mb-6 shadow-lg">
                        <i class="fas fa-clipboard-check text-white text-2xl"></i>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        {{ $locale === 'id' ? 'Persyaratan' : 'Requirements' }}
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        {{ $locale === 'id' ? 'Apa yang Anda butuhkan untuk bergabung dengan bootcamp ini' : 'What you need to join this bootcamp' }}
                    </p>
                </div>

                <div class="max-w-6xl mx-auto">
                    <div class="bg-gradient-to-br from-white to-orange-50 rounded-3xl shadow-2xl border border-orange-100 p-10">
                        @if($bootcamp->requirements)
                            <div class="grid md:grid-cols-2 gap-8">
                                @foreach($bootcamp->requirements as $requirement)
                                <div class="flex items-start p-6 rounded-2xl bg-white hover:bg-gradient-to-r hover:from-orange-50 hover:to-white transition-all duration-300 group">
                                    <div class="flex-shrink-0 mr-5">
                                        <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center text-white shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas fa-check-circle text-lg text-secondary"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors duration-300">{{ $requirement }}</h4>
                                        {{-- <p class="text-gray-600 text-sm">
                                            {{ $locale === 'id' ? 'Persyaratan penting untuk keberhasilan' : 'Essential requirement for success' }}
                                        </p> --}}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- What You'll Get After Completing Bootcamp Section -->
        <section class="py-20 bg-gradient-to-b from-white to-blue-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-secondary rounded-full mb-6 shadow-lg">
                        <i class="fas fa-gift text-white text-2xl"></i>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">{{ $what_youll_get['title'] }}</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        {{ $locale === 'id' ? 'Manfaat eksklusif yang akan Anda dapatkan' : 'Exclusive benefits you will receive' }}
                    </p>
                </div>

                <div class="grid lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                    <!-- Certificates -->
                    <div class="bg-white rounded-3xl p-10 shadow-2xl border border-blue-100 transform hover:-translate-y-2 transition-all duration-300 group">
                        <div class="text-center mb-8">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white mx-auto mb-6 shadow-xl transform group-hover:rotate-12 transition-transform duration-300">
                                <i class="fas fa-certificate text-3xl text-secondary"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-secondary transition-colors duration-300">{{ $what_youll_get['certificates']['title'] }}</h3>
                        </div>
                        <ul class="space-y-5">
                            @foreach($what_youll_get['certificates']['items'] as $item)
                                <li class="flex items-start p-3 rounded-xl hover:bg-green-50 transition-colors duration-200">
                                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-award text-secondary"></i>
                                    </div>
                                    <span class="font-medium">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Career Support -->
                    <div class="bg-white rounded-3xl p-10 shadow-2xl border border-green-100 transform hover:-translate-y-2 transition-all duration-300 group">
                        <div class="text-center mb-8">
                            <div class="w-24 h-24 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white mx-auto mb-6 shadow-xl transform group-hover:rotate-12 transition-transform duration-300">
                                <i class="fas fa-users text-3xl text-secondary"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-secondary transition-colors duration-300">{{ $what_youll_get['career_support']['title'] }}</h3>
                        </div>
                        <ul class="space-y-5">
                            @foreach($what_youll_get['career_support']['items'] as $item)
                                <li class="flex items-start p-3 rounded-xl hover:bg-green-50 transition-colors duration-200">
                                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-network-wired text-secondary"></i>
                                    </div>
                                    <span class="text-gray-700 font-medium">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Unlimited Mentoring -->
                    <div class="bg-white rounded-3xl p-10 shadow-2xl border border-purple-100 transform hover:-translate-y-2 transition-all duration-300 group">
                        <div class="text-center mb-8">
                            <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white mx-auto mb-6 shadow-xl transform group-hover:rotate-12 transition-transform duration-300">
                                <i class="fas fa-comments text-3xl text-secondary"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-secondary transition-colors duration-300">{{ $what_youll_get['unlimited_mentoring']['title'] }}</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed text-lg text-center p-4 bg-green-50 rounded-xl">
                            <i class="fas fa-quote-left text-secondary mr-2"></i>
                            {{ $what_youll_get['unlimited_mentoring']['description'] }}
                            <i class="fas fa-quote-right text-secondary ml-2"></i>
                        </p>
                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <div class="flex items-center justify-center space-x-6">
                                <div class="text-center">
                                    <div class="text-2xl font-bold">24/7</div>
                                    <div class="text-sm">{{ $locale === 'id' ? 'Akses' : 'Access' }}</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold">1-on-1</div>
                                    <div class="text-sm">{{ $locale === 'id' ? 'Sesi' : 'Sessions' }}</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold">Unlimited</div>
                                    <div class="text-sm">{{ $locale === 'id' ? 'Konsultasi' : 'Consultation' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Instructor Section -->
        <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-secondary rounded-full mb-6 shadow-lg">
                        <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        {{ $bootcamp->mentors->count() > 1 ? ($locale === 'id' ? 'Tim Instruktur' : 'Meet Our Instructors') : $detail['meet_instructor'] }}
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        {{ $locale === 'id' ? 'Belajar dari para ahli dengan pengalaman industri nyata' : 'Learn from industry experts with real-world experience' }}
                    </p>
                </div>

                @foreach($bootcamp->mentors as $index => $instructor)
                    <div class="bg-white rounded-3xl p-10 shadow-2xl border border-gray-100 mb-12 transform hover:-translate-y-1 transition-all duration-300 border-l-4 border-l-secondary">
                        <div class="flex flex-col lg:flex-row items-start gap-10">
                            <!-- Profile Image -->
                            <div class="lg:w-1/4 text-center lg:text-left">
                                <div class="relative inline-block">
                                    <img src="{{ $instructor->image }}" alt="{{ $instructor->name }}"
                                        class="w-48 h-48 rounded-full object-cover border-4 border-white shadow-2xl">
                                    <div class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-amber-500 to-orange-600 text-secondary px-6 py-2 rounded-full text-sm font-bold shadow-lg">
                                        {{ $locale === 'id' ? 'Instruktur' : 'Instructor' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Profile Info -->
                            <div class="lg:w-3/4">
                                <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-6">
                                    <div>
                                        <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $instructor->name }}</h3>
                                        <div class="flex items-center mb-4">
                                            <span class="bg-gradient-to-r from-amber-50 to-orange-50 text-secondary font-semibold px-4 py-2 rounded-full text-sm">
                                                <i class="fas fa-gem mr-2"></i>
                                                {{ $instructor->specialization }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="flex items-center bg-green-50 px-4 py-2 rounded-full">
                                            <i class="fas fa-star text-secondary mr-1"></i>
                                            <span class="font-bold">{{ $instructor->rating }}</span>
                                            <span class="text-gray-600 ml-1">{{ $detail['rating'] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-gray-600 text-lg leading-relaxed mb-8">{{ $instructor->bio }}</p>

                                <!-- Stats -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="bg-gradient-to-r from-amber-50 to-white p-6 rounded-2xl text-center">
                                        <div class="text-3xl font-bold text-secondary mb-2">{{ $instructor->experience }}</div>
                                        <div class="text-gray-600">{{ $detail['experience'] }}</div>
                                    </div>
                                    <div class="bg-gradient-to-r from-orange-50 to-white p-6 rounded-2xl text-center">
                                        <div class="text-3xl font-bold text-secondary mb-2">{{ $instructor->students_taught }}</div>
                                        <div class="text-gray-600">{{ $locale === 'id' ? 'Siswa' : 'Students Taught' }}</div>
                                    </div>
                                    <div class="bg-gradient-to-r from-yellow-50 to-white p-6 rounded-2xl text-center">
                                        <div class="text-3xl font-bold text-secondary mb-2">{{ $locale === 'id' ? 'Expert' : 'Expert' }}</div>
                                        <div class="text-gray-600">{{ $locale === 'id' ? 'Level' : 'Level' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- HRC Mentor Team Section -->
        <section class="py-20 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 relative overflow-hidden">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-indigo-200 to-purple-300 rounded-full opacity-20 animate-pulse"></div>
                <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-purple-200 to-pink-300 rounded-full opacity-20 animate-pulse delay-1000"></div>
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-16">
                    <div class="flex flex-col items-center mb-8">
                        <div class="w-24 h-24 bg-secondary rounded-full flex items-center justify-center text-white mb-6 shadow-2xl transform hover:rotate-12 transition-transform duration-300">
                            <i class="fas fa-user-tie text-3xl"></i>
                        </div>
                        <div class="text-center">
                            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                                {{ $locale === 'id' ? 'Tim Mentor HRC' : 'HRC Mentor Team' }}
                            </h2>
                            <div class="w-32 h-1.5 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full mx-auto mb-6"></div>
                            <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                                {{ $locale === 'id' ? 'Bergabunglah dengan tim mentor berpengalaman kami yang berkomitmen untuk kesuksesan Anda' : 'Join our experienced mentor team committed to your success' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                    <div class="grid lg:grid-cols-2 gap-12 p-12">
                        <!-- Left Column -->
                        <div>
                            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 mb-10 border border-indigo-100">
                                <p class="text-gray-700 text-lg leading-relaxed text-center italic">
                                    <i class="fas fa-quote-left text-secondary text-2xl mr-2"></i>
                                    {{ $training_modules['hrc_mentors'] }}
                                    <i class="fas fa-quote-right text-secondary text-2xl ml-2"></i>
                                </p>
                            </div>

                            <!-- Features -->
                            <div class="space-y-6">
                                <div class="flex items-start p-6 rounded-2xl bg-white hover:bg-gradient-to-r hover:from-indigo-50 hover:via-purple-50 hover:to-white transition-all duration-300 group border border-gray-100">
                                    <div class="flex-shrink-0 mr-5">
                                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center text-white shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas fa-users text-xl text-secondary"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-secondary transition-colors duration-300">
                                            {{ $locale === 'id' ? '5+ Mentor Berpengalaman' : '5+ Expert Mentors' }}
                                        </h4>
                                        <p class="text-gray-600">
                                            {{ $locale === 'id' ? 'Tim mentor profesional dengan pengalaman industri lebih dari 10 tahun' : 'Professional mentor team with over 10 years of industry experience' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start p-6 rounded-2xl bg-white hover:bg-gradient-to-r hover:from-purple-50 hover:via-pink-50 hover:to-white transition-all duration-300 group border border-gray-100">
                                    <div class="flex-shrink-0 mr-5">
                                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center text-white shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas fa-globe-americas text-xl text-secondary"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-secondary transition-colors duration-300">
                                            {{ $locale === 'id' ? 'Jaringan Luas' : 'Extensive  Network' }}
                                        </h4>
                                        <p class="text-gray-600">
                                            {{ $locale === 'id' ? 'Koneksi dengan mentor dan semua alumni' : 'Connections with mentors and all alumni' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="flex flex-col">
                            <!-- Premium Badge -->
                            <div class="relative bg-gradient-to-br from-yellow-400 to-orange-500 rounded-3xl p-10 text-white shadow-2xl mb-10 transform hover:scale-105 transition-transform duration-300">
                                <div class="text-center">
                                    <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-award text-4xl text-secondary"></i>
                                    </div>
                                    <h3 class="text-3xl font-bold mb-3 text-black">{{ $locale === 'id' ? 'Mentor Terbaik' : 'Top Mentors' }}</h3>
                                    <p class="text-black text-lg">{{ $locale === 'id' ? 'Dipilih dengan ketat melalui beberapa seleksi' : 'Carefully selected through multiple rounds of screening' }}</p>
                                </div>
                                <div class="absolute -top-4 -right-4 bg-secondary text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg shadow-lg">
                                    #1
                                </div>
                            </div>

                            <!-- Stats -->
                            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                                <h4 class="text-2xl font-bold text-gray-900 mb-8 text-center">
                                    {{ $locale === 'id' ? 'Statistik Mentor Kami' : 'Our Mentor Statistics' }}
                                </h4>
                                <div class="space-y-6">
                                    <div class="flex items-center justify-between p-6 bg-gradient-to-r from-indigo-50 to-white rounded-2xl hover:from-indigo-100 transition-all duration-300">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                                                <i class="fas fa-history text-secondary"></i>
                                            </div>
                                            <div>
                                                <div class="text-gray-600">{{ $locale === 'id' ? 'Rata-rata Pengalaman' : 'Average Experience' }}</div>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold text-secondary">12+</div>
                                    </div>

                                    <div class="flex items-center justify-between p-6 bg-gradient-to-r from-green-50 to-white rounded-2xl hover:from-green-100 transition-all duration-300">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                                                <i class="fas fa-chart-line text-green-600"></i>
                                            </div>
                                            <div>
                                                <div class="text-gray-600">{{ $locale === 'id' ? 'Tingkat Kepuasan' : 'Success Rate' }}</div>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold text-secondary">98%</div>
                                    </div>

                                    <div class="flex items-center justify-between p-6 bg-gradient-to-r from-purple-50 to-white rounded-2xl hover:from-purple-100 transition-all duration-300">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                                                <i class="fas fa-graduation-cap text-secondary"></i>
                                            </div>
                                            <div>
                                                <div class="text-gray-600">{{ $locale === 'id' ? 'Jumlah Orang' : 'Students Taught' }}</div>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold text-secondary">10,000+</div>
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
                    <p class="text-gray-600">{{ $locale === 'id' ? 'Rasio instruktur-orang maksimal 1:10 untuk pembelajaran yang efektif' : 'Maximum 1:10 instructor-student ratio for effective learning' }}</p>
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

    <!-- Career Support & Outcomes Section (Redesigned) -->
    <section class="py-20 bg-gradient-to-b from-white to-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-secondary rounded-full mb-6 shadow-lg">
                    <i class="fas fa-briefcase text-white text-2xl"></i>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">{{ $detail['career_support'] }}</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    {{ $locale === 'id' ? 'Dukungan karir komprehensif untuk memastikan kesuksesan Anda pasca bootcamp' : 'Comprehensive career support to ensure your post-bootcamp success' }}
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-10 max-w-6xl mx-auto">
                <!-- Left Column: Career Support Services -->
                <div class="bg-gradient-to-br from-white to-blue-50 rounded-3xl p-8 shadow-xl border border-blue-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 group">
                    <div class="flex items-center mb-8">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white mr-5 shadow-lg">
                            <i class="fas fa-tasks text-xl text-secondary"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 group-hover:text-secondary transition-colors duration-300">
                            {{ $detail['whats_included'] }}
                        </h3>
                    </div>

                    <div class="space-y-5">
                        <div class="flex items-start p-5 rounded-2xl bg-white hover:bg-gradient-to-r hover:from-blue-50 hover:to-white transition-all duration-300 group/item border border-gray-100">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center text-white mr-5 shadow-md">
                                <i class="fas fa-file-alt text-secondary"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-800 mb-1 group-hover/item:text-secondary transition-colors duration-300">
                                    {{ $detail['resume_review'] }}
                                </h4>
                                <p class="text-sm text-gray-600">
                                    {{ $locale === 'id' ? 'Review CV profesional dan tips optimasi' : 'Professional CV review and optimization tips' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start p-5 rounded-2xl bg-white hover:bg-gradient-to-r hover:from-blue-50 hover:to-white transition-all duration-300 group/item border border-gray-100">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center text-white mr-5 shadow-md">
                                <i class="fas fa-comments text-secondary"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-800 mb-1 group-hover/item:text-secondary transition-colors duration-300">
                                    {{ $detail['mock_interviews'] }}
                                </h4>
                                <p class="text-sm text-gray-600">
                                    {{ $locale === 'id' ? 'Simulasi wawancara dengan feedback mendalam' : 'Mock interviews with detailed feedback' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start p-5 rounded-2xl bg-white hover:bg-gradient-to-r hover:from-blue-50 hover:to-white transition-all duration-300 group/item border border-gray-100">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center text-white mr-5 shadow-md">
                                <i class="fas fa-network-wired text-secondary"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-800 mb-1 group-hover/item:text-secondary transition-colors duration-300">
                                    {{ $detail['networking_events'] }}
                                </h4>
                                <p class="text-sm text-gray-600">
                                    {{ $locale === 'id' ? 'Akses ke event networking dengan industri' : 'Access to industry networking events' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start p-5 rounded-2xl bg-white hover:bg-gradient-to-r hover:from-blue-50 hover:to-white transition-all duration-300 group/item border border-gray-100">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white mr-5 shadow-md">
                                <i class="fas fa-briefcase text-secondary"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-800 mb-1 group-hover/item:text-secondary transition-colors duration-300">
                                    {{ $detail['job_placement'] }}
                                </h4>
                                <p class="text-sm text-gray-600">
                                    {{ $locale === 'id' ? 'Bantuan penempatan kerja dengan partner' : 'Job placement assistance with partners' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start p-5 rounded-2xl bg-white hover:bg-gradient-to-r hover:from-blue-50 hover:to-white transition-all duration-300 group/item border border-gray-100">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center text-white mr-5 shadow-md">
                                <i class="fas fa-users text-secondary"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-800 mb-1 group-hover/item:text-secondary transition-colors duration-300">
                                    {{ $detail['alumni_network'] }}
                                </h4>
                                <p class="text-sm text-gray-600">
                                    {{ $locale === 'id' ? 'Jaringan alumni untuk kolaborasi' : 'Alumni network for collaboration' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Career Outcomes & Statistics -->
                <div class="bg-gradient-to-br from-white to-emerald-50 rounded-3xl p-8 shadow-xl border border-emerald-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 group">
                    <div class="flex items-center mb-8">
                        <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center text-white mr-5 shadow-lg">
                            <i class="fas fa-chart-line text-xl text-secondary"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors duration-300">
                            {{ $detail['career_outcomes'] }}
                        </h3>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-lg transition-shadow duration-300 border border-emerald-100 hover:border-secondary">
                            <div class="text-4xl md:text-5xl font-bold text-emerald-600 mb-2">85%</div>
                            <div class="text-sm font-medium text-gray-700 mb-1">{{ $detail['job_placement_rate'] }}</div>
                            <div class="text-xs text-gray-500">
                                {{ $locale === 'id' ? 'Tingkat penempatan kerja' : 'Job placement rate' }}
                            </div>
                            <div class="mt-3 h-2 bg-emerald-100 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-lg transition-shadow duration-300 border border-blue-100 hover:border-secondary">
                            <div class="text-4xl md:text-5xl font-bold text-secondary mb-2">3<span class="text-lg">months</span></div>
                            <div class="text-sm font-medium text-gray-700 mb-1">{{ $detail['avg_search_time'] }}</div>
                            <div class="text-xs text-gray-500">
                                {{ $locale === 'id' ? 'Rata-rata waktu pencarian' : 'Average job search time' }}
                            </div>
                            <div class="mt-3 flex justify-center">
                                <i class="fas fa-clock text-secondary"></i>
                                <i class="fas fa-clock text-secondary mx-1"></i>
                                <i class="fas fa-clock text-secondary"></i>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-lg transition-shadow duration-300 border border-amber-100 hover:border-secondary">
                            <div class="text-4xl md:text-5xl font-bold text-secondary mb-2">40%</div>
                            <div class="text-sm font-medium text-gray-700 mb-1">{{ $detail['salary_increase'] }}</div>
                            <div class="text-xs text-gray-500">
                                {{ $locale === 'id' ? 'Kenaikan gaji rata-rata' : 'Average salary increase' }}
                            </div>
                            <div class="mt-3 flex items-center justify-center">
                                <i class="fas fa-arrow-up text-secondary mr-1"></i>
                                <span class="text-sm font-semibold text-secondary">Significant Growth</span>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-lg transition-shadow duration-300 border border-purple-100 hover:border-secondary">
                            <div class="text-4xl md:text-5xl font-bold text-secondary mb-2">500<span class="text-xl">+</span></div>
                            <div class="text-sm font-medium text-gray-700 mb-1">{{ $detail['hiring_partners'] }}</div>
                            <div class="text-xs text-gray-500">
                                {{ $locale === 'id' ? 'Perusahaan partner' : 'Hiring partner companies' }}
                            </div>
                            <div class="mt-3">
                                <div class="flex justify-center space-x-1">
                                    <div class="w-3 h-3 bg-secondary rounded-full"></div>
                                    <div class="w-3 h-3 bg-secondary rounded-full"></div>
                                    <div class="w-3 h-3 bg-secondary rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Success Story Highlight -->
                    <div class="bg-gradient-to-r from-emerald-50 to-green-50 rounded-2xl p-6 border border-emerald-200">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-4">
                                <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-medal text-emerald-600"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">
                                    {{ $locale === 'id' ? 'Kisah Sukses Alumni' : 'Alumni Success Story' }}
                                </h4>
                                <p class="text-sm text-gray-600">
                                    {{ $locale === 'id' ? '90% alumni mendapatkan pekerjaan dalam 6 bulan dengan kenaikan gaji rata-rata 40%' : '90% of alumni secured jobs within 6 months with an average 40% salary increase' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-12 max-w-4xl mx-auto">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 border border-secondary">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="text-center md:text-left">
                            <h4 class="text-xl font-bold text-gray-900 mb-2">
                                {{ $locale === 'id' ? 'Mulai Perjalanan Karir Anda Hari Ini' : 'Start Your Career Journey Today' }}
                            </h4>
                            <p class="text-gray-600">
                                {{ $locale === 'id' ? 'Bergabunglah dengan bootcamp kami dan dapatkan dukungan karir komprehensif untuk masa depan yang cerah' : 'Join our bootcamp and get comprehensive career support for a brighter future' }}
                            </p>
                        </div>
                        <button class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105 shadow-lg whitespace-nowrap">
                            <i class="fas fa-rocket mr-2 text-secondary"></i> <span class="text-secondary">{{ $locale === 'id' ? 'Daftar Sekarang' : 'Enroll Now' }}</span>
                        </button>
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
                                <img src="{{$relatedBootcamp->image}}" alt="{{ $relatedBootcamp->title }}" class="w-full h-48 md:h-full object-cover">
                            </div>
                            <div class="md:w-3/5 p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $relatedBootcamp->category->name }}</span>
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <span class="ml-1 text-sm font-medium">{{ $relatedBootcamp->rating }}</span>
                                    </div>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">{{ $relatedBootcamp->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ $relatedBootcamp->description }}</p>
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span class="mr-4">{{ $relatedBootcamp->duration }}</span>
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>{{ $relatedBootcamp->start_date->format('Y-m-d') }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-xl font-bold text-secondary">Rp {{ number_format($relatedBootcamp->price, 0, ',', '.') }}</span>
                                        @if($relatedBootcamp->price < $relatedBootcamp->original_price)
                                            <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($relatedBootcamp->original_price, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <a href="/{{ $locale }}/bootcamp/{{ $relatedBootcamp->id }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
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
                @foreach($otherBootcamps as $otherBootcamp)
                    <div class="bg-gray-50 rounded-xl shadow-md overflow-hidden card-hover">
                        <div class="md:flex">
                            <div class="md:w-2/5">
                                <img src="{{ $otherBootcamp->image }}" alt="{{ $otherBootcamp->title }}" class="w-full h-48 md:h-full object-cover">
                            </div>
                            <div class="md:w-3/5 p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-secondary bg-secondary/10 px-3 py-1 rounded-full">{{ $otherBootcamp->category->name }}</span>
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <span class="ml-1 text-sm font-medium">{{ $otherBootcamp->rating }}</span>
                                    </div>
                                </div>
                                <h3 class="text-xl font-semibold mb-2">{{ $otherBootcamp->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ $otherBootcamp->description }}</p>
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span class="mr-4">{{ $otherBootcamp->duration }}</span>
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>{{ $otherBootcamp->start_date->format('Y-m-d') }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-xl font-bold text-secondary">Rp {{ number_format($otherBootcamp->price, 0, ',', '.') }}</span>
                                        @if($otherBootcamp->price < $otherBootcamp->original_price)
                                            <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($otherBootcamp->original_price, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <a href="/{{ $locale }}/bootcamp/{{ $otherBootcamp->id }}" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-4 rounded-lg transition duration-300">
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
        {{-- <div class="absolute inset-0 z-10">
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
        </div> --}}

        <div class="container mx-auto px-6 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $detail['ready_transform'] }}</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto">{{ str_replace('{category}', $bootcamp->category->name, $detail['transform_subtitle']) }}</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="bg-secondary border-2 border-white hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-shopping-cart mr-2"></i> {{ $detail['enroll_bootcamp'] }}
                </button>
            </div>
        </div>
    </section>

    @include('components.footer')
@endif
