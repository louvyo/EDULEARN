<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Website JOKI')</title>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.1/dist/cdn.min.js"></script>

  @if (class_exists('\\Illuminate\\Support\\Facades\\Vite'))
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @else
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="{{ asset('js/app.js') }}" defer></script>
  @endif

  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>

  @stack('head')
</head>

<body class="bg-gray-50">
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
    <div class="flex-1 flex flex-col transition-all duration-300 ease-in-out"
      :class="{
                 'lg:ml-64': sidebarOpen && !isMobile,
                 'ml-0': !sidebarOpen || isMobile
             }">

      @include('components.navbar')

      <main class="flex-1 p-6">
        @yield('content')
      </main>
    </div>
  </div>

  <script>
    document.documentElement.style.scrollBehavior = 'smooth';

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
</body>

</html>