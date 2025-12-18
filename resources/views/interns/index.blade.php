<x-layouts.app bodyClass="bg-gray-50">

    {{-- Enhanced HERO --}}
    <x-heros.intern :totalInterns="$interns->total()" />

    {{-- CONTENT --}}
    <div id="intern-list" class="max-w-6xl mx-auto px-6 pb-20">

        {{-- FILTER (REUSABLE COMPONENT) --}}
        <x-filters.index
            :departments="$departments"
            context="intern"
        />

        {{-- INFO + VIEW --}}
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mt-10">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-slate-100 rounded-lg">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">
                        Menampilkan
                        <span class="font-bold text-slate-700">{{ $interns->total() }}</span>
                        alumni intern
                    </p>
                    @if(request()->has('search') || request()->has('department_uuid') || request()->has('sort'))
                        <p class="text-xs text-gray-500">Hasil filter aktif</p>
                    @endif
                </div>
            </div>

            <div class="flex gap-2">
                <a href="{{ request()->fullUrlWithQuery(['view' => 'grid']) }}"
                   class="flex items-center gap-2 px-4 py-2 border-2 rounded-lg text-sm font-medium transition-all
                   {{ request('view', 'grid') === 'grid' ? 'bg-slate-700 text-white border-slate-700 shadow-md' : 'border-gray-300 text-gray-700 hover:border-slate-400 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Grid
                </a>

                <a href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}"
                   class="flex items-center gap-2 px-4 py-2 border-2 rounded-lg text-sm font-medium transition-all
                   {{ request('view') === 'list' ? 'bg-slate-700 text-white border-slate-700 shadow-md' : 'border-gray-300 text-gray-700 hover:border-slate-400 hover:bg-slate-50' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    List
                </a>
            </div>
        </div>

        {{-- DATA --}}
        @if ($interns->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm mt-8">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                        Tidak ada data ditemukan
                    </h3>
                    <p class="text-gray-500 mb-6">
                        Coba ubah filter atau kata kunci pencarian Anda.
                    </p>
                    <a href="{{ route('intern.index') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-slate-700 text-white rounded-lg font-medium hover:bg-slate-800 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset Filter
                    </a>
                </div>
            </div>
        @else
            <div class="{{ request('view', 'grid') === 'list' ? 'space-y-4' : 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6' }} mt-6">
                @foreach ($interns as $intern)
                    <x-cards.intern.index
                        user_name="{{ $intern->user_name }}"
                        position="{{ $intern->position }}"
                        join_date="{{ $intern->join_date }}"
                        end_date="{{ $intern->end_date }}"
                        school="{{ $intern->school }}"
                        major="{{ $intern->major }}"
                        instagram_url="{{ $intern->instagram_url }}"
                        linkedin_url="{{ $intern->linkedin_url }}"
                        rating_range="{{ $intern->rating->rating_range ?? null }}"
                        user_image="{{ $intern->user_image ?? null }}"
                        url="{{ route('intern.index') . '/' . $intern->user_uuid }}"
                    />
                @endforeach
            </div>

            {{-- PAGINATION --}}
            @if ($interns->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $interns->withQueryString()->links() }}
                </div>
            @endif
        @endif

    </div>

</x-layouts.app>
