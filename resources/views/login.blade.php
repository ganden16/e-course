<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Healthcare Remote Circle</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo1.png') }}">
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
                        // 'secondary': '#ff9500',
                        'secondary': '#009b77',
                        'secondary-dark': '#174e47',
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
                        <a href="/">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-secondary rounded-full mb-4 float-animation">
                                <i class="fas fa-graduation-cap text-white text-2xl"></i>
                            </div>
                        </a>
                        <h2 class="text-2xl font-bold text-gray-800">Healthcare Remote Circle</h2>
                        <p class="text-gray-600 mt-2">Selamat datang kembali admin!</p>

                        <!-- Flash Messages -->
                        @if(session('error'))
                            <div class="mt-4 bg-red-50 border border-red-200 rounded-lg p-3">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-circle text-red-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-red-800">{{ session('error') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="mt-4 bg-green-50 border border-green-200 rounded-lg p-3">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-green-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-green-800">{{ session('success') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Login Form -->
                    <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                        @csrf
                        <!-- Username Field -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                                Username
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input id="username"
                                       name="username"
                                       type="text"
                                       autocomplete="username"
                                       value="{{ old('username') }}"
                                       required
                                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-secondary focus:border-secondary transition-colors duration-200 @error('username') border-red-500 @enderror"
                                       placeholder="Masukkan username">
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
                                       class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-secondary focus:border-secondary transition-colors duration-200 @error('password') border-red-500 @enderror"
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
                                       {{ old('remember-me') ? 'checked' : '' }}
                                       class="h-4 w-4 text-secondary focus:ring-secondary border-gray-300 rounded">
                                <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                                    Ingat saya
                                </label>
                            </div>
                        </div>

                        <!-- Error Message -->
                        @error('username')
                            <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-circle text-red-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">
                                            {{ $message }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        @enderror

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-secondary hover:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary transition-all duration-200 transform hover:scale-[1.02]">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Login
                            </button>
                        </div>

                        <!-- Demo Account Info -->
                        <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-xs text-blue-800">
                                <i class="fas fa-info-circle mr-1"></i>
                                Demo Admin: admin / admin123
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Right Side - Hero Section -->
                {{-- <div class="w-full lg:w-1/2 bg-primary-dark text-white relative overflow-hidden p-8 lg:p-12 flex flex-col justify-center">
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
                            Bergabunglah dengan ribuan orang yang telah mengubah karir mereka melalui kursus dan bootcamp berkualitas tinggi kami.
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
                                <div class="text-sm opacity-80">Orang Aktif</div>
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
                </div> --}}
            </div>

            <!-- Footer Links -->
            <div class="text-center mt-5 text-sm text-gray-600">
                <p>&copy; 2025 Healthcare Remote Circle. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
