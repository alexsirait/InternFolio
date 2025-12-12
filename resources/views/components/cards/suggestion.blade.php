@props([
    'category_name' => null,
    'bg_color' => null,
    'txt_color' => null,
    'suggestion_title' => null,
    'user_name' => null,
    'created_at' => null,
    'url' => '#',
])

<a href="{{ $url }}" class="block group">
    <div class="bg-white rounded-xl shadow-sm group-hover:shadow-lg transition-all duration-300 p-5 border border-gray-200 group-hover:border-blue-300">

        {{-- TOP ROW: Category (left) & Created At (right) --}}
        <div class="flex items-start justify-between gap-3">

            {{-- Category --}}
            @if ($category_name)
                <span class="inline-block text-[11px] font-semibold px-2 py-1 rounded-md"
                    style="background-color: #{{ substr($bg_color, -6) }}; color: #{{ substr($txt_color, -6) }};">
                    {{ $category_name }}
                </span>
            @endif

            {{-- Created At --}}
            @if ($created_at)
                <span class="text-[11px] text-gray-400 whitespace-nowrap">
                    {{ \Carbon\Carbon::parse($created_at)->diffForHumans() }}
                </span>
            @endif

        </div>

        {{-- Title --}}
        <h3 class="mt-3 font-bold text-gray-900 text-[15px] leading-snug line-clamp-2 group-hover:text-blue-600 transition">
            {{ $suggestion_title }}
        </h3>

        {{-- Author --}}
        <p class="text-xs text-gray-500 mt-1">
            by <span class="font-medium text-gray-700">{{ $user_name }}</span>
        </p>

    </div>
</a>
