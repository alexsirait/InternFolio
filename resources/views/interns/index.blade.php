<x-layouts.app bodyClass="bg-gray-50">

    <x-heros.intern />

    <div class="max-w-6xl mx-auto py-10">

        <form method="GET">
            <x-filters.index :departments="$departments" />
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            @if ($interns->isEmpty())
                <div class="col-span-3 text-center py-10 text-gray-500">
                    Tidak ada data ditemukan berdasarkan filter yang dipilih.
                </div>
            @else
                @foreach ($interns as $intern)
                    <x-cards.intern 
                        user_name="{{ $intern->user_name }}"
                        position="{{ $intern->position }}"
                        join_date="{{ $intern->join_date }}"
                        end_date="{{ $intern->end_date }}"
                        school="{{ $intern->school }}"
                        major="{{ $intern->major }}"
                        instagram_url="{{ $intern->instagram_url }}"
                        linkedin_url="{{ $intern->linkedin_url }}"
                        rating_range="{{ $intern->rating->rating_range }}"
                        user_image="{{ $intern->user_image ?? null }}"
                        url="{{ route('intern.index') . '/' . $intern->user_uuid }}"
                    />
                @endforeach
            @endif
        </div>

        <div class="mt-10">
            {{ $interns->links() }}
        </div>

    </div>

</x-layouts.app>
