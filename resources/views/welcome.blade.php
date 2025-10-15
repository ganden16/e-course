<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayWise - Your Next Online Bank</title>
	  @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .pulse-animation {
            animation: pulse 2s ease-in-out infinite;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #10b981 0%, #064e3b 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'paywise-green': '#10b981',
                        'paywise-dark': '#064e3b',
                        'paywise-light': '#d1fae5',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="gradient-bg shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <i class="fas fa-chart-line text-paywise-green text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-white">PAYWISE</h1>
                </div>
                <div class="hidden md:flex space-x-6">
                    <a href="#" class="text-white hover:text-paywise-light transition transform hover:scale-105">Home</a>
                    <a href="#" class="text-white hover:text-paywise-light transition transform hover:scale-105">Features</a>
                    <a href="#" class="text-white hover:text-paywise-light transition transform hover:scale-105">Services</a>
                    <a href="#" class="text-white hover:text-paywise-light transition transform hover:scale-105">About</a>
                    <a href="#" class="text-white hover:text-paywise-light transition transform hover:scale-105">Contact</a>
                </div>
                <button class="md:hidden text-white hover:text-paywise-light transition">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="container mx-auto px-6 py-16">
        <div class="flex flex-col md:flex-row items-center">
            <!-- Left Content -->
            <div class="md:w-1/2 mb-8 md:mb-0">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 float-animation">Your Next Online Bank.</h2>
                <p class="text-lg text-gray-600 mb-8">Experience the future of banking with PayWise. Secure, fast, and convenient financial services at your fingertips.</p>
                
                <!-- Stats -->
                <div class="flex space-x-8 mb-8">
                    <div class="text-center card-hover bg-white p-4 rounded-lg shadow-md">
                        <div class="text-3xl font-bold text-paywise-green pulse-animation">6X</div>
                        <div class="text-sm text-gray-600">Faster Transactions</div>
                    </div>
                    <div class="text-center card-hover bg-white p-4 rounded-lg shadow-md">
                        <div class="text-3xl font-bold text-paywise-green pulse-animation">-15%</div>
                        <div class="text-sm text-gray-600">Lower Fees</div>
                    </div>
                    <div class="text-center card-hover bg-white p-4 rounded-lg shadow-md">
                        <div class="text-3xl font-bold text-paywise-green pulse-animation">3M+</div>
                        <div class="text-sm text-gray-600">Happy Customers</div>
                    </div>
                </div>
                
                <!-- CTA Button -->
                <button class="gradient-bg hover:shadow-lg text-white font-bold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105 pulse-animation">
                    <i class="fas fa-download mr-2"></i> Download Now
                </button>
            </div>
            
            <!-- Right Content -->
            <div class="md:w-1/2 md:pl-12">
                <!-- Currency Exchange Rates -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6 card-hover">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-exchange-alt text-paywise-green mr-2"></i> Currency Exchange Rates
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-2 hover:bg-paywise-light rounded transition">
                            <span class="text-gray-600">USD/EUR</span>
                            <span class="font-semibold text-paywise-green">0.92</span>
                        </div>
                        <div class="flex justify-between items-center p-2 hover:bg-paywise-light rounded transition">
                            <span class="text-gray-600">USD/GBP</span>
                            <span class="font-semibold text-paywise-green">0.79</span>
                        </div>
                        <div class="flex justify-between items-center p-2 hover:bg-paywise-light rounded transition">
                            <span class="text-gray-600">USD/JPY</span>
                            <span class="font-semibold text-paywise-green">140.25</span>
                        </div>
                    </div>
                </div>
                
                <!-- Global Services -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6 card-hover">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-globe-americas text-paywise-green mr-2"></i> Global Services
                    </h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center p-3 hover:bg-paywise-light rounded-lg transition">
                            <i class="fas fa-globe text-2xl text-paywise-green mb-2 float-animation"></i>
                            <p class="text-sm text-gray-600">Worldwide Access</p>
                        </div>
                        <div class="text-center p-3 hover:bg-paywise-light rounded-lg transition">
                            <i class="fas fa-shield-alt text-2xl text-paywise-green mb-2 float-animation"></i>
                            <p class="text-sm text-gray-600">Secure Banking</p>
                        </div>
                        <div class="text-center p-3 hover:bg-paywise-light rounded-lg transition">
                            <i class="fas fa-mobile-alt text-2xl text-paywise-green mb-2 float-animation"></i>
                            <p class="text-sm text-gray-600">Mobile App</p>
                        </div>
                    </div>
                </div>
                
                <!-- Cards -->
                <div class="bg-white rounded-lg shadow-lg p-6 card-hover">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-credit-card text-paywise-green mr-2"></i> Our Cards
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center p-3 hover:bg-paywise-light rounded-lg transition">
                            <div class="w-16 h-10 bg-gradient-to-r from-green-400 to-green-600 rounded mr-4 shadow-md"></div>
                            <div>
                                <h4 class="font-semibold">Petal1</h4>
                                <p class="text-sm text-gray-600">Basic card with 1% cashback</p>
                            </div>
                        </div>
                        <div class="flex items-center p-3 hover:bg-paywise-light rounded-lg transition">
                            <div class="w-16 h-10 bg-gradient-to-r from-green-600 to-green-800 rounded mr-4 shadow-md"></div>
                            <div>
                                <h4 class="font-semibold">Petal2</h4>
                                <p class="text-sm text-gray-600">Premium card with 2% cashback</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-gradient-to-br from-paywise-light to-white py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Why Choose PayWise?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                        <i class="fas fa-lock text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Secure</h3>
                    <p class="text-gray-600">Bank-level security to protect your money and data</p>
                </div>
                <div class="text-center bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                        <i class="fas fa-bolt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Fast</h3>
                    <p class="text-gray-600">Instant transfers and real-time notifications</p>
                </div>
                <div class="text-center bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="gradient-bg text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 float-animation">
                        <i class="fas fa-chart-line text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Smart</h3>
                    <p class="text-gray-600">AI-powered insights to help you manage your finances</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="gradient-bg text-white py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <div class="flex items-center space-x-2 mb-2">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                            <i class="fas fa-chart-line text-paywise-green text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold">PAYWISE</h3>
                    </div>
                    <p class="text-sm">Your Next Online Bank.</p>
                </div>
                <div class="flex space-x-6 mb-4 md:mb-0">
                    <a href="#" class="hover:text-paywise-light transition transform hover:scale-105">Privacy Policy</a>
                    <a href="#" class="hover:text-paywise-light transition transform hover:scale-105">Terms of Service</a>
                    <a href="#" class="hover:text-paywise-light transition transform hover:scale-105">Support</a>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-paywise-light transition transform hover:scale-105"><i class="fab fa-facebook text-xl"></i></a>
                    <a href="#" class="hover:text-paywise-light transition transform hover:scale-105"><i class="fab fa-twitter text-xl"></i></a>
                    <a href="#" class="hover:text-paywise-light transition transform hover:scale-105"><i class="fab fa-instagram text-xl"></i></a>
                    <a href="#" class="hover:text-paywise-light transition transform hover:scale-105"><i class="fab fa-linkedin text-xl"></i></a>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-white/20 text-center">
                <p class="text-sm">&copy; {{ date('Y') }} PayWise. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Newsletter Subscription -->
    {{-- <div class="fixed bottom-0 right-0 bg-white shadow-2xl rounded-tl-lg p-6 max-w-sm card-hover">
        <div class="flex items-center mb-2">
            <i class="fas fa-envelope text-paywise-green text-xl mr-2"></i>
            <h3 class="text-lg font-semibold">Stay Updated</h3>
        </div>
        <p class="text-sm text-gray-600 mb-4">Subscribe to our newsletter for the latest updates</p>
        <form class="flex">
            <input type="email" placeholder="Your email" class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-paywise-green">
            <button type="submit" class="gradient-bg hover:shadow-lg text-white px-4 py-2 rounded-r-md transition transform hover:scale-105">
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>
    </div> --}}
</body>
</html>