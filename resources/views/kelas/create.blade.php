@extends('layouts.app')

@section('title', 'Buat Kelas Baru - EduLearn')

@section('content')
<div class="space-y-8 max-w-4xl mx-auto">
    <!-- Header -->
    <div class="animate-fade-in">
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg overflow-hidden relative">
            <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full -mr-24 -mt-24"></div>
            <div class="p-8 text-white relative z-10">
                <div class="flex items-center gap-3 mb-2">
                    <a href="{{ route('kelas') }}" class="p-2 hover:bg-white/20 rounded-lg transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <h1 class="text-4xl font-bold">Buat Kelas Baru</h1>
                </div>
                <p class="text-purple-100 text-lg pl-14">Tambahkan kelas baru untuk siswa</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal p-8">
        <form action="{{ route('kelas.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Nama Kelas -->
            <div>
                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Kelas *</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200"
                    placeholder="Contoh: Matematika Kelas 10A">
                @error('nama')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Guru (Auto-filled, Read-only) -->
            <div>
                <label for="guru" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Guru
                    <span class="text-xs text-gray-500 font-normal">(otomatis terisi)</span>
                </label>
                <input type="text" name="guru_display" id="guru" value="{{ auth()->user()->name }}" readonly
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-600 cursor-not-allowed"
                    placeholder="Nama pengajar">
                <p class="mt-1 text-xs text-gray-500">Nama guru diambil dari akun yang login</p>
            </div>

            <!-- Semester -->
            <div>
                <label for="semester" class="block text-sm font-semibold text-gray-700 mb-2">Semester *</label>
                <input type="text" name="semester" id="semester" value="{{ old('semester', 'Ganjil 2024/2025') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200"
                    placeholder="Contoh: Ganjil 2024/2025">
                @error('semester')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Warna (Auto-generated with color picker) -->
            <div x-data="{
                color: '{{ old('warna', $defaultColor) }}',
                generateRandomColor() {
                    const hue = Math.floor(Math.random() * 360);
                    const saturation = 60 + Math.floor(Math.random() * 30);
                    const lightness = 45 + Math.floor(Math.random() * 20);
                    this.color = `hsl(${hue}, ${saturation}%, ${lightness}%)`;
                },
                hexToHsl(hex) {
                    // Convert hex to RGB first
                    let r = 0, g = 0, b = 0;
                    if (hex.length === 7) {
                        r = parseInt(hex.slice(1, 3), 16) / 255;
                        g = parseInt(hex.slice(3, 5), 16) / 255;
                        b = parseInt(hex.slice(5, 7), 16) / 255;
                    }
                    
                    // Convert RGB to HSL
                    const max = Math.max(r, g, b);
                    const min = Math.min(r, g, b);
                    let h, s, l = (max + min) / 2;
                    
                    if (max === min) {
                        h = s = 0;
                    } else {
                        const d = max - min;
                        s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
                        switch (max) {
                            case r: h = ((g - b) / d + (g < b ? 6 : 0)) / 6; break;
                            case g: h = ((b - r) / d + 2) / 6; break;
                            case b: h = ((r - g) / d + 4) / 6; break;
                        }
                    }
                    
                    h = Math.round(h * 360);
                    s = Math.round(s * 100);
                    l = Math.round(l * 100);
                    
                    return `hsl(${h}, ${s}%, ${l}%)`;
                },
                hslToHex(hsl) {
                    // Extract HSL values
                    const match = hsl.match(/hsl\((\d+),\s*(\d+)%,\s*(\d+)%\)/);
                    if (!match) return '#000000';
                    
                    let h = parseInt(match[1]) / 360;
                    let s = parseInt(match[2]) / 100;
                    let l = parseInt(match[3]) / 100;
                    
                    let r, g, b;
                    if (s === 0) {
                        r = g = b = l;
                    } else {
                        const hue2rgb = (p, q, t) => {
                            if (t < 0) t += 1;
                            if (t > 1) t -= 1;
                            if (t < 1/6) return p + (q - p) * 6 * t;
                            if (t < 1/2) return q;
                            if (t < 2/3) return p + (q - p) * (2/3 - t) * 6;
                            return p;
                        };
                        
                        const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
                        const p = 2 * l - q;
                        r = hue2rgb(p, q, h + 1/3);
                        g = hue2rgb(p, q, h);
                        b = hue2rgb(p, q, h - 1/3);
                    }
                    
                    const toHex = x => {
                        const hex = Math.round(x * 255).toString(16);
                        return hex.length === 1 ? '0' + hex : hex;
                    };
                    
                    return `#${toHex(r)}${toHex(g)}${toHex(b)}`;
                },
                get hexColor() {
                    return this.hslToHex(this.color);
                },
                updateFromHex(hex) {
                    this.color = this.hexToHsl(hex);
                },
                presetColors: [
                    { color: 'hsl(217, 91%, 60%)', label: 'Biru' },
                    { color: 'hsl(158, 64%, 52%)', label: 'Hijau' },
                    { color: 'hsl(262, 83%, 58%)', label: 'Ungu' },
                    { color: 'hsl(0, 84%, 60%)', label: 'Merah' },
                    { color: 'hsl(38, 92%, 50%)', label: 'Kuning' },
                    { color: 'hsl(330, 81%, 60%)', label: 'Pink' },
                ]
            }">
                <input type="hidden" name="warna" :value="color">
                
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    Warna Kelas
                    <span class="text-xs text-gray-500 font-normal">(warna dipilih otomatis, bisa diubah)</span>
                </label>
                
                <!-- Preview & Controls -->
                <div class="flex gap-4 mb-4">
                    <!-- Color Preview -->
                    <div class="flex-shrink-0">
                        <div class="w-24 h-24 rounded-2xl shadow-lg border-4 border-gray-200 transition-all duration-300"
                             :style="{ background: color }">
                        </div>
                        <p class="text-xs text-center mt-2 text-gray-600 font-mono" x-text="color"></p>
                    </div>
                    
                    <!-- Controls -->
                    <div class="flex-1 space-y-3">
                        <button type="button" @click="generateRandomColor()" 
                                class="w-full px-4 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-semibold hover:shadow-lg transition-all duration-300 hover:scale-105">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Generate Warna Baru
                            </span>
                        </button>
                        
                        <div>
                            <label class="block text-xs text-gray-600 mb-2">Atau pilih manual:</label>
                            <input type="color" @input="updateFromHex($event.target.value)" :value="hexColor"
                                   class="w-full h-12 rounded-xl cursor-pointer border-2 border-gray-200 hover:border-purple-400 transition-colors">
                        </div>
                    </div>
                </div>
                
                <!-- Preset Colors -->
                <div>
                    <p class="text-xs text-gray-600 mb-2">Warna preset:</p>
                    <div class="grid grid-cols-6 gap-2">
                        <template x-for="preset in presetColors" :key="preset.color">
                            <button type="button" @click="color = preset.color"
                                    class="h-12 rounded-xl border-2 transition-all duration-200 hover:scale-110"
                                    :class="color === preset.color ? 'border-gray-900 ring-4 ring-gray-200' : 'border-gray-200'"
                                    :style="{ background: preset.color }"
                                    :title="preset.label">
                            </button>
                        </template>
                    </div>
                </div>
                
                @error('warna')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200"
                    placeholder="Deskripsi atau keterangan kelas (opsional)">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-purple-500 to-purple-600 text-white py-3 px-6 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 hover:scale-105">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Buat Kelas
                    </span>
                </button>
                <a href="{{ route('kelas') }}" class="flex-1 bg-gray-100 text-gray-700 py-3 px-6 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-300 text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
