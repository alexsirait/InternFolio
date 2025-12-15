<x-layouts.app bodyClass="bg-gray-50">

    <x-heros.project />

    <div class="max-w-6xl mx-auto px-6 py-10">

        {{-- FILTER --}}
        <x-filters.index 
            :departments="$departments"
            :categories="$categories"
            context="project"
        />

        {{-- DATA --}}
        @if ($projects->isEmpty())
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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                @foreach ($projects as $project)
                    <x-cards.project
                        category_name="{{ $project->category->category_name }}"
                        bg_color="{{ $project->category->bg_color }}"
                        txt_color="{{ $project->category->txt_color }}"
                        project_title="{{ $project->project_title }}"
                        project_description="{{ $project->project_description }}"
                        project_technology="{{ $project->project_technology }}"
                        project_duration="{{ $project->project_duration }}"
                        user_name="{{ $project->user->user_name }}"
                        photo_url="{{ $project->photos[0]->photo_url ?? null }}"
                        url="{{ route('project.index') . '/' . $project->project_uuid }}"
                    />
                @endforeach
            </div>

            {{-- PAGINATION --}}
            @if ($projects->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $projects->withQueryString()->links() }}
                </div>
            @endif
        @endif

    </div>

</x-layouts.app>
