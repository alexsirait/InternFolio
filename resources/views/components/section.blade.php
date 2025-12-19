@props([
    'title' => null,
    'subtitle' => null,
    'link' => null,
    'linkText' => 'Lihat Semua',
    'id' => null,
    'background' => 'default', // default | alternate
])

@php
    $classes = $attributes->get('class');
    $bgClass =
        $background === 'alternate' ? 'bg-gradient-to-br from-blue-50/30 via-white to-indigo-50/30' : 'bg-transparent';
@endphp

<div id="{{ $id }}" {{ $attributes->merge(['class' => "relative py-16 px-6 rounded-3xl $bgClass"]) }}>

    {{-- Decorative Accent Line --}}
    <div class="absolute top-0 left-6 w-20 h-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full"></div>

    <div class="max-w-7xl mx-auto">

        {{-- Header Title + Button --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
            <div class="flex-1">
                @if ($title)
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3 leading-tight">
                        {{ $title }}
                    </h2>
                @endif

                @if ($subtitle)
                    <p class="text-gray-600 text-lg max-w-2xl">{{ $subtitle }}</p>
                @endif
            </div>

            @if ($link)
                <a href="{{ $link }}"
                    class="inline-flex items-center gap-2 px-6 py-3 
                        bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold text-sm 
                        rounded-xl shadow-lg shadow-blue-500/30
                        hover:shadow-xl hover:shadow-blue-500/40 hover:from-blue-700 hover:to-indigo-700
                        transform hover:-translate-y-0.5
                        transition-all duration-200
                        group">

                    {{ $linkText }}

                    {{-- Icon Panah --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor"
                        class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>

                </a>
            @endif
        </div>

        {{-- Slot --}}
        <div>
            {{ $slot }}
        </div>
    </div>
</div>
