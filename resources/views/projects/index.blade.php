<x-layouts.app bodyClass="bg-gray-50">

    {{-- Enhanced HERO --}}
    <x-heros.project :totalProjects="$projects->total()" />

    <div id="project-list" class="max-w-6xl mx-auto px-6 py-10">

        {{-- FILTER --}}
        <x-filters.index 
            :departments="$departments"
            :categories="$categories"
            context="project"
        />

        {{-- INFO --}}
        <div class="flex items-center gap-3 mt-10 mb-6">
            <div class="p-2 bg-violet-100 rounded-lg">
                <svg class="w-5 h-5 text-violet-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-600">
                    Menampilkan
                    <span class="font-bold text-violet-700">{{ $projects->total() }}</span>
                    project
                </p>
                @if(request()->has('search') || request()->has('department_uuid') || request()->has('category_uuid') || request()->has('sort'))
                    <p class="text-xs text-gray-500">Hasil filter aktif</p>
                @endif
            </div>
        </div>

        {{-- DATA --}}
        @if ($projects->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-violet-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                        Tidak ada project ditemukan
                    </h3>
                    <p class="text-gray-500 mb-6">
                        Coba ubah filter atau kata kunci pencarian.
                    </p>
                    <a href="{{ route('project.index') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-violet-700 text-white rounded-lg font-medium hover:bg-violet-800 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset Filter
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
