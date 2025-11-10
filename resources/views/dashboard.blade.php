@extends('layout.app')

@section('title', 'Dashboard - MyClassroom')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="transform transition-all duration-500 ease-in-out">
        <h1 class="text-3xl font-bold text-gray-900 transition-all duration-300">Dashboard</h1>
        <p class="text-gray-600 mt-2 transition-all duration-500 delay-100">Selamat datang, Murid 👋 - Selamat belajar hari ini!</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($stats ?? [] as $index => $stat)
        @php
            // make safe defaults
            $label = $stat['label'] ?? '-';
            $value = isset($stat['value']) ? $stat['value'] : '-';
            $color = $stat['color'] ?? 'gray';
            $trend = $stat['trend'] ?? '';
        @endphp
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg"
             style="transition-delay: {{ $index * 100 }}ms">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 transition-colors duration-300">{{ $label }}</p>
                    <p class="text-2xl font-bold text-gray-900 mt-2 transition-all duration-500">{{ $value }}</p>
                </div>
                <div class="p-3 bg-{{ $color }}-50 rounded-lg transition-all duration-300">
                    <!-- Icon akan disesuaikan -->
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm text-{{ $color }}-600 transition-colors duration-300">
                <span>{{ $trend }}</span>
            </div>
        </div>
        @empty
        <div class="col-span-1 sm:col-span-2 lg:col-span-4">
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm text-center text-gray-500">Tidak ada statistik untuk ditampilkan.</div>
        </div>
        @endforelse
    </div>

    <!-- Kelas Saya Section -->
    <div class="transition-all duration-500 ease-in-out">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 transition-all duration-300">Kelas Saya</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($classes ?? [] as $index => $class)
            @php
                $cTitle = $class['title'] ?? ($class->nama ?? '-');
                $cColor = $class['color'] ?? ($class->warna ?? 'blue');
                $cProgress = isset($class['progress']) ? (int) $class['progress'] : 0;
                $cId = $class['id'] ?? ($class->id ?? null);
            @endphp
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg"
                 style="transition-delay: {{ $index * 150 }}ms">
                <div class="h-4 bg-{{ $cColor }}-500 transition-all duration-300"></div>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 transition-all duration-300">{{ $cTitle }}</h3>
                    
                    <!-- Progress Bar -->
                    <div class="mt-4 transition-all duration-500">
                        <div class="flex justify-between text-xs text-gray-600 mb-2 transition-all duration-300">
                            <span>Progress Kelas</span>
                            <span>{{ $cProgress }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 transition-all duration-500">
                            {{-- Apply width directly to avoid Alpine timing/parsing issues so all bars show immediately --}}
                            <div class="h-2 rounded-full bg-{{ $cColor }}-600 transition-all duration-1000 ease-out"
                                 style="width: {{ $cProgress }}%">
                            </div>
                        </div>
                    </div>

                    <a href="{{ $cId ? route('kelas.detail', ['id' => $cId]) : '#' }}" 
                       class="mt-4 block text-center py-2 px-4 bg-{{ $cColor }}-50 text-{{ $cColor }}-700 rounded-lg hover:bg-{{ $cColor }}-100 transition-all duration-300 transform hover:scale-105 font-medium">
                        Masuk Kelas
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm text-center text-gray-500">Belum ada kelas untuk ditampilkan.</div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection