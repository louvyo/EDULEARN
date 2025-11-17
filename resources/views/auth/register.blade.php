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
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="input-focus block w-full px-4 py-3.5 border rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 {{ $errors->has('email') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-200' }}"
                        placeholder="nama@contoh.com" value="{{ old('email') }}">
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required
                        class="input-focus block w-full px-4 py-3.5 border rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-200' }}"
                        placeholder="Minimal 6 karakter">
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Konfirmasi
                        Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        autocomplete="new-password" required
                        class="input-focus block w-full px-4 py-3.5 border rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password') ? 'border-red-500 ring-2 ring-red-200' : 'border-gray-200' }}"
                        placeholder="Ulangi password">
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
</body>

</html>
