@extends('layouts.app')

@section('title', 'Kelas Saya - MyClassroom')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    <!-- Header Section with Background -->
    <div class="animate-fade-in">
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg overflow-hidden">
            <div class="p-8 text-white">
                <div class="pl-8 lg:pl-0">
                    <h1 class="text-4xl font-bold mb-2">Kelas Saya</h1>
                    <p class="text-green-100 text-lg">Daftar kelas yang Anda ikuti.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kelas Cards -->
        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($classes ?? [] as $class)
                @include('kelas.card', ['class' => $class])
            @empty
                <div class="col-span-1 md:col-span-2">
                    <div class="bg-white/80 backdrop-blur-sm p-12 rounded-2xl border border-gray-100 text-center shadow-minimal">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p class="text-gray-500 text-lg">Belum ada kelas untuk ditampilkan.</p>
                    </div>
                </div>
            @endforelse

            {{-- Pagination links if using LengthAwarePaginator --}}
            @if(method_exists($classes ?? [], 'links'))
                <div class="md:col-span-2 mt-4">
                    {{ $classes->links() }}
                </div>
            @endif
        </div>

        {{-- Sidebar: latest activities --}}
        <aside class="lg:col-span-1">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal p-6 animate-fade-in-scale" style="animation-delay: 200ms;">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Aktivitas Terbaru
                </h3>
                <div class="space-y-4">
                    @forelse($latestActivities ?? [] as $act)
                        <div class="border-l-2 border-blue-500 pl-4 py-2 hover:bg-blue-50/50 rounded-r transition-colors duration-200">
                            <div class="font-medium text-gray-900 text-sm">{{ data_get($act, 'judul', '-') }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ optional(data_get($act, 'waktu', null))->diffForHumans() ?? '' }}</div>
                            <div class="text-xs text-gray-600 mt-1">{{ Str::limit(data_get($act, 'deskripsi', ''), 80) }}</div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="text-sm text-gray-500">Belum ada aktivitas terbaru.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
