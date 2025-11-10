@extends('layout.app')

@section('content')
<div class="p-6">
    {{-- Header Kelas --}}
    <div class="bg-white border-b">
        <div class="relative h-32 bg-{{ $kelas['color'] }}-600">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute bottom-4 left-4">
                <h1 class="text-2xl font-bold text-white">{{ $kelas['name'] }}</h1>
                <p class="text-{{ $kelas['color'] }}-100">{{ $kelas['semester'] }} • {{ $kelas['teacher'] }}</p>
            </div>
        </div>
        
        {{-- Tab Navigation --}}
        <div class="flex border-b px-4">
            <a href="#" class="px-4 py-3 text-sm font-medium text-blue-600 border-b-2 border-blue-600">
                Stream
            </a>
            <a href="#" class="px-4 py-3 text-sm font-medium text-gray-500 hover:text-gray-700">
                Tugas Kelas
            </a>
            <a href="#" class="px-4 py-3 text-sm font-medium text-gray-500 hover:text-gray-700">
                Materi
            </a>
            <a href="#" class="px-4 py-3 text-sm font-medium text-gray-500 hover:text-gray-700">
                Anggota
            </a>
        </div>
    </div>

    {{-- Content Area --}}
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="grid grid-cols-3 gap-6">
            {{-- Main Content (2/3 width) --}}
            <div class="col-span-2 space-y-4">
                {{-- Stream Items --}}
                <div class="space-y-4">
                    @foreach($kelas['assignments'] as $assignment)
                    {{-- Assignment Posted --}}
                    <div class="bg-white rounded-lg border shadow-sm overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-{{ $kelas['color'] }}-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-{{ $kelas['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-base font-semibold text-gray-900">Tugas: {{ $assignment['title'] }}</h3>
                                            <p class="text-sm text-gray-500">{{ $kelas['teacher'] }} • {{ $assignment['time'] }}</p>
                                        </div>
                                        <p class="text-sm font-medium text-{{ $kelas['color'] }}-600">{{ $assignment['points'] }} poin</p>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600">{{ $assignment['description'] }}</p>
                                    <div class="mt-3 flex items-center space-x-4">
                                        <a href="#" class="text-sm font-medium text-{{ $kelas['color'] }}-600 hover:text-{{ $kelas['color'] }}-700">Lihat Detail</a>
                                        <span class="text-gray-300">•</span>
                                        <button class="text-sm text-gray-500 hover:text-gray-700">0 komentar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @foreach($kelas['materials'] as $material)
                    {{-- Material Posted --}}
                    <div class="bg-white rounded-lg border shadow-sm overflow-hidden">
                        <div class="p-4">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-base font-semibold text-gray-900">Materi: {{ $material['title'] }}</h3>
                                            <p class="text-sm text-gray-500">{{ $kelas['teacher'] }} • {{ $material['time'] }}</p>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-sm text-gray-600">{{ $material['description'] }}</p>
                                    {{-- Attachment --}}
                                    <div class="mt-3 flex items-center p-3 bg-gray-50 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-sm text-gray-600">{{ $material['file'] }}</span>
                                        <button class="ml-auto text-{{ $kelas['color'] }}-600 hover:text-{{ $kelas['color'] }}-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="mt-3 flex items-center space-x-4">
                                        <button class="text-sm text-gray-500 hover:text-gray-700">0 komentar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Sidebar (1/3 width) --}}
            <div class="space-y-4">
                {{-- Upcoming --}}
                <div class="bg-white rounded-lg border shadow-sm p-4">
                    <h2 class="text-base font-medium text-gray-900 mb-3">Mendatang</h2>
                    <div class="space-y-3">
                        @foreach($kelas['assignments'] as $assignment)
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $assignment['title'] }}</p>
                                <p class="text-xs text-gray-500">Batas: {{ $assignment['due_date'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="#" class="mt-3 block text-sm font-medium text-blue-600 hover:text-blue-700">Lihat semua</a>
                </div>

                {{-- Class Information --}}
                <div class="bg-white rounded-lg border shadow-sm p-4">
                    <h2 class="text-base font-medium text-gray-900 mb-3">Informasi Kelas</h2>
                    <dl class="space-y-2 text-sm">
                        <div>
                            <dt class="text-gray-500">Kode Kelas</dt>
                            <dd class="font-medium text-gray-900">{{ $kelas['code'] }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Pengajar</dt>
                            <dd class="font-medium text-gray-900">{{ $kelas['teacher'] }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Jadwal</dt>
                            <dd class="font-medium text-gray-900">{{ $kelas['schedule'] }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Ruang</dt>
                            <dd class="font-medium text-gray-900">{{ $kelas['room'] }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
