{{-- Sidebar --}}
<div class="relative z-30">
    {{-- Toggle Button - Minimalist Design --}}
    <button
        @click="sidebarOpen = !sidebarOpen"
        class="fixed z-50 bg-white/90 backdrop-blur-md rounded-2xl border border-gray-200/80 shadow-minimal p-2.5 text-gray-600 hover:text-gray-900 hover:bg-white hover:shadow-minimal-hover focus:outline-none transition-all duration-300 hover:scale-105"
        :class="{
            'left-4 top-4': !sidebarOpen || isMobile,
            'left-64 top-4': sidebarOpen && !isMobile
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
        class="fixed w-64 bg-white/95 backdrop-blur-xl border-r border-gray-100 min-h-screen p-5 space-y-6 shadow-xl left-0 top-0 overflow-y-auto z-40">

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
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-4 border border-blue-100/50 mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-md">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900">Murid</p>
                    <p class="text-xs text-gray-600">Kelas X-A</p>
                </div>
            </div>
        </div>

        {{-- Navigation Menu --}}
        <nav class="space-y-1">
            <a href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard') ? 'flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md hover:shadow-lg transform hover:scale-[1.02]' : 'flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

            <div class="pt-4 pb-2">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Kelas Saya</p>
            </div>

            @foreach([
            ['id' => 1, 'name' => 'Matematika Dasar', 'color' => 'blue'],
            ['id' => 2, 'name' => 'Bahasa Inggris', 'color' => 'green'],
            ['id' => 3, 'name' => 'Fisika', 'color' => 'purple']
            ] as $class)
            <a href="{{ route('kelas.detail', $class['id']) }}"
                class="{{ (request()->routeIs('kelas.detail') && request()->route('id') == $class['id']) ? 'flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 bg-gray-50 text-gray-900 border-l-4 border-'.$class['color'].'-500' : 'flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                <span class="w-2 h-2 mr-3 rounded-full bg-{{ $class['color'] }}-500 shadow-sm"></span>
                {{ $class['name'] }}
            </a>
            @endforeach
        </nav>

        {{-- Upcoming Tasks --}}
        <div class="pt-4">
            <h3 class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Tugas Mendatang</h3>
            <div class="space-y-2">
                <div class="px-3 py-2.5 bg-white rounded-xl border border-gray-100 hover:border-gray-200 hover:shadow-sm transition-all duration-200">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-gray-900 truncate">Latihan Aljabar</p>
                            <p class="text-xs text-gray-500">10 Nov • Matematika</p>
                        </div>
                    </div>
                </div>
                <div class="px-3 py-2.5 bg-white rounded-xl border border-gray-100 hover:border-gray-200 hover:shadow-sm transition-all duration-200">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-gray-900 truncate">Essay Writing</p>
                            <p class="text-xs text-gray-500">12 Nov • B. Inggris</p>
                        </div>
                    </div>
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