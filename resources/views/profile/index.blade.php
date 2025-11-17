@extends('layouts.app')

@section('title', 'Profil Saya - EduLearn')

@section('content')
    <div class="max-w-5xl mx-auto space-y-8">
        <!-- Header dengan Gradient -->
        <div class="animate-fade-in">
            <div
                class="bg-linear-to-br from-blue-500 via-indigo-600 to-purple-600 rounded-2xl shadow-xl shadow-blue-500/20 overflow-hidden relative">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -ml-24 -mb-24"></div>

                <div class="p-8 text-white relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-extrabold mb-2">👤 Profil Saya</h1>
                            <p class="text-blue-100">Kelola informasi akun, foto profil, dan kata sandi.</p>
                        </div>
                        <div class="hidden sm:block">
                            <div
                                class="w-20 h-20 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                @if ($user->avatar_path)
                                    <img src="{{ asset('storage/' . $user->avatar_path) }}" alt="Avatar"
                                        class="w-full h-full object-cover rounded-2xl">
                                @else
                                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Profile Card -->
        <div class="animate-slide-in-up">
            <div class="bg-white/90 backdrop-blur-xl rounded-2xl border border-gray-200/50 shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-linear-to-r from-gray-50 to-blue-50/30">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Informasi Profil
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Perbarui foto dan data diri Anda</p>
                </div>

                <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Avatar Section -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-24">
                            <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Foto Profil
                            </h3>
                            <div class="flex flex-col items-center gap-4 p-6 bg-linear-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-100"
                                x-data="{ previewUrl: null, maxBytes: 5 * 1024 * 1024, error: '' }">
                                <div class="relative group">
                                    <div
                                        class="w-32 h-32 rounded-2xl overflow-hidden bg-white shadow-lg ring-4 ring-blue-100 group-hover:ring-blue-300 transition-all duration-300">
                                        <template x-if="previewUrl">
                                            <img :src="previewUrl" alt="Preview Avatar"
                                                class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!previewUrl">
                                            <div class="w-full h-full flex items-center justify-center">
                                                @if ($user->avatar_path)
                                                    <img src="{{ asset('storage/' . $user->avatar_path) }}" alt="Avatar"
                                                        class="w-full h-full object-cover">
                                                @else
                                                    <svg class="w-16 h-16 text-gray-300" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                @endif
                                            </div>
                                        </template>
                                    </div>
                                    <div
                                        class="absolute inset-0 rounded-2xl bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                </div>

                                <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data"
                                    class="w-full space-y-3">
                                    @csrf
                                    <div class="relative">
                                        <input type="file" name="avatar" accept="image/*" id="avatar-input"
                                            @change="const f=$event.target.files[0]; if (f) { if (f.size > maxBytes) { error='Ukuran file terlalu besar. Maksimum 5MB.'; previewUrl=null; $event.target.value=''; } else { error=''; const r=new FileReader(); r.onload=e=>previewUrl=e.target.result; r.readAsDataURL(f); } } else { previewUrl=null; error=''; }"
                                            class="hidden" />
                                        <label for="avatar-input"
                                            class="flex items-center justify-center gap-2 w-full py-2.5 px-4 bg-white border-2 border-dashed border-blue-300 text-blue-600 rounded-xl hover:bg-blue-50 hover:border-blue-400 transition-all duration-300 cursor-pointer font-medium text-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                            </svg>
                                            Pilih Foto
                                        </label>
                                    </div>
                                    <button type="submit" :disabled="error !== '' || !previewUrl"
                                        class="w-full py-2.5 px-4 rounded-xl font-semibold text-sm transition-all duration-300 shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                                        :class="error || !previewUrl ? 'bg-gray-300 text-gray-500' :
                                            'bg-linear-to-r from-blue-600 to-indigo-600 text-white hover:from-blue-700 hover:to-indigo-700'">
                                        <span class="flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Simpan Foto
                                        </span>
                                    </button>
                                    <p class="text-xs text-center"
                                        :class="error ? 'text-red-600 font-medium' : 'text-gray-500'"
                                        x-text="error || 'PNG, JPG, WEBP. Maks 5MB.'"></p>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Info -->
                    <div class="lg:col-span-2">
                        <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Informasi Dasar
                        </h3>
                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
                            @csrf
                            @method('PUT')

                            <div
                                class="p-5 bg-gradient-to-br from-gray-50 to-blue-50/20 rounded-xl border border-gray-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Nama Lengkap
                                </label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-all duration-300 hover:border-blue-400"
                                    required>
                                <p class="text-xs text-gray-500 mt-2">Nama akan ditampilkan di seluruh platform</p>
                            </div>

                            <div
                                class="p-5 bg-gradient-to-br from-gray-50 to-purple-50/20 rounded-xl border border-gray-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Email
                                </label>
                                <input type="email" value="{{ $user->email }}"
                                    class="w-full rounded-xl border-gray-300 bg-gray-100 cursor-not-allowed" disabled>
                                <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Hubungi admin untuk mengganti email
                                </p>
                            </div>

                            <div
                                class="p-5 bg-gradient-to-br from-gray-50 to-indigo-50/20 rounded-xl border border-gray-200">
                                <div class="flex items-center justify-between mb-2">
                                    <label class="block text-sm font-semibold text-gray-700 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                        </svg>
                                        Role
                                    </label>
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold {{ $user->role === 'guru' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ $user->role === 'guru' ? '👨‍🏫 Guru' : '👨‍🎓 Siswa' }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500">Role akun Anda saat ini</p>
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit"
                                    class="group flex items-center gap-2 px-6 py-3 bg-linear-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl hover:scale-105">
                                    <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password Card -->
        <div class="animate-slide-in-up" style="animation-delay:200ms;">
            <div class="bg-white/90 backdrop-blur-xl rounded-2xl border border-gray-200/50 shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-linear-to-r from-purple-50 to-pink-50/30">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Keamanan Akun
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Perbarui kata sandi untuk menjaga keamanan akun Anda</p>
                </div>
                <form action="{{ route('profile.password') }}" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="group">
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-purple-500 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                                Kata Sandi Lama
                            </label>
                            <div class="relative">
                                <input type="password" name="current_password"
                                    class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm transition-all duration-300 hover:border-purple-400 pr-10"
                                    required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-purple-500 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                </svg>
                                Kata Sandi Baru
                            </label>
                            <div class="relative">
                                <input type="password" name="password"
                                    class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm transition-all duration-300 hover:border-purple-400 pr-10"
                                    required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-purple-500 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Konfirmasi
                            </label>
                            <div class="relative">
                                <input type="password" name="password_confirmation"
                                    class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm transition-all duration-300 hover:border-purple-400 pr-10"
                                    required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-purple-50 rounded-xl border border-purple-100">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-purple-600 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-purple-900">Kata sandi yang kuat</p>
                                <p class="text-xs text-purple-700 mt-1">Minimal 8 karakter, kombinasi huruf, angka, dan
                                    simbol</p>
                            </div>
                        </div>
                        <button type="submit"
                            class="group shrink-0 flex items-center gap-2 px-6 py-3 bg-linear-to-r from-purple-600 to-pink-600 text-white rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl hover:scale-105">
                            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                            Perbarui Kata Sandi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
