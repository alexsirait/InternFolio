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

<div class="p-5 bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300 relative">

    {{-- Rating di pojok kanan atas --}}
    @if ($rating_range)
        <div class="absolute top-3 right-3 flex items-center gap-1 bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-semibold shadow">
            <svg class="w-5 h-5 text-yellow-400 transition-all duration-200 hover:scale-110" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46 1.287 3.97c.3.921-.755 1.688-1.54 1.118L10 13.348l-3.365 2.427c-.784.57-1.838-.197-1.539-1.118l1.286-3.97-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178l1.286-3.97z"/>
            </svg>
            {{ $rating_range }}
        </div>
    @endif

    <div class="flex items-start gap-4">

        {{-- Avatar --}}
        @if ($user_image)
            <img src="{{ asset('storage/' . $user_image) }}"
                 alt="{{ $user_name }}"
                 class="w-16 h-16 md:w-18 md:h-18 rounded-full object-cover shadow-inner flex-shrink-0">
        @else
            <div class="w-16 h-16 md:w-18 md:h-18 bg-blue-100 rounded-full flex items-center justify-center 
                text-blue-600 font-bold text-xl shadow-inner flex-shrink-0">
                {{ strtoupper(substr($user_name, 0, 1)) }}
            </div>
        @endif

        {{-- Kolom Kanan --}}
        <div class="min-w-0 flex-1">

            {{-- Nama --}}
            <h3 class="font-bold text-gray-800 text-base md:text-lg truncate">
                {{ $user_name }}
            </h3>

            {{-- Position --}}
            <p class="text-sm text-blue-600 font-medium truncate">
                {{ $position }}
            </p>

            {{-- Join Date - End Date --}}
            @if ($join_date && $end_date)
                <p class="text-xs text-gray-500">
                    {{ \Carbon\Carbon::parse($join_date)->format('M Y') }} -
                    {{ \Carbon\Carbon::parse($end_date)->format('M Y') }}
                </p>
            @endif

            {{-- School + Major dipindah ke kiri --}}
            <div class="mt-3 flex justify-between items-start">

                {{-- ⬅️ School-Major Sekarang mentok kiri --}}
                <div class="w-full">
                    <p class="text-sm font-semibold text-gray-700 leading-tight">{{ $school }}</p>
                    <p class="text-xs text-gray-500">{{ $major }}</p>
                </div>

                {{-- Social Icons --}}
                <div class="flex flex-row items-center gap-2 ml-4 whitespace-nowrap">

                    @if ($instagram_url)
                        <a href="{{ $instagram_url }}" target="_blank" class="hover:opacity-80 text-pink-600 bg-pink-50 border border-pink-200 rounded-lg hover:bg-pink-100 hover:border-pink-300 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    @endif

                    @if ($linkedin_url)
                        <a href="{{ $linkedin_url }}" target="_blank" class="hover:opacity-80 text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    @endif

                </div>

            </div>
        </div>

    </div>

    {{-- Button --}}
    <a href="{{ $url }}"
       class="mt-5 block w-full text-center rounded-lg py-2.5 bg-blue-600 text-white font-semibold 
              hover:bg-blue-700 transition shadow text-sm md:text-base">
        Lihat Profil
    </a>
</div>
