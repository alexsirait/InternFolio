<x-layouts.app bodyClass="bg-gray-50">

    <x-heros.project />

    <div class="max-w-6xl mx-auto py-10">

        <form method="GET">
            <x-filters.index :departments="$departments" />
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            @if ($projects->isEmpty())
                <div class="col-span-3 text-center py-10 text-gray-500">
                    Tidak ada data ditemukan berdasarkan filter yang dipilih.
                </div>
            @else
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
            @endif
        </div>

        <div class="mt-10">
            {{ $projects->links() }}
        </div>

    </div>

</x-layouts.app>
