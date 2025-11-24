<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EDULEARN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 20s infinite ease-in-out;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            top: 60%;
            left: 80%;
            animation-delay: 4s;
        }

        .shape:nth-child(3) {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50% 50% 0 50%;
            top: 40%;
            left: 5%;
            animation-delay: 2s;
        }

        .shape:nth-child(4) {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            top: 80%;
            left: 70%;
            animation-delay: 6s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(180deg);
            }
        }

        .glassmorphism {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
    </style>
</head>

<body class="gradient-bg min-h-screen">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-md w-full space-y-6 animate-fade-in">
            <!-- Logo & Header -->
            <div class="text-center">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 mb-6 bg-white rounded-2xl shadow-lg animate-fade-in-scale">
                    <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h2 class="text-4xl font-bold text-white drop-shadow-lg mb-2">
                    Welcome Back! 👋
                </h2>
                <p class="text-purple-100 text-lg">
                    Login ke akun EDULEARN Anda
                </p>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="glassmorphism rounded-2xl p-4 border border-white/20 shadow-lg animate-slide-in-up">
                    <div class="flex items-start gap-3">
                        <div class="shrink-0">
                            <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Error Message -->
            @if (session('error'))
                <div class="glassmorphism rounded-2xl p-4 border border-red-200 shadow-lg animate-slide-in-up">
                    <div class="flex items-start gap-3">
                        <div class="shrink-0">
                            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M12 2a10 10 0 100 20 10 10 0 000-20z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-red-700">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form class="glassmorphism p-8 rounded-3xl shadow-2xl border border-white/20 space-y-6"
                action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Social Login -->
                <div class="space-y-4">
                    <a href="{{ route('oauth.google.redirect') }}"
                        class="w-full inline-flex items-center justify-center gap-3 py-3.5 px-4 rounded-xl border border-gray-200 bg-white text-gray-900 hover:bg-gray-50 shadow-sm hover:shadow transition-all duration-200">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21.35 11.1H12v2.9h5.35c-.25 1.5-1.8 4.4-5.35 4.4A6.4 6.4 0 0 1 5.6 12a6.4 6.4 0 0 1 6.4-6.4c3.65 0 5.15 2.3 5.65 3.4l2.55-2.45C18.7 4.1 16.35 3 12 3 6.5 3 2 7.5 2 13s4.5 10 10 10c5.75 0 9.55-4.05 9.55-9.75 0-.65-.1-1.1-.2-1.65Z"
                                fill="#4285F4" />
                        </svg>
                        <span class="font-semibold">Lanjutkan dengan Google</span>
                    </a>

                    <div class="flex items-center gap-4">
                        <div class="h-px bg-gray-200 flex-1"></div>
                        <span class="text-xs text-gray-500 font-medium">atau login dengan email</span>
                        <div class="h-px bg-gray-200 flex-1"></div>
                    </div>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="input-focus block w-full pl-12 pr-4 py-3.5 border rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('email') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-200' }}"
                            placeholder="nama@contoh.com" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-gray-700">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password"
                            required
                            class="input-focus block w-full pl-12 pr-12 py-3.5 border rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-200' }}"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePassword('password', 'eye-icon-login')"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                            <svg id="eye-icon-login" class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded transition-all duration-200">
                    <label for="remember" class="ml-2 block text-sm font-medium text-gray-700">
                        Ingat saya
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center items-center gap-2 py-3.5 px-4 border border-transparent text-base font-semibold rounded-xl text-white bg-linear-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Login Sekarang
                    </button>
                </div>

                <!-- Demo Credentials -->
                <div class="pt-6 border-t border-gray-200">
                    <p class="text-xs font-semibold text-gray-600 text-center mb-4">🎭 Demo Akun untuk Testing</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div
                            class="group bg-linear-to-br from-blue-50 to-blue-100 p-4 rounded-xl border border-blue-200 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center gap-2 mb-2">
                                <div
                                    class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white text-lg">
                                    👨‍🏫
                                </div>
                                <p class="font-bold text-blue-900">Guru</p>
                            </div>
                            <p class="text-xs text-blue-700 font-medium mb-0.5">guru@edulearn.com</p>
                            <p class="text-xs text-blue-600">Password: password</p>
                        </div>
                        <div
                            class="group bg-linear-to-br from-green-50 to-green-100 p-4 rounded-xl border border-green-200 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center gap-2 mb-2">
                                <div
                                    class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center text-white text-lg">
                                    👨‍🎓
                                </div>
                                <p class="font-bold text-green-900">Siswa</p>
                            </div>
                            <p class="text-xs text-green-700 font-medium mb-0.5">murid@edulearn.com</p>
                            <p class="text-xs text-green-600">Password: password</p>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Footer -->
            <div class="text-center">
                <p class="text-sm text-white/90 drop-shadow">
                    © 2025 EDULEARN. Built with ❤️ for better learning.
                </p>
                <p class="text-sm text-white/90 drop-shadow mt-2">
                    Belum punya akun?
                    <a href="{{ route('register') }}"
                        class="font-semibold underline decoration-white/60 hover:decoration-white">Daftar</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        }
    </script>
</body>

</html>
