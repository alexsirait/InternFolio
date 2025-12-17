<x-layouts.app bodyClass="bg-gray-50">

    {{-- Enhanced HERO --}}
    <x-heros.suggestion :totalSuggestions="$suggestions->total()" />

    <div id="suggestion-list" class="max-w-6xl mx-auto px-6 py-10">

        {{-- FILTER --}}
        <x-filters.index 
            :departments="$departments"
            :categories="$categories"
            context="suggestion"
        />

        {{-- INFO --}}
        <div class="flex items-center gap-3 mt-10 mb-6">
            <div class="p-2 bg-emerald-100 rounded-lg">
                <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-600">
                    Menampilkan
                    <span class="font-bold text-emerald-700">{{ $suggestions->total() }}</span>
                    tips & saran
                </p>
                @if(request()->has('search') || request()->has('department_uuid') || request()->has('category_uuid') || request()->has('sort'))
                    <p class="text-xs text-gray-500">Hasil filter aktif</p>
                @endif
            </div>
        </div>

        {{-- DATA --}}
        @if ($suggestions->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                        Tidak ada saran ditemukan
                    </h3>
                    <p class="text-gray-500 mb-6">
                        Coba ubah filter atau kata kunci pencarian.
                    </p>
                    <a href="{{ route('suggestion.index') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-700 text-white rounded-lg font-medium hover:bg-emerald-800 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset Filter
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($suggestions as $suggestion)
                    <x-cards.suggestion
                        category_name="{{ $suggestion->category->category_name }}"
                        bg_color="{{ $suggestion->category->bg_color }}"
                        txt_color="{{ $suggestion->category->txt_color }}"
                        suggestion_title="{{ $suggestion->suggestion_title }}"
                        user_name="{{ $suggestion->user->user_name }}"
                        user_image="{{ $suggestion->user->user_image ?? null }}"
                        created_at="{{ $suggestion->created_at }}"
                        url="{{ route('suggestion.index') . '/' . $suggestion->suggestion_uuid }}"
                    />
                @endforeach
            </div>

            {{-- PAGINATION --}}
            @if ($suggestions->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $suggestions->withQueryString()->links() }}
                </div>
            @endif
        @endif

    </div>

</x-layouts.app>
