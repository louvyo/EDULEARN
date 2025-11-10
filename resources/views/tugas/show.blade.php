@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <div class="bg-white border rounded-lg p-6">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-800">{{ session('error') }}</div>
        @endif

        <h1 class="text-2xl font-bold mb-2">{{ $tugas->judul }}</h1>
        <p class="text-sm text-gray-500">Kelas: <a href="{{ route('kelas.detail', $tugas->kelas_id) }}" class="text-blue-600">{{ optional($tugas->kelas)->name }}</a> • Dibuat oleh: {{ optional($tugas->user)->name ?? 'Guru' }}</p>

        <div class="mt-4 text-gray-700">{!! nl2br(e($tugas->deskripsi)) !!}</div>

        <div class="mt-4 grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Batas waktu</p>
                <p class="font-medium">{{ optional($tugas->deadline)->format('d M Y H:i') ?? 'Tidak ada' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status</p>
                <p class="font-medium">{{ ucfirst($tugas->status ?? '---') }}</p>
            </div>
        </div>

        {{-- Submission area --}}
        <div class="mt-6 border-t pt-4">
            <h2 class="text-lg font-semibold mb-2">Pengumpulan</h2>

            @if($submission)
                <div class="bg-gray-50 border rounded p-3 mb-4">
                    <p class="text-sm text-gray-600">Anda sudah mengumpulkan pada <span class="font-medium">{{ $submission->submitted_at->format('d M Y H:i') }}</span></p>
                    @if($submission->file_path)
                        <p class="mt-2"><a href="{{ Storage::url($submission->file_path) }}" class="text-blue-600">Unduh file yang dikumpulkan</a></p>
                    @endif
                    @if($submission->content)
                        <div class="mt-2 text-gray-700">{{ $submission->content }}</div>
                    @endif
                    @if($submission->grade)
                        <div class="mt-2 text-sm text-green-700">Nilai: {{ $submission->grade }}</div>
                    @endif
                    @if($submission->feedback)
                        <div class="mt-2 text-sm text-gray-700">Feedback: {{ $submission->feedback }}</div>
                    @endif
                </div>
            @endif

            <form action="{{ route('tugas.submit', $tugas->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm text-gray-600">Upload file (opsional)</label>
                        <input type="file" name="file" class="mt-1" />
                        @error('file')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600">Isi / catatan (opsional)</label>
                        <textarea name="content" rows="4" class="w-full border rounded p-2">{{ old('content') }}</textarea>
                        @error('content')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Kumpulkan</button>
                        <a href="{{ route('tugas') }}" class="text-sm text-gray-600">Kembali ke daftar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
