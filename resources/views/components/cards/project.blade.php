@props([
    'category_name',
    'bg_color' => null,
    'txt_color' => null,
    'project_title',
    'user_name',
    'project_description' => null,
    'project_duration' => null,
    'project_technology' => null,
    'photo_url' => null,
    'url' => '#',
])

@php
    $technologies = $project_technology
        ? array_map('trim', explode(',', $project_technology))
        : [];
@endphp

<a href="{{ $url }}" class="block group">
    <div class="bg-white shadow-md hover:shadow-lg transition rounded-xl overflow-hidden">

        {{-- Thumbnail --}}
        <div class="relative h-48 bg-gray-200">

            {{-- Category Badge (Overlay) --}}
            <span class="absolute top-3 left-3 text-[11px] px-2 py-1 rounded-md font-semibold shadow-sm z-10"
                style="background-color: #{{ substr($bg_color, -6) }}; color: #{{ substr($txt_color, -6) }};">
                {{ $category_name }}
            </span>

            {{-- Gambar --}}
            @if ($photo_url)
                <img src="{{ asset('storage/' . $photo_url) }}"
                     alt="{{ $project_title }}"
                     class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                    No Image
                </div>
            @endif
        </div>

        {{-- Content --}}
        <div class="p-5">

            {{-- Title --}}
            <h3 class="font-bold text-lg text-gray-800 leading-tight group-hover:text-blue-600 transition">
                {{ $project_title }}
            </h3>

            {{-- project_description --}}
            @if ($project_description)
                <p class="text-sm text-gray-600 mt-2 break-words">
                    {{ \Illuminate\Support\Str::words($project_description, 30, '...') }}
                </p>
            @endif

            {{-- Technologies --}}
            @if (!empty($technologies))
                <div class="flex flex-wrap gap-2 mt-3">
                    @foreach ($technologies as $tech)
                        <span class="text-[10px] px-2 py-1 bg-blue-50 text-blue-700 font-medium rounded-md border border-blue-200">
                            {{ $tech }}
                        </span>
                    @endforeach
                </div>
            @endif

            {{-- Author --}}
            <p class="text-xs text-gray-500 mt-2">
                by <span class="font-medium text-gray-700">{{ $user_name }}</span>
            </p>

            {{-- project_duration --}}
            @if ($project_duration)
                <p class="text-xs text-gray-400 mt-4 border-t pt-3">
                    Durasi: <span class="font-medium">{{ $project_duration }} bulan</span>
                </p>
            @endif

        </div>

    </div>
</a>
