{{-- Sidebar --}}
<div class="relative z-30">
    {{-- Toggle Button - Minimalist Design --}}
    <button
        @click="sidebarOpen = !sidebarOpen"
        class="fixed bg-white/90 backdrop-blur-md rounded-2xl border border-gray-200/80 shadow-minimal p-2.5 text-gray-600 hover:text-gray-900 hover:bg-white hover:shadow-minimal-hover focus:outline-none transition-all duration-300 hover:scale-105"
        :class="{
            'left-4 top-20 z-40': !sidebarOpen || isMobile,
            'left-64 top-20 z-50': sidebarOpen && !isMobile
        }"
        :style="sidebarOpen && !isMobile ? 'transform: translateX(-50%);' : ''">
        {{-- Icon when sidebar is closed --}}
        <svg x-show="!sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>

        {{-- Icon when sidebar is open --}}
        <svg x-show="sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    {{-- Sidebar Content --}}
    <div x-show="sidebarOpen"
        x-transition:enter="transform transition-all duration-500 ease-out"
        x-transition:enter-start="-translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transform transition-all duration-400 ease-in"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="-translate-x-full opacity-0"
        class="fixed w-64 bg-white/95 backdrop-blur-xl border-r border-gray-100 h-screen flex flex-col shadow-xl left-0 top-0 z-40">
        
        <div class="flex-shrink-0 p-5 space-y-6">

        {{-- Logo & Brand --}}
        <div class="flex items-center space-x-3 mb-8 mt-8 px-1">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <div>
                <p class="text-lg font-bold text-gray-900">EduLearn</p>
                <p class="text-xs text-gray-500">Learning Hub</p>
            </div>
        </div>

        {{-- Profile Card --}}
        <div class="bg-{{ auth()->user()->role === 'guru' ? 'white' : 'gradient-to-br from-blue-50 to-blue-50' }} rounded-2xl p-4 border border-{{ auth()->user()->role === 'guru' ? 'gray-200' : 'blue-100' }} mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-14 h-14 rounded-2xl bg-{{ auth()->user()->role === 'guru' ? 'purple' : 'blue' }}-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                        @if(auth()->user()->role === 'guru')
                        <path d="M12 2L1 7l11 5 9-4.09V17h2V6M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/>
                        @else
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        @endif
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-base font-bold text-gray-900 truncate mb-1">{{ auth()->user()->name }}</p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-{{ auth()->user()->role === 'guru' ? 'purple' : 'blue' }}-500 text-white">
                        {{ auth()->user()->role === 'guru' ? '👨‍🏫 Guru' : '👨‍🎓 Siswa' }}
                    </span>
                </div>
            </div>
        </div>
        </div>

        {{-- Scrollable Content Area --}}
        <div class="flex-1 overflow-y-auto px-5" style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">
        
        {{-- Navigation Menu --}}
        <nav class="space-y-1">
            <a href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard') ? 'flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 bg-gradient-to-r from-'.( auth()->user()->role === 'guru' ? 'purple-500 to-purple-600' : 'blue-500 to-blue-600').' text-white shadow-md hover:shadow-lg transform hover:scale-[1.02]' : 'flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

            @if(auth()->user()->role === 'guru')
            {{-- Menu khusus Guru --}}
            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">⚡ Aksi Cepat</p>
            </div>
            
            <a href="{{ route('kelas.create') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 text-gray-700 hover:bg-purple-50 hover:text-purple-700">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Kelas Baru
            </a>
            
            <a href="{{ route('tugas.create') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 text-gray-700 hover:bg-purple-50 hover:text-purple-700">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Buat Tugas Baru
            </a>
            
            <a href="{{ route('nilai') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 text-gray-700 hover:bg-purple-50 hover:text-purple-700">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                Nilai Tugas Siswa
            </a>
            @else
            {{-- Menu khusus Siswa --}}
            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">⚡ Aksi Cepat</p>
            </div>
            
            <a href="{{ route('kelas.join') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 shadow-md hover:shadow-lg transform hover:scale-[1.02]">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Gabung Kelas
            </a>
            @endif

            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ auth()->user()->role === 'guru' ? '📚 Kelas yang Diampu' : '📚 Kelas Saya' }}</p>
            </div>

            @foreach($sidebarClasses ?? [] as $class)
            <a href="{{ route('kelas.detail', $class->id) }}"
                class="{{ (request()->routeIs('kelas.detail') && request()->route('id') == $class->id) ? 'flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 bg-gray-50 text-gray-900 border-l-4' : 'flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}"
                style="{{ (request()->routeIs('kelas.detail') && request()->route('id') == $class->id) ? 'border-left-color: ' . ($class->warna === 'blue' ? '#3b82f6' : ($class->warna === 'green' ? '#10b981' : ($class->warna === 'purple' ? '#a855f7' : ($class->warna === 'red' ? '#ef4444' : ($class->warna === 'yellow' ? '#f59e0b' : '#ec4899'))))) : '' }}">
                @php
                    $dotColor = match($class->warna ?? 'blue') {
                        'blue' => '#3b82f6',
                        'green' => '#10b981',
                        'purple' => '#a855f7',
                        'red' => '#ef4444',
                        'yellow' => '#f59e0b',
                        'pink' => '#ec4899',
                        default => '#3b82f6'
                    };
                @endphp
                <span class="w-2 h-2 mr-3 rounded-full shadow-sm" style="background-color: {{ $dotColor }}"></span>
                {{ $class->nama }}
            </a>
            @endforeach

            {{-- View All Classes Link --}}
            <a href="{{ route('kelas') }}"
                class="flex items-center justify-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-300 text-blue-600 hover:bg-blue-50 border border-blue-200 hover:border-blue-300 mt-2">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                Lihat Semua Kelas
            </a>
        </nav>

        {{-- Upcoming Tasks --}}
        <div class="pt-4 pb-6">
            <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Tugas Mendatang</h3>
            <div class="space-y-2 max-h-96 overflow-y-auto pr-1" style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">
                @forelse($upcomingTasks ?? [] as $task)
                    @php
                        $daysLeft = now()->diffInDays($task->deadline, false);
                        $isUrgent = $daysLeft <= 2;
                        $colorClass = $isUrgent ? 'orange' : 'green';
                        
                        // Check if student has submitted
                        $hasSubmitted = false;
                        $isGraded = false;
                        if (auth()->user()->role === 'siswa' && isset($task->user_submission)) {
                            $hasSubmitted = true;
                            $isGraded = $task->user_submission->grade !== null;
                        }
                    @endphp
                    <a href="{{ route('tugas.show', $task->id) }}" class="block px-3 py-2.5 bg-white rounded-xl border border-gray-100 hover:border-{{ $colorClass }}-200 hover:shadow-sm transition-all duration-200">
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-{{ $colorClass }}-50 flex items-center justify-center flex-shrink-0">
                                @if($hasSubmitted)
                                    <svg class="w-4 h-4 text-{{ $isGraded ? 'green' : 'blue' }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-{{ $colorClass }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-1 mb-1">
                                    <p class="text-xs font-medium text-gray-900 truncate flex-1">{{ $task->judul }}</p>
                                    @if(auth()->user()->role === 'siswa')
                                        @if($isGraded)
                                            <span class="flex-shrink-0 px-1.5 py-0.5 bg-green-100 text-green-700 text-xs font-bold rounded">✓</span>
                                        @elseif($hasSubmitted)
                                            <span class="flex-shrink-0 px-1.5 py-0.5 bg-blue-100 text-blue-700 text-xs font-bold rounded">✓</span>
                                        @endif
                                    @endif
                                </div>
                                <p class="text-xs text-gray-500 mb-1">{{ optional($task->kelas)->name }}</p>
                                <p class="text-xs {{ $isUrgent ? 'text-orange-600 font-semibold' : 'text-gray-600' }} countdown" 
                                   data-deadline="{{ $task->deadline->toIso8601String() }}">
                                    Menghitung...
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="px-3 py-4 text-center">
                        <svg class="w-8 h-8 mx-auto text-gray-300 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-xs text-gray-500">Tidak ada tugas</p>
                    </div>
                @endforelse
            </div>
        </div>
        </div>
        
    </div>

    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen && isMobile"
        x-transition:enter="transition-opacity duration-300 ease-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-300 ease-in"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-30 bg-black/20 backdrop-blur-sm lg:hidden"
        x-cloak>
    </div>
</div>