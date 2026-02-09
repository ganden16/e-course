@php
    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for contact page
    $translations = include lang_path("{$locale}/contact.php");
    $hero = $translations['hero'];
    $contact_info = $translations['contact_info'];
    $contact_form = $translations['contact_form'];
    $faq = $translations['faq'];
    $cta = $translations['cta'];

    // Get data from language files
    $contact = $translations['contact'];

    // Build URLs with current locale
    $baseUrl = '/' . $locale;
@endphp

@include('components.header', ['title' => 'Contact Us'])

<!-- Hero Section -->
<section class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <!-- Use hero image from contact page -->
        <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ $contact['image'] ?? asset('assets/images/logo1.png') }}');">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/50"></div>
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
        </div>
    </div>

    <!-- Hero Content -->
    <div class="container mx-auto px-6 py-20 relative z-10">
        <div class="text-center max-w-4xl mx-auto">
            <!-- Headline -->
            <h1 class="text-4xl lg:text-5xl font-bold leading-tight mb-4 text-white tracking-wide">
                {{ $hero['title'] }}
            </h1>

            <!-- Subheadline -->
            <p class="text-xl lg:text-2xl mb-8 font-light text-gray-200">
                {{ $hero['subtitle'] }}
            </p>

            <!-- CTA Buttons -->
            {{-- <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#contact-form" class="bg-primary hover:bg-primary-dark text-white font-bold py-4 px-10 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                    {{ $contact_form['send_message'] }}
                </a>
                <a href="#contact-info" class="hover:bg-white hover:text-primary border border-white text-white font-bold py-4 px-10 rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                    {{ $contact_info['follow_us'] }}
                </a>
            </div> --}}
        </div>
    </div>
</section>

<!-- Contact Info Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-12">
            <div class="lg:w-1/2">
                <img src="{{ $contact['image'] }}" alt="Contact Us" class="w-full rounded-lg shadow-lg">
            </div>
            <div class="lg:w-1/2">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">{{ $contact_info['description'] }}</h2>
                <p class="text-lg text-gray-600 mb-8">{{ $contact_info['additional_info'] }}</p>

                <div class="space-y-6">
                    @foreach($contact['contact_info'] as $info)
                        <div class="flex items-start">
                            <div class="bg-secondary text-white rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="{{ $info['icon'] }}"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-1">{{ $info['type'] }}</h3>
                                <p class="text-gray-600">{{ $info['value'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-4">{{ $contact_info['office_hours'] }}</h3>
                    <div class="space-y-2">
                        @foreach($contact['office_hours'] as $hours)
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ $hours['day'] }}</span>
                                <span class="font-medium">{{ $hours['hours'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div> --}}

                <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-4">{{ $contact_info['follow_us'] }}</h3>
                    <div class="flex space-x-4">
                        @foreach($contact['social_links'] as $social)
                            <a href="{{ $social['url'] }}" class="bg-gray-100 hover:bg-secondary hover:text-white text-gray-700 w-12 h-12 rounded-full flex items-center justify-center transition duration-300">
                                <i class="{{ $social['icon'] }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $contact_form['title'] }}</h2>
                <p class="text-lg text-gray-600">{{ $contact_form['subtitle'] }}</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.send', app()->getLocale()) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="firstName" class="block text-gray-700 font-medium mb-2">{{ $contact_form['first_name'] }}</label>
                            <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
                        </div>
                        <div>
                            <label for="lastName" class="block text-gray-700 font-medium mb-2">{{ $contact_form['last_name'] }}</label>
                            <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">{{ $contact_form['email_address'] }}</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
                        </div>
                        <div>
                            <label for="phone" class="block text-gray-700 font-medium mb-2">{{ $contact_form['phone_number'] }}</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
                        </div>
                    </div>

                    {{-- <div class="mb-6">
                        <label for="subject" class="block text-gray-700 font-medium mb-2">{{ $contact_form['subject'] }}</label>
                        <select id="subject" name="subject" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">
                            <option value="">{{ $contact_form['select_subject'] }}</option>
                            <option value="general">{{ $contact_form['general_inquiry'] }}</option>
                            <option value="course">{{ $contact_form['course_information'] }}</option>
                            <option value="bootcamp">{{ $contact_form['bootcamp_details'] }}</option>
                            <option value="technical">{{ $contact_form['technical_support'] }}</option>
                            <option value="billing">{{ $contact_form['billing_payment'] }}</option>
                            <option value="partnership">{{ $contact_form['partnership_opportunities'] }}</option>
                        </select>
                    </div> --}}

                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 font-medium mb-2">{{ $contact_form['message'] }}</label>
                        <textarea id="message" name="message" rows="5" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary">{{ old('message') }}</textarea>
                    </div>

                    {{-- <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2">
                            <span class="text-gray-700">{!! $contact_form['privacy_terms'] !!}</span>
                        </label>
                    </div> --}}

                    <button type="submit" class="w-full bg-secondary hover:bg-secondary-dark text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105">
                        {{ $contact_form['send_message'] }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $faq['title'] }}</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $faq['subtitle'] }}</p>
        </div>

        <div class="max-w-3xl mx-auto" x-data="{ open: 0 }">
            <div class="mb-4">
                <button @click="open = 0" class="w-full text-left bg-gray-100 p-4 rounded-lg flex justify-between items-center hover:bg-gray-200 transition">
                    <span class="font-semibold">{{ $faq['how_to_enroll']['question'] }}</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 0 }"></i>
                </button>
                <div x-show="open === 0" x-transition class="bg-gray-50 p-4 rounded-b-lg">
                    <p class="text-gray-600">{{ $faq['how_to_enroll']['answer'] }}</p>
                </div>
            </div>

            <div class="mb-4">
                <button @click="open = 1" class="w-full text-left bg-gray-100 p-4 rounded-lg flex justify-between items-center hover:bg-gray-200 transition">
                    <span class="font-semibold">{{ $faq['payment_methods']['question'] }}</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 1 }"></i>
                </button>
                <div x-show="open === 1" x-transition class="bg-gray-50 p-4 rounded-b-lg">
                    <p class="text-gray-600">{{ $faq['payment_methods']['answer'] }}</p>
                </div>
            </div>

            <div class="mb-4">
                <button @click="open = 2" class="w-full text-left bg-gray-100 p-4 rounded-lg flex justify-between items-center hover:bg-gray-200 transition">
                    <span class="font-semibold">{{ $faq['refund_policy']['question'] }}</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 2 }"></i>
                </button>
                <div x-show="open === 2" x-transition class="bg-gray-50 p-4 rounded-b-lg">
                    <p class="text-gray-600">{{ $faq['refund_policy']['answer'] }}</p>
                </div>
            </div>

            <div class="mb-4">
                <button @click="open = 3" class="w-full text-left bg-gray-100 p-4 rounded-lg flex justify-between items-center hover:bg-gray-200 transition">
                    <span class="font-semibold">{{ $faq['corporate_training']['question'] }}</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 3 }"></i>
                </button>
                <div x-show="open === 3" x-transition class="bg-gray-50 p-4 rounded-b-lg">
                    <p class="text-gray-600">{{ $faq['corporate_training']['answer'] }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Location Section -->
{{-- <section class="py-16 bg-light">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Visit Our Office</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Stop by our office for a personal consultation or to meet our team.</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="h-96 bg-gray-200">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613507864!3d-6.194741395493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5390917b759%3A0x6b45e67356080477!2sMonas!5e0!3m2!1sen!2sid!4v1635959047141!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="p-8">
                <h3 class="text-2xl font-semibold mb-4">{{ $site['name'] }} Headquarters</h3>
                <p class="text-gray-600 mb-4">{{ $site['address'] }}</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="https://maps.google.com/?q={{ $site['address'] }}" target="_blank" class="bg-secondary hover:bg-secondary-dark text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                        <i class="fas fa-directions mr-2"></i> Get Directions
                    </a>
                    <a href="tel:{{ str_replace([' ', '-'], '', $site['phone']) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-6 rounded-lg transition duration-300">
                        <i class="fas fa-phone mr-2"></i> Call Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<!-- CTA Section -->
<section class="py-16 bg-primary text-white relative overflow-hidden">
    <!-- Animated Background with Secondary-Dark Circular Ribbon Pattern -->
    {{-- <div class="absolute inset-0 z-10">
        <!-- Circular Ribbon 1 - Top Left -->
        <svg class="absolute top-0 left-0 w-96 h-96" viewBox="0 0 400 400">
            <path d="M200,50 A150,150 0 0,1 350,200 L300,200 A100,100 0 0,0 200,100 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
            <path d="M200,350 A150,150 0 0,1 50,200 L100,200 A100,100 0 0,0 200,300 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
        </svg>

        <!-- Circular Ribbon 2 - Top Right -->
        <svg class="absolute top-0 right-0 w-96 h-96" viewBox="0 0 400 400">
            <path d="M200,50 A150,150 0 0,0 50,200 L100,200 A100,100 0 0,1 200,100 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
            <path d="M200,350 A150,150 0 0,0 350,200 L300,200 A100,100 0 0,1 200,300 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
        </svg>

        <!-- Circular Ribbon 3 - Bottom Left -->
        <svg class="absolute bottom-0 left-0 w-96 h-96" viewBox="0 0 400 400">
            <path d="M200,50 A150,150 0 0,0 50,200 L100,200 A100,100 0 0,1 200,100 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
            <path d="M200,350 A150,150 0 0,1 350,200 L300,200 A100,100 0 0,0 200,300 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
        </svg>

        <!-- Circular Ribbon 4 - Bottom Right -->
        <svg class="absolute bottom-0 right-0 w-96 h-96" viewBox="0 0 400 400">
            <path d="M200,50 A150,150 0 0,1 350,200 L300,200 A100,100 0 0,0 200,100 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
            <path d="M200,350 A150,150 0 0,0 50,200 L100,200 A100,100 0 0,1 200,300 Z"
                  fill="currentColor"
                  class="text-secondary-dark"/>
        </svg>
    </div> --}}

    <div class="container mx-auto px-6 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">{{ $cta['title'] }}</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $cta['subtitle'] }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ $baseUrl }}/product" class="bg-secondary border-2 border-white hover:bg-secondary-dark text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                {{ $cta['browse_courses'] }}
            </a>
            <a href="{{ $baseUrl }}/bootcamp" class="bg-transparent border-2 border-white hover:bg-white hover:text-secondary text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                {{ $cta['explore_bootcamps'] }}
            </a>
        </div>
    </div>
</section>

@include('components.footer')
