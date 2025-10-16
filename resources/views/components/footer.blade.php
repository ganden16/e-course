@php
    $data = json_decode(file_get_contents(resource_path('json/data.json')), true);
    $site = $data['site'];
@endphp

    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center mb-4">
                        <i class="{{ $site['logo'] }} text-2xl mr-2"></i>
                        <h3 class="text-xl font-bold">{{ $site['name'] }}</h3>
                    </div>
                    <p class="text-sm text-gray-300 mb-4">{{ $site['description'] }}</p>
                    <div class="flex space-x-3">
                        <a href="https://facebook.com/{{ $site['name'] }}" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-facebook text-lg"></i>
                        </a>
                        <a href="https://twitter.com/{{ $site['name'] }}" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-twitter text-lg"></i>
                        </a>
                        <a href="https://instagram.com/{{ $site['name'] }}" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-instagram text-lg"></i>
                        </a>
                        <a href="https://linkedin.com/company/{{ $site['name'] }}" class="text-gray-300 hover:text-white transition-colors">
                            <i class="fab fa-linkedin text-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold mb-4 text-lg">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/" class="text-gray-300 hover:text-white transition-colors">Home</a></li>
                        <li><a href="/about-us" class="text-gray-300 hover:text-white transition-colors">About Us</a></li>
                        <li><a href="/product" class="text-gray-300 hover:text-white transition-colors">Courses</a></li>
                        <li><a href="/bootcamp" class="text-gray-300 hover:text-white transition-colors">Bootcamps</a></li>
                        <li><a href="/blog" class="text-gray-300 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="/community" class="text-gray-300 hover:text-white transition-colors">Community</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="font-semibold mb-4 text-lg">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/contact" class="text-gray-300 hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Refund Policy</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">FAQ</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="font-semibold mb-4 text-lg">Contact Info</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-primary"></i>
                            <span class="text-gray-300">{{ $site['email'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone mt-1 mr-3 text-primary"></i>
                            <span class="text-gray-300">{{ $site['phone'] }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-primary"></i>
                            <span class="text-gray-300">{{ $site['address'] }}</span>
                        </li>
                    </ul>

                    <!-- Newsletter -->
                    <div class="mt-6">
                        <h5 class="font-semibold mb-2">Subscribe to Our Newsletter</h5>
                        <div class="flex">
                            <input type="email" placeholder="Your email" class="flex-1 px-3 py-2 bg-gray-800 text-white rounded-l-md focus:outline-none focus:ring-2 focus:ring-primary">
                            <button class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-r-md transition duration-300">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} {{ $site['name'] }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-8 right-8 bg-primary hover:bg-primary-dark text-white p-3 rounded-full shadow-lg transition duration-300 transform hover:scale-105 opacity-0 invisible">
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
