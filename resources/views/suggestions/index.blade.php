<x-layouts.app bodyClass="bg-gray-50">

    <x-heros.suggestion />

    <div class="max-w-6xl mx-auto px-6 py-10">

        {{-- FILTER --}}
        <x-filters.index 
            :departments="$departments"
            :categories="$categories"
            context="suggestion"
        />

        {{-- DATA --}}
        @if ($suggestions->isEmpty())
            <div class="text-center py-20 text-gray-500">
                <div class="text-5xl mb-4">😕</div>
                <p class="text-lg font-medium">
                    Tidak ada data ditemukan
                </p>
                <p class="mt-2 text-sm">
                    Coba ubah filter atau kata kunci pencarian.
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
                @foreach ($suggestions as $suggestion)
                    <x-cards.suggestion
                        category_name="{{ $suggestion->category->category_name }}"
                        bg_color="{{ $suggestion->category->bg_color }}"
                        txt_color="{{ $suggestion->category->txt_color }}"
                        suggestion_title="{{ $suggestion->suggestion_title }}"
                        user_name="{{ $suggestion->user->user_name }}"
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
