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
        $mainColor = $color;
        $lighterColor = $color; // Will use opacity for lighter version
    } else {
        // Use preset color map
        $colorMap = [
            'blue' => ['from' => '#3b82f6', 'to' => '#1e40af', 'light' => '#dbeafe', 'lighter' => '#eff6ff'],
            'green' => ['from' => '#10b981', 'to' => '#065f46', 'light' => '#d1fae5', 'lighter' => '#ecfdf5'],
            'purple' => ['from' => '#a855f7', 'to' => '#6b21a8', 'light' => '#e9d5ff', 'lighter' => '#f3e8ff'],
            'red' => ['from' => '#ef4444', 'to' => '#991b1b', 'light' => '#fecaca', 'lighter' => '#fee2e2'],
            'yellow' => ['from' => '#f59e0b', 'to' => '#b45309', 'light' => '#fde68a', 'lighter' => '#fef3c7'],
            'pink' => ['from' => '#ec4899', 'to' => '#9f1239', 'light' => '#fbcfe8', 'lighter' => '#fce7f3'],
        ];
        $gradientColors = $colorMap[$color] ?? $colorMap['blue'];
        $mainColor = $gradientColors['to'];
        $lighterColor = $gradientColors['lighter'];
    }
@endphp

<div
    class="group bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal hover:shadow-minimal-hover overflow-hidden transition-all duration-500 ease-out hover:-translate-y-2 animate-fade-in-scale">
    <!-- Gradient stripe at top -->
    @if ($isCustomColor)
        <div class="h-2 transition-all duration-300 group-hover:h-3" style="background: {{ $color }};"></div>
    @else
        <div class="h-2 transition-all duration-300 group-hover:h-3"
            style="background: linear-gradient(to right, {{ $gradientColors['from'] }}, {{ $gradientColors['to'] }});">
        </div>
    @endif

    <div class="p-5 pb-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-1 transition-colors duration-300">{{ $title }}</h3>
        <p class="text-sm text-gray-500 mb-3">{{ $teacher }} • {{ $semester }}</p>

        <!-- Progress Bar -->
        <div class="mb-3">
            <div class="flex justify-between text-xs text-gray-600 mb-1.5">
                <span class="font-medium">Progress Kelas</span>
                <span class="font-bold" style="color: {{ $mainColor }};">{{ $progress }}%</span>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                @if ($isCustomColor)
                    <div class="h-2 rounded-full transition-all duration-[1500ms] ease-out shadow-sm"
                        data-progress="{{ $progress }}" style="width: 0%; background: {{ $color }};">
                    </div>
                @else
                    <div class="h-2 rounded-full transition-all duration-[1500ms] ease-out shadow-sm"
                        data-progress="{{ $progress }}"
                        style="width: 0%; background: linear-gradient(to right, {{ $gradientColors['from'] }}, {{ $gradientColors['to'] }});">
                    </div>
                @endif
            </div>
        </div>

        <a href="{{ $id ? route('kelas.detail', ['id' => $id]) : '#' }}"
            class="block text-center py-2 px-4 rounded-xl transition-all duration-300 font-semibold group-hover:scale-105"
            style="background-color: {{ $isCustomColor ? 'rgba(0,0,0,0.05)' : 'white' }}; color: {{ $mainColor }};"
            onmouseover="this.style.backgroundColor='{{ $isCustomColor ? 'rgba(0,0,0,0.1)' : $lighterColor }}'"
            onmouseout="this.style.backgroundColor='{{ $isCustomColor ? 'rgba(0,0,0,0.05)' : 'white' }}'">
            Masuk Kelas
        </a>
    </div>
</div>
