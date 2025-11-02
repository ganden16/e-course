<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Healthcare Remote Circle</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#ffb433',
                        'primary-dark': '#ff9500',
                        'secondary': '#ff9500',
                        'accent': '#ffb433',
                        'dark': '#1f2937',
                    }
                }
            }
        }
    </script>

    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #ffb433 0%, #ff9500 100%);
        }
        .pattern-bg {
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233b82f6' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center pattern-bg" x-data="{ showPassword: false, selectedRole: 'admin' }">
    <div class="container mx-auto px-6 py-12">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center justify-center bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Left Side - Login Form -->
                <div class="w-full lg:w-1/2 p-8 lg:p-12">
                    <!-- Logo -->
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-secondary rounded-full mb-4 float-animation">
                            <i class="fas fa-graduation-cap text-white text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Healthcare Remote Circle</h2>
                        <p class="text-gray-600 mt-2">Selamat datang kembali!</p>
                    </div>

                    <!-- Role Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Login Sebagai</label>
                        <div class="grid grid-cols-3 gap-2">
                            <button @click="selectedRole = 'admin'"
                                    :class="selectedRole === 'admin' ? 'bg-secondary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                                    class="py-2 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-user-shield mr-1"></i> Admin
                            </button>
                            <button @click="selectedRole = 'mentor'"
                                    :class="selectedRole === 'mentor' ? 'bg-secondary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                                    class="py-2 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-chalkboard-teacher mr-1"></i> Mentor
                            </button>
                            <button @click="selectedRole = 'user'"
                                    :class="selectedRole === 'user' ? 'bg-secondary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                                    class="py-2 px-4 rounded-lg text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-user mr-1"></i> User
                            </button>
                        </div>
                    </div>

                    <!-- Login Form -->
                    <form class="space-y-6">
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input id="email"
                                       name="email"
                                       type="email"
                                       autocomplete="email"
                                       required
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-secondary focus:border-secondary transition-colors duration-200"
                                       placeholder="email@example.com">
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password"
                                       name="password"
                                       :type="showPassword ? 'text' : 'password'"
                                       autocomplete="current-password"
                                       required
                                       class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-secondary focus:border-secondary transition-colors duration-200"
                                       placeholder="••••••••">
                                <button type="button"
                                        @click="showPassword = !showPassword"
                                        class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'" class="text-gray-400 hover:text-gray-600"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me"
                                       name="remember-me"
                                       type="checkbox"
                                       class="h-4 w-4 text-secondary focus:ring-secondary border-gray-300 rounded">
                                <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                                    Ingat saya
                                </label>
                            </div>
                            <div class="text-sm">
                                <a href="#" class="font-medium text-secondary hover:text-secondary-dark transition-colors duration-200">
                                    Lupa password?
                                </a>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-200 transform hover:scale-[1.02]">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Login
                            </button>
                        </div>

                        <!-- Demo Account Info -->
                        <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-xs text-blue-800">
                                <i class="fas fa-info-circle mr-1"></i>
                                <span x-show="selectedRole === 'admin'">Demo Admin: admin@healthcare.com / admin123</span>
                                <span x-show="selectedRole === 'mentor'">Demo Mentor: mentor@healthcare.com / mentor123</span>
                                <span x-show="selectedRole === 'user'">Demo User: user@healthcare.com / user123</span>
                            </p>
                        </div>
                    </form>

                    <!-- Social Login -->
                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Atau login dengan</span>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <button class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                <i class="fab fa-google text-red-500"></i>
                                <span class="ml-2">Google</span>
                            </button>
                            <button class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                <i class="fab fa-linkedin text-blue-600"></i>
                                <span class="ml-2">LinkedIn</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Hero Section -->
                <div class="w-full lg:w-1/2 bg-primary-dark text-white relative overflow-hidden p-8 lg:p-12 flex flex-col justify-center">
                    <!-- Animated Background with Orange Spiral Pattern -->
                    <div class="absolute inset-0 opacity-40 z-10">
                        <div class="absolute top-0 left-0 w-96 h-96 bg-secondary rounded-full filter blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
                        <div class="absolute top-0 left-0 w-96 h-40 bg-secondary rounded-full filter blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
                        <div class="absolute top-20 right-0 w-64 h-64 bg-secondary/80 rounded-full filter blur-2xl transform translate-x-1/3 translate-y-1/3"></div>
                        <div class="absolute bottom-20 left-1/4 w-80 h-80 bg-secondary/60 rounded-full filter blur-xl transform translate-x-1/4 translate-y-1/4"></div>
                        <div class="absolute bottom-0 right-1/3 w-72 h-72 bg-secondary/40 rounded-full filter blur-lg transform translate-x-1/3 translate-y-1/3"></div>
                        <div class="absolute top-1/2 left-1/2 w-32 h-32 bg-accent rounded-full filter blur-md transform rotate-45"></div>
                        <div class="absolute bottom-1/4 right-1/4 w-40 h-40 bg-accent/80 rounded-full filter blur-md transform -rotate-12"></div>
                        <div class="absolute top-1/3 right-1/2 w-24 h-24 bg-accent/60 rounded-full filter blur-sm transform rotate-12"></div>
                        <div class="absolute top-1/4 left-1/3 w-16 h-16 bg-secondary rounded-full"></div>
                        <div class="absolute top-1/2 right-1/3 w-20 h-20 bg-secondary/90 rounded-full"></div>
                        <div class="absolute bottom-1/3 left-1/2 w-24 h-24 bg-secondary/70 rounded-full"></div>
                        <div class="absolute bottom-1/4 right-1/2 w-32 h-32 bg-secondary/50 rounded-full"></div>
                    </div>
                    <div class="float-animation relative z-10">
                        <h1 class="text-3xl lg:text-4xl font-bold mb-6">
                            Platform E-Learning Terbaik untuk Karir Anda
                        </h1>
                        <p class="text-lg mb-8 opacity-90">
                            Bergabunglah dengan ribuan siswa yang telah mengubah karir mereka melalui kursus dan bootcamp berkualitas tinggi kami.
                        </p>

                        <!-- Features -->
                        <div class="space-y-4 mb-8">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-white/20">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium">Instruktur Berpengalaman</h3>
                                    <p class="text-sm opacity-80">Belajar dari para ahli industri dengan pengalaman nyata</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-white/20">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium">Sertifikat Bergengsi</h3>
                                    <p class="text-sm opacity-80">Dapatkan sertifikat yang diakui industri</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-white/20">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium">Belajar Fleksibel</h3>
                                    <p class="text-sm opacity-80">Akses kursus kapan saja, di mana saja</p>
                                </div>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold">15K+</div>
                                <div class="text-sm opacity-80">Siswa Aktif</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">100+</div>
                                <div class="text-sm opacity-80">Kursus</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">95%</div>
                                <div class="text-sm opacity-80">Kepuasan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Links -->
            <div class="text-center mt-8 text-sm text-gray-600">
                <p>&copy; 2024 Healthcare Remote Circle. All rights reserved.</p>
                <div class="mt-2 space-x-4">
                    <a href="#" class="hover:text-secondary transition-colors duration-200">Privacy Policy</a>
                    <a href="#" class="hover:text-secondary transition-colors duration-200">Terms of Service</a>
                    <a href="#" class="hover:text-secondary transition-colors duration-200">Contact Support</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
