<x-layouts.app bodyClass="bg-gray-50">

    {{-- Hero --}}
    <x-sections.hero />

    <div class="container mx-auto py-10">

        <x-section id="intern-section" class="scroll-mt-28" title="Intern Terbaru" subtitle="Daftar magang terbaru dari berbagai jurusan" link="{{ route('intern.index') }}" linkText="Lihat Semua Intern">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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
            </div>
        </x-section>

        <x-section id="project-section" class="scroll-mt-28" title="Project Terbaru" subtitle="Kumpulan project intern" link="{{ route('project.index') }}" linkText="Lihat Semua Project">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
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
        </x-section>
        
        <x-section id="suggestion-section" class="scroll-mt-28" title="Saran Terbaru" subtitle="Kumpulan saran intern" link="{{ route('suggestion.index') }}" linkText="Lihat Semua Saran">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
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
        </x-section>


    </div>
</x-sections.hero>
