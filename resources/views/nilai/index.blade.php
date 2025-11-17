@extends('layouts.app')

@section('title', 'Nilai - EduLearn')

@section('content')
    <div class="space-y-8">
        <!-- Header Section with Background -->
        <div class="animate-fade-in">
            <div
                class="bg-gradient-to-br from-{{ $isGuru ? 'purple' : 'blue' }}-500 to-{{ $isGuru ? 'purple' : 'blue' }}-600 rounded-2xl shadow-lg overflow-hidden">
                <div class="p-8 text-white">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pl-8 lg:pl-0">
                        <div>
                            <h1 class="text-4xl font-bold mb-2 flex items-center gap-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                {{ $isGuru ? '📊 Penilaian Tugas' : '📊 Nilai Saya' }}
                            </h1>
                            <p class="text-{{ $isGuru ? 'purple' : 'blue' }}-100 text-lg">
                                {{ $isGuru ? 'Kelola penilaian tugas siswa' : 'Ringkasan nilai dan pengumpulan tugas' }}
                            </p>
                        </div>

                        @if ($isGuru)
                            <!-- Stats for Teacher -->
                            <div class="flex gap-4">
                                <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 min-w-[160px] text-center">
                                    <p class="text-purple-100 text-sm mb-2 font-medium">Belum Dinilai</p>
                                    <p class="text-5xl font-bold text-white">{{ $ungradedCount ?? 0 }}</p>
                                </div>
                                <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 min-w-[160px] text-center">
                                    <p class="text-purple-100 text-sm mb-2 font-medium">Total Submission</p>
                                    <p class="text-5xl font-bold text-white">{{ $totalSubmissions ?? 0 }}</p>
                                </div>
                            </div>
                        @else
                            <!-- Overall Average Card for Student -->
                            <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 min-w-[200px] text-center">
                                <p class="text-blue-100 text-sm mb-2 font-medium">Rata-rata Keseluruhan</p>
                                <p class="text-5xl font-bold text-white">
                                    {{ $overallAverage ? number_format($overallAverage, 1) : '-' }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if (!$isGuru)
            {{-- Kelas summaries - Only for Students --}}
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Ringkasan Per Kelas</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($kelasSummaries as $k)
                        <div
                            class="group bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal hover:shadow-minimal-hover overflow-hidden transition-all duration-500 ease-out hover:-translate-y-2 animate-fade-in-scale">
                            <div class="h-2 bg-gradient-to-r from-blue-400 to-blue-600"></div>
                            <div class="p-6">
                                <h3
                                    class="text-lg font-semibold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                                    {{ optional($k['kelas'])->name ?? 'Umum' }}
                                </h3>

                                <div class="space-y-3 mb-4">
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                        <span class="text-sm text-gray-600 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            Total Tugas
                                        </span>
                                        <span class="font-bold text-gray-900">{{ $k['total_tugas'] }}</span>
                                    </div>

                                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-xl">
                                        <span class="text-sm text-gray-600 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Dikumpulkan
                                        </span>
                                        <span class="font-bold text-green-700">{{ $k['submitted'] }}</span>
                                    </div>

                                    <div
                                        class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                                        <p class="text-xs text-gray-600 mb-1 font-medium">Rata-rata Kelas</p>
                                        <p class="text-2xl font-bold text-blue-600">
                                            {{ $k['average'] ? number_format($k['average'], 1) : '-' }}</p>
                                    </div>
                                </div>

                                @if (optional($k['kelas'])->id)
                                    <a href="{{ route('kelas.detail', optional($k['kelas'])->id) }}"
                                        class="block text-center py-2.5 px-4 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 rounded-xl hover:from-blue-100 hover:to-blue-200 transition-all duration-300 font-semibold">
                                        Lihat Kelas
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-1 md:col-span-2 lg:col-span-3">
                            <div
                                class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal p-12 text-center">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <p class="text-gray-500 text-lg">Belum ada nilai/pengumpulan untuk user ini.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        @endif

        {{-- Recent submissions / grades --}}
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                    <svg class="w-6 h-6 text-{{ $isGuru ? 'purple' : 'blue' }}-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    {{ $isGuru ? 'Daftar Pengumpulan Siswa' : 'Pengumpulan & Nilai Terbaru' }}
                </h2>
            </div>

            @if ($submissions->isEmpty())
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-gray-500 text-lg">
                        {{ $isGuru ? 'Belum ada pengumpulan dari siswa.' : 'Belum ada pengumpulan.' }}</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                @if ($isGuru)
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Siswa</th>
                                @endif
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tugas</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Kelas</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Tanggal</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nilai</th>
                                @if (!$isGuru)
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Feedback</th>
                                @endif
                                @if ($isGuru)
                                    <th
                                        class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach ($submissions as $s)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    @if ($isGuru)
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                                                    <span
                                                        class="text-purple-600 font-semibold">{{ substr(optional($s->user)->name ?? 'U', 0, 1) }}</span>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-900">
                                                        {{ optional($s->user)->name ?? 'Unknown' }}</p>
                                                    <p class="text-xs text-gray-500">{{ optional($s->user)->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                    <td class="px-6 py-4">
                                        <p class="font-medium text-gray-900">{{ optional($s->tugas)->judul }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-lg bg-{{ $isGuru ? 'purple' : 'blue' }}-50 text-{{ $isGuru ? 'purple' : 'blue' }}-700 text-xs font-semibold">
                                            {{ optional(optional($s->tugas)->kelas)->nama }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        @formatDate($s->submitted_at)<br>
                                        <span class="text-xs text-gray-500">@formatTime($s->submitted_at)</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold {{ $s->status === 'late' ? 'bg-red-50 text-red-700' : 'bg-green-50 text-green-700' }}">
                                            {{ $s->status === 'late' ? 'Terlambat' : 'Tepat Waktu' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($s->grade)
                                            <span
                                                class="text-lg font-bold text-{{ $isGuru ? 'purple' : 'blue' }}-600">{{ $s->grade }}</span>
                                        @else
                                            <span class="text-sm text-gray-400 italic">Belum dinilai</span>
                                        @endif
                                    </td>
                                    @if (!$isGuru)
                                        <td class="px-6 py-4">
                                            @if ($s->feedback)
                                                <p class="text-sm text-gray-600 max-w-xs truncate"
                                                    title="{{ $s->feedback }}">{{ $s->feedback }}</p>
                                            @else
                                                <span class="text-sm text-gray-400">-</span>
                                            @endif
                                        </td>
                                    @endif
                                    @if ($isGuru)
                                        <td class="px-6 py-4 text-center">
                                            <a href="{{ route('tugas.show', $s->tugas_id) }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-semibold transition-all duration-300 hover:scale-105">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                {{ $s->grade ? 'Edit Nilai' : 'Beri Nilai' }}
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
