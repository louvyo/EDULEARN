@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto animate-fade-in">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Tugas</h1>
        <p class="text-gray-600">Perbarui informasi tugas {{ $tugas->judul }}</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal overflow-hidden">
        <!-- Header with gradient -->
        <div class="p-6 bg-gradient-to-r from-orange-500 to-orange-600">
            <div class="flex items-center gap-3 text-white">
                <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold">Form Edit Tugas</h2>
                    <p class="text-orange-100 text-sm">Lengkapi formulir di bawah ini</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('tugas.update', $tugas->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul Tugas -->
            <div>
                <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Tugas <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="judul" 
                    name="judul" 
                    value="{{ old('judul', $tugas->judul) }}"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-200 @error('judul') border-red-300 @enderror"
                    placeholder="Contoh: Tugas Matematika - Persamaan Linear"
                    required
                >
                @error('judul')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Kelas -->
            <div>
                <label for="kelas_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Kelas <span class="text-red-500">*</span>
                </label>
                <select 
                    id="kelas_id" 
                    name="kelas_id" 
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-200 @error('kelas_id') border-red-300 @enderror"
                    required
                >
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}" {{ old('kelas_id', $tugas->kelas_id) == $k->id ? 'selected' : '' }}>
                            {{ $k->nama }} - {{ $k->guru }}
                        </option>
                    @endforeach
                </select>
                @error('kelas_id')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi Tugas <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="deskripsi" 
                    name="deskripsi" 
                    rows="6"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-200 @error('deskripsi') border-red-300 @enderror"
                    placeholder="Tuliskan deskripsi atau instruksi tugas secara detail..."
                    required
                >{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Deadline & Poin -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Deadline -->
                <div>
                    <label for="deadline" class="block text-sm font-semibold text-gray-700 mb-2">
                        Batas Waktu <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="datetime-local" 
                        id="deadline" 
                        name="deadline" 
                        value="{{ old('deadline', $tugas->deadline ? $tugas->deadline->format('Y-m-d\TH:i') : '') }}"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-200 @error('deadline') border-red-300 @enderror"
                        required
                    >
                    @error('deadline')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Poin -->
                <div>
                    <label for="poin" class="block text-sm font-semibold text-gray-700 mb-2">
                        Poin <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="poin" 
                        name="poin" 
                        value="{{ old('poin', $tugas->poin) }}"
                        min="0" 
                        max="100"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-200 @error('poin') border-red-300 @enderror"
                        placeholder="0-100"
                        required
                    >
                    @error('poin')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl font-semibold hover:from-orange-600 hover:to-orange-700 transition-all duration-300 shadow-sm hover:shadow-md hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('tugas') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
