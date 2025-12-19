<x-layouts.app bodyClass="bg-gray-50">

    {{-- Enhanced Hero with Statistics --}}
    <x-heros.home :totalInterns="$totalInterns ?? 0" :totalProjects="$totalProjects ?? 0" :totalSuggestions="$totalSuggestions ?? 0" />

    {{-- Features Section --}}
    <x-features-section />

    {{-- Statistics Section --}}
    <x-stats-section :totalInterns="$totalInterns ?? 0" :totalProjects="$totalProjects ?? 0" :totalSuggestions="$totalSuggestions ?? 0" />

    {{-- Main Content Container with Consistent Spacing --}}
    <div class="max-w-7xl mx-auto px-6 py-12 space-y-20">

        {{-- Intern Section --}}
        <x-section id="intern-section" class="scroll-mt-28" title="🎓 Alumni Intern Terbaru"
            subtitle="Temukan pengalaman dan insight dari para alumni intern terbaik" link="{{ route('intern.index') }}"
            linkText="Lihat Semua Alumni" background="alternate">
            @if ($interns->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($interns as $intern)
                        <x-cards.intern.home user_name="{{ $intern->user_name }}" position="{{ $intern->position }}"
                            join_date="{{ $intern->join_date }}" end_date="{{ $intern->end_date }}"
                            school="{{ $intern->school }}" major="{{ $intern->major }}"
                            rating_range="{{ $intern->rating->rating_range ?? null }}"
                            user_image="{{ $intern->user_image ?? null }}"
                            url="{{ route('intern.index') . '/' . $intern->user_uuid }}" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-block p-6 bg-gray-100 rounded-full mb-4">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Data Alumni</h3>
                    <p class="text-gray-500">Data alumni intern akan ditampilkan di sini</p>
                </div>
            @endif
        </x-section>

        {{-- Project Section --}}
        <x-section id="project-section" class="scroll-mt-28" title="💼 Project Unggulan"
            subtitle="Karya terbaik dari para intern selama masa magang" link="{{ route('project.index') }}"
            linkText="Lihat Semua Project">
            @if ($projects->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($projects as $project)
                        <x-cards.project.home category_name="{{ $project->category->category_name }}"
                            bg_color="{{ $project->category->bg_color }}"
                            txt_color="{{ $project->category->txt_color }}"
                            project_title="{{ $project->project_title }}"
                            project_description="{{ $project->project_description }}"
                            project_technology="{{ $project->project_technology }}"
                            user_name="{{ $project->user->user_name }}"
                            photo_url="{{ $project->photos[0]->photo_url ?? null }}"
                            url="{{ route('project.index') . '/' . $project->project_uuid }}" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-block p-6 bg-gray-100 rounded-full mb-4">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Project</h3>
                    <p class="text-gray-500">Project dari alumni akan ditampilkan di sini</p>
                </div>
            @endif
        </x-section>

        {{-- Suggestion Section --}}
        <x-section id="suggestion-section" class="scroll-mt-28" title="💡 Saran & Tips Terbaru"
            subtitle="Masukan berharga dari para alumni untuk calon intern" link="{{ route('suggestion.index') }}"
            linkText="Lihat Semua Saran" background="alternate">
            @if ($suggestions->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($suggestions as $suggestion)
                        <x-cards.suggestion.home category_name="{{ $suggestion->category->category_name }}"
                            bg_color="{{ $suggestion->category->bg_color }}"
                            txt_color="{{ $suggestion->category->txt_color }}"
                            suggestion_title="{{ $suggestion->suggestion_title }}"
                            user_name="{{ $suggestion->user->user_name }}" created_at="{{ $suggestion->created_at }}"
                            url="{{ route('suggestion.index') . '/' . $suggestion->suggestion_uuid }}" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-block p-6 bg-gray-100 rounded-full mb-4">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Saran & Tips</h3>
                    <p class="text-gray-500">Saran dan tips dari alumni akan ditampilkan di sini</p>
                </div>
            @endif
        </x-section>

    </div>

    {{-- Call to Action Section --}}
    <x-cta-section />

</x-layouts.app>
