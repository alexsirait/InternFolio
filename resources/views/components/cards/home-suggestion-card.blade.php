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
    <div class="bg-white rounded-xl shadow-sm group-hover:shadow-lg transition-all duration-300 p-6 border-l-4 group-hover:border-l-8"
         style="border-color: #{{ substr($bg_color, -6) }};">
        
        {{-- Header: Category & Time --}}
        <div class="flex items-center justify-between mb-3">
            @if ($category_name)
                <span class="inline-block text-xs font-bold px-3 py-1.5 rounded-lg"
                    style="background-color: #{{ substr($bg_color, -6) }}; color: #{{ substr($txt_color, -6) }};">
                    {{ $category_name }}
                </span>
            @endif

            @if ($created_at)
                <span class="text-xs text-gray-400 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ \Carbon\Carbon::parse($created_at)->diffForHumans() }}
                </span>
            @endif
        </div>

        {{-- Title --}}
        <h3 class="font-bold text-gray-900 text-base leading-snug mb-3 line-clamp-2 group-hover:text-blue-600 transition">
            {{ $suggestion_title }}
        </h3>

        {{-- Author --}}
        <div class="flex items-center gap-2 text-sm">
            <div class="w-6 h-6 bg-gradient-to-br from-gray-400 to-gray-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                {{ strtoupper(substr($user_name, 0, 1)) }}
            </div>
            <span class="text-gray-600">
                <span class="text-gray-400">by</span> <span class="font-semibold text-gray-700">{{ $user_name }}</span>
            </span>
        </div>

        {{-- Arrow indicator on hover --}}
        <div class="flex justify-end mt-4 opacity-0 group-hover:opacity-100 transition-opacity">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </div>
    </div>
</a>
