{{-- Sidebar with Modern Design --}}
<div class="relative z-30">
    {{-- Toggle Button - Enhanced with Gradient --}}
    <button @click="sidebarOpen = !sidebarOpen"
        class="fixed backdrop-blur-xl rounded-2xl shadow-lg p-3 focus:outline-none transition-all duration-300 hover:scale-110 group"
        :class="{
            'left-4 top-24 z-40 bg-linear-to-br from-blue-500 to-purple-600': !sidebarOpen || isMobile,
            'left-64 top-24 z-50 bg-white/90 border border-gray-200': sidebarOpen && !isMobile
        }"
        :style="sidebarOpen && !isMobile ? 'transform: translateX(-50%);' : ''">
        {{-- Icon when sidebar is closed --}}
        <svg x-show="!sidebarOpen" class="w-5 h-5 text-white drop-shadow-md" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
        </svg>

        {{-- Icon when sidebar is open --}}
        <svg x-show="sidebarOpen" class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            x-cloak>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
        </svg>

        {{-- Pulsing ring animation when closed --}}
        <div x-show="!sidebarOpen" class="absolute inset-0 rounded-2xl bg-blue-400/30 animate-ping"
            style="animation-duration: 2s;"></div>
    </button>

    {{-- Sidebar Content with Gradient Background --}}
    <div x-show="sidebarOpen" x-transition:enter="transform transition-all duration-500 ease-out"
        x-transition:enter-start="-translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transform transition-all duration-400 ease-in"
        x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="-translate-x-full opacity-0"
        class="fixed w-72 h-screen flex flex-col shadow-2xl left-0 top-0 z-40 bg-linear-to-br from-slate-50 via-white to-blue-50/30 border-r border-gray-200/50 backdrop-blur-2xl pt-16">

        <div class="shrink-0 p-6 space-y-6 pt-4">

            {{-- Logo & Brand - Enhanced with Animation --}}
            <div class="flex items-center space-x-4 mb-6 px-2 group cursor-pointer">
                <div class="relative">
                    <div
                        class="absolute inset-0 bg-linear-to-br from-blue-400 to-purple-500 rounded-2xl blur-md opacity-50 group-hover:opacity-75 transition-opacity duration-300">
                    </div>
                    <div
                        class="relative w-12 h-12 rounded-2xl bg-linear-to-br from-blue-500 via-blue-600 to-purple-600 flex items-center justify-center shadow-xl transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-7 h-7 text-white drop-shadow-lg" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <div
                            class="absolute -top-1 -right-1 w-3 h-3 bg-green-400 rounded-full border-2 border-white animate-pulse">
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-xl font-black text-gray-900 tracking-tight">EduLearn</p>
                    <p class="text-xs font-semibold text-blue-600/80">✨ Learning Hub</p>
                </div>
            </div>

            {{-- Profile Card - Enhanced with Gradient Border --}}
            <div
                class="relative bg-white rounded-2xl p-4 mb-6 shadow-lg hover:shadow-xl transition-all duration-300 group">
                <div
                    class="absolute inset-0 bg-linear-to-br from-blue-500/10 via-purple-500/5 to-pink-500/10 rounded-2xl">
                </div>
                <div class="relative">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div
                                class="w-16 h-16 rounded-2xl overflow-hidden ring-2 ring-offset-2 {{ auth()->user()->role === 'guru' ? 'ring-purple-400' : 'ring-blue-400' }} bg-gray-100 flex items-center justify-center shrink-0 transform group-hover:scale-105 transition-transform duration-300">
                                @if (auth()->user()->avatar_path)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" alt="Avatar"
                                        class="w-full h-full object-cover">
                                @else
                                    <svg class="w-8 h-8 {{ auth()->user()->role === 'guru' ? 'text-purple-400' : 'text-blue-400' }}"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        @if (auth()->user()->role === 'guru')
                                            <path
                                                d="M12 2L1 7l11 5 9-4.09V17h2V6M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z" />
                                        @else
                                            <path
                                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        @endif
                                    </svg>
                                @endif
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 w-5 h-5 {{ auth()->user()->role === 'guru' ? 'bg-purple-500' : 'bg-blue-500' }} rounded-full border-3 border-white flex items-center justify-center">
                                <span
                                    class="text-[10px]">{{ auth()->user()->role === 'guru' ? '👨‍🏫' : '👨‍🎓' }}</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-base font-bold text-gray-900 truncate mb-1.5">{{ auth()->user()->name }}</p>
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold {{ auth()->user()->role === 'guru' ? 'bg-linear-to-r from-purple-500 to-purple-600' : 'bg-linear-to-r from-blue-500 to-blue-600' }} text-white shadow-md">
                                <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                                {{ auth()->user()->role === 'guru' ? 'Teacher' : 'Student' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Scrollable Content Area --}}
        <div class="flex-1 overflow-y-auto pl-6 pr-7 pt-2"
            style="scrollbar-width: thin; scrollbar-color: #93c5fd transparent;">

            {{-- Navigation Menu --}}
            <nav class="space-y-3">
                @php $sidebarActiveColor = auth()->user()->role === 'guru' ? 'purple' : 'blue'; @endphp
                <x-ui.nav-item href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                    activeColor="{{ $sidebarActiveColor }}">
                    <x-slot:icon>
                        <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-blue-600' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </x-slot:icon>
                    Dashboard
                </x-ui.nav-item>
                @if (auth()->user()->role === 'guru')
                    {{-- Menu khusus Guru --}}
                    <div class="pt-5 pb-3">
                        <div class="flex items-center px-4 space-x-2">
                            <div class="flex-1 h-px bg-linear-to-r from-transparent via-gray-300 to-transparent"></div>
                            <p
                                class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-1.5">
                                <span class="text-yellow-500">⚡</span> Quick Actions
                            </p>
                            <div class="flex-1 h-px bg-linear-to-r from-transparent via-gray-300 to-transparent"></div>
                        </div>
                    </div>

                    <a href="{{ route('kelas.create') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 text-gray-700 hover:bg-linear-to-r hover:from-purple-50 hover:to-purple-100/50 hover:text-purple-700 hover:shadow-sm group relative">
                        <div
                            class="p-1.5 rounded-lg bg-purple-100 group-hover:bg-purple-200 mr-3 transition-all duration-300 group-hover:scale-110">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <span class="flex-1">Buat Kelas Baru</span>
                        <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="{{ route('tugas.create') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 text-gray-700 hover:bg-linear-to-r hover:from-purple-50 hover:to-purple-100/50 hover:text-purple-700 hover:shadow-sm group relative">
                        <div
                            class="p-1.5 rounded-lg bg-purple-100 group-hover:bg-purple-200 mr-3 transition-all duration-300 group-hover:scale-110">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <span class="flex-1">Buat Tugas Baru</span>
                        <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <a href="{{ route('nilai') }}"
                        class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 text-gray-700 hover:bg-linear-to-r hover:from-purple-50 hover:to-purple-100/50 hover:text-purple-700 hover:shadow-sm group relative">
                        <div
                            class="p-1.5 rounded-lg bg-purple-100 group-hover:bg-purple-200 mr-3 transition-all duration-300 group-hover:scale-110">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <span class="flex-1">Nilai Tugas Siswa</span>
                        <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @else
                    {{-- Menu khusus Siswa --}}
                    <div class="pt-5 pb-3">
                        <div class="flex items-center px-4 space-x-2">
                            <div class="flex-1 h-px bg-linear-to-r from-transparent via-gray-300 to-transparent"></div>
                            <p
                                class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-1.5">
                                <span class="text-yellow-500">⚡</span> Quick Actions
                            </p>
                            <div class="flex-1 h-px bg-linear-to-r from-transparent via-gray-300 to-transparent"></div>
                        </div>
                    </div>

                    <a href="{{ route('kelas.join') }}"
                        class="flex items-center px-4 py-3.5 text-sm font-bold rounded-xl transition-all duration-300 text-white bg-linear-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 shadow-lg hover:shadow-xl transform hover:scale-[1.03] hover:-translate-y-0.5 relative overflow-visible hover:z-10 group">
                        <div class="absolute inset-0 bg-white/10 animate-pulse"></div>
                        <div class="relative flex items-center w-full">
                            <div class="p-1.5 rounded-lg bg-white/20 mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <span class="flex-1">Gabung Kelas</span>
                            <span class="text-xs opacity-75">→</span>
                        </div>
                    </a>
                @endif

                <div class="pt-5 pb-3">
                    <div class="flex items-center px-4 space-x-2">
                        <div class="flex-1 h-px bg-linear-to-r from-transparent via-gray-300 to-transparent"></div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-1.5">
                            <span>📚</span> My Classes
                        </p>
                        <div class="flex-1 h-px bg-linear-to-r from-transparent via-gray-300 to-transparent"></div>
                    </div>
                </div>

                @foreach ($sidebarClasses ?? [] as $class)
                    <a href="{{ route('kelas.detail', $class->id) }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 relative overflow-visible hover:z-10 {{ request()->routeIs('kelas.detail') && request()->route('id') == $class->id ? 'bg-linear-to-r from-gray-50 to-white text-gray-900 shadow-md' : 'text-gray-700 hover:bg-linear-to-r hover:from-gray-50 hover:to-white hover:text-gray-900 hover:shadow-sm' }}">
                        @php
                            $dotColor = match ($class->warna ?? 'blue') {
                                'blue' => '#3b82f6',
                                'green' => '#10b981',
                                'purple' => '#a855f7',
                                'red' => '#ef4444',
                                'yellow' => '#f59e0b',
                                'pink' => '#ec4899',
                                default => '#3b82f6',
                            };
                            $isActive = request()->routeIs('kelas.detail') && request()->route('id') == $class->id;
                        @endphp

                        {{-- Active indicator line --}}
                        @if ($isActive)
                            <div class="absolute left-0 top-0 bottom-0 w-1 rounded-r-full"
                                style="background-color: {{ $dotColor }}"></div>
                        @endif

                        {{-- Colored dot with glow effect --}}
                        <div class="relative mr-3 group-hover:scale-125 transition-transform duration-300">
                            <div class="absolute inset-0 rounded-full blur-sm opacity-50"
                                style="background-color: {{ $dotColor }}"></div>
                            <span
                                class="relative block w-3 h-3 rounded-full shadow-md {{ $isActive ? 'animate-pulse' : '' }}"
                                style="background-color: {{ $dotColor }}"></span>
                        </div>

                        <span class="flex-1 truncate">{{ $class->nama }}</span>

                        {{-- Arrow indicator on hover --}}
                        <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endforeach

                {{-- View All Classes Link --}}
                <a href="{{ route('kelas') }}"
                    class="group flex items-center justify-center px-4 py-3 text-sm font-semibold rounded-xl transition-all duration-300 text-blue-600 hover:text-blue-700 bg-linear-to-r from-blue-50 to-blue-100/50 hover:from-blue-100 hover:to-blue-200/50 border border-blue-200 hover:border-blue-300 mt-4 shadow-sm hover:shadow-md transform hover:scale-[1.02]">
                    <svg class="w-4 h-4 mr-2 group-hover:animate-bounce" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                    </svg>
                    Lihat Semua Kelas
                    <span class="ml-2 opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                </a>
            </nav>

            {{-- Upcoming Tasks --}}
            <div class="pt-6 pb-6">
                <div class="flex items-center px-4 space-x-2 mb-4">
                    <div class="flex-1 h-px bg-linear-to-r from-transparent via-gray-300 to-transparent"></div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-1.5">
                        <span>📅</span> Upcoming Tasks
                    </h3>
                    <div class="flex-1 h-px bg-linear-to-r from-transparent via-gray-300 to-transparent"></div>
                </div>
                <div class="space-y-2.5 max-h-96 overflow-y-auto pr-1"
                    style="scrollbar-width: thin; scrollbar-color: #93c5fd transparent;">
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
                        <a href="{{ route('tugas.show', $task->id) }}"
                            class="group block px-4 py-3.5 bg-white rounded-xl border-2 transition-all duration-300 hover:shadow-lg hover:scale-[1.02] relative overflow-visible hover:z-10 {{ $isUrgent ? 'border-orange-200 hover:border-orange-300' : 'border-green-200 hover:border-green-300' }}">

                            {{-- Background gradient glow effect --}}
                            <div
                                class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 {{ $isUrgent ? 'bg-linear-to-br from-orange-50 to-transparent' : 'bg-linear-to-br from-green-50 to-transparent' }}">
                            </div>

                            <div class="relative flex items-start space-x-3">
                                {{-- Enhanced icon container --}}
                                <div class="relative">
                                    <div
                                        class="absolute inset-0 rounded-xl blur-md opacity-30 {{ $isUrgent ? 'bg-orange-400' : 'bg-green-400' }}">
                                    </div>
                                    <div
                                        class="relative w-10 h-10 rounded-xl flex items-center justify-center shrink-0 shadow-md {{ $isUrgent ? 'bg-linear-to-br from-orange-400 to-orange-500' : 'bg-linear-to-br from-green-400 to-green-500' }}">
                                        @if ($hasSubmitted)
                                            <svg class="w-5 h-5 text-white drop-shadow" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2.5"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-white drop-shadow" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2.5"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @endif
                                    </div>
                                    @if ($isUrgent && !$hasSubmitted)
                                        <div
                                            class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-white animate-pulse">
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-2 mb-1.5">
                                        <p
                                            class="text-sm font-bold text-gray-900 truncate flex-1 group-hover:text-{{ $isUrgent ? 'orange' : 'green' }}-700 transition-colors">
                                            {{ $task->judul }}</p>
                                        @if (auth()->user()->role === 'siswa')
                                            @if ($isGraded)
                                                <span
                                                    class="shrink-0 px-2 py-1 bg-linear-to-r from-green-500 to-green-600 text-white text-xs font-bold rounded-lg shadow-sm">✓
                                                    Graded</span>
                                            @elseif($hasSubmitted)
                                                <span
                                                    class="shrink-0 px-2 py-1 bg-linear-to-r from-blue-500 to-blue-600 text-white text-xs font-bold rounded-lg shadow-sm">✓
                                                    Done</span>
                                            @endif
                                        @endif
                                    </div>
                                    <p class="text-xs font-medium text-gray-500 mb-2 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                        </svg>
                                        {{ optional($task->kelas)->nama ?? 'Unknown Class' }}
                                    </p>
                                    <div class="flex items-center gap-2">
                                        <p class="text-xs font-bold countdown {{ $isUrgent ? 'text-orange-600' : 'text-green-600' }}"
                                            data-deadline="{{ $task->deadline->toIso8601String() }}">
                                            Menghitung...
                                        </p>
                                        @if ($isUrgent && !$hasSubmitted)
                                            <span
                                                class="px-2 py-0.5 bg-red-100 text-red-600 text-[10px] font-bold rounded uppercase">Urgent!</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div
                            class="relative px-4 py-8 text-center bg-white rounded-xl border-2 border-dashed border-gray-200">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-16 h-16 bg-blue-200 rounded-full blur-2xl opacity-50"></div>
                                </div>
                                <svg class="relative w-12 h-12 mx-auto text-gray-300 mb-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-600 mb-1">All caught up! 🎉</p>
                            <p class="text-xs text-gray-400">No pending tasks</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen && isMobile" x-transition:enter="transition-opacity duration-300 ease-out"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-300 ease-in" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
        class="fixed inset-0 z-30 bg-black/20 backdrop-blur-sm lg:hidden" x-cloak>
    </div>
</div>
