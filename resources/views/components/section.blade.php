@props(['title' => null, 'subtitle' => null])

<div class="py-12">
    <div class="max-w-6xl mx-auto">

        @if ($title)
            <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $title }}</h2>
        @endif

        @if ($subtitle)
            <p class="text-gray-600 mb-6">{{ $subtitle }}</p>
        @endif

        <div>
            {{ $slot }}
        </div>
    </div>
</div>
