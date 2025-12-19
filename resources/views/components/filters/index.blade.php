@props([
    'departments' => [],
    'categories' => [],
    'context' => 'intern', // intern | project | suggestion
])

<div class="sticky top-20 z-40 bg-white shadow-lg rounded-xl p-4 md:p-6 -mt-12 border border-gray-100">

    {{-- Mobile Filter Toggle Button --}}
    <button type="button" onclick="toggleFilter()"
        class="md:hidden w-full flex items-center justify-between px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-sm">
        <span class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            Filter & Cari
        </span>
        <svg id="filterChevron" class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    {{-- Filter Form --}}
    <form method="GET" id="filterForm" class="hidden md:block space-y-4 md:mt-0 mt-4">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

            {{-- Search (ALL) --}}
            <div class="relative lg:col-span-2">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan nama atau deskripsi..."
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            {{-- Department Filter with Search (ALL) --}}
            <div class="relative" x-data="searchableDropdown({
                items: {{ json_encode(
                    $departments->map(
                        fn($d) => [
                            'value' => $d->department_uuid,
                            'label' => $d->department_name,
                        ],
                    ),
                ) }},
                selected: '{{ request('department_uuid') }}',
                placeholder: 'Semua Department'
            })">
                <input type="hidden" name="department_uuid" :value="selectedValue">

                <button type="button" @click="open = !open"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition cursor-pointer text-left flex items-center justify-between">
                    <span x-text="selectedLabel" class="truncate"></span>
                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0 ml-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-80 overflow-hidden">
                    <div class="p-2 border-b border-gray-200">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" x-model="searchTerm" @input="debouncedSearch()"
                                placeholder="Cari department..."
                                class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <div class="max-h-60 overflow-y-auto">
                        <button type="button" @click="selectItem('', placeholder)"
                            class="w-full px-4 py-2 text-left text-sm hover:bg-blue-50 transition"
                            :class="selectedValue === '' && 'bg-blue-100 font-medium'">
                            <span x-text="placeholder"></span>
                        </button>

                        <template x-for="item in filteredItems" :key="item.value">
                            <button type="button" @click="selectItem(item.value, item.label)"
                                class="w-full px-4 py-2 text-left text-sm hover:bg-blue-50 transition"
                                :class="selectedValue === item.value && 'bg-blue-100 font-medium'">
                                <span x-text="item.label"></span>
                            </button>
                        </template>

                        <div x-show="filteredItems.length === 0" class="px-4 py-8 text-center text-sm text-gray-500">
                            Tidak ada hasil ditemukan
                        </div>
                    </div>
                </div>
            </div>

            {{-- Category Filter with Search (PROJECT & SUGGESTION) --}}
            @if (in_array($context, ['project', 'suggestion']))
                <div class="relative" x-data="searchableDropdown({
                    items: {{ json_encode(
                        $categories->map(
                            fn($c) => [
                                'value' => $c->category_uuid,
                                'label' => $c->category_name,
                            ],
                        ),
                    ) }},
                    selected: '{{ request('category_uuid') }}',
                    placeholder: 'Semua Kategori'
                })">
                    <input type="hidden" name="category_uuid" :value="selectedValue">

                    <button type="button" @click="open = !open"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition cursor-pointer text-left flex items-center justify-between">
                        <span x-text="selectedLabel" class="truncate"></span>
                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0 ml-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-80 overflow-hidden">
                        <div class="p-2 border-b border-gray-200">
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <input type="text" x-model="searchTerm" @input="debouncedSearch()"
                                    placeholder="Cari kategori..."
                                    class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div class="max-h-60 overflow-y-auto">
                            <button type="button" @click="selectItem('', placeholder)"
                                class="w-full px-4 py-2 text-left text-sm hover:bg-blue-50 transition"
                                :class="selectedValue === '' && 'bg-blue-100 font-medium'">
                                <span x-text="placeholder"></span>
                            </button>

                            <template x-for="item in filteredItems" :key="item.value">
                                <button type="button" @click="selectItem(item.value, item.label)"
                                    class="w-full px-4 py-2 text-left text-sm hover:bg-blue-50 transition"
                                    :class="selectedValue === item.value && 'bg-blue-100 font-medium'">
                                    <span x-text="item.label"></span>
                                </button>
                            </template>

                            <div x-show="filteredItems.length === 0"
                                class="px-4 py-8 text-center text-sm text-gray-500">
                                Tidak ada hasil ditemukan
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Sort (ALL, rating ONLY INTERN) --}}
            <div class="relative">
                <select name="sort"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg appearance-none bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition cursor-pointer">
                    <option value="">Urutkan</option>
                    <option value="latest" @selected(request('sort') === 'latest')>
                        ↓ Terbaru
                    </option>
                    <option value="oldest" @selected(request('sort') === 'oldest')>
                        ↑ Terlama
                    </option>

                    @if ($context === 'intern')
                        <option value="rating" @selected(request('sort') === 'rating')>
                            ★ Rating Tertinggi
                        </option>
                    @endif
                </select>
                <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>

        </div>

        {{-- Actions --}}
        <div class="flex gap-3 pt-2">
            <button type="submit"
                class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg px-6 py-2.5 font-medium hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:ring-blue-300 transition-all duration-200 shadow-sm hover:shadow-md">
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Terapkan Filter
                </span>
            </button>

            <a href="{{ url()->current() }}"
                class="flex-shrink-0 border border-gray-300 rounded-lg px-6 py-2.5 text-gray-700 font-medium hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 transition-all duration-200">
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reset
                </span>
            </a>
        </div>

    </form>

    {{-- Active Filters Badge (Mobile) --}}
    @if (request()->hasAny(['search', 'department_uuid', 'category_uuid', 'sort']))
        <div class="md:hidden mt-3 flex items-center gap-2 text-sm text-blue-600">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
            </svg>
            <span class="font-medium">Filter Aktif</span>
        </div>
    @endif

</div>

<script>
    function toggleFilter() {
        const form = document.getElementById('filterForm');
        const chevron = document.getElementById('filterChevron');

        if (form.classList.contains('hidden')) {
            form.classList.remove('hidden');
            chevron.style.transform = 'rotate(180deg)';
        } else {
            form.classList.add('hidden');
            chevron.style.transform = 'rotate(0deg)';
        }
    }

    // Auto-scroll to content section after filtering
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const hasFilters = urlParams.has('search') || urlParams.has('department_uuid') ||
            urlParams.has('category_uuid') || urlParams.has('sort');

        if (hasFilters) {
            // Determine context and scroll to appropriate section
            const context = '{{ $context }}';
            let sectionId = '';

            if (context === 'intern') {
                sectionId = 'intern-list';
            } else if (context === 'project') {
                sectionId = 'project-list';
            } else if (context === 'suggestion') {
                sectionId = 'suggestion-list';
            }

            if (sectionId) {
                setTimeout(() => {
                    const section = document.getElementById(sectionId);
                    if (section) {
                        section.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }, 100);
            }
        }
    });

    // Searchable Dropdown Component
    function searchableDropdown(config) {
        return {
            open: false,
            items: config.items || [],
            filteredItems: config.items || [],
            searchTerm: '',
            selectedValue: config.selected || '',
            selectedLabel: config.placeholder || 'Pilih...',
            placeholder: config.placeholder || 'Pilih...',
            debounceTimer: null,

            init() {
                // Set initial selected label
                if (this.selectedValue) {
                    const selected = this.items.find(item => item.value === this.selectedValue);
                    if (selected) {
                        this.selectedLabel = selected.label;
                    }
                }
            },

            debouncedSearch() {
                clearTimeout(this.debounceTimer);
                this.debounceTimer = setTimeout(() => {
                    this.filterItems();
                }, 1000);
            },

            filterItems() {
                if (!this.searchTerm.trim()) {
                    this.filteredItems = this.items;
                } else {
                    const term = this.searchTerm.toLowerCase();
                    this.filteredItems = this.items.filter(item =>
                        item.label.toLowerCase().includes(term)
                    );
                }
            },

            selectItem(value, label) {
                this.selectedValue = value;
                this.selectedLabel = label;
                this.open = false;
                this.searchTerm = '';
                this.filteredItems = this.items;
            }
        }
    }
</script>
