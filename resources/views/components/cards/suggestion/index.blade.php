@props([
    'category_name' => null,
    'bg_color' => null,
    'txt_color' => null,
    'suggestion_title' => null,
    'user_name' => null,
    'user_image' => null,
    'created_at' => null,
    'url' => '#',
])

<a href="{{ $url }}" class="block group h-full">
    <div class="h-full bg-white rounded-2xl shadow-sm group-hover:shadow-xl transition-all duration-300 
                p-6 border-l-4 group-hover:border-l-8 transform group-hover:-translate-y-1"
         style="border-color: #{{ substr($bg_color, -6) }};">
        
        {{-- Header: Category & Time --}}
        <div class="flex items-start justify-between mb-4 gap-3">
            @if ($category_name)
                <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm"
                    style="background-color: #{{ substr($bg_color, -6) }}; color: #{{ substr($txt_color, -6) }};">
                    {{-- Category Icon based on name --}}
                    @if (str_contains(strtolower($category_name), 'tips'))
                        💡
                    @elseif (str_contains(strtolower($category_name), 'tech'))
                        💻
                    @elseif (str_contains(strtolower($category_name), 'career'))
                        🎯
                    @elseif (str_contains(strtolower($category_name), 'skill'))
                        🚀
                    @else
                        ✨
                    @endif
                    {{ $category_name }}
                </span>
            @endif

            @if ($created_at)
                <span class="text-xs text-gray-400 flex items-center gap-1 whitespace-nowrap">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ \Carbon\Carbon::parse($created_at)->diffForHumans() }}
                </span>
            @endif
        </div>

        {{-- Title --}}
        <h3 class="font-bold text-gray-900 text-lg leading-snug mb-4 line-clamp-2 group-hover:text-green-600 transition-colors">
            {{ $suggestion_title }}
        </h3>

        {{-- Footer: Author & Arrow --}}
        <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
            <div class="flex items-center gap-2.5">
                @if ($user_image)
                    <img src="{{ asset('storage/' . $user_image) }}" 
                         alt="{{ $user_name }}"
                         class="w-9 h-9 rounded-full object-cover shadow-sm ring-2 ring-green-100">
                @else
                    <div class="w-9 h-9 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-sm">
                        {{ strtoupper(substr($user_name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <span class="text-xs text-gray-400">oleh</span>
                    <p class="text-sm font-semibold text-gray-700">{{ $user_name }}</p>
                </div>
            </div>

            {{-- Arrow indicator --}}
            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-green-50 text-green-600 
                        opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </div>
        </div>
    </div>
</a>
