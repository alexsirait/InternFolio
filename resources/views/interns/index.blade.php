<x-layouts.app bodyClass="bg-gray-50">

    {{-- HERO --}}
    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 py-24 text-white">
        <div class="max-w-6xl mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-bold tracking-tight">
                Daftar Intern
            </h1>
            <p class="mt-4 text-blue-100 max-w-2xl">
                Temukan intern terbaik berdasarkan jurusan, departemen, dan periode magang.
            </p>
        </div>
    </div>

    {{-- CONTENT --}}
    <div id="intern-list" class="max-w-6xl mx-auto px-6 pb-20">

        {{-- FILTER --}}
        <div class="sticky top-20 z-40 bg-white shadow rounded-xl p-6 -mt-16">

            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">

                {{-- Search --}}
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nama, sekolah, jurusan..."
                       class="border rounded-lg px-4 py-2 w-full">

                {{-- Department --}}
                <select name="department_uuid"
                        class="border rounded-lg px-4 py-2">
                    <option value="">Semua Department</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->department_uuid }}"
                            {{ request('department_uuid') == $dept->department_uuid ? 'selected' : '' }}>
                            {{ $dept->department_name }}
                        </option>
                    @endforeach
                </select>

                {{-- Sort --}}
                <select name="sort" class="border rounded-lg px-4 py-2">
                    <option value="">Urutkan</option>
                    <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>
                        Terbaru
                    </option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>
                        Terlama
                    </option>
                    <option value="rating" {{ request('sort') === 'rating' ? 'selected' : '' }}>
                        Rating Tertinggi
                    </option>
                </select>

                {{-- Actions --}}
                <div class="flex gap-2">
                    <button class="flex-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Filter
                    </button>

                    <a href="{{ route('intern.index') }}"
                       class="flex-1 text-center border rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-50">
                        Reset
                    </a>
                </div>

            </form>
        </div>

        {{-- INFO + VIEW --}}
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mt-10">
            <p class="text-sm text-gray-600">
                Menampilkan
                <span class="font-semibold text-gray-800">
                    {{ $interns->total() }}
                </span>
                intern
            </p>

            <div class="flex gap-2">
                <a href="{{ request()->fullUrlWithQuery(['view' => 'grid']) }}"
                   class="px-3 py-1 border rounded-lg text-sm
                   {{ request('view', 'grid') === 'grid' ? 'bg-blue-600 text-white' : '' }}">
                    Grid
                </a>

                <a href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}"
                   class="px-3 py-1 border rounded-lg text-sm
                   {{ request('view') === 'list' ? 'bg-blue-600 text-white' : '' }}">
                    List
                </a>
            </div>
        </div>

        {{-- DATA --}}
        @if ($interns->isEmpty())
            {{-- EMPTY STATE --}}
            <div class="text-center py-20">
                <div class="text-5xl mb-4">😕</div>
                <h3 class="text-lg font-semibold text-gray-800">
                    Data tidak ditemukan
                </h3>
                <p class="text-gray-500 mt-2">
                    Coba ubah filter atau kata kunci pencarian.
                </p>
            </div>
        @else

            @if (request('view', 'grid') === 'list')
                {{-- LIST VIEW --}}
                <div class="space-y-4 mt-6">
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
            @else
                {{-- GRID VIEW --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
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
            @endif

            {{-- PAGINATION --}}
            @if ($interns->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $interns->withQueryString()->links() }}
                </div>
            @endif

        @endif

    </div>

</x-layouts.app>
