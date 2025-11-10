@extends('layouts.app')

@section('content')
@php
    // Define color values for gradient
    $colorMap = [
        'blue' => ['from' => '#60a5fa', 'to' => '#2563eb', 'light' => '#dbeafe', 'lighter' => '#eff6ff'],
        'green' => ['from' => '#4ade80', 'to' => '#16a34a', 'light' => '#d1fae5', 'lighter' => '#ecfdf5'],
        'purple' => ['from' => '#c084fc', 'to' => '#9333ea', 'light' => '#e9d5ff', 'lighter' => '#f3e8ff'],
        'red' => ['from' => '#f87171', 'to' => '#dc2626', 'light' => '#fecaca', 'lighter' => '#fee2e2'],
        'yellow' => ['from' => '#fbbf24', 'to' => '#d97706', 'light' => '#fde68a', 'lighter' => '#fef3c7'],
        'pink' => ['from' => '#f472b6', 'to' => '#db2777', 'light' => '#fbcfe8', 'lighter' => '#fce7f3'],
    ];
    $color = $kelas['color'] ?? 'blue';
    $gradientColors = $colorMap[$color] ?? $colorMap['blue'];
@endphp

<div class="space-y-8 max-w-7xl mx-auto">
    {{-- Header Kelas --}}
    <div class="animate-fade-in">
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal overflow-hidden">
            <div class="relative h-48 overflow-hidden" style="background: linear-gradient(135deg, {{ $gradientColors['from'] }}, {{ $gradientColors['to'] }});">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                <div class="absolute bottom-6 left-6 right-6 pl-8 lg:pl-0">
                    <h1 class="text-4xl font-bold text-white drop-shadow-lg">{{ $kelas['name'] }}</h1>
                    <p class="text-white/90 mt-2 drop-shadow text-lg">{{ $kelas['semester'] }} • {{ $kelas['teacher'] }}</p>
                </div>
            </div>
            
            {{-- Tab Navigation --}}
            <div class="flex border-b border-gray-100 px-6 bg-white/50 backdrop-blur-sm overflow-x-auto">
                <a href="#" class="px-5 py-4 text-sm font-semibold text-white whitespace-nowrap border-b-2 transition-all duration-300" style="color: {{ $gradientColors['to'] }}; border-color: {{ $gradientColors['to'] }};">
                    Stream
                </a>
                <a href="#" class="px-5 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-all duration-300 rounded-t-lg whitespace-nowrap">
                    Tugas Kelas
                </a>
                <a href="#" class="px-5 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-all duration-300 rounded-t-lg whitespace-nowrap">
                    Materi
                </a>
                <a href="#" class="px-5 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-all duration-300 rounded-t-lg whitespace-nowrap">
                    Anggota
                </a>
            </div>
        </div>
    </div>

    {{-- Content Area --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Content (2/3 width) --}}
        <div class="lg:col-span-2 space-y-6">
            @foreach($kelas['assignments'] ?? [] as $assignment)
            {{-- Assignment Card --}}
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal hover:shadow-minimal-hover overflow-hidden transition-all duration-300 hover:-translate-y-1 group animate-fade-in-scale">
                <div class="p-6">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300" style="background: linear-gradient(135deg, {{ $gradientColors['lighter'] }}, {{ $gradientColors['light'] }});">
                                <svg class="w-6 h-6" style="color: {{ $gradientColors['to'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex-1">
                                    <h3 class="text-base font-semibold text-gray-900 group-hover:transition-colors duration-300" style="--hover-color: {{ $gradientColors['to'] }};">{{ $assignment['title'] }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">{{ $kelas['teacher'] }} • {{ $assignment['time'] }}</p>
                                </div>
                                <span class="ml-4 inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold whitespace-nowrap" style="background-color: {{ $gradientColors['lighter'] }}; color: {{ $gradientColors['to'] }};">
                                    {{ $assignment['points'] }} poin
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $assignment['description'] }}</p>
                            <div class="mt-4 flex items-center gap-4">
                                <a href="#" class="inline-flex items-center text-sm font-semibold transition-colors duration-200" style="color: {{ $gradientColors['to'] }};">
                                    Lihat Detail
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                                <button class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                    0 komentar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @foreach($kelas['materials'] ?? [] as $material)
            {{-- Material Card --}}
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal hover:shadow-minimal-hover overflow-hidden transition-all duration-500 ease-out hover:-translate-y-2 group animate-fade-in-scale">
                <div class="p-6">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-semibold text-gray-900 group-hover:text-green-600 transition-colors duration-300">{{ $material['title'] }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $kelas['teacher'] }} • {{ $material['time'] }}</p>
                            <p class="text-sm text-gray-600 mt-2 leading-relaxed">{{ $material['description'] }}</p>
                            
                            {{-- Attachment --}}
                            <div class="mt-4 flex items-center p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 hover:border-gray-300 transition-all duration-200 group/file">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm text-gray-700 font-medium flex-1">{{ $material['file'] }}</span>
                                <button class="ml-4 p-2 text-{{ $kelas['color'] }}-600 hover:bg-{{ $kelas['color'] }}-50 rounded-lg transition-all duration-200 group-hover/file:scale-110">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Sidebar (1/3 width) --}}
        <aside class="lg:col-span-1 space-y-6">
            {{-- Upcoming Tasks --}}
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal p-6 sticky top-24 animate-fade-in-scale" style="animation-delay: 200ms;">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2" style="color: {{ $gradientColors['to'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Mendatang
                </h2>
                <div class="space-y-3">
                    @foreach($kelas['assignments'] ?? [] as $assignment)
                    <div class="flex items-start gap-3 p-3 rounded-xl transition-all duration-300 border" style="background: linear-gradient(90deg, {{ $gradientColors['lighter'] }}, transparent); border-color: {{ $gradientColors['light'] }};">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: {{ $gradientColors['light'] }};">
                            <svg class="w-5 h-5" style="color: {{ $gradientColors['to'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ $assignment['title'] }}</p>
                            <p class="text-xs text-gray-600 mt-0.5">Batas: {{ $assignment['due_date'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="#" class="mt-4 block text-center text-sm font-semibold transition-colors duration-200" style="color: {{ $gradientColors['to'] }};">
                    Lihat semua →
                </a>
            </div>

            {{-- Class Information --}}
            <div class="rounded-2xl shadow-minimal p-6 animate-fade-in-scale" style="background: linear-gradient(135deg, {{ $gradientColors['lighter'] }}, {{ $gradientColors['light'] }}); border: 1px solid {{ $gradientColors['light'] }}; animation-delay: 300ms;">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2" style="color: {{ $gradientColors['to'] }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Informasi Kelas
                </h2>
                <dl class="space-y-3 text-sm">
                    <div class="flex items-center justify-between p-3 bg-white/70 rounded-xl">
                        <dt class="text-gray-600 font-medium">Kode Kelas</dt>
                        <dd class="font-bold" style="color: {{ $gradientColors['to'] }};">{{ $kelas['code'] }}</dd>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-white/70 rounded-xl">
                        <dt class="text-gray-600 font-medium">Pengajar</dt>
                        <dd class="font-semibold text-gray-900">{{ $kelas['teacher'] }}</dd>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-white/70 rounded-xl">
                        <dt class="text-gray-600 font-medium">Jadwal</dt>
                        <dd class="font-semibold text-gray-900">{{ $kelas['schedule'] }}</dd>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-white/70 rounded-xl">
                        <dt class="text-gray-600 font-medium">Ruang</dt>
                        <dd class="font-semibold text-gray-900">{{ $kelas['room'] }}</dd>
                    </div>
                </dl>
            </div>
        </aside>
    </div>
</div>
@endsection
