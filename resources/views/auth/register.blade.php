<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - EDULEARN</title>
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
            background: linear-gradient(135deg, #10b981 0%, #0ea5e9 100%);
        }

        .glassmorphism {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12);
        }
    </style>
</head>

<body class="gradient-bg min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-6 animate-fade-in">
            <!-- Header -->
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-white drop-shadow mb-2">Buat Akun</h1>
                <p class="text-white/80">Daftar untuk mulai menggunakan EDULEARN</p>
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

            <!-- Error summary -->
            @if ($errors->any())
                <div class="glassmorphism rounded-2xl p-4 border border-red-200 shadow">
                    <p class="text-sm font-semibold text-red-700 mb-2">Periksa kembali input Anda:</p>
                    <ul class="list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Register Form -->
            <form class="glassmorphism p-8 rounded-3xl shadow-2xl border border-white/20 space-y-5"
                action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Role Selector -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Daftar sebagai</label>
                    <div class="grid grid-cols-2 gap-2">
                        <label
                            class="flex items-center justify-center gap-2 px-4 py-2 rounded-xl border {{ old('role', 'siswa') === 'siswa' ? 'border-emerald-500 bg-emerald-50 text-emerald-700' : 'border-gray-200 text-gray-700' }} cursor-pointer">
                            <input type="radio" name="role" value="siswa" class="hidden"
                                {{ old('role', 'siswa') === 'siswa' ? 'checked' : '' }}>
                            <span class="text-sm font-semibold">Siswa</span>
                        </label>
                        <label
                            class="flex items-center justify-center gap-2 px-4 py-2 rounded-xl border {{ old('role') === 'guru' ? 'border-emerald-500 bg-emerald-50 text-emerald-700' : 'border-gray-200 text-gray-700' }} cursor-pointer">
                            <input type="radio" name="role" value="guru" class="hidden"
                                {{ old('role') === 'guru' ? 'checked' : '' }}>
                            <span class="text-sm font-semibold">Guru</span>
                        </label>
                    </div>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Teacher Invite Code (required if role=guru) -->
                <div class="space-y-2">
                    <label for="teacher_code" class="block text-sm font-semibold text-gray-700">Kode Undangan Guru <span
                            class="text-gray-400 font-normal">(hanya untuk guru)</span></label>
                    <input id="teacher_code" name="teacher_code" type="text"
                        class="input-focus block w-full px-4 py-3.5 border rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 {{ $errors->has('teacher_code') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-200' }}"
                        placeholder="Masukkan kode undangan jika daftar sebagai Guru" value="{{ old('teacher_code') }}">
                    @error('teacher_code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                    <input id="name" name="name" type="text" autocomplete="name" required
                        class="input-focus block w-full px-4 py-3.5 border rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 {{ $errors->has('name') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-200' }}"
                        placeholder="Nama Anda" value="{{ old('name') }}">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="input-focus block w-full px-4 py-3.5 border rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 {{ $errors->has('email') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-200' }}"
                        placeholder="nama@contoh.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="input-focus block w-full px-4 pr-12 py-3.5 border rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-200' }}"
                            placeholder="Minimal 6 karakter">
                        <button type="button" onclick="togglePassword('password', 'eye-icon-password')"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
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
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Konfirmasi
                        Password</label>
                    <div class="relative">
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            autocomplete="new-password" required
                            class="input-focus block w-full px-4 pr-12 py-3.5 border rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-200' }}"
                            placeholder="Ulangi password">
                        <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-confirm')"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
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

                <!-- Submit -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full inline-flex justify-center items-center gap-2 py-3.5 px-4 text-base font-semibold rounded-xl text-white bg-linear-to-r from-emerald-600 to-cyan-600 hover:from-emerald-700 hover:to-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.01] active:scale-[0.99]">
                        Buat Akun
                    </button>
                </div>

                <p class="text-center text-sm text-gray-600">Sudah punya akun?
                    <a href="{{ route('login') }}"
                        class="font-semibold text-emerald-700 hover:text-emerald-800">Masuk</a>
                </p>
            </form>
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
