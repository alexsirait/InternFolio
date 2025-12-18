@props([
    'user_name',
    'position',
    'join_date' => null,
    'end_date' => null,
    'school',
    'major',
    'instagram_url' => null,
    'linkedin_url' => null,
    'rating_range' => null,
    'user_image' => null,
    'url' => '#',
])

<a href="{{ $url }}" class="block group h-full">
    <div class="h-full p-6 bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 
                border border-gray-100 group-hover:border-blue-300 transform group-hover:-translate-y-2">
        
        {{-- Rating Badge --}}
        @if ($rating_range)
            <div class="flex justify-end mb-3">
                <div class="flex items-center gap-1.5 bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-700 px-3 py-1.5 rounded-full text-xs font-bold shadow-sm">
                    <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46 1.287 3.97c.3.921-.755 1.688-1.54 1.118L10 13.348l-3.365 2.427c-.784.57-1.838-.197-1.539-1.118l1.286-3.97-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178l1.286-3.97z"/>
                    </svg>
                    {{ $rating_range }}/5
                </div>
            </div>
        @endif

        <div class="flex flex-col items-center text-center">

            {{-- Avatar dengan Gradient Ring --}}
            <div class="relative mb-4">
                @if ($user_image)
                    <div class="p-1 bg-gradient-to-br from-blue-400 via-blue-600 to-indigo-600 rounded-full transform group-hover:scale-110 transition-transform duration-300">
                        <img src="{{ asset('storage/' . $user_image) }}"
                             alt="{{ $user_name }}"
                             class="w-24 h-24 rounded-full object-cover ring-4 ring-white">
                    </div>
                @else
                    <div class="p-1 bg-gradient-to-br from-blue-400 via-blue-600 to-indigo-600 rounded-full transform group-hover:scale-110 transition-transform duration-300">
                        <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center text-blue-600 font-bold text-3xl ring-4 ring-white">
                            {{ strtoupper(substr($user_name, 0, 1)) }}
                        </div>
                    </div>
                @endif
            </div>

            {{-- Name --}}
            <h3 class="font-bold text-gray-900 text-xl mb-1 group-hover:text-blue-600 transition-colors">
                {{ $user_name }}
            </h3>

            {{-- Position --}}
            <p class="text-blue-600 font-semibold text-sm mb-3">
                {{ $position }}
            </p>

            {{-- Duration Badge --}}
            @if ($join_date && $end_date)
                <div class="flex items-center gap-1.5 text-xs text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full mb-4">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ \Carbon\Carbon::parse($join_date)->format('M Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('M Y') }}
                </div>
            @endif

            {{-- School & Major --}}
            <div class="w-full bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-100">
                <p class="text-sm font-bold text-gray-800 mb-1">{{ $school }}</p>
                <p class="text-xs text-gray-600">{{ $major }}</p>
            </div>

        </div>
    </div>
</a>
