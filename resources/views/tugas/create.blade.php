@extends('layouts.app')

@section('title', 'Buat Tugas Baru - EduLearn')

@section('content')
    <div class="space-y-8 max-w-4xl mx-auto">
        <!-- Header -->
        <div class="animate-fade-in">
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl shadow-lg overflow-hidden relative">
                <div class="absolute top-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mt-24"></div>
                <div class="p-8 text-white relative z-10">
                    <div class="flex items-center gap-3 mb-2">
                        <a href="{{ route('tugas') }}" class="p-2 hover:bg-white/20 rounded-lg transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </a>
                        <h1 class="text-4xl font-bold">Buat Tugas Baru</h1>
                    </div>
                    <p class="text-orange-100 text-lg pl-14">Tambahkan tugas baru untuk siswa</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal p-8">
            <form action="{{ route('tugas.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Kelas -->
                <div>
                    <label for="kelas_id" class="block text-sm font-semibold text-gray-700 mb-2">Kelas *</label>
                    <select name="kelas_id" id="kelas_id" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all duration-200">
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Judul Tugas -->
                <div>
                    <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">Judul Tugas *</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all duration-200"
                        placeholder="Contoh: Tugas Matematika - Persamaan Linear">
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Tugas *</label>
                    <textarea name="deskripsi" id="deskripsi" rows="6" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all duration-200"
                        placeholder="Jelaskan detail tugas, instruksi pengerjaan, dan kriteria penilaian...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deadline dan Poin -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="deadline" class="block text-sm font-semibold text-gray-700 mb-2">Deadline *</label>
                        <input type="datetime-local" name="deadline" id="deadline" value="{{ old('deadline') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all duration-200">
                        @error('deadline')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="poin" class="block text-sm font-semibold text-gray-700 mb-2">Poin (0-100)</label>
                        <input type="number" name="poin" id="poin" value="{{ old('poin', 100) }}" min="0"
                            max="100"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all duration-200"
                            placeholder="100">
                        @error('poin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-4">
                    <button type="submit"
                        class="flex-1 bg-gradient-to-r from-orange-500 to-orange-600 text-white py-3 px-6 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 hover:scale-105">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Buat Tugas
                        </span>
                    </button>
                    <a href="{{ route('tugas') }}"
                        class="flex-1 bg-gray-100 text-gray-700 py-3 px-6 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-300 text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
