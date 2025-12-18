<x-layouts.app bodyClass="bg-gray-50">

    {{-- Enhanced Hero with Statistics --}}
    <x-heros.home 
        :totalInterns="$totalInterns ?? 0"
        :totalProjects="$totalProjects ?? 0"
        :totalSuggestions="$totalSuggestions ?? 0"
    />

    {{-- Features Section --}}
    <x-features-section />

    <div class="container mx-auto py-10">

        {{-- Intern Section --}}
        <x-section 
            id="intern-section" 
            class="scroll-mt-28" 
            title="🎓 Alumni Intern Terbaru" 
            subtitle="Temukan pengalaman dan insight dari para alumni intern terbaik" 
            link="{{ route('intern.index') }}" 
            linkText="Lihat Semua Alumni"
        >
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($interns as $intern)
                    <x-cards.intern.home 
                        user_name="{{ $intern->user_name }}"
                        position="{{ $intern->position }}"
                        join_date="{{ $intern->join_date }}"
                        end_date="{{ $intern->end_date }}"
                        school="{{ $intern->school }}"
                        major="{{ $intern->major }}"
                        rating_range="{{ $intern->rating->rating_range ?? null }}"
                        user_image="{{ $intern->user_image ?? null }}"
                        url="{{ route('intern.index') . '/' . $intern->user_uuid }}"
                    />
                @endforeach
            </div>
        </x-section>

        {{-- Project Section --}}
        <x-section 
            id="project-section" 
            class="scroll-mt-28" 
            title="💼 Project Unggulan" 
            subtitle="Karya terbaik dari para intern selama masa magang" 
            link="{{ route('project.index') }}" 
            linkText="Lihat Semua Project"
        >
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($projects as $project)
                    <x-cards.project.home
                        category_name="{{ $project->category->category_name }}"
                        bg_color="{{ $project->category->bg_color }}"
                        txt_color="{{ $project->category->txt_color }}"
                        project_title="{{ $project->project_title }}"
                        project_description="{{ $project->project_description }}"
                        project_technology="{{ $project->project_technology }}"
                        user_name="{{ $project->user->user_name }}"
                        photo_url="{{ $project->photos[0]->photo_url ?? null }}"
                        url="{{ route('project.index') . '/' . $project->project_uuid }}"
                    />
                @endforeach
            </div>
        </x-section>
        
        {{-- Suggestion Section --}}
        <x-section 
            id="suggestion-section" 
            class="scroll-mt-28" 
            title="💡 Saran & Tips Terbaru" 
            subtitle="Masukan berharga dari para alumni untuk calon intern" 
            link="{{ route('suggestion.index') }}" 
            linkText="Lihat Semua Saran"
        >
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($suggestions as $suggestion)
                    <x-cards.suggestion.home
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
        </x-section>

    </div>

    {{-- Call to Action Section --}}
    <x-cta-section />

</x-layouts.app>
