@php
    $data = json_decode(file_get_contents(resource_path('json/data.json')), true);
    $site = $data['site'];
    $contact = $data['contact'];
@endphp

@include('components.header', ['title' => 'Contact Us'])

<!-- Hero Section -->
<section class="gradient-bg text-white py-16">
    <div class="container mx-auto px-6">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $contact['title'] }}</h1>
            <p class="text-xl max-w-3xl mx-auto">{{ $contact['subtitle'] }}</p>
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
                <h2 class="text-3xl font-bold text-gray-800 mb-6">{{ $contact['description'] }}</h2>
                <p class="text-lg text-gray-600 mb-8">Whether you have questions about our courses, need technical support, or want to learn more about our bootcamps, our team is here to help you every step of the way.</p>

                <div class="space-y-6">
                    @foreach($contact['contact_info'] as $info)
                        <div class="flex items-start">
                            <div class="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="{{ $info['icon'] }}"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-1">{{ $info['type'] }}</h3>
                                <p class="text-gray-600">{{ $info['value'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-4">Office Hours</h3>
                    <div class="space-y-2">
                        @foreach($contact['office_hours'] as $hours)
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ $hours['day'] }}</span>
                                <span class="font-medium">{{ $hours['hours'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        @foreach($contact['social_links'] as $social)
                            <a href="{{ $social['url'] }}" class="bg-gray-100 hover:bg-primary hover:text-white text-gray-700 w-12 h-12 rounded-full flex items-center justify-center transition duration-300">
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
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Send Us a Message</h2>
                <p class="text-lg text-gray-600">Fill out the form below and we'll get back to you as soon as possible.</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="firstName" class="block text-gray-700 font-medium mb-2">First Name</label>
                            <input type="text" id="firstName" name="firstName" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div>
                            <label for="lastName" class="block text-gray-700 font-medium mb-2">Last Name</label>
                            <input type="text" id="lastName" name="lastName" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input type="email" id="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div>
                            <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                        <select id="subject" name="subject" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="">Select a subject</option>
                            <option value="general">General Inquiry</option>
                            <option value="course">Course Information</option>
                            <option value="bootcamp">Bootcamp Details</option>
                            <option value="technical">Technical Support</option>
                            <option value="billing">Billing & Payment</option>
                            <option value="partnership">Partnership Opportunities</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                        <textarea id="message" name="message" rows="5" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-2">
                            <span class="text-gray-700">I agree to the <a href="#" class="text-primary hover:underline">Privacy Policy</a> and <a href="#" class="text-primary hover:underline">Terms of Service</a></span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 px-6 rounded-lg transition duration-300 transform hover:scale-105">
                        Send Message
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
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Frequently Asked Questions</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Find answers to common questions about our courses and services.</p>
        </div>

        <div class="max-w-3xl mx-auto" x-data="{ open: 0 }">
            <div class="mb-4">
                <button @click="open = 0" class="w-full text-left bg-gray-100 p-4 rounded-lg flex justify-between items-center hover:bg-gray-200 transition">
                    <span class="font-semibold">How do I enroll in a course?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 0 }"></i>
                </button>
                <div x-show="open === 0" x-transition class="bg-gray-50 p-4 rounded-b-lg">
                    <p class="text-gray-600">Simply browse our course catalog, select the course you're interested in, and click the "Enroll Now" button. You'll be guided through the registration and payment process.</p>
                </div>
            </div>

            <div class="mb-4">
                <button @click="open = 1" class="w-full text-left bg-gray-100 p-4 rounded-lg flex justify-between items-center hover:bg-gray-200 transition">
                    <span class="font-semibold">What payment methods do you accept?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 1 }"></i>
                </button>
                <div x-show="open === 1" x-transition class="bg-gray-50 p-4 rounded-b-lg">
                    <p class="text-gray-600">We accept all major credit cards, debit cards, PayPal, and bank transfers. We also offer installment plans for select courses and bootcamps.</p>
                </div>
            </div>

            <div class="mb-4">
                <button @click="open = 2" class="w-full text-left bg-gray-100 p-4 rounded-lg flex justify-between items-center hover:bg-gray-200 transition">
                    <span class="font-semibold">Can I get a refund if I'm not satisfied?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 2 }"></i>
                </button>
                <div x-show="open === 2" x-transition class="bg-gray-50 p-4 rounded-b-lg">
                    <p class="text-gray-600">Yes, we offer a 30-day money-back guarantee for most courses. If you're not satisfied with your purchase, contact our support team within 30 days for a full refund.</p>
                </div>
            </div>

            <div class="mb-4">
                <button @click="open = 3" class="w-full text-left bg-gray-100 p-4 rounded-lg flex justify-between items-center hover:bg-gray-200 transition">
                    <span class="font-semibold">Do you offer corporate training?</span>
                    <i class="fas fa-chevron-down transition-transform" :class="{ 'rotate-180': open === 3 }"></i>
                </button>
                <div x-show="open === 3" x-transition class="bg-gray-50 p-4 rounded-b-lg">
                    <p class="text-gray-600">Yes, we offer customized corporate training programs for teams and organizations. Contact our business team for more information about group discounts and tailored solutions.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Location Section -->
<section class="py-16 bg-light">
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
                    <a href="https://maps.google.com/?q={{ $site['address'] }}" target="_blank" class="bg-primary hover:bg-primary-dark text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                        <i class="fas fa-directions mr-2"></i> Get Directions
                    </a>
                    <a href="tel:{{ str_replace([' ', '-'], '', $site['phone']) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-6 rounded-lg transition duration-300">
                        <i class="fas fa-phone mr-2"></i> Call Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 gradient-bg text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Start Your Learning Journey?</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">Join thousands of students who are already advancing their careers with our courses.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/product" class="bg-accent hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105 shadow-lg">
                Browse Courses
            </a>
            <a href="/bootcamp" class="bg-transparent border-2 border-white hover:bg-white hover:text-primary text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">
                Explore Bootcamps
            </a>
        </div>
    </div>
</section>

@include('components.footer')
