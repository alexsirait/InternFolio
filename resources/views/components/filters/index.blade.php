@props([
    'departments' => [],
    'categories' => [],
    'showCategory' => false,
])

<div class="flex flex-col md:flex-row items-center justify-between gap-4 p-4 bg-white shadow rounded-lg">

    {{-- Search --}}
    <input type="text"
           name="search"
           placeholder="Cari..."
           value="{{ request('search') }}"
           class="w-full md:w-1/4 border border-gray-300 rounded-lg px-4 py-2">

    {{-- Department --}}
    <select name="department_uuid"
            class="w-full md:w-1/4 border border-gray-300 rounded-lg px-4 py-2">
        <option value="">Semua Department</option>
        @foreach ($departments as $dept)
            <option value="{{ $dept->department_uuid }}"
                {{ request('department_uuid') == $dept->department_uuid ? 'selected' : '' }}>
                {{ $dept->department_name }}
            </option>
        @endforeach
    </select>

    {{-- Category (only project & suggestion) --}}
    @if ($showCategory)
        <select name="category_uuid"
                class="w-full md:w-1/4 border border-gray-300 rounded-lg px-4 py-2">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->category_uuid }}"
                    {{ request('category_uuid') == $cat->category_uuid ? 'selected' : '' }}>
                    {{ $cat->category_name }}
                </option>
            @endforeach
        </select>
    @endif

    {{-- Submit --}}
    <button class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        Filter
    </button>

</div>
