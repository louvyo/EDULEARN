<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EduLearn - Learning Management System')</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"></script>

    @if (class_exists('\\Illuminate\\Support\\Facades\\Vite'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Timezone Utilities -->
    <script src="{{ asset('js/timezone-utils.js') }}" defer></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        * {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
    </style>

    @stack('head')
</head>

<body class="bg-gradient-to-br from-gray-50 via-white to-gray-50 min-h-screen">
    <div x-data="{
        sidebarOpen: false,
        isMobile: false,
    
        init() {
            // Check if mobile on init
            this.isMobile = window.innerWidth < 1024;
    
            // Load sidebar state from localStorage, default to true for desktop, false for mobile
            const savedState = localStorage.getItem('sidebarOpen');
    
            if (savedState !== null) {
                this.sidebarOpen = savedState === 'true';
            } else {
                this.sidebarOpen = !this.isMobile;
            }
    
            // Save to localStorage whenever sidebar state changes
            this.$watch('sidebarOpen', (value) => {
                localStorage.setItem('sidebarOpen', value);
            });
    
            // Handle window resize
            window.addEventListener('resize', () => {
                this.isMobile = window.innerWidth < 1024;
    
                // Auto-close sidebar on mobile if it was open
                if (this.isMobile && this.sidebarOpen) {
                    this.sidebarOpen = false;
                }
                // Auto-open sidebar on desktop if it was closed by mobile behavior
                if (!this.isMobile && !this.sidebarOpen && localStorage.getItem('sidebarOpen') === 'true') {
                    this.sidebarOpen = true;
                }
            });
        }
    }" class="flex min-h-screen">

        @include('components.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col transition-all duration-500 ease-out"
            :class="{
                'lg:ml-64': sidebarOpen && !isMobile,
                'ml-0': !sidebarOpen || isMobile
            }">

            <!-- Sticky Navbar -->
            <div class="sticky top-0 z-50">
                @include('components.navbar')
            </div>

            <main class="flex-1 p-4 lg:p-8 animate-fade-in">
                <div class="max-w-7xl 2xl:max-w-[1800px] mx-auto px-4 xl:px-6">
                    @if (session('success'))
                        <div class="mb-4 bg-green-50 border border-green-200 rounded-xl p-4 flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-sm font-medium text-green-800">{{ session('success') }}</div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-600 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M12 2a10 10 0 100 20 10 10 0 000-20z" />
                            </svg>
                            <div class="text-sm font-medium text-red-800">{{ session('error') }}</div>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-4 bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                            <div class="text-sm font-semibold text-yellow-800 mb-1">Periksa kembali input Anda:</div>
                            <ul class="list-disc list-inside text-sm text-yellow-800">
                                @foreach ($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="mt-auto py-6 px-8 border-t border-gray-100 bg-white/50 backdrop-blur-sm">
                <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                    <p class="mb-2 md:mb-0">&copy; 2025 EduLearn. Built with ❤️ for better learning.</p>
                    <div class="flex space-x-6">
                        <a href="#" class="hover:text-blue-600 transition-colors duration-200">Privacy</a>
                        <a href="#" class="hover:text-blue-600 transition-colors duration-200">Terms</a>
                        <a href="#" class="hover:text-blue-600 transition-colors duration-200">Support</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        document.documentElement.style.scrollBehavior = 'smooth';

        // Scroll to top on page load
        window.addEventListener('load', function() {
            window.scrollTo(0, 0);
        });

        // Also scroll to top immediately
        if (history.scrollRestoration) {
            history.scrollRestoration = 'manual';
        }
        window.scrollTo(0, 0);

        // Apply progress bar widths with animation
        document.addEventListener('DOMContentLoaded', function() {
            // Progress bars - animate after page fully loads
            setTimeout(function() {
                document.querySelectorAll('[data-progress]').forEach(function(el, index) {
                    var p = el.getAttribute('data-progress');
                    if (p !== null) {
                        // ensure numeric and clamp 0..100
                        var n = parseInt(p, 10) || 0;
                        if (n < 0) n = 0;
                        if (n > 100) n = 100;

                        // Stagger animation for each progress bar
                        setTimeout(function() {
                            el.style.width = n + '%';
                        }, index * 300); // Each bar animates 300ms after the previous
                    }
                });
            }, 500); // Wait 500ms after page load

            // Countdown timers for upcoming tasks
            function updateCountdowns() {
                document.querySelectorAll('.countdown').forEach(function(el) {
                    var deadline = el.getAttribute('data-deadline');
                    if (!deadline) return;

                    // Use TimezoneUtils if available, otherwise fallback to old method
                    if (window.TimezoneUtils) {
                        var countdown = window.TimezoneUtils.getCountdown(deadline);
                        el.textContent = countdown.text;

                        // Update classes based on urgency
                        el.classList.remove('text-red-600', 'text-orange-600', 'text-green-600',
                            'font-semibold');
                        if (countdown.isPast) {
                            el.classList.add('text-red-600', 'font-semibold');
                        } else if (countdown.isUrgent) {
                            el.classList.add('text-orange-600', 'font-semibold');
                        } else {
                            el.classList.add('text-gray-600');
                        }
                        return;
                    }

                    // Fallback for old browsers
                    var deadlineDate = new Date(deadline);
                    var now = new Date();
                    var diff = deadlineDate - now;

                    if (diff <= 0) {
                        el.textContent = 'Deadline terlewat';
                        el.classList.add('text-red-600', 'font-semibold');
                        return;
                    }

                    var days = Math.floor(diff / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((diff % (1000 * 60)) / 1000);

                    var countdownText = '';
                    if (days > 0) {
                        countdownText = days + 'h ' + hours + 'j ' + minutes + 'm ' + seconds + 'd';
                    } else if (hours > 0) {
                        countdownText = hours + 'j ' + minutes + 'm ' + seconds + 'd';
                    } else if (minutes > 0) {
                        countdownText = minutes + 'm ' + seconds + 'd';
                    } else {
                        countdownText = seconds + 'd';
                    }

                    el.textContent = countdownText;
                });
            }

            // Update immediately
            updateCountdowns();

            // Update every second
            setInterval(updateCountdowns, 1000);
        });

        // Optional: Clear sidebar state on page refresh if you want fresh start
        // localStorage.removeItem('sidebarOpen');
    </script>

    @stack('scripts')
    <!-- Hidden safelist for Tailwind to include dynamic color classes used in templates -->
    <div class="hidden" aria-hidden="true">
        bg-blue-50 bg-green-50 bg-purple-50 bg-orange-50
        bg-blue-600 bg-green-600 bg-purple-600 bg-orange-600
        text-blue-700 text-green-700 text-purple-700 text-orange-700
    </div>
    <script>
        // Apply dynamic styles that were moved to data- attributes to avoid CSS parser warnings
        document.addEventListener('DOMContentLoaded', function() {
            // transition delay in ms
            document.querySelectorAll('[data-transition-ms]').forEach(function(el) {
                var ms = el.getAttribute('data-transition-ms');
                if (ms !== null) {
                    el.style.transitionDelay = ms + 'ms';
                }
            });

            // progress bars
            document.querySelectorAll('[data-progress]').forEach(function(el) {
                var p = el.getAttribute('data-progress');
                if (p !== null) {
                    // ensure numeric and clamp 0..100
                    var n = parseInt(p, 10) || 0;
                    if (n < 0) n = 0;
                    if (n > 100) n = 100;
                    el.style.width = n + '%';
                }
            });
        });
    </script>
</body>

</html>
