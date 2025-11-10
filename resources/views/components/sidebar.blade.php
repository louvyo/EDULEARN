{{-- Sidebar --}}
<div class="relative z-30">
    {{-- Single Toggle Button - Fixed Position di garis sidebar --}}
    <button
        @click="sidebarOpen = !sidebarOpen"
        class="fixed z-50 bg-white rounded-full border shadow-lg p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-50 focus:outline-none transition-all duration-300 hover:scale-110"
        :class="{
            'left-4 top-4': !sidebarOpen || isMobile,
            'left-64 top-4': sidebarOpen && !isMobile
        }"
        :style="sidebarOpen && !isMobile ? 'transform: translateX(-50%);' : ''">
        {{-- Icon when sidebar is closed --}}
        <svg x-show="!sidebarOpen" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
        </svg>

        {{-- Icon when sidebar is open --}}
        <svg x-show="sidebarOpen" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
        </svg>
    </button>

    {{-- Sidebar Content --}}
    <div x-show="sidebarOpen"
        x-transition:enter="transform transition-all duration-300 ease-in-out"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition-all duration-300 ease-in-out"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed w-64 bg-white border-r min-h-screen p-4 space-y-6 shadow-lg left-0 top-0 overflow-y-auto z-40">

        {{-- Profile Overview --}}
        <div class="flex items-center space-x-3 mb-6 mt-8">
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-900">Murid</p>
                <p class="text-xs text-gray-500">Kelas X-A</p>
            </div>
        </div>

        {{-- Navigation Menu --}}
        <nav class="space-y-1">
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-200"
                :class="request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50'">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

            @foreach([
            ['id' => 1, 'name' => 'Matematika Dasar', 'color' => 'blue'],
            ['id' => 2, 'name' => 'Bahasa Inggris', 'color' => 'green'],
            ['id' => 3, 'name' => 'Fisika', 'color' => 'purple']
            ] as $class)
            <a href="{{ route('kelas.detail', $class['id']) }}"
                class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-200"
                :class="request()->routeIs('kelas.detail') && request()->route('id') == $class['id'] ? 'bg-gray-50 text-gray-900' : 'text-gray-600 hover:bg-gray-50'">
                <span class="w-2 h-2 mr-3 rounded-full bg-{{ $class['color'] }}-600"></span>
                {{ $class['name'] }}
            </a>
            @endforeach
        </nav>

        {{-- Tugas Mendatang --}}
        <div>
            <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tugas Mendatang</h3>
            <div class="mt-2 space-y-3">
                <div class="px-3 py-2">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Latihan Aljabar Dasar</p>
                            <p class="text-xs text-gray-500">Matematika • 10 Nov</p>
                        </div>
                    </div>
                </div>
                <div class="px-3 py-2">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Essay Writing Task</p>
                            <p class="text-xs text-gray-500">B. Inggris • 12 Nov</p>
                        </div>
                    </div>
                </div>
                <div class="px-3 py-2">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Praktikum Gerak Lurus</p>
                            <p class="text-xs text-gray-500">Fisika • 15 Nov</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Aktivitas Terbaru --}}
        <div>
            <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aktivitas Terbaru</h3>
            <div class="mt-2 space-y-3">
                <div class="px-3 py-2">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-900">Tugas dikumpulkan</p>
                            <p class="text-xs text-gray-500">Quiz Matematika • 2 jam lalu</p>
                        </div>
                    </div>
                </div>
                <div class="px-3 py-2">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-900">Materi baru ditambahkan</p>
                            <p class="text-xs text-gray-500">Bahasa Inggris • 5 jam lalu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen && isMobile"
        x-transition:enter="transition-opacity duration-300 ease-in-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-300 ease-in-out"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-30 bg-black bg-opacity-50 lg:hidden"
        x-cloak>
    </div>
</div>