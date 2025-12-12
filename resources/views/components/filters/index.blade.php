<div class="flex flex-col md:flex-row items-center justify-between gap-4 p-4 bg-white shadow rounded-lg">

    {{-- Search --}}
    <input type="text" 
           name="search"
           placeholder="Cari..."
           value="{{ request('search') }}"
           class="w-full md:w-1/3 border border-gray-300 rounded-lg px-4 py-2">

    {{-- Department --}}
    <select name="department_uuid"
            class="w-full md:w-1/4 border border-gray-300 rounded-lg px-4 py-2">
        <option value="">Semua Department</option>

        @foreach ($departments as $dept)
            <option value="{{ $dept->department_uuid }}" {{ request('department_uuid') == $dept->department_uuid ? 'selected' : '' }}>
                {{ $dept->department_name }}
            </option>
        @endforeach
    </select>

    {{-- Submit --}}
    <button class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        Filter
    </button>
</div>
