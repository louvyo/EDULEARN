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

        body {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%);
            background-attachment: fixed;
        }

        .mesh-gradient {
            background-image:
                radial-gradient(at 27% 37%, hsla(215, 98%, 61%, 0.3) 0px, transparent 50%),
                radial-gradient(at 97% 21%, hsla(125, 98%, 72%, 0.2) 0px, transparent 50%),
                radial-gradient(at 52% 99%, hsla(354, 98%, 61%, 0.2) 0px, transparent 50%),
                radial-gradient(at 10% 29%, hsla(256, 96%, 67%, 0.3) 0px, transparent 50%),
                radial-gradient(at 97% 96%, hsla(38, 60%, 74%, 0.2) 0px, transparent 50%),
                radial-gradient(at 33% 50%, hsla(222, 67%, 73%, 0.2) 0px, transparent 50%),
                radial-gradient(at 79% 53%, hsla(343, 68%, 79%, 0.3) 0px, transparent 50%);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .card-glass {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(40px);
            -webkit-backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .input-modern:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.3);
        }
    </style>
</head>

<body class="min-h-screen mesh-gradient">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md" style="animation: fadeInUp 0.6s ease-out">

            <!-- Header Section -->
            <div class="text-center mb-8">
                <!-- Logo with Gradient Ring -->
                <div class="relative inline-block mb-6">
                    <!-- Animated gradient ring -->
                    <div class="absolute inset-0 -m-2">
                        <div
                            class="w-24 h-24 rounded-full bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 opacity-20 blur-xl animate-pulse">
                        </div>
                    </div>
                    <!-- Logo container -->
                    <div
                        class="relative bg-white rounded-3xl p-5 shadow-2xl transform hover:scale-105 hover:rotate-3 transition-all duration-300">
                        <svg class="w-12 h-12 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>

                <!-- Brand Name with Gradient -->
                <div class="space-y-4">
                    <div class="relative inline-block">
                        <h1 class="text-6xl font-black text-white mb-2 tracking-tight relative z-10"
                            style="text-shadow: 0 4px 20px rgba(0,0,0,0.5), 0 2px 8px rgba(0,0,0,0.3);">
                            EDU<span class="text-blue-300">LEARN</span>
                        </h1>
                        <!-- Decorative underline -->
                        <div
                            class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-gradient-to-r from-transparent via-blue-400 to-transparent rounded-full">
                        </div>
                    </div>

                    <!-- School Badge with Icons -->
                    <div
                        class="inline-flex items-center gap-3 px-5 py-2.5 bg-white/40 backdrop-blur-md rounded-full border-2 border-white/60 shadow-xl">
                        <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                        </svg>
                        <span class="text-base font-black text-gray-800 tracking-wide">SMK HIDAYATUL MUSLIMIN</span>
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse shadow-lg shadow-green-500/50">
                        </div>
                    </div>

                    <!-- Welcome Message -->
                    <div class="mt-4 space-y-1">
                        <p class="text-xl font-bold text-white" style="text-shadow: 0 2px 10px rgba(0,0,0,0.3);">Selamat
                            Datang Kembali! 👋</p>
                        <p class="text-white/90 text-sm font-medium">Masuk ke akun Anda</p>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="card-glass rounded-2xl p-4 border-l-4 border-green-500 shadow-lg mb-6">
                    <div class="flex items-start gap-3">
                        <div class="shrink-0">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Error Message -->
            @if (session('error'))
                <div class="card-glass rounded-2xl p-4 border-l-4 border-red-500 shadow-lg mb-6">
                    <div class="flex items-start gap-3">
                        <div class="shrink-0">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M12 2a10 10 0 100 20 10 10 0 000-20z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <!-- Login Form -->
            <form class="card-glass rounded-3xl shadow-2xl p-8 space-y-6" action="{{ route('login') }}" method="POST">
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
                        Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="input-modern w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 {{ $errors->has('email') ? 'border-red-400' : '' }}"
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
                            class="input-modern w-full pl-12 pr-12 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 {{ $errors->has('password') ? 'border-red-400' : '' }}"
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
