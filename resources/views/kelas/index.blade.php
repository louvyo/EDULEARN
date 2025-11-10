@extends('layout.app')

@section('title', 'Kelas Saya - MyClassroom')

@section('content')
<div class="space-y-8">
    <div class="transform transition-all duration-500 ease-in-out">
        <h1 class="text-3xl font-bold text-gray-900 transition-all duration-300">Kelas Saya</h1>
        <p class="text-gray-600 mt-2 transition-all duration-500 delay-100">Daftar kelas yang Anda ikuti.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($classes ?? [] as $class)
                @include('kelas._card', ['class' => $class])
            @empty
                <div class="col-span-1 md:col-span-2">
                    <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm text-center text-gray-500">Belum ada kelas untuk ditampilkan.</div>
                </div>
            @endforelse

            {{-- Pagination links if using LengthAwarePaginator --}}
            @if(method_exists($classes, 'links'))
                <div class="md:col-span-2 mt-4">
                    {{ $classes->links() }}
                </div>
            @endif
        </div>

        {{-- Sidebar: latest activities --}}
        <aside class="lg:col-span-1">
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                <div class="mt-4 space-y-4">
                    @forelse($latestActivities ?? [] as $act)
                        <div class="text-sm text-gray-700">
                            <div class="font-medium">{{ $act->judul ?? ($act['judul'] ?? '-') }}</div>
                            <div class="text-xs text-gray-500">{{ optional($act->waktu ?? ($act['waktu'] ?? null))->diffForHumans() ?? '' }}</div>
                            <div class="text-xs text-gray-600 mt-1">{{ Str::limit($act->deskripsi ?? ($act['deskripsi'] ?? ''), 80) }}</div>
                        </div>
                    @empty
                        <div class="text-sm text-gray-500">Belum ada aktivitas terbaru.</div>
                    @endforelse
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
