@php
    // expects $class (model or array) to be available
    $id = data_get($class, 'id', null);
    $title = data_get($class, 'nama', data_get($class, 'title', '-'));
    $teacher = data_get($class, 'guru', '---');
    $semester = data_get($class, 'semester', '---');
    $color = data_get($class, 'warna', data_get($class, 'color', 'blue'));
    $progress = (int) data_get($class, 'progress', data_get($class, 'progress', 0));
    
    // Define color values for gradient
    $colorMap = [
        'blue' => ['from' => '#60a5fa', 'to' => '#2563eb', 'lighter' => '#dbeafe', 'light' => '#bfdbfe'],
        'green' => ['from' => '#4ade80', 'to' => '#16a34a', 'lighter' => '#d1fae5', 'light' => '#a7f3d0'],
        'purple' => ['from' => '#c084fc', 'to' => '#9333ea', 'lighter' => '#e9d5ff', 'light' => '#d8b4fe'],
        'red' => ['from' => '#f87171', 'to' => '#dc2626', 'lighter' => '#fee2e2', 'light' => '#fecaca'],
        'yellow' => ['from' => '#fbbf24', 'to' => '#d97706', 'lighter' => '#fef3c7', 'light' => '#fde68a'],
        'pink' => ['from' => '#f472b6', 'to' => '#db2777', 'lighter' => '#fce7f3', 'light' => '#fbcfe8'],
    ];
    $gradientColors = $colorMap[$color] ?? $colorMap['blue'];
@endphp

<div class="group bg-white/80 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-minimal hover:shadow-minimal-hover overflow-hidden transition-all duration-500 ease-out hover:-translate-y-2 animate-fade-in-scale">
    <!-- Gradient stripe at top -->
    <div class="h-2 transition-all duration-300 group-hover:h-3" 
         style="background: linear-gradient(to right, {{ $gradientColors['from'] }}, {{ $gradientColors['to'] }});"></div>
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-1 transition-colors duration-300">{{ $title }}</h3>
        <p class="text-sm text-gray-500 mb-4">{{ $teacher }} • {{ $semester }}</p>
        
        <!-- Progress Bar -->
        <div class="mb-4">
            <div class="flex justify-between text-xs text-gray-600 mb-2">
                <span class="font-medium">Progress Kelas</span>
                <span class="font-bold" style="color: {{ $gradientColors['to'] }};">{{ $progress }}%</span>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                <div class="h-2 rounded-full transition-all duration-[1500ms] ease-out shadow-sm"
                    data-progress="{{ $progress }}"
                    style="width: 0%; background: linear-gradient(to right, {{ $gradientColors['from'] }}, {{ $gradientColors['to'] }});">
                </div>
            </div>
        </div>

        <a href="{{ $id ? route('kelas.detail', ['id' => $id]) : '#' }}" 
           class="block text-center py-3 px-4 rounded-xl transition-all duration-300 font-semibold group-hover:scale-105"
           style="background-color: white; color: {{ $gradientColors['to'] }};"
           onmouseover="this.style.backgroundColor='{{ $gradientColors['lighter'] }}'"
           onmouseout="this.style.backgroundColor='white'">
            Masuk Kelas
        </a>
    </div>
</div>
