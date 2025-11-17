@props(['href' => '#', 'active' => false, 'activeColor' => 'blue'])
@php
    $classes = $active
        ? 'group relative px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-300 text-white bg-linear-to-r from-' .
            $activeColor .
            '-500 to-' .
            $activeColor .
            '-600 shadow-lg shadow-' .
            $activeColor .
            '-500/30'
        : 'group relative px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-300 text-gray-700 hover:text-' .
            $activeColor .
            '-600 hover:bg-' .
            $activeColor .
            '-50/50';
@endphp
<a href="{{ $href }}" class="{{ $classes }}">
    <span class="flex items-center gap-2">
        {{ $icon ?? '' }}
        {{ $slot }}
    </span>
    @unless ($active)
        <div
            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 group-hover:w-3/4 h-0.5 bg-linear-to-r from-{{ $activeColor }}-400 to-{{ $activeColor }}-600 transition-all duration-300 rounded-full">
        </div>
    @endunless
</a>
