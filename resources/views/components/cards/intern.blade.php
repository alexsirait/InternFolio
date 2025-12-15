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
            <img src="{{ asset('image/logo.png') }}" class="w-4 h-4" alt="rating">
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
                        <a href="{{ $instagram_url }}" target="_blank" class="hover:opacity-80 transition">
                            <img src="{{ asset('image/logo.png') }}"
                                 alt="Instagram"
                                 class="w-6 h-6 object-contain">
                        </a>
                    @endif

                    @if ($linkedin_url)
                        <a href="{{ $linkedin_url }}" target="_blank" class="hover:opacity-80 transition">
                            <img src="{{ asset('image/logo.png') }}"
                                 alt="LinkedIn"
                                 class="w-6 h-6 object-contain">
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
