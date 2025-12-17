@props([
    'category_name',
    'bg_color' => null,
    'txt_color' => null,
    'project_title',
    'user_name',
    'project_description' => null,
    'project_technology' => null,
    'photo_url' => null,
    'url' => '#',
])

@php
    $technologies = $project_technology
        ? array_map('trim', explode(',', $project_technology))
        : [];
@endphp

<a href="{{ $url }}" class="block group h-full">
    <div class="bg-white shadow-md hover:shadow-2xl transition-all duration-300 rounded-2xl overflow-hidden h-full flex flex-col border border-gray-100 group-hover:border-blue-300">

        {{-- Thumbnail --}}
        <div class="relative h-56 bg-gradient-to-br from-gray-200 to-gray-300 overflow-hidden">

            {{-- Category Badge --}}
            <span class="absolute top-4 left-4 text-xs px-3 py-1.5 rounded-lg font-bold shadow-lg z-10 backdrop-blur-sm"
                style="background-color: #{{ substr($bg_color, -6) }}; color: #{{ substr($txt_color, -6) }};">
                {{ $category_name }}
            </span>

            {{-- Image --}}
            @if ($photo_url)
                <img src="{{ asset('storage/' . $photo_url) }}"
                     alt="{{ $project_title }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif

            {{-- Overlay on hover --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>

        {{-- Content --}}
        <div class="p-6 flex-1 flex flex-col">

            {{-- Title --}}
            <h3 class="font-bold text-xl text-gray-900 leading-tight mb-3 group-hover:text-blue-600 transition line-clamp-2">
                {{ $project_title }}
            </h3>

            {{-- Description --}}
            @if ($project_description)
                <p class="text-sm text-gray-600 mb-4 line-clamp-3 flex-1">
                    {{ $project_description }}
                </p>
            @endif

            {{-- Technologies --}}
            @if (!empty($technologies))
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach (array_slice($technologies, 0, 3) as $tech)
                        <span class="text-xs px-3 py-1 bg-blue-50 text-blue-700 font-semibold rounded-full border border-blue-200">
                            {{ $tech }}
                        </span>
                    @endforeach
                    @if (count($technologies) > 3)
                        <span class="text-xs px-3 py-1 bg-gray-100 text-gray-600 font-semibold rounded-full">
                            +{{ count($technologies) - 3 }}
                        </span>
                    @endif
                </div>
            @endif

            {{-- Author --}}
            <div class="flex items-center gap-2 pt-4 border-t border-gray-100">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                    {{ strtoupper(substr($user_name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-xs text-gray-500">Created by</p>
                    <p class="text-sm font-semibold text-gray-700">{{ $user_name }}</p>
                </div>
            </div>

        </div>

    </div>
</a>
