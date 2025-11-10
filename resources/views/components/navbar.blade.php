<header>
    <nav class="bg-white/80 backdrop-blur-xl border-b border-gray-100 px-4 lg:px-8 py-4 shadow-minimal sticky top-0 z-50" 
         x-data="{ 
            mobileMenuOpen: false,
            notificationOpen: false,
            notifications: [],
            unreadCount: 0,
            loading: false
         }"
         x-init="
            // Load notifications on page load
            fetch('{{ route('notifications.unread') }}')
                .then(res => res.json())
                .then(data => {
                    notifications = data.notifications;
                    unreadCount = data.unread_count;
                });
         ">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-2xl">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center lg:ml-2 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-md group-hover:shadow-lg transition-all duration-300 group-hover:scale-105">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <span class="ml-3 text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text text-transparent">EduLearn</span>
            </a>

            <!-- Menu Desktop -->
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1">
                @php
                    $isGuru = auth()->check() && auth()->user()->role === 'guru';
                    $activeColor = $isGuru ? 'purple' : 'blue';
                @endphp
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-2 lg:mt-0">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-'.$activeColor.'-50 text-'.$activeColor.'-600 font-semibold' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kelas') }}" class="flex items-center px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('kelas') || request()->routeIs('kelas.*') ? 'bg-'.$activeColor.'-50 text-'.$activeColor.'-600 font-semibold' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            {{ $isGuru ? 'Kelola Kelas' : 'Kelas Saya' }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tugas') }}" class="flex items-center px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('tugas') || request()->routeIs('tugas.*') ? 'bg-'.$activeColor.'-50 text-'.$activeColor.'-600 font-semibold' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            {{ $isGuru ? 'Kelola Tugas' : 'Tugas Saya' }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('nilai') }}" class="flex items-center px-4 py-2 rounded-xl transition-all duration-300 {{ request()->routeIs('nilai') || request()->routeIs('nilai.*') ? 'bg-'.$activeColor.'-50 text-'.$activeColor.'-600 font-semibold' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($isGuru)
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                @endif
                            </svg>
                            {{ $isGuru ? 'Penilaian' : 'Nilai Saya' }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Right Side Actions -->
            <div class="flex items-center gap-3 lg:order-2">
                <!-- Search (optional) -->
                <button type="button" class="hidden lg:flex p-2.5 text-gray-500 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                <!-- Notifications -->
                <div class="relative" x-data @click.away="notificationOpen = false">
                    <button @click="notificationOpen = !notificationOpen" type="button" class="relative p-2.5 text-gray-500 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <!-- Badge Counter -->
                        <span x-show="unreadCount > 0" 
                              x-text="unreadCount > 9 ? '9+' : unreadCount"
                              class="absolute top-1.5 right-1.5 min-w-[18px] h-[18px] bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center px-1 animate-pulse">
                        </span>
                    </button>

                    <!-- Notification Dropdown -->
                    <div x-show="notificationOpen"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-96 bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50"
                         style="display: none;">
                        
                        <!-- Header -->
                        <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center bg-gradient-to-r from-blue-50 to-blue-100">
                            <h3 class="text-sm font-semibold text-gray-900">Notifikasi</h3>
                            <button @click="
                                fetch('{{ route('notifications.readAll') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                                    }
                                }).then(() => {
                                    notifications.forEach(n => n.is_read = true);
                                    unreadCount = 0;
                                });
                            " class="text-xs text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                Tandai Semua Dibaca
                            </button>
                        </div>

                        <!-- Notification List -->
                        <div class="max-h-96 overflow-y-auto">
                            <template x-if="notifications.length === 0">
                                <div class="px-4 py-8 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="text-sm">Tidak ada notifikasi</p>
                                </div>
                            </template>

                            <template x-for="notif in notifications" :key="notif.id">
                                <a :href="notif.link || '#'" 
                                   @click="
                                        if(!notif.is_read) {
                                            fetch(`/notifications/${notif.id}/read`, {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                                                }
                                            }).then(() => {
                                                notif.is_read = true;
                                                unreadCount = Math.max(0, unreadCount - 1);
                                            });
                                        }
                                   "
                                   class="block px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-0"
                                   :class="{ 'bg-blue-50/50': !notif.is_read }">
                                    <div class="flex items-start gap-3">
                                        <!-- Icon based on type -->
                                        <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center"
                                             :class="{
                                                'bg-blue-100': notif.type === 'tugas_baru',
                                                'bg-yellow-100': notif.type === 'deadline_reminder',
                                                'bg-green-100': notif.type === 'nilai_keluar',
                                                'bg-purple-100': notif.type === 'info'
                                             }">
                                            <svg class="w-5 h-5"
                                                 :class="{
                                                    'text-blue-600': notif.type === 'tugas_baru',
                                                    'text-yellow-600': notif.type === 'deadline_reminder',
                                                    'text-green-600': notif.type === 'nilai_keluar',
                                                    'text-purple-600': notif.type === 'info'
                                                 }"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 mb-0.5" x-text="notif.title"></p>
                                            <p class="text-xs text-gray-600 line-clamp-2 mb-1" x-text="notif.message"></p>
                                            <p class="text-xs text-gray-400" x-text="new Date(notif.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' })"></p>
                                        </div>
                                        <!-- Unread indicator -->
                                        <div x-show="!notif.is_read" class="flex-shrink-0 w-2 h-2 bg-blue-500 rounded-full"></div>
                                    </div>
                                </a>
                            </template>
                        </div>

                        <!-- Footer -->
                        <div class="px-4 py-3 border-t border-gray-100 bg-gray-50">
                            <a href="{{ route('notifications.index') }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                Lihat Semua Notifikasi →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Profile & Logout -->
                <div class="hidden lg:flex items-center gap-3 ml-3 pl-3 border-l border-gray-200" x-data="{ profileOpen: false }">
                    <div class="flex items-center gap-3 cursor-pointer" @click="profileOpen = !profileOpen">
                        <div class="relative w-10 h-10 rounded-xl overflow-hidden bg-gradient-to-br from-blue-100 to-blue-200 ring-2 ring-blue-100">
                            <svg class="absolute w-12 h-12 text-blue-400 -left-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="hidden xl:block">
                            @auth
                            <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ ucfirst(auth()->user()->role ?? 'Siswa') }}</p>
                            @else
                            <p class="text-sm font-semibold text-gray-900">Guest</p>
                            <p class="text-xs text-gray-500">Pengunjung</p>
                            @endauth
                        </div>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>

                    <!-- Dropdown Menu -->
                    <div x-show="profileOpen"
                         @click.away="profileOpen = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-4 top-16 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden z-50"
                         style="display: none;">
                        @auth
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        @endauth
                        <div class="py-2">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profil Saya
                                </div>
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Pengaturan
                                </div>
                            </a>
                        </div>
                        <div class="border-t border-gray-100">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center p-2.5 text-gray-500 rounded-xl lg:hidden hover:bg-gray-50 transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="w-full lg:hidden mt-4"
                x-cloak>
                
                <!-- Profile Info Mobile -->
                @auth
                @php
                    $isGuru = auth()->user()->role === 'guru';
                    $mobileColor = $isGuru ? 'purple' : 'blue';
                @endphp
                <div class="px-4 py-3 mb-3 bg-gradient-to-r from-{{ $mobileColor }}-50 to-{{ $mobileColor }}-100 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl overflow-hidden bg-gradient-to-br from-{{ $mobileColor }}-100 to-{{ $mobileColor }}-200 ring-2 ring-{{ $mobileColor }}-200 flex items-center justify-center">
                            <svg class="w-8 h-8 text-{{ $mobileColor }}-400" fill="currentColor" viewBox="0 0 20 20">
                                @if($isGuru)
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                @else
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                @endif
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-600">{{ auth()->user()->email }}</p>
                            <p class="text-xs text-{{ $mobileColor }}-600 font-medium">{{ $isGuru ? '👨‍🏫 Guru' : '👨‍🎓 Siswa' }}</p>
                        </div>
                    </div>
                </div>
                @endauth
                
                <ul class="flex flex-col space-y-2 pb-4">
                    @php
                        $isGuru = auth()->check() && auth()->user()->role === 'guru';
                        $mobileActiveColor = $isGuru ? 'purple' : 'blue';
                    @endphp
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-'.$mobileActiveColor.'-50 text-'.$mobileActiveColor.'-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kelas') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('kelas') || request()->routeIs('kelas.*') ? 'bg-'.$mobileActiveColor.'-50 text-'.$mobileActiveColor.'-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            {{ $isGuru ? 'Kelola Kelas' : 'Kelas Saya' }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tugas') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('tugas') || request()->routeIs('tugas.*') ? 'bg-'.$mobileActiveColor.'-50 text-'.$mobileActiveColor.'-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            {{ $isGuru ? 'Kelola Tugas' : 'Tugas Saya' }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('nilai') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('nilai') || request()->routeIs('nilai.*') ? 'bg-'.$mobileActiveColor.'-50 text-'.$mobileActiveColor.'-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($isGuru)
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                @endif
                            </svg>
                            {{ $isGuru ? 'Penilaian' : 'Nilai Saya' }}
                        </a>
                    </li>
                    
                    <!-- Divider -->
                    <li class="border-t border-gray-200 my-2"></li>
                    
                    <!-- Logout Button Mobile -->
                    @auth
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-4 py-3 rounded-xl transition-all duration-300 text-red-600 hover:bg-red-50">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>