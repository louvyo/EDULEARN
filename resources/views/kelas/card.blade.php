@php
    // expects $class (model or array) to be available
    $id = data_get($class, 'id', null);
    $title = data_get($class, 'nama', data_get($class, 'title', '-'));
    $teacher = data_get($class, 'guru', '---');
    $semester = data_get($class, 'semester', '---');
    $color = data_get($class, 'warna', data_get($class, 'color', 'blue'));
    $progress = (int) data_get($class, 'progress', data_get($class, 'progress', 0));
@endphp

<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">
    <div class="h-4 bg-{{ $color }}-500 transition-all duration-300"></div>
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
        <p class="text-sm text-gray-600 mt-1">{{ $teacher }} • {{ $semester }}</p>

        <div class="mt-4">
            <div class="flex justify-between text-xs text-gray-600 mb-2">
                <span>Progress Kelas</span>
                <span>{{ $progress }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="h-2 rounded-full bg-{{ $color }}-600" data-progress="{{ $progress }}"></div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ $id ? route('kelas.detail', ['id' => $id]) : '#' }}" class="inline-block w-full text-center py-2 px-4 bg-{{ $color }}-50 text-{{ $color }}-700 rounded-lg hover:bg-{{ $color }}-100 font-medium">Masuk Kelas</a>
        </div>
    </div>
</div>
