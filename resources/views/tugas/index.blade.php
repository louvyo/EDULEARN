@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white border rounded-lg p-4 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Tugas</h1>
                    <p class="text-sm text-gray-500">Daftar tugas untuk semua kelas</p>
                </div>
                <form method="get" class="flex items-center space-x-2">
                    <label for="kelas_id" class="sr-only">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="border rounded px-2 py-1 text-sm">
                        <option value="">Semua Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-600 text-white text-sm px-3 py-1 rounded">Filter</button>
                </form>
            </div>
        </div>

        @if($tugas->isEmpty())
            <div class="bg-white border rounded-lg p-6 text-center text-gray-600">
                Belum ada tugas.
            </div>
        @else
            <div class="space-y-4">
                @foreach($tugas as $t)
                <div class="bg-white rounded-lg border shadow-sm overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $t->judul }}</h3>
                                <p class="text-sm text-gray-500">Kelas: <a href="{{ route('kelas.detail', $t->kelas_id) }}" class="text-blue-600">{{ optional($t->kelas)->name }}</a> • Dibuat oleh: {{ optional($t->user)->name ?? 'Guru' }}</p>
                                <p class="mt-2 text-sm text-gray-700">{{ $t->deskripsi }}</p>
                            </div>
                            <div class="ml-4 text-right">
                                <p class="text-sm text-gray-500">Batas</p>
                                <p class="text-sm font-medium text-gray-900">{{ optional($t->deadline)->format('d M Y H:i') ?? 'Tidak ada' }}</p>
                                <p class="mt-2 text-sm {{ $t->status === 'selesai' ? 'text-green-600' : 'text-yellow-600' }}">{{ ucfirst($t->status ?? 'pending') }}</p>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center space-x-3">
                            <a href="#" class="text-sm text-{{ $t->kelas->color ?? 'blue' }}-600 font-medium">Lihat Detail</a>
                            <span class="text-gray-300">•</span>
                            <button class="text-sm text-gray-500">Komentar</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
