@php
    // expects $class (model or array) to be available
    $id = data_get($class, 'id', null);
    $title = data_get($class, 'nama', data_get($class, 'title', '-'));
    $teacher = data_get($class, 'guru', '---');
    $semester = data_get($class, 'semester', '---');
    $color = data_get($class, 'warna', data_get($class, 'color', 'blue'));
    $progress = (int) data_get($class, 'progress', data_get($class, 'progress', 0));

    // Check if color is preset or custom
    $isCustomColor = !in_array($color, ['blue', 'green', 'purple', 'red', 'yellow', 'pink']);

    if ($isCustomColor) {
        // Use custom color directly
        $bgGradient = $color;
    } else {
        // Use preset color map
        $colorMap = [
            'blue' => ['from' => '#3b82f6', 'to' => '#1e40af'],
            'green' => ['from' => '#10b981', 'to' => '#065f46'],
            'purple' => ['from' => '#a855f7', 'to' => '#6b21a8'],
            'red' => ['from' => '#ef4444', 'to' => '#991b1b'],
            'yellow' => ['from' => '#f59e0b', 'to' => '#b45309'],
            'pink' => ['from' => '#ec4899', 'to' => '#9f1239'],
        ];
        $gradientColors = $colorMap[$color] ?? $colorMap['blue'];
        $bgGradient = "linear-gradient(135deg, {$gradientColors['from']} 0%, {$gradientColors['to']} 100%)";
    }
@endphp

<a href="{{ $id ? route('kelas.detail', ['id' => $id]) : '#' }}"
    class="block group rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 ease-out transform hover:-translate-y-1"
    style="background: {{ $bgGradient }};">

    <!-- Pattern Overlay -->
    <div class="relative">
        <div class="absolute inset-0 opacity-10 group-hover:opacity-20 transition-opacity duration-300"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>

        <div class="relative p-4 text-white">
            <!-- Header -->
            <div class="mb-3">
                <h3
                    class="text-lg font-bold mb-1 drop-shadow-md transition-all duration-300 group-hover:drop-shadow-lg group-hover:translate-x-1">
                    {{ $title }}
                </h3>
                <div
                    class="flex items-center gap-2 text-xs opacity-90 group-hover:opacity-100 transition-all duration-300">
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:scale-110" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="drop-shadow">{{ $teacher }}</span>
                </div>
                <div
                    class="flex items-center gap-2 text-[11px] mt-0.5 opacity-80 group-hover:opacity-100 transition-all duration-300">
                    <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:scale-110" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="drop-shadow">{{ $semester }}</span>
                </div>
            </div>

            <!-- Progress Section -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <span
                        class="text-[11px] font-semibold uppercase tracking-wider opacity-90 group-hover:opacity-100 transition-opacity duration-300">Progress
                        Kelas</span>
                    <span
                        class="text-base font-bold drop-shadow-lg transition-all duration-300 group-hover:scale-110">{{ $progress }}%</span>
                </div>
                <div
                    class="w-full bg-white/20 backdrop-blur-sm rounded-full h-2 overflow-hidden shadow-inner group-hover:bg-white/30 transition-colors duration-300">
                    <div class="h-2 rounded-full transition-all duration-1500 ease-out shadow-lg"
                        data-progress="{{ $progress }}" style="width: 0%; background: white;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
