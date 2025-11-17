@props(['href' => '#', 'active' => false, 'activeColor' => 'blue'])
@php
    $classes = $active
        ? 'flex items-center px-4 py-3.5 text-sm font-bold rounded-xl transition-all duration-300 bg-linear-to-r from-' .
            $activeColor .
            '-500 to-' .
            $activeColor .
            '-600 text-white shadow-lg hover:shadow-xl transform hover:scale-[1.03] hover:-translate-y-0.5 relative overflow-visible hover:z-10 group'
        : 'flex items-center px-4 py-3.5 text-sm font-medium rounded-xl transition-all duration-300 text-gray-700 hover:bg-linear-to-r hover:from-gray-50 hover:to-blue-50/50 hover:text-gray-900 hover:shadow-sm relative overflow-visible hover:z-10 group';
@endphp
<a href="{{ $href }}" class="{{ $classes }}">
    @if ($active)
        <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
    @endif
    <div class="relative flex items-center w-full">
        <div
            class="p-1.5 rounded-lg {{ $active ? 'bg-white/20' : 'bg-blue-100 group-hover:bg-blue-200' }} mr-3 transition-colors duration-300">
            {{ $icon ?? '' }}
        </div>
        <span class="flex-1">{{ $slot }}</span>
        @if ($active)
            <span class="text-xs opacity-75">●</span>
        @endif
    </div>
</a>
