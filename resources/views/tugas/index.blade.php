@extends('layouts.app')

@section('title', 'Tugas - EduLearn')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    <!-- Header Section with Background -->
    <div class="animate-fade-in">
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg overflow-hidden">
            <div class="p-8 text-white">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pl-8 lg:pl-0">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">Tugas</h1>
                        <p class="text-purple-100 text-lg">Daftar tugas untuk semua kelas</p>
                    </div>
                    <!-- Filter Form -->
                    <form method="get" class="flex items-center gap-3">
                        <div class="relative">
                            <select name="kelas_id" id="kelas_id" class="appearance-none bg-white/20 backdrop-blur-sm border border-white/30 text-white rounded-xl px-4 py-2.5 pr-10 text-sm font-medium hover:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200">
                                <option value="" class="text-gray-900">Semua Kelas</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id }}" class="text-gray-900" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->name }}</option>
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
                </div>
            </div>
        </div>
    </div>

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
                                        <span class="text-sm text-gray-500">{{ optional($t->user)->name ?? 'Guru' }}</span>
                                    </div>
                                    <p class="mt-3 text-sm text-gray-600 leading-relaxed">{{ $t->deskripsi }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex-shrink-0 text-right">
                            <div class="inline-flex items-center px-3 py-1.5 rounded-lg {{ $t->status === 'selesai' ? 'bg-green-50 text-green-700' : 'bg-yellow-50 text-yellow-700' }} text-xs font-semibold mb-3">
                                {{ ucfirst($t->status ?? 'pending') }}
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Batas Waktu</p>
                                <p class="text-sm font-semibold text-gray-900">{{ optional($t->deadline)->format('d M Y') ?? 'Tidak ada' }}</p>
                                <p class="text-xs text-gray-500">{{ optional($t->deadline)->format('H:i') ?? '' }}</p>
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
@endsection
