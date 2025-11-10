@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white border rounded-lg p-4 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Nilai Saya</h1>
                    <p class="text-sm text-gray-500">Ringkasan nilai dan pengumpulan tugas</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Rata-rata:</p>
                    <p class="text-xl font-semibold text-gray-900">{{ $overallAverage ? number_format($overallAverage, 2) : '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Kelas summaries --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            @forelse($kelasSummaries as $k)
            <div class="bg-white border rounded-lg p-4">
                <h3 class="text-lg font-semibold">{{ optional($k['kelas'])->name ?? 'Umum' }}</h3>
                <p class="text-sm text-gray-500">Total Tugas: {{ $k['total_tugas'] }} • Dikirim: {{ $k['submitted'] }}</p>
                <p class="mt-2 text-sm">Rata-rata kelas: <span class="font-medium">{{ $k['average'] ? number_format($k['average'], 2) : '-' }}</span></p>
                @if(optional($k['kelas'])->id)
                <a href="{{ route('kelas.detail', optional($k['kelas'])->id) }}" class="mt-3 inline-block text-sm text-blue-600">Lihat Kelas</a>
                @endif
            </div>
            @empty
            <div class="bg-white border rounded-lg p-4 col-span-2 text-center text-gray-600">
                Belum ada nilai/pengumpulan untuk user ini.
            </div>
            @endforelse
        </div>

        {{-- Recent submissions / grades --}}
        <div class="bg-white border rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-4">Pengumpulan & Nilai Terbaru</h2>
            @if($submissions->isEmpty())
                <p class="text-gray-600">Belum ada pengumpulan.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead>
                            <tr class="text-gray-600">
                                <th class="px-3 py-2">Tugas</th>
                                <th class="px-3 py-2">Kelas</th>
                                <th class="px-3 py-2">Tanggal</th>
                                <th class="px-3 py-2">Status</th>
                                <th class="px-3 py-2">Nilai</th>
                                <th class="px-3 py-2">Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($submissions as $s)
                                <tr class="border-t">
                                    <td class="px-3 py-2">{{ optional($s->tugas)->judul }}</td>
                                    <td class="px-3 py-2">{{ optional(optional($s->tugas)->kelas)->name }}</td>
                                    <td class="px-3 py-2">{{ optional($s->submitted_at)->format('d M Y H:i') }}</td>
                                    <td class="px-3 py-2"><span class="text-sm {{ $s->status === 'late' ? 'text-red-600' : 'text-green-600' }}">{{ ucfirst($s->status) }}</span></td>
                                    <td class="px-3 py-2">{{ $s->grade ?? '-' }}</td>
                                    <td class="px-3 py-2">{{ $s->feedback ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
