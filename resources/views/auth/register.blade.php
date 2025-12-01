<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EDULEARN</title>
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
    </style>
</head>

<body class="min-h-screen mesh-gradient">
    <div class="min-h-screen flex items-center justify-center p-4 py-12">
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
                            class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-linear-to-r from-transparent via-blue-400 to-transparent rounded-full">
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
                        <p class="text-xl font-bold text-white" style="text-shadow: 0 2px 10px rgba(0,0,0,0.3);">Mulai
                            Perjalanan Belajar! 🚀</p>
                        <p class="text-white/90 text-sm font-medium">Buat akun baru</p>
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

            <!-- Register Form Card -->
            <div class="card-glass rounded-3xl shadow-2xl p-8 space-y-6">
                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama
                            Lengkap</label>
                        <input id="name" name="name" type="text" autocomplete="name" required
                            class="input-modern w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 {{ $errors->has('name') ? 'border-red-400' : '' }}"
                            placeholder="Masukkan nama lengkap" value="{{ old('name') }}">
                        @error('name')
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

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="input-modern w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 {{ $errors->has('email') ? 'border-red-400' : '' }}"
                            placeholder="nama@example.com" value="{{ old('email') }}">
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

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                class="input-modern w-full px-4 py-3.5 pr-12 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 {{ $errors->has('password') ? 'border-red-400' : '' }}"
                                placeholder="Minimal 8 karakter">
                            <button type="button" onclick="togglePassword('password', 'eye-icon-password')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg id="eye-icon-password" class="w-5 h-5" fill="none" stroke="currentColor"
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

                    <!-- Confirm Password Field -->
                    <div>
                        <label for="password_confirmation"
                            class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                autocomplete="new-password" required
                                class="input-modern w-full px-4 py-3.5 pr-12 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400"
                                placeholder="Ulangi password">
                            <button type="button"
                                onclick="togglePassword('password_confirmation', 'eye-icon-confirm')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg id="eye-icon-confirm" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Daftar Sebagai</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="role" value="guru" class="peer sr-only"
                                    {{ old('role') == 'guru' ? 'checked' : '' }} onchange="toggleInviteCode()">
                                <div
                                    class="p-4 border-2 border-gray-200 rounded-xl text-center transition-all peer-checked:border-indigo-500 peer-checked:bg-indigo-50 hover:border-gray-300">
                                    <div class="text-3xl mb-2">👨‍🏫</div>
                                    <div class="font-semibold text-gray-700 peer-checked:text-indigo-700">Guru</div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="role" value="siswa" class="peer sr-only"
                                    {{ old('role') == 'siswa' ? 'checked' : '' }} onchange="toggleInviteCode()">
                                <div
                                    class="p-4 border-2 border-gray-200 rounded-xl text-center transition-all peer-checked:border-green-500 peer-checked:bg-green-50 hover:border-gray-300">
                                    <div class="text-3xl mb-2">👨‍🎓</div>
                                    <div class="font-semibold text-gray-700 peer-checked:text-green-700">Siswa</div>
                                </div>
                            </label>
                        </div>
                        @error('role')
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

                    <!-- Invite Code Field (Only for Teachers) -->
                    <div id="invite-code-field" class="overflow-hidden transition-all duration-300 max-h-0 opacity-0">
                        <label for="teacher_code" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kode Undangan Guru
                        </label>
                        <input id="teacher_code" name="teacher_code" type="text"
                            class="input-modern w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 {{ $errors->has('teacher_code') ? 'border-red-400' : '' }}"
                            placeholder="Masukkan kode undangan guru" value="{{ old('teacher_code') }}">
                        <p class="mt-1 text-xs text-gray-500">Kode undangan wajib untuk pendaftaran Guru</p>
                        @error('teacher_code')
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

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center items-center gap-2 py-3.5 px-4 border border-transparent text-base font-semibold rounded-xl text-white bg-linear-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Daftar Sekarang
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center mt-6">
                <p class="text-sm text-white/90 drop-shadow">
                    © 2025 EDULEARN. Built with ❤️ for better learning.
                </p>
                <p class="text-sm text-white/90 drop-shadow mt-2">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                        class="font-semibold underline decoration-white/60 hover:decoration-white">Login</a>
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

        function toggleInviteCode() {
            const roleRadios = document.getElementsByName('role');
            const inviteCodeField = document.getElementById('invite-code-field');
            const teacherCodeInput = document.getElementById('teacher_code');

            let selectedRole = '';
            for (const radio of roleRadios) {
                if (radio.checked) {
                    selectedRole = radio.value;
                    break;
                }
            }

            // Smooth show/hide: animate height and opacity
            if (selectedRole === 'guru') {
                inviteCodeField.classList.remove('max-h-0', 'opacity-0');
                inviteCodeField.classList.add('max-h-[200px]', 'opacity-100', 'mt-2');
                if (teacherCodeInput) teacherCodeInput.setAttribute('required', 'required');
            } else {
                inviteCodeField.classList.add('max-h-0', 'opacity-0');
                inviteCodeField.classList.remove('max-h-[200px]', 'opacity-100', 'mt-2');
                if (teacherCodeInput) teacherCodeInput.removeAttribute('required');
            }
        }

        // Check on page load if role is already selected (for validation errors)
        document.addEventListener('DOMContentLoaded', function() {
            toggleInviteCode();
        });
    </script>
</body>

</html>
