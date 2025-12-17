@props([
    'user_name',
    'position',
    'join_date' => null,
    'end_date' => null,
    'school',
    'major',
    'rating_range' => null,
    'user_image' => null,
    'url' => '#',
])

<a href="{{ $url }}" class="block group">
    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 p-5 border border-gray-100 group-hover:border-blue-300">
        
        <div class="flex gap-4">
            
            {{-- Avatar --}}
            <div class="flex-shrink-0">
                @if ($user_image)
                    <img src="{{ asset('storage/' . $user_image) }}"
                         alt="{{ $user_name }}"
                         class="w-20 h-20 rounded-xl object-cover shadow-sm ring-2 ring-blue-100">
                @else
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center 
                        text-white font-bold text-2xl shadow-sm ring-2 ring-blue-100">
                        {{ strtoupper(substr($user_name, 0, 1)) }}
                    </div>
                @endif
            </div>

            {{-- Content --}}
            <div class="flex-1 min-w-0">
                
                {{-- Name & Rating --}}
                <div class="flex items-start justify-between gap-2 mb-1">
                    <h3 class="font-bold text-gray-900 text-lg truncate group-hover:text-blue-600 transition">
                        {{ $user_name }}
                    </h3>
                    
                    @if ($rating_range)
                        <div class="flex items-center gap-1 bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-semibold flex-shrink-0">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46 1.287 3.97c.3.921-.755 1.688-1.54 1.118L10 13.348l-3.365 2.427c-.784.57-1.838-.197-1.539-1.118l1.286-3.97-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178l1.286-3.97z"/>
                            </svg>
                            {{ $rating_range }}
                        </div>
                    @endif
                </div>

                {{-- Position --}}
                <p class="text-blue-600 font-semibold text-sm mb-2 truncate">
                    {{ $position }}
                </p>

                {{-- School & Major --}}
                <p class="text-sm text-gray-700 font-medium truncate">{{ $school }}</p>
                <p class="text-xs text-gray-500 truncate">{{ $major }}</p>

                {{-- Duration --}}
                @if ($join_date && $end_date)
                    <div class="flex items-center gap-1 mt-2 text-xs text-gray-400">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($join_date)->format('M Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('M Y') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</a>
