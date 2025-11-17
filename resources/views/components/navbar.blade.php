<header>
    <nav class="bg-white/90 backdrop-blur-2xl border-b border-gray-200/50 px-4 lg:px-8 py-3.5 shadow-lg shadow-gray-100/50 sticky top-0 z-50 transition-all duration-300"
        x-data="{ mobileMenuOpen: false, notifOpen: false, notifications: [], unreadCount: 0, loading: false }" x-init="fetch('{{ route('notifications.unread') }}').then(r => r.json()).then(d => {
            notifications = d.notifications || [];
            unreadCount = d.unread_count || 0;
        })">
        <div class="flex justify-between items-center mx-auto max-w-screen-2xl 2xl:max-w-[2000px] px-4 xl:px-6">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center lg:ml-2 group relative">
                <div
                    class="w-11 h-11 rounded-xl bg-linear-to-br from-blue-500 via-blue-600 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:shadow-xl group-hover:shadow-blue-500/50 transition-all duration-500 group-hover:scale-110 group-hover:rotate-3 relative overflow-hidden">
                    <!-- Animated glow effect -->
                    <div
                        class="absolute inset-0 bg-white/20 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    </div>
                    <svg class="w-6 h-6 text-white relative z-10 group-hover:scale-110 transition-transform duration-500"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <div class="ml-3">
                    <span
                        class="text-xl font-extrabold bg-linear-to-r from-blue-600 via-indigo-600 to-purple-600 bg-clip-text text-transparent group-hover:from-blue-700 group-hover:via-indigo-700 group-hover:to-purple-700 transition-all duration-300">EduLearn</span>
                    <div
                        class="h-0.5 w-0 group-hover:w-full bg-linear-to-r from-blue-500 to-purple-500 transition-all duration-500 rounded-full">
                    </div>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <div class="hidden lg:flex items-center gap-2">
                @php
                    $isGuru = auth()->check() && auth()->user()->role === 'guru';
                    $activeColor = $isGuru ? 'purple' : 'blue';
                @endphp
                <x-ui.topnav-item href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" activeColor="{{ $activeColor }}">
                    <x-slot:icon>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </x-slot:icon>
                    Dashboard
                </x-ui.topnav-item>

                <x-ui.topnav-item href="{{ route('kelas') }}" :active="request()->routeIs('kelas') || request()->routeIs('kelas.*')" activeColor="{{ $activeColor }}">
                    <x-slot:icon>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </x-slot:icon>
                    {{ $isGuru ? 'Kelola Kelas' : 'Kelas Saya' }}
                </x-ui.topnav-item>

                <x-ui.topnav-item href="{{ route('tugas') }}" :active="request()->routeIs('tugas') || request()->routeIs('tugas.*')" activeColor="{{ $activeColor }}">
                    <x-slot:icon>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </x-slot:icon>
                    {{ $isGuru ? 'Kelola Tugas' : 'Tugas Saya' }}
                </x-ui.topnav-item>

                <x-ui.topnav-item href="{{ route('nilai') }}" :active="request()->routeIs('nilai') || request()->routeIs('nilai.*')" activeColor="{{ $activeColor }}">
                    <x-slot:icon>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if ($isGuru)
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            @endif
                        </svg>
                    </x-slot:icon>
                    {{ $isGuru ? 'Penilaian' : 'Nilai Saya' }}
                </x-ui.topnav-item>
            </div>

            <!-- Right actions (desktop) -->
            <div class="hidden lg:flex items-center gap-4">
                <!-- Notifications -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="group relative p-2.5 rounded-xl hover:bg-linear-to-br hover:from-blue-50 hover:to-indigo-50 transition-all duration-300 hover:scale-105">
                        <svg class="w-6 h-6 text-gray-600 group-hover:text-blue-600 transition-colors duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span x-show="unreadCount > 0" x-text="unreadCount"
                            class="absolute -top-1 -right-1 text-[10px] font-bold leading-none px-2 py-1 rounded-full bg-linear-to-r from-red-500 to-pink-500 text-white shadow-lg shadow-red-500/50 animate-pulse"></span>
                    </button>
                    <div x-show="open" @click.away="open=false" x-transition
                        class="absolute right-0 mt-2 w-80 bg-white border border-gray-100 rounded-xl shadow-lg overflow-hidden z-50"
                        style="display:none;">
                        <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                            <p class="text-sm font-semibold text-gray-900">Notifikasi</p>
                            <a href="{{ route('notifications.index') }}"
                                class="text-xs text-blue-600 hover:text-blue-700">Lihat semua</a>
                        </div>
                        <div class="max-h-80 overflow-y-auto divide-y divide-gray-50" x-show="notifications.length">
                            <template x-for="notif in notifications" :key="notif.id">
                                <div>
                                    <a :href="notif.link || '/notifications'"
                                        @click.prevent="(e) => {
                                            if (!notif.is_read) {
                                                fetch(`/notifications/${notif.id}/read`, {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                                                    }
                                                }).then(() => {
                                                    notif.is_read = true;
                                                    unreadCount = Math.max(0, unreadCount - 1);
                                                    if (notif.link) {
                                                        window.location.href = notif.link;
                                                    }
                                                });
                                            } else if (notif.link) {
                                                window.location.href = notif.link;
                                            }
                                        }"
                                        class="block px-4 py-3 hover:bg-gray-50/60 transition-colors cursor-pointer"
                                        :class="{ 'bg-blue-50/40': !notif.is_read }">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900" x-text="notif.title"></p>
                                                <p class="text-xs text-gray-600 mt-0.5 line-clamp-2"
                                                    x-text="notif.message">
                                                </p>
                                                <p class="text-[11px] text-gray-400 mt-1"
                                                    x-text="new Date(notif.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' })">
                                                </p>
                                            </div>
                                            <span x-show="!notif.is_read"
                                                class="shrink-0 ml-2 w-2 h-2 bg-blue-500 rounded-full"></span>
                                        </div>
                                    </a>
                                </div>
                            </template>
                        </div>
                        <div class="px-4 py-6 text-center text-sm text-gray-500" x-show="!notifications.length">
                            Belum ada notifikasi
                        </div>
                    </div>
                </div>

                <!-- Profile -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="group flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-linear-to-r hover:from-blue-50 hover:to-purple-50 transition-all duration-300">
                        <div
                            class="relative w-10 h-10 rounded-xl overflow-hidden ring-2 ring-blue-200 group-hover:ring-4 group-hover:ring-blue-300/50 bg-linear-to-br from-blue-50 to-purple-50 transition-all duration-300 group-hover:scale-105">
                            @auth
                                @if (auth()->user()->avatar_path)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" alt="Avatar"
                                        class="w-full h-full object-cover">
                                @else
                                    <svg class="absolute w-12 h-12 text-blue-400 -left-1" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @endif
                            @endauth
                        </div>
                        <div class="hidden xl:block text-left">
                            @auth
                                <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ auth()->user()->role === 'guru' ? 'Teacher' : 'Student' }}</p>
                            @else
                                <p class="text-sm font-semibold text-gray-900">Guest</p>
                                <p class="text-xs text-gray-500">Pengunjung</p>
                            @endauth
                        </div>
                        <svg class="w-4 h-4 text-gray-500 group-hover:text-blue-600 transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open=false" x-transition
                        class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-50"
                        style="display:none;">
                        @auth
                            <div class="px-4 py-3 border-b border-gray-100 bg-linear-to-r from-blue-50 to-purple-50">
                                <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                            </div>
                        @endauth
                        <a href="{{ route('profile.show') }}"
                            class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profil Saya
                        </a>
                        <div class="border-t border-gray-100">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile toggle -->
            <button class="lg:hidden p-2 rounded-lg hover:bg-gray-50" @click="mobileMenuOpen = !mobileMenuOpen">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileMenuOpen" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-transition class="w-full lg:hidden border-b border-gray-100 bg-white" x-cloak>
        <div class="px-4 py-4">
            @auth
                @php
                    $isGuru = auth()->user()->role === 'guru';
                    $mobileColor = $isGuru ? 'purple' : 'blue';
                @endphp
                <div
                    class="px-3 py-3 mb-3 bg-linear-to-r from-{{ $mobileColor }}-50 to-{{ $mobileColor }}-100 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 rounded-xl overflow-hidden bg-linear-to-br from-{{ $mobileColor }}-100 to-{{ $mobileColor }}-200 ring-2 ring-{{ $mobileColor }}-200 flex items-center justify-center">
                            @if (auth()->user()->avatar_path)
                                <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" alt="Avatar"
                                    class="w-full h-full object-cover">
                            @else
                                <svg class="w-8 h-8 text-{{ $mobileColor }}-400" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    @if ($isGuru)
                                        <path
                                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01-.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                    @else
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    @endif
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-600">{{ auth()->user()->email }}</p>
                            <p class="text-xs text-{{ $mobileColor }}-600 font-medium">
                                {{ $isGuru ? '👨‍🏫 Guru' : '👨‍🎓 Siswa' }}</p>
                        </div>
                    </div>
                </div>
            @endauth

            <ul class="flex flex-col space-y-2">
                @php
                    $isGuru = auth()->check() && auth()->user()->role === 'guru';
                    $mobileActiveColor = $isGuru ? 'purple' : 'blue';
                @endphp
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-3 py-3 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-' . $mobileActiveColor . '-50 text-' . $mobileActiveColor . '-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('kelas') }}"
                        class="flex items-center px-3 py-3 rounded-xl transition-all {{ request()->routeIs('kelas') || request()->routeIs('kelas.*') ? 'bg-' . $mobileActiveColor . '-50 text-' . $mobileActiveColor . '-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        {{ $isGuru ? 'Kelola Kelas' : 'Kelas Saya' }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('tugas') }}"
                        class="flex items-center px-3 py-3 rounded-xl transition-all {{ request()->routeIs('tugas') || request()->routeIs('tugas.*') ? 'bg-' . $mobileActiveColor . '-50 text-' . $mobileActiveColor . '-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        {{ $isGuru ? 'Kelola Tugas' : 'Tugas Saya' }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('nilai') }}"
                        class="flex items-center px-3 py-3 rounded-xl transition-all {{ request()->routeIs('nilai') || request()->routeIs('nilai.*') ? 'bg-' . $mobileActiveColor . '-50 text-' . $mobileActiveColor . '-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if ($isGuru)
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            @endif
                        </svg>
                        {{ $isGuru ? 'Penilaian' : 'Nilai Saya' }}
                    </a>
                </li>

                <li class="border-t border-gray-200"></li>

                @auth
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center px-3 py-3 rounded-xl text-red-600 hover:bg-red-50">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</header>
