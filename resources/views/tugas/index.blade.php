@extends('layouts.app')

@section('title', 'Tugas - EduLearn')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    <!-- Header Section with Background -->
    <div class="animate-fade-in">
        @php
            $isGuru = isset($isGuru) && $isGuru;
            $headerColor = $isGuru ? 'orange' : 'purple';
        @endphp
        <div class="bg-gradient-to-br from-{{ $headerColor }}-500 to-{{ $headerColor }}-600 rounded-2xl shadow-lg overflow-hidden relative">
            <!-- Decorative elements -->
            <div class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full -ml-32 -mt-32"></div>
            
            <div class="p-8 text-white relative z-10">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pl-8 lg:pl-0">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h1 class="text-4xl font-bold">{{ $isGuru ? '📝 Kelola Tugas' : '📝 Tugas Saya' }}</h1>
                            @if($isGuru)
                            <span class="px-3 py-1 bg-orange-700/50 backdrop-blur-sm rounded-full text-xs font-semibold">Guru Mode</span>
                            @else
                            <span class="px-3 py-1 bg-purple-700/50 backdrop-blur-sm rounded-full text-xs font-semibold">Siswa Mode</span>
                            @endif
                        </div>
                        <p class="text-{{ $headerColor }}-100 text-lg">{{ $isGuru ? 'Kelola tugas untuk semua kelas' : 'Daftar tugas untuk semua kelas' }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <!-- Filter Form -->
                        <form method="get" class="flex items-center gap-3">
                            <div class="relative">
                                <select name="kelas_id" id="kelas_id" class="appearance-none bg-white/20 backdrop-blur-sm border border-white/30 text-white rounded-xl px-4 py-2.5 pr-10 text-sm font-medium hover:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200">
                                    <option value="" class="text-gray-900">Semua Kelas</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id }}" class="text-gray-900" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                                <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-white pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <button type="submit" class="bg-white/20 backdrop-blur-sm border border-white/30 text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-white/30 transition-all duration-300">
                                Filter
                            </button>
                        </form>
                        
                        @if($isGuru)
                        <a href="{{ route('tugas.create') }}" class="hidden lg:flex items-center gap-2 px-6 py-3 bg-white text-orange-600 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Tugas
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Tugas List -->
        <div class="lg:col-span-2">
            @if($tugas->isEmpty())
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <p class="text-gray-500 text-lg">Belum ada tugas.</p>
                </div>
            @else
                <div class="space-y-5">
            @foreach($tugas as $t)
            <a href="{{ route('tugas.show', $t->id) }}" class="block group bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal hover:shadow-minimal-hover overflow-hidden transition-all duration-500 ease-out hover:-translate-y-2 animate-fade-in-scale">
                <div class="p-6">
                    <div class="flex items-start justify-between gap-6">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">{{ $t->judul }}</h3>
                                    <div class="flex flex-wrap items-center gap-2 mt-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-50 text-blue-700 text-xs font-semibold">
                                            {{ optional($t->kelas)->name }}
                                        </span>
                                        <span class="text-gray-400">•</span>
                                        <span class="text-sm text-gray-500">{{ $t->user->name ?? 'Guru' }}</span>
                                    </div>
                                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">{{ $t->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex-shrink-0 text-right">
                            @if(!$isGuru && isset($t->user_submission))
                                @php
                                    $submission = $t->user_submission;
                                    $hasGrade = $submission->grade !== null;
                                @endphp
                                <div class="inline-flex items-center px-3 py-1.5 rounded-lg {{ $hasGrade ? 'bg-green-50 text-green-700' : 'bg-blue-50 text-blue-700' }} text-xs font-semibold mb-3">
                                    {{ $hasGrade ? '✓ Dinilai' : '✓ Dikumpulkan' }}
                                </div>
                                @if($hasGrade)
                                    <div class="mb-2">
                                        <p class="text-xs text-gray-500 mb-1">Nilai</p>
                                        <p class="text-lg font-bold text-green-600">{{ $submission->grade }}</p>
                                    </div>
                                @endif
                            @elseif(!$isGuru)
                                <div class="inline-flex items-center px-3 py-1.5 rounded-lg bg-yellow-50 text-yellow-700 text-xs font-semibold mb-3">
                                    Belum Dikumpulkan
                                </div>
                            @endif
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Batas Waktu</p>
                                <p class="text-sm font-semibold text-gray-900">@formatDate($t->deadline)</p>
                                <p class="text-xs text-gray-500">@formatTime($t->deadline)</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center gap-4">
                        <span class="inline-flex items-center text-sm font-semibold text-blue-600 group-hover:text-blue-700 transition-colors duration-200">
                            Lihat Detail
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                        <span class="inline-flex items-center text-sm text-gray-500 group-hover:text-gray-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            Komentar
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
                </div>
            @endif
        </div>

        <!-- Sidebar: Tugas Mendatang -->
        <aside class="lg:col-span-1">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal p-6 animate-fade-in-scale sticky top-24" style="animation-delay: 200ms;">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Tugas Mendatang
                </h3>
                <div class="space-y-3">
                    @php
                        $upcomingTugas = $tugas->filter(function($t) use ($isGuru) {
                            // Hanya tampilkan tugas dengan deadline di masa depan
                            if (!$t->deadline || !$t->deadline->isFuture()) {
                                return false;
                            }

                            // Untuk siswa: sembunyikan tugas yang sudah dikumpulkan
                            if (!$isGuru && isset($t->user_submission)) {
                                return false;
                            }

                            return true;
                        })->sortBy('deadline')->take(5);
                    @endphp
                    
                    @forelse($upcomingTugas as $ut)
                        @php
                            $daysLeft = now()->diffInDays($ut->deadline, false);
                            $isUrgent = $daysLeft <= 2;
                            $borderColor = $isUrgent ? 'border-red-500' : 'border-purple-500';
                            $bgColor = $isUrgent ? 'hover:bg-red-50/50' : 'hover:bg-purple-50/50';
                        @endphp
                        <a href="{{ route('tugas.show', $ut->id) }}" class="block border-l-2 {{ $borderColor }} pl-4 py-2 {{ $bgColor }} rounded-r transition-colors duration-200">
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex-1 min-w-0">
                                    <div class="font-semibold text-gray-900 text-sm truncate">{{ $ut->judul }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ optional($ut->kelas)->name }}</div>
                                </div>
                                <div class="flex flex-col items-end gap-1">
                                    @if(!$isGuru && isset($ut->user_submission))
                                        @php
                                            $hasGrade = $ut->user_submission->grade !== null;
                                            $isLate = ($ut->user_submission->status ?? null) === 'late';
                                        @endphp
                                        <span class="flex-shrink-0 px-2 py-0.5 rounded-full text-xs font-semibold {{ $hasGrade ? 'bg-green-100 text-green-700' : ($isLate ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700') }}">
                                            {{ $hasGrade ? 'Dinilai' : ($isLate ? 'Terlambat' : 'Dikumpulkan') }}
                                        </span>
                                    @endif
                                    @if($isUrgent)
                                        <span class="flex-shrink-0 px-2 py-0.5 bg-red-100 text-red-700 text-xs font-bold rounded-full">
                                            Urgent
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <svg class="w-3.5 h-3.5 {{ $isUrgent ? 'text-red-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs {{ $isUrgent ? 'text-red-600 font-semibold' : 'text-gray-600' }} countdown" data-deadline="{{ $ut->deadline->toIso8601String() }}">
                                    Menghitung...
                                </span>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm text-gray-500">Tidak ada tugas mendatang</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
