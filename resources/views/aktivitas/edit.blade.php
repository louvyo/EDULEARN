@extends('layouts.app')

@section('title', 'Edit Aktivitas - EduLearn')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-8 text-white">
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('kelas.detail', $kelas->id) }}" class="hover:bg-white/20 p-2 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-3xl font-bold">✏️ Edit {{ $aktivitas->tipe === 'pengumuman' ? 'Pengumuman' : 'Materi' }}
                </h1>
            </div>
            <p class="text-purple-100 ml-14">Kelas: {{ $kelas->nama }}</p>
        </div>

        <!-- Form -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal p-8">
            <form action="{{ route('aktivitas.update', $aktivitas->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Tipe -->
                <div class="mb-6">
                    <label for="tipe" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tipe <span class="text-red-500">*</span>
                    </label>
                    <select name="tipe" id="tipe" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300">
                        <option value="materi" {{ old('tipe', $aktivitas->tipe) == 'materi' ? 'selected' : '' }}>Materi
                            Pembelajaran</option>
                        <option value="pengumuman" {{ old('tipe', $aktivitas->tipe) == 'pengumuman' ? 'selected' : '' }}>
                            Pengumuman</option>
                    </select>
                    @error('tipe')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Judul -->
                <div class="mb-6">
                    <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $aktivitas->judul) }}"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300">
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="5"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300"
                        placeholder="Tulis deskripsi singkat...">{{ old('deskripsi', $aktivitas->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- File saat ini -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Lampiran</label>
                    @if ($aktivitas->file_path)
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-200 mb-3">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <span
                                class="text-sm text-gray-700 flex-1 truncate">{{ basename($aktivitas->file_path) }}</span>
                            <a href="{{ route('aktivitas.download', $aktivitas->id) }}"
                                class="px-2 py-1 rounded-lg text-purple-700 bg-purple-50 hover:bg-purple-100 transition">Download</a>
                        </div>
                        <label class="inline-flex items-center gap-2 mb-3">
                            <input type="checkbox" name="remove_file" value="1"
                                class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <span class="text-sm text-gray-700">Hapus lampiran</span>
                        </label>
                    @endif

                    <input type="file" name="file"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300">
                    <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti file.</p>
                    @error('file')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('kelas.detail', $kelas->id) }}"
                        class="px-4 py-2 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition">Batal</a>
                    <button type="submit" class="px-4 py-2 rounded-lg text-white"
                        style="background: linear-gradient(135deg, #a855f7, #6b21a8)">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
