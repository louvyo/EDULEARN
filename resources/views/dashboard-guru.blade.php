@extends('layouts.app')

@section('title', 'Dashboard Guru - EduLearn')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    <!-- Header Section with Background -->
    <div class="animate-fade-in">
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg overflow-hidden relative">
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
            <div class="absolute top-1/2 right-1/4 w-32 h-32 bg-white/5 rounded-full"></div>
            
            <div class="p-8 text-white relative z-10">
                <div class="pl-8 lg:pl-0">
                    <div class="flex items-center gap-3 mb-3">
                        <h1 class="text-4xl font-bold">👨‍🏫 Dashboard Guru</h1>
                        <span class="px-3 py-1 bg-purple-700/50 backdrop-blur-sm rounded-full text-xs font-semibold">Teacher Mode</span>
                    </div>
                    <p class="text-purple-100 text-lg">Selamat datang kembali, {{ auth()->user()->name }} 👋</p>
                    <p class="text-purple-200 text-sm mt-1">Kelola kelas dan pantau perkembangan siswa Anda</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($stats ?? [] as $index => $stat)
        @php
            $label = data_get($stat, 'label', '-');
            $value = data_get($stat, 'value', '-');
            $color = data_get($stat, 'color', 'gray');
            $icon = data_get($stat, 'icon', 'chart');
            $trend = data_get($stat, 'trend', '');
            
            $iconMap = [
                'book' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                'clipboard' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                'users' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                'alert' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z',
                'check' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                'star' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
            ];
            $iconPath = $iconMap[$icon] ?? $iconMap['chart'];
        @endphp
        <div class="group bg-white/80 backdrop-blur-sm p-6 rounded-2xl border border-gray-100 shadow-minimal hover:shadow-minimal-hover transition-all duration-500 ease-out hover:-translate-y-2 animate-fade-in-scale"
            style="animation-delay: {{ $index * 100 }}ms;">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 mb-2">{{ $label }}</p>
                    <p class="text-3xl font-bold text-gray-900 transition-all duration-300">{{ $value }}</p>
                </div>
                <div class="p-3 bg-gradient-to-br from-{{ $color }}-50 to-{{ $color }}-100 rounded-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-{{ $color }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}" />
                    </svg>
                </div>
            </div>
            @if($trend)
            <div class="mt-4 flex items-center text-sm">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg bg-{{ $color }}-50 text-{{ $color }}-700 font-medium">
                    {{ $trend }}
                </span>
            </div>
            @endif
        </div>
        @empty
        <div class="col-span-1 sm:col-span-2 lg:col-span-4">
            <div class="bg-white/80 backdrop-blur-sm p-8 rounded-2xl border border-gray-100 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Tidak ada statistik untuk ditampilkan.
            </div>
        </div>
        @endforelse
    </div>

    <!-- Quick Actions for Guru -->
    <div class="animate-slide-in-up" style="animation-delay: 400ms;">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Aksi Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('kelas.create') }}" class="group bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-2xl text-white hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-1">Buat Kelas Baru</h3>
                <p class="text-blue-100 text-sm">Tambahkan kelas baru untuk siswa</p>
            </a>

            <a href="{{ route('tugas.create') }}" class="group bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-2xl text-white hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-1">Buat Tugas Baru</h3>
                <p class="text-green-100 text-sm">Berikan tugas kepada siswa</p>
            </a>

            <a href="{{ route('nilai') }}" class="group bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-2xl text-white hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-1">Nilai Tugas</h3>
                <p class="text-orange-100 text-sm">Beri nilai pada pengumpulan siswa</p>
            </a>
        </div>
    </div>

    <!-- Kelas yang Diampu -->
    <div class="animate-slide-in-right" style="animation-delay: 600ms;">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Kelas yang Diampu</h2>
            <a href="{{ route('kelas') }}" class="text-purple-600 hover:text-purple-700 font-medium text-sm flex items-center gap-2 transition-colors duration-200">
                Lihat semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($classes ?? [] as $index => $class)
            @php
                $cTitle = data_get($class, 'title', data_get($class, 'nama', '-'));
                $cColor = data_get($class, 'color', data_get($class, 'warna', 'blue'));
                $totalSiswa = data_get($class, 'total_siswa', 0);
                $totalTugas = data_get($class, 'total_tugas', 0);
                $cId = data_get($class, 'id', null);
                
                // Define color values for gradient
                $colorMap = [
                    'blue' => ['from' => '#60a5fa', 'to' => '#2563eb', 'lighter' => '#dbeafe', 'light' => '#bfdbfe'],
                    'green' => ['from' => '#4ade80', 'to' => '#16a34a', 'lighter' => '#d1fae5', 'light' => '#a7f3d0'],
                    'purple' => ['from' => '#c084fc', 'to' => '#9333ea', 'lighter' => '#e9d5ff', 'light' => '#d8b4fe'],
                    'red' => ['from' => '#f87171', 'to' => '#dc2626', 'lighter' => '#fee2e2', 'light' => '#fecaca'],
                    'yellow' => ['from' => '#fbbf24', 'to' => '#d97706', 'lighter' => '#fef3c7', 'light' => '#fde68a'],
                    'pink' => ['from' => '#f472b6', 'to' => '#db2777', 'lighter' => '#fce7f3', 'light' => '#fbcfe8'],
                ];
                $gradientColors = $colorMap[$cColor] ?? $colorMap['blue'];
            @endphp
            <div class="group bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal hover:shadow-minimal-hover overflow-hidden transition-all duration-500 ease-out hover:-translate-y-2 animate-fade-in-scale"
                style="animation-delay: {{ ($index + 7) * 150 }}ms;">
                <!-- Gradient stripe at top -->
                <div class="h-2 transition-all duration-300 group-hover:h-3" 
                     style="background: linear-gradient(to right, {{ $gradientColors['from'] }}, {{ $gradientColors['to'] }});"></div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1 transition-colors duration-300">{{ $cTitle }}</h3>
                    <p class="text-sm text-gray-500 mb-4">Semester Ganjil 2024/2025</p>
                    
                    <!-- Stats Kelas untuk Guru -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="bg-gray-50 rounded-xl p-3">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span class="text-xs text-gray-600 font-medium">Siswa</span>
                            </div>
                            <p class="text-xl font-bold" style="color: {{ $gradientColors['to'] }};">{{ $totalSiswa }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-3">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <span class="text-xs text-gray-600 font-medium">Tugas</span>
                            </div>
                            <p class="text-xl font-bold" style="color: {{ $gradientColors['to'] }};">{{ $totalTugas }}</p>
                        </div>
                    </div>

                    <a href="{{ $cId ? route('kelas.detail', ['id' => $cId]) : '#' }}" 
                       class="block text-center py-3 px-4 rounded-xl transition-all duration-300 font-semibold group-hover:scale-105"
                       style="background-color: white; color: {{ $gradientColors['to'] }};"
                       onmouseover="this.style.backgroundColor='{{ $gradientColors['lighter'] }}'"
                       onmouseout="this.style.backgroundColor='white'">
                        Kelola Kelas
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                <div class="bg-white/80 backdrop-blur-sm p-12 rounded-2xl border border-gray-100 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <p class="text-gray-500 text-lg mb-2">Belum ada kelas untuk ditampilkan.</p>
                    <p class="text-gray-400 text-sm mb-4">Mulai dengan membuat kelas pertama Anda</p>
                    <button class="mt-4 px-6 py-2.5 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition-colors duration-200 font-medium">
                        Buat Kelas Pertama
                    </button>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Tugas Terbaru -->
    @if(isset($tugasTerbaru) && $tugasTerbaru->count() > 0)
    <div class="animate-slide-in-left" style="animation-delay: 800ms;">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Tugas yang Baru Dibuat</h2>
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal overflow-hidden">
            <div class="divide-y divide-gray-100">
                @foreach($tugasTerbaru as $tugas)
                <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $tugas->judul }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $tugas->kelas->nama ?? 'Kelas tidak diketahui' }}</p>
                            <div class="flex items-center gap-4 text-xs text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Deadline: {{ \Carbon\Carbon::parse($tugas->deadline)->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('tugas.show', $tugas->id) }}" class="px-4 py-2 bg-purple-50 text-purple-600 rounded-xl hover:bg-purple-100 transition-colors duration-200 font-medium text-sm">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
