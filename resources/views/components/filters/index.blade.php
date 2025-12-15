@props([
    'departments' => [],
    'categories' => [],
    'context' => 'intern', // intern | project | suggestion
])

<div class="sticky top-20 z-40 bg-white shadow rounded-xl p-6 -mt-12">

    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">

        {{-- Search (ALL) --}}
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari..."
            class="border rounded-lg px-4 py-2 w-full"
        >

        {{-- Department (ALL) --}}
        <select
            name="department_uuid"
            class="border rounded-lg px-4 py-2"
        >
            <option value="">Semua Department</option>
            @foreach ($departments as $dept)
                <option
                    value="{{ $dept->department_uuid }}"
                    @selected(request('department_uuid') === $dept->department_uuid)
                >
                    {{ $dept->department_name }}
                </option>
            @endforeach
        </select>

        {{-- Category (PROJECT & SUGGESTION) --}}
        @if(in_array($context, ['project', 'suggestion']))
            <select
                name="category_uuid"
                class="border rounded-lg px-4 py-2"
            >
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option
                        value="{{ $cat->category_uuid }}"
                        @selected(request('category_uuid') === $cat->category_uuid)
                    >
                        {{ $cat->category_name }}
                    </option>
                @endforeach
            </select>
        @endif

        {{-- Sort (ALL, rating ONLY INTERN) --}}
        <select
            name="sort"
            class="border rounded-lg px-4 py-2"
        >
            <option value="">Urutkan</option>
            <option value="latest" @selected(request('sort') === 'latest')>
                Terbaru
            </option>
            <option value="oldest" @selected(request('sort') === 'oldest')>
                Terlama
            </option>

            @if($context === 'intern')
                <option value="rating" @selected(request('sort') === 'rating')>
                    Rating Tertinggi
                </option>
            @endif
        </select>

        {{-- Actions --}}
        <div class="flex gap-2">
            <button
                type="submit"
                class="flex-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
            >
                Filter
            </button>

            <a
                href="{{ url()->current() }}"
                class="flex-1 text-center border rounded-lg px-4 py-2 text-gray-600 hover:bg-gray-50 transition"
            >
                Reset
            </a>
        </div>

    </form>
</div>
