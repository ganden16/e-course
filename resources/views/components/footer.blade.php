@php
    // Get current locale from middleware
    $locale = app()->getLocale();

    // Load language file for landing page (header/footer are part of landing page)
    $translations = include lang_path("{$locale}/landingPage.php");
    $site = $translations['site'];
    $footer = $translations['footer'];
    $navigation = $translations['navigation'];

    // Build URLs with current locale
    $baseUrl = '/' . $locale;
@endphp

    </main>

    <!-- Footer -->
    <footer class="bg-primary-dark text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center mb-4">
                        <i class="{{ $site['logo'] }} text-2xl mr-2"></i>
                        <h3 class="text-xl font-bold">HRC Academy</h3>
                    </div>
                    <p class="text-sm text-gray-300 mb-4">{{ $site['description'] }}</p>
                    <div class="flex space-x-3">
                        <a href="https://dub.sh/gRcQl5R" class="text-gray-300 hover:text-white transition-colors" target="_blank">
                            <i class="fab fa-facebook text-lg"></i>
                        </a>
                        <a href="https://bit.ly/InstagramHRC" class="text-gray-300 hover:text-white transition-colors" target="_blank">
                            <i class="fab fa-instagram text-lg"></i>
                        </a>
                        <a href="https://bit.ly/3IHNbcK" class="text-gray-300 hover:text-white transition-colors" target="_blank">
                            <i class="fab fa-linkedin text-lg"></i>
                        </a>
                        <a href="https://dub.sh/k8eqlEQ" class="text-gray-300 hover:text-white transition-colors" target="_blank">
                            <i class="fab fa-tiktok text-lg"></i>
                        </a>
                        <a href="https://dub.sh/Bnfb8p0" class="text-gray-300 hover:text-white transition-colors" target="_blank">
                            <i class="fab fa-youtube text-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold mb-4 text-lg">{{ $footer['quick_links'] }}</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ $baseUrl }}" class="text-gray-300 hover:text-white transition-colors">{{ $navigation['home'] }}</a></li>
                        <li><a href="{{ $baseUrl }}/about-us" class="text-gray-300 hover:text-white transition-colors">{{ $navigation['about'] }}</a></li>
                        <li><a href="{{ $baseUrl }}/product" class="text-gray-300 hover:text-white transition-colors">{{ $navigation['product'] }}</a></li>
                        <li><a href="{{ $baseUrl }}/bootcamp" class="text-gray-300 hover:text-white transition-colors">{{ $navigation['bootcamp'] }}</a></li>
                        <li><a href="{{ $baseUrl }}/blog" class="text-gray-300 hover:text-white transition-colors">{{ $navigation['blog'] }}</a></li>
                        <li><a href="{{ $baseUrl }}/community" class="text-gray-300 hover:text-white transition-colors">{{ $navigation['community'] }}</a></li>
                    </ul>
                </div>

                <!-- Support -->
                {{-- <div>
                    <h4 class="font-semibold mb-4 text-lg">{{ $footer['support'] }}</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ $baseUrl }}/contact" class="text-gray-300 hover:text-white transition-colors">{{ $footer['contact_info'] }}</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Refund Policy</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">FAQ</a></li>
                    </ul>
                </div> --}}

                <!-- Contact Info -->
                <div>
                    <h4 class="font-semibold mb-4 text-lg">{{ $footer['contact_info'] }}</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-white"></i>
                            <span class="text-gray-300">{{ $site['email'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone mt-1 mr-3 text-white"></i>
                            <span class="text-gray-300">{{ $site['phone'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-white"></i>
                            <span class="text-gray-300">{{ $site['address'] }}</span>
                        </li>
                    </ul>

                    <!-- Newsletter -->
                    {{-- <div class="mt-6">
                        <h5 class="font-semibold mb-2">{{ $footer['newsletter'] }}</h5>
                        <div class="flex">
                            <input type="email" placeholder="{{ $footer['your_email'] }}" class="flex-1 px-3 py-2 bg-gray-800 text-white rounded-l-md focus:outline-none focus:ring-2 focus:ring-primary">
                            <button class="bg-orange hover:bg-orange-dark text-white px-4 py-2 rounded-r-md transition duration-300">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div> --}}
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} Healthcare Remote Circle. {{ $footer['all_rights_reserved'] }}.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-8 right-8 bg-orange hover:bg-orange-dark text-white p-3 rounded-full shadow-lg transition duration-300 transform hover:scale-105 opacity-0 invisible">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Back to top button
        const backToTopButton = document.getElementById('backToTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.add('opacity-0', 'invisible');
                backToTopButton.classList.remove('opacity-100', 'visible');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>
