<x-layouts.app bodyClass="bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-10">

        {{-- Back Button --}}
        <a href="{{ route('suggestion.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 mb-6 transition-colors group">
            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Tips
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LEFT CONTENT --}}
            <div class="lg:col-span-2 bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow">

                {{-- Category + Date --}}
                <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
                    <span
                        class="text-xs font-semibold px-4 py-2 rounded-full shadow-sm"
                        style="background-color: {{ str_replace('0xFF', '#', $suggestion['category']['bg_color']) }};
                               color: {{ str_replace('0xFF', '#', $suggestion['category']['txt_color']) }}">
                        {{ $suggestion['category']['category_name'] }}
                    </span>

                    <div class="flex items-center gap-2 text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-sm">
                            {{ \Carbon\Carbon::parse($suggestion['created_at'])->translatedFormat('d F Y') }}
                        </span>
                    </div>
                </div>

                {{-- Title --}}
                <h1 class="text-3xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $suggestion['suggestion_title'] }}
                </h1>

                {{-- Description with HTML --}}
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! $suggestion['suggestion_description'] !!}
                </div>
            </div>

            {{-- RIGHT SIDEBAR --}}
            <div class="space-y-6">

                {{-- Author Info --}}
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 shadow-lg border border-blue-100">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <h3 class="font-semibold text-gray-900">
                            Informasi Penulis
                        </h3>
                    </div>

                    <div class="bg-white rounded-xl p-4 shadow-sm">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="relative">
                                <img
                                    src="{{ asset('storage/' . $suggestion['user']['user_image']) }}"
                                    class="w-16 h-16 rounded-xl object-cover ring-4 ring-blue-100"
                                    alt="{{ $suggestion['user']['user_name'] }}"
                                >
                                <div class="absolute -bottom-1 -right-1 bg-green-500 w-5 h-5 rounded-full border-2 border-white"></div>
                            </div>

                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">
                                    {{ $suggestion['user']['user_name'] }}
                                </p>
                                <p class="text-sm text-gray-600 flex items-center gap-1 mt-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    {{ $suggestion['user']['department']['department_name'] }}
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('intern.show', $suggestion['user']['user_uuid']) }}" 
                           class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Lihat Profil
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Related Tips --}}
                <div class="bg-white rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="font-semibold text-gray-900">
                                Tips Terkait
                            </h3>
                        </div>
                        <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                            {{ count($suggestion['related_suggestions']) }} tips
                        </span>
                    </div>

                    <div class="space-y-3 max-h-[400px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                        @forelse ($suggestion['related_suggestions'] as $related)
                            <a href="{{ route('suggestion.show', $related['suggestion_uuid']) }}"
                               class="block border-2 border-gray-100 rounded-xl px-4 py-3 hover:border-green-300 hover:bg-green-50 hover:shadow-md transition-all group">
                                <div class="flex items-start justify-between gap-2">
                                    <span class="text-sm font-medium text-gray-900 group-hover:text-green-700 transition-colors flex-1">
                                        {{ $related['suggestion_title'] }}
                                    </span>
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-green-600 transition-colors flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </a>
                        @empty
                            <div class="flex flex-col items-center justify-center py-8 text-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-sm text-gray-500">
                                    Tidak ada tips terkait
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>