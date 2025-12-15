<div class="sticky top-20 z-40 bg-white shadow rounded-xl p-6 mt-[-3rem]">

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
            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
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
