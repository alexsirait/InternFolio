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

<a href="{{ $url }}" class="block group h-full">
    <div class="h-full bg-white shadow-md hover:shadow-2xl transition-all duration-300 rounded-2xl overflow-hidden 
                border border-gray-100 group-hover:border-indigo-300 transform group-hover:-translate-y-2">

        {{-- Thumbnail dengan Zoom Effect --}}
        <div class="relative h-56 bg-gradient-to-br from-gray-200 to-gray-300 overflow-hidden">

            {{-- Category Badge --}}
            <span class="absolute top-4 left-4 text-xs px-3 py-1.5 rounded-lg font-bold shadow-lg z-10 backdrop-blur-sm border border-white/20"
                style="background-color: #{{ substr($bg_color, -6) }}; color: #{{ substr($txt_color, -6) }};">
                {{ $category_name }}
            </span>

            {{-- Image dengan Zoom --}}
            @if ($photo_url)
                <img src="{{ asset('storage/' . $photo_url) }}"
                     alt="{{ $project_title }}"
                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
            @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-100 to-indigo-200">
                    <svg class="w-20 h-20 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif

            {{-- Gradient Overlay on Hover --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                <div class="text-white">
                    <p class="text-xs font-medium flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Lihat Detail
                    </p>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="p-6 flex flex-col flex-1">

            {{-- Title --}}
            <h3 class="font-bold text-xl text-gray-900 leading-tight mb-3 line-clamp-2 group-hover:text-indigo-600 transition-colors">
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
                <div class="mb-4">
                    <p class="text-xs text-gray-500 font-semibold mb-2 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                        Technologies:
                    </p>
                    <div class="flex flex-wrap gap-2">
                        @foreach (array_slice($technologies, 0, 4) as $tech)
                            <span class="text-xs px-2.5 py-1 bg-indigo-50 text-indigo-700 font-semibold rounded-md border border-indigo-200 hover:bg-indigo-100 transition">
                                {{ $tech }}
                            </span>
                        @endforeach
                        @if (count($technologies) > 4)
                            <span class="text-xs px-2.5 py-1 bg-gray-100 text-gray-600 font-semibold rounded-md">
                                +{{ count($technologies) - 4 }} more
                            </span>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Bottom Section: Author & Duration --}}
            <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                {{-- Author --}}
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-sm">
                        {{ strtoupper(substr($user_name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">by</p>
                        <p class="text-sm font-semibold text-gray-700">{{ $user_name }}</p>
                    </div>
                </div>

                {{-- Duration --}}
                @if ($project_duration)
                    <div class="flex items-center gap-1.5 bg-indigo-50 px-3 py-1.5 rounded-lg border border-indigo-200">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xs font-semibold text-indigo-700">{{ $project_duration }} bln</span>
                    </div>
                @endif
            </div>

        </div>

    </div>
</a>
