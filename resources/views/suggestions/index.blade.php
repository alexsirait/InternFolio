<x-layouts.app bodyClass="bg-gray-50">

    <x-heros.suggestion />

    <div class="max-w-6xl mx-auto py-10">

        <form method="GET">
            <x-filters.index :departments="$departments" />
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
            @if ($suggestions->isEmpty())
                <div class="col-span-3 text-center py-10 text-gray-500">
                    Tidak ada data ditemukan berdasarkan filter yang dipilih.
                </div>
            @else
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
            @endif
        </div>

        <div class="mt-10">
            {{ $suggestions->links() }}
        </div>

    </div>

</x-layouts.app>
