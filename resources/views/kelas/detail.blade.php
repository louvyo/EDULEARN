@extends('layouts.app')

@section('content')
    @php
        $color = $kelas['color'] ?? 'blue';

        // Check if color is preset or custom
        $isCustomColor = !in_array($color, ['blue', 'green', 'purple', 'red', 'yellow', 'pink']);

        if ($isCustomColor) {
            // Use custom color directly
            $mainColor = $color;
            $headerBg = $color;
            $gradientColors = [
                'from' => $color,
                'to' => $color,
                'light' => 'rgba(0,0,0,0.1)',
                'lighter' => 'rgba(0,0,0,0.05)',
            ];
        } else {
            // Use preset color map
            $colorMap = [
                'blue' => ['from' => '#3b82f6', 'to' => '#1e40af', 'light' => '#dbeafe', 'lighter' => '#eff6ff'],
                'green' => ['from' => '#10b981', 'to' => '#065f46', 'light' => '#d1fae5', 'lighter' => '#ecfdf5'],
                'purple' => ['from' => '#a855f7', 'to' => '#6b21a8', 'light' => '#e9d5ff', 'lighter' => '#f3e8ff'],
                'red' => ['from' => '#ef4444', 'to' => '#991b1b', 'light' => '#fecaca', 'lighter' => '#fee2e2'],
                'yellow' => ['from' => '#f59e0b', 'to' => '#b45309', 'light' => '#fde68a', 'lighter' => '#fef3c7'],
                'pink' => ['from' => '#ec4899', 'to' => '#9f1239', 'light' => '#fbcfe8', 'lighter' => '#fce7f3'],
            ];
            $gradientColors = $colorMap[$color] ?? $colorMap['blue'];
            $mainColor = $gradientColors['to'];
            $headerBg = "linear-gradient(135deg, {$gradientColors['from']} 0%, {$gradientColors['to']} 100%)";
        }
    @endphp

    <div class="space-y-4">

        {{-- Header Kelas --}}
        <div class="animate-fade-in">
            <div class="rounded-2xl shadow-lg overflow-hidden" style="background: {{ $headerBg }};">
                <!-- Pattern Overlay -->
                <div class="relative">
                    <div class="absolute inset-0 opacity-10"
                        style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
                    </div>

                    <div class="relative p-6 text-white">
                        <div class="pl-8 lg:pl-0">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-start gap-4 mb-2">
                                        <h1 class="text-3xl font-bold drop-shadow-lg">{{ $kelas['name'] }}</h1>
                                        @if ($isGuru ?? false)
                                            <div
                                                class="flex items-center gap-2 px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-lg">
                                                <span class="text-xs font-medium">Kode:</span>
                                                <span class="font-mono font-bold">{{ $kelas['kode_kelas'] ?? 'N/A' }}</span>
                                                <button id="copyBtnDetail"
                                                    onclick="copyKode('{{ $kelas['kode_kelas'] ?? '' }}')"
                                                    class="hover:bg-white/20 p-1 rounded transition-all duration-200"
                                                    title="Salin kode">
                                                    <svg id="copyIconDetail" class="w-4 h-4" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                    </svg>
                                                    <svg id="checkIconDetail" class="w-4 h-4 hidden" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex flex-wrap items-center gap-2 text-white/90 drop-shadow">
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <span class="text-sm">{{ $kelas['teacher'] }}</span>
                                        </div>
                                        <span class="text-white/70">•</span>
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-sm">{{ $kelas['semester'] }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if ($isGuru ?? false)
                                    <div class="flex items-center gap-2 ml-4">
                                        <a href="{{ route('aktivitas.create', $kelas['id']) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-green-500/90 hover:bg-green-600 backdrop-blur-sm rounded-xl text-white font-semibold transition-all duration-300 hover:scale-105">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Tambah Materi
                                        </a>
                                        <a href="{{ route('kelas.edit', $kelas['id']) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-xl text-white font-semibold transition-all duration-300 hover:scale-105">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('kelas.destroy', $kelas['id']) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus kelas ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-red-500/90 hover:bg-red-600 backdrop-blur-sm rounded-xl text-white font-semibold transition-all duration-300 hover:scale-105">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tab Navigation --}}
                <div class="flex border-t border-white/20 px-4 bg-black/10 backdrop-blur-sm overflow-x-auto">
                    <button onclick="switchTab('stream')" id="tab-stream"
                        class="tab-button px-4 py-3 text-sm font-semibold text-white whitespace-nowrap border-b-2 border-white transition-all duration-300 hover:bg-white/10">
                        Stream
                    </button>
                    <button onclick="switchTab('tugas')" id="tab-tugas"
                        class="tab-button px-4 py-3 text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300 rounded-t-lg whitespace-nowrap">
                        Tugas Kelas
                    </button>
                    <button onclick="switchTab('materi')" id="tab-materi"
                        class="tab-button px-4 py-3 text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300 rounded-t-lg whitespace-nowrap">
                        Materi
                    </button>
                    @if ($isGuru ?? false)
                        <a href="{{ route('kelas.students', $kelas['id']) }}"
                            class="px-4 py-3 text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300 rounded-t-lg whitespace-nowrap flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Kelola Siswa
                        </a>
                    @else
                        <button onclick="switchTab('anggota')" id="tab-anggota"
                            class="tab-button px-4 py-3 text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300 rounded-t-lg whitespace-nowrap">
                            Anggota
                        </button>
                    @endif
                </div>
            </div>
        </div>

        {{-- Content Area --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            {{-- Main Content (2/3 width) --}}
            <div class="lg:col-span-2 space-y-4">

                {{-- Tab Content: Stream --}}
                <div id="content-stream" class="tab-content">
                    @foreach ($kelas['assignments'] ?? [] as $assignment)
                        {{-- Assignment Card --}}
                        <div
                            class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal hover:shadow-minimal-hover overflow-hidden transition-all duration-300 hover:-translate-y-1 group animate-fade-in-scale mb-4">
                            <div class="p-4">
                                <div class="flex items-start gap-3">
                                    <div class="shrink-0">
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300"
                                            style="background: linear-gradient(135deg, {{ $gradientColors['from'] }}, {{ $gradientColors['to'] }});">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between mb-1">
                                            <div class="flex-1">
                                                <h3
                                                    class="text-base font-semibold text-gray-900 group-hover:translate-x-1 transition-transform duration-300">
                                                    {{ $assignment['title'] }}</h3>
                                                <p class="text-xs text-gray-500 mt-0.5">{{ $kelas['teacher'] }} •
                                                    {{ $assignment['time'] }}</p>
                                            </div>
                                            <span
                                                class="ml-3 inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold whitespace-nowrap group-hover:scale-110 transition-transform duration-300"
                                                style="background-color: {{ $gradientColors['lighter'] }}; color: {{ $gradientColors['to'] }};">
                                                {{ $assignment['points'] }} poin
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 leading-relaxed">{{ $assignment['description'] }}
                                        </p>
                                        <div class="mt-3 flex items-center gap-3">
                                            <a href="{{ route('tugas.show', $assignment['id']) }}"
                                                class="inline-flex items-center text-xs font-semibold hover:translate-x-1 transition-transform duration-200"
                                                style="color: {{ $gradientColors['to'] }};">
                                                Lihat Detail
                                                <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                            <button
                                                class="inline-flex items-center text-xs text-gray-500 hover:text-gray-700 transition-colors duration-200">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                                </svg>
                                                0 komentar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($kelas['materials'] ?? [] as $material)
                        {{-- Material Card --}}
                        <div
                            class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal hover:shadow-minimal-hover overflow-hidden transition-all duration-300 hover:-translate-y-1 group animate-fade-in-scale mb-4">
                            <div class="p-4">
                                <div class="flex items-start gap-3">
                                    <div class="shrink-0">
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300"
                                            style="background: linear-gradient(135deg, {{ $gradientColors['from'] }}, {{ $gradientColors['to'] }});">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-2">
                                            <div class="flex-1">
                                                <h3
                                                    class="text-base font-semibold text-gray-900 group-hover:translate-x-1 transition-transform duration-300">
                                                    {{ $material['title'] }}</h3>
                                                <p class="text-xs text-gray-500 mt-0.5">{{ $kelas['teacher'] }} •
                                                    {{ $material['time'] }}</p>
                                            </div>
                                            @if ($isGuru ?? false)
                                                <div class="flex items-center gap-1 shrink-0">
                                                    <a href="{{ route('aktivitas.edit', $material['id']) }}"
                                                        class="p-1.5 rounded-lg hover:bg-gray-50 text-gray-400 hover:text-gray-700 transition-colors"
                                                        title="Edit">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5h2m-9 9l3 3L20 5a2.121 2.121 0 10-3-3L4 11l-1 4z" />
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('aktivitas.destroy', $material['id']) }}"
                                                        method="POST" class="shrink-0"
                                                        onsubmit="return confirm('Yakin ingin menghapus materi ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="p-1.5 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-600 transition-colors"
                                                            title="Hapus">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                                            {{ $material['description'] }}</p>

                                        {{-- Attachment --}}
                                        @if ($material['file_path'])
                                            <div
                                                class="mt-3 flex items-center p-3 bg-linear-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 hover:border-gray-300 transition-all duration-200 group/file">
                                                <svg class="w-4 h-4 text-gray-400 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                <span
                                                    class="text-xs text-gray-700 font-medium flex-1">{{ $material['file'] }}</span>
                                                <a href="{{ URL::signedRoute('aktivitas.download', ['id' => $material['id']]) }}"
                                                    download
                                                    class="ml-2 p-1.5 rounded-lg transition-all duration-200 group-hover/file:scale-110"
                                                    style="color: {{ $gradientColors['to'] }}; background-color: {{ $gradientColors['lighter'] }};">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($kelas['announcements'] ?? [] as $announcement)
                        {{-- Announcement Card --}}
                        <div
                            class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal hover:shadow-minimal-hover overflow-hidden transition-all duration-300 hover:-translate-y-1 group animate-fade-in-scale mb-4">
                            <div class="p-4">
                                <div class="flex items-start gap-3">
                                    <div class="shrink-0">
                                        <div
                                            class="w-10 h-10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 bg-linear-to-br from-yellow-400 to-yellow-500">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-2">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-yellow-100 text-yellow-800">
                                                        📢 Pengumuman
                                                    </span>
                                                </div>
                                                <h3
                                                    class="text-base font-semibold text-gray-900 group-hover:translate-x-1 transition-transform duration-300">
                                                    {{ $announcement['title'] }}</h3>
                                                <p class="text-xs text-gray-500 mt-0.5">{{ $kelas['teacher'] }} •
                                                    {{ $announcement['time'] }}</p>
                                            </div>
                                            @if ($isGuru ?? false)
                                                <div class="flex items-center gap-1 shrink-0">
                                                    <a href="{{ route('aktivitas.edit', $announcement['id']) }}"
                                                        class="p-1.5 rounded-lg hover:bg-gray-50 text-gray-400 hover:text-gray-700 transition-colors"
                                                        title="Edit">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5h2m-9 9l3 3L20 5a2.121 2.121 0 10-3-3L4 11l-1 4z" />
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('aktivitas.destroy', $announcement['id']) }}"
                                                        method="POST" class="shrink-0"
                                                        onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="p-1.5 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-600 transition-colors"
                                                            title="Hapus">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                                            {{ $announcement['description'] }}</p>

                                        {{-- Attachment if exists --}}
                                        @if ($announcement['file_path'])
                                            <div
                                                class="mt-3 flex items-center p-3 bg-linear-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 hover:border-gray-300 transition-all duration-200 group/file">
                                                <svg class="w-4 h-4 text-gray-400 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                <span
                                                    class="text-xs text-gray-700 font-medium flex-1">{{ $announcement['file'] }}</span>
                                                <a href="{{ URL::signedRoute('aktivitas.download', ['id' => $announcement['id']]) }}"
                                                    download
                                                    class="ml-2 p-1.5 rounded-lg transition-all duration-200 group-hover/file:scale-110"
                                                    style="color: {{ $gradientColors['to'] }}; background-color: {{ $gradientColors['lighter'] }};">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if (empty($kelas['assignments']) && empty($kelas['materials']) && empty($kelas['announcements']))
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 p-12 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <p class="text-gray-500 text-lg">Belum ada aktivitas di kelas ini</p>
                        </div>
                    @endif
                </div>

                {{-- Tab Content: Tugas Kelas --}}
                <div id="content-tugas" class="tab-content hidden">
                    @forelse($kelas['assignments'] ?? [] as $assignment)
                        {{-- Assignment Card --}}
                        <div
                            class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal hover:shadow-minimal-hover overflow-hidden transition-all duration-300 hover:-translate-y-1 group animate-fade-in-scale">
                            <div class="p-4">
                                <div class="flex items-start gap-3">
                                    <div class="shrink-0">
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300"
                                            style="background: linear-gradient(135deg, {{ $gradientColors['from'] }}, {{ $gradientColors['to'] }});">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between mb-1">
                                            <div class="flex-1">
                                                <h3
                                                    class="text-base font-semibold text-gray-900 group-hover:translate-x-1 transition-transform duration-300">
                                                    {{ $assignment['title'] }}</h3>
                                                <p class="text-xs text-gray-500 mt-0.5">{{ $kelas['teacher'] }} •
                                                    {{ $assignment['time'] }}</p>
                                            </div>
                                            <span
                                                class="ml-3 inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold whitespace-nowrap group-hover:scale-110 transition-transform duration-300"
                                                style="background-color: {{ $gradientColors['lighter'] }}; color: {{ $gradientColors['to'] }};">
                                                {{ $assignment['points'] }} poin
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 leading-relaxed">{{ $assignment['description'] }}
                                        </p>
                                        <div class="mt-3 flex items-center gap-3">
                                            <a href="{{ route('tugas.show', $assignment['id']) }}"
                                                class="inline-flex items-center text-xs font-semibold hover:translate-x-1 transition-transform duration-200"
                                                style="color: {{ $gradientColors['to'] }};">
                                                Lihat Detail
                                                <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                            <button
                                                class="inline-flex items-center text-xs text-gray-500 hover:text-gray-700 transition-colors duration-200">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 p-12 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            <p class="text-gray-500 text-lg">Belum ada tugas di kelas ini</p>
                        </div>
                    @endforelse
                </div>

                {{-- Tab Content: Materi --}}
                <div id="content-materi" class="tab-content hidden">
                    @forelse($kelas['materials'] ?? [] as $material)
                        {{-- Material Card --}}
                        <div
                            class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal hover:shadow-minimal-hover overflow-hidden transition-all duration-300 hover:-translate-y-1 group animate-fade-in-scale mb-4">
                            <div class="p-4">
                                <div class="flex items-start gap-3">
                                    <div class="shrink-0">
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300"
                                            style="background: linear-gradient(135deg, {{ $gradientColors['from'] }}, {{ $gradientColors['to'] }});">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-2">
                                            <div class="flex-1">
                                                <h3
                                                    class="text-base font-semibold text-gray-900 group-hover:translate-x-1 transition-transform duration-300">
                                                    {{ $material['title'] }}</h3>
                                                <p class="text-xs text-gray-500 mt-0.5">{{ $kelas['teacher'] }} •
                                                    {{ $material['time'] }}</p>
                                            </div>
                                            @if ($isGuru ?? false)
                                                <form action="{{ route('aktivitas.destroy', $material['id']) }}"
                                                    method="POST" class="shrink-0"
                                                    onsubmit="return confirm('Yakin ingin menghapus materi ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-1.5 rounded-lg hover:bg-red-50 text-gray-400 hover:text-red-600 transition-colors">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1 leading-relaxed">
                                            {{ $material['description'] }}</p>

                                        {{-- Attachment --}}
                                        @if ($material['file_path'])
                                            <div
                                                class="mt-3 flex items-center p-3 bg-linear-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 hover:border-gray-300 transition-all duration-200 group/file">
                                                <svg class="w-4 h-4 text-gray-400 mr-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                <span
                                                    class="text-xs text-gray-700 font-medium flex-1">{{ $material['file'] }}</span>
                                                <a href="{{ URL::signedRoute('aktivitas.download', ['id' => $material['id']]) }}"
                                                    download
                                                    class="ml-2 p-1.5 rounded-lg transition-all duration-200 group-hover/file:scale-110"
                                                    style="color: {{ $gradientColors['to'] }}; background-color: {{ $gradientColors['lighter'] }};">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 p-12 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-gray-500 text-lg">Belum ada materi di kelas ini</p>
                        </div>
                    @endforelse
                </div>

                {{-- Tab Content: Anggota (for Student) --}}
                @if (!($isGuru ?? false))
                    <div id="content-anggota" class="tab-content hidden">
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 p-8 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <p class="text-gray-500 text-lg mb-2">Daftar Anggota Kelas</p>
                            <p class="text-gray-400 text-sm">Fitur ini akan segera tersedia</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar (1/3 width) --}}
            <aside class="lg:col-span-1 space-y-4">
                {{-- Upcoming Tasks --}}
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal p-4 animate-fade-in-scale"
                    style="animation-delay: 200ms;">
                    <h2 class="text-base font-semibold text-gray-900 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-1.5" style="color: {{ $gradientColors['to'] }};" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Mendatang
                    </h2>
                    <div class="space-y-2">
                        @forelse ($kelas['assignments'] ?? [] as $assignment)
                            <div class="flex items-start gap-2 p-2.5 rounded-xl transition-all duration-300 border"
                                style="background: linear-gradient(90deg, {{ $gradientColors['lighter'] }}, transparent); border-color: {{ $gradientColors['light'] }};">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                                    style="background-color: {{ $gradientColors['light'] }};">
                                    <svg class="w-4 h-4" style="color: {{ $gradientColors['to'] }};" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-gray-900 truncate">{{ $assignment['title'] }}</p>
                                    <p class="text-xs text-gray-600 mt-0.5">Batas: {{ $assignment['due_date'] }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-xs text-gray-500">Tidak ada tugas mendatang</p>
                            </div>
                        @endforelse
                    </div>
                    @if (count($kelas['assignments'] ?? []) > 0)
                        <a href="#"
                            class="mt-3 block text-center text-xs font-semibold transition-colors duration-200"
                            style="color: {{ $gradientColors['to'] }};">
                            Lihat semua →
                        </a>
                    @endif
                </div>

                {{-- Class Information --}}
                <div class="rounded-2xl shadow-minimal p-4 animate-fade-in-scale"
                    style="background: linear-gradient(135deg, {{ $gradientColors['lighter'] }}, {{ $gradientColors['light'] }}); border: 1px solid {{ $gradientColors['light'] }}; animation-delay: 300ms;">
                    <h2 class="text-base font-semibold text-gray-900 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-1.5" style="color: {{ $gradientColors['to'] }};" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Informasi Kelas
                    </h2>
                    <dl class="space-y-2 text-sm">
                        <div class="flex items-center justify-between p-2.5 bg-white/70 rounded-xl">
                            <dt class="text-gray-600 font-medium text-xs">Kode Kelas</dt>
                            <dd class="font-bold text-xs" style="color: {{ $gradientColors['to'] }};">
                                {{ $kelas['code'] }}</dd>
                        </div>
                        <div class="flex items-center justify-between p-2.5 bg-white/70 rounded-xl">
                            <dt class="text-gray-600 font-medium text-xs">Pengajar</dt>
                            <dd class="font-semibold text-gray-900 text-xs">{{ $kelas['teacher'] }}</dd>
                        </div>
                        <div class="flex items-center justify-between p-2.5 bg-white/70 rounded-xl">
                            <dt class="text-gray-600 font-medium text-xs">Jadwal</dt>
                            <dd class="font-semibold text-gray-900 text-xs">{{ $kelas['schedule'] }}</dd>
                        </div>
                        <div class="flex items-center justify-between p-2.5 bg-white/70 rounded-xl">
                            <dt class="text-gray-600 font-medium text-xs">Ruang</dt>
                            <dd class="font-semibold text-gray-900 text-xs">{{ $kelas['room'] }}</dd>
                        </div>
                    </dl>
                </div>
            </aside>
        </div>
    </div>

    <script>
        function copyKode(kode) {
            if (!kode) return;

            const copyBtn = document.getElementById('copyBtnDetail');
            const copyIcon = document.getElementById('copyIconDetail');
            const checkIcon = document.getElementById('checkIconDetail');

            // Try modern clipboard API first
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(kode).then(function() {
                    showCopySuccess();
                }).catch(function(err) {
                    // Fallback if clipboard API fails
                    fallbackCopy(kode);
                });
            } else {
                // Use fallback for older browsers
                fallbackCopy(kode);
            }

            function fallbackCopy(text) {
                const textArea = document.createElement('textarea');
                textArea.value = text;
                textArea.style.position = 'fixed';
                textArea.style.left = '-999999px';
                textArea.style.top = '-999999px';
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();

                try {
                    document.execCommand('copy');
                    showCopySuccess();
                } catch (err) {
                    alert('Gagal menyalin kode: ' + text);
                }

                document.body.removeChild(textArea);
            }

            function showCopySuccess() {
                // Change button icon
                if (copyIcon && checkIcon) {
                    copyIcon.classList.add('hidden');
                    checkIcon.classList.remove('hidden');
                    copyBtn.classList.add('bg-white/30');
                }

                // Show toast notification
                const toast = document.createElement('div');
                toast.className =
                    'fixed top-4 right-4 bg-linear-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-xl shadow-lg z-50 flex items-center gap-2 animate-slide-in';
                toast.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="font-semibold">Kode berhasil disalin!</span>
                `;
                document.body.appendChild(toast);

                // Reset button after 2 seconds
                setTimeout(() => {
                    if (copyIcon && checkIcon) {
                        copyIcon.classList.remove('hidden');
                        checkIcon.classList.add('hidden');
                        copyBtn.classList.remove('bg-white/30');
                    }
                }, 2000);

                // Remove toast after 3 seconds
                setTimeout(() => {
                    toast.style.animation = 'slide-out 0.3s ease-out';
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            }
        }

        // Tab switching function
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active class from all tabs
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('text-white', 'font-semibold', 'border-b-2', 'border-white');
                button.classList.add('text-white/80', 'font-medium');
            });

            // Show selected tab content
            const selectedContent = document.getElementById('content-' + tabName);
            if (selectedContent) {
                selectedContent.classList.remove('hidden');
            }

            // Add active class to selected tab
            const selectedTab = document.getElementById('tab-' + tabName);
            if (selectedTab) {
                selectedTab.classList.remove('text-white/80', 'font-medium');
                selectedTab.classList.add('text-white', 'font-semibold', 'border-b-2', 'border-white');
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Set stream tab as active by default
            switchTab('stream');
        });
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }

        @keyframes slide-in {
            from {
                opacity: 0;
                transform: translateX(100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slide-out {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(100px);
            }
        }

        .animate-slide-in {
            animation: slide-in 0.3s ease-out;
        }
    </style>
@endsection
