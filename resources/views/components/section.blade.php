@props([
    'title' => null, 
    'subtitle' => null,
    'link' => null,
    'linkText' => 'Lihat Semua',
    'id' => null,
])

@php
    $classes = $attributes->get('class');
@endphp

<div id="{{ $id }}" {{ $attributes->merge(['class' => 'py-6 px-4 sm:px-6 lg:px-0']) }}>
    <div class="max-w-6xl mx-auto">

        {{-- Header Title + Button --}}
        <div class="flex items-center justify-between mb-1">
            @if ($title)
                <h2 class="text-2xl font-bold text-gray-900">{{ $title }}</h2>
            @endif

            @if ($link)
                <a href="{{ $link }}"
                    class="inline-flex items-center gap-2 px-4 py-1.5 
                        bg-white text-blue-600 font-semibold text-sm 
                        border border-blue-300 rounded-full shadow-sm
                        hover:shadow-md hover:bg-blue-50 hover:text-blue-700 
                        transition">
                    
                    {{ $linkText }}

                    {{-- Icon Panah --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>

                </a>

            @endif
        </div>

        {{-- Subtitle --}}
        @if ($subtitle)
            <p class="text-gray-600 mb-6">{{ $subtitle }}</p>
        @endif

        {{-- Slot --}}
        <div>
            {{ $slot }}
        </div>
    </div>
</div>
