@extends('layouts.app')

@section('title', 'Dashboard - EduLearn')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    <!-- Header Section with Background -->
    <div class="animate-fade-in">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg overflow-hidden">
            <div class="p-8 text-white">
                <div class="pl-8 lg:pl-0">
                    <h1 class="text-4xl font-bold mb-2">Dashboard</h1>
                    <p class="text-blue-100 text-lg">Selamat datang kembali, Murid 👋</p>
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
            $trend = data_get($stat, 'trend', '');
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
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

    <!-- Kelas Saya Section -->
    <div class="animate-slide-in-right" style="animation-delay: 400ms;">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Kelas Saya</h2>
            <a href="{{ route('kelas') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center gap-2 transition-colors duration-200">
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
                $cProgress = (int) data_get($class, 'progress', 0);
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
                style="animation-delay: {{ ($index + 4) * 150 }}ms;">
                <!-- Gradient stripe at top -->
                <div class="h-2 transition-all duration-300 group-hover:h-3" 
                     style="background: linear-gradient(to right, {{ $gradientColors['from'] }}, {{ $gradientColors['to'] }});"></div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1 transition-colors duration-300">{{ $cTitle }}</h3>
                    <p class="text-sm text-gray-500 mb-4">Semester Ganjil 2024/2025</p>
                    
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="flex justify-between text-xs text-gray-600 mb-2">
                            <span class="font-medium">Progress Kelas</span>
                            <span class="font-bold" style="color: {{ $gradientColors['to'] }};">{{ $cProgress }}%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                            <div class="h-2 rounded-full transition-all duration-[1500ms] ease-out shadow-sm"
                                data-progress="{{ $cProgress }}"
                                style="width: 0%; background: linear-gradient(to right, {{ $gradientColors['from'] }}, {{ $gradientColors['to'] }});">
                            </div>
                        </div>
                    </div>

                    <a href="{{ $cId ? route('kelas.detail', ['id' => $cId]) : '#' }}" 
                       class="block text-center py-3 px-4 rounded-xl transition-all duration-300 font-semibold group-hover:scale-105"
                       style="background-color: white; color: {{ $gradientColors['to'] }};"
                       onmouseover="this.style.backgroundColor='{{ $gradientColors['lighter'] }}'"
                       onmouseout="this.style.backgroundColor='white'">
                        Masuk Kelas
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                <div class="bg-white/80 backdrop-blur-sm p-12 rounded-2xl border border-gray-100 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <p class="text-gray-500 text-lg">Belum ada kelas untuk ditampilkan.</p>
                    <button class="mt-4 px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors duration-200 font-medium">
                        Tambah Kelas
                    </button>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection