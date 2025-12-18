<x-layouts.app bodyClass="bg-gradient-to-br from-gray-50 via-cyan-50/30 to-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- Breadcrumb & Share --}}
        <div class="flex items-center justify-between mb-6">
            <nav class="flex items-center gap-2 text-sm" aria-label="Breadcrumb">
                <a href="{{ route('dashboard.index') }}" class="text-gray-500 hover:text-blue-600 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                <a href="{{ route('suggestion.index') }}" class="text-gray-500 hover:text-cyan-600 transition">
                    Tips & Saran
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                <span class="text-gray-900 font-medium">Detail</span>
            </nav>
            
            {{-- Share Button --}}
            <x-share-button 
                :shortLink="$shortLink"
                :title="$suggestion['suggestion_title']"
                :description="$suggestion['category']['category_name']"
                color="cyan"
            />
        </div>

        {{-- Back Button --}}
        <a href="{{ route('suggestion.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm bg-white border border-gray-200 rounded-lg
                  text-gray-700 hover:bg-gray-50 hover:border-cyan-300 transition-all group shadow-sm mb-6">
            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Tips & Saran
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- MAIN CONTENT --}}
            <div class="lg:col-span-2">
                <article class="bg-white rounded-2xl shadow-lg p-8 md:p-10 border border-gray-100 hover:shadow-xl transition-shadow">

                    {{-- Article Header --}}
                    <header class="mb-8">
                        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                            <span
                                class="inline-flex items-center gap-2 text-sm font-bold px-4 py-2 rounded-lg shadow-md"
                                style="background-color: {{ str_replace('0xFF', '#', $suggestion['category']['bg_color']) }};
                                       color: {{ str_replace('0xFF', '#', $suggestion['category']['txt_color']) }}">
                                @if (str_contains(strtolower($suggestion['category']['category_name']), 'tips'))
                                    💡
                                @elseif (str_contains(strtolower($suggestion['category']['category_name']), 'tech'))
                                    💻
                                @elseif (str_contains(strtolower($suggestion['category']['category_name']), 'career'))
                                    🎯
                                @else
                                    ✨
                                @endif
                                {{ $suggestion['category']['category_name'] }}
                            </span>

                            <div class="flex items-center gap-2 text-gray-500 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($suggestion['created_at'])->translatedFormat('d F Y') }}
                            </div>
                        </div>

                        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-4">
                            {{ $suggestion['suggestion_title'] }}
                        </h1>
                    </header>

                    {{-- Article Content --}}
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! $suggestion['suggestion_description'] !!}
                    </div>

                </article>
            </div>

            {{-- SIDEBAR --}}
            <aside class="space-y-6">

                {{-- Author Card --}}
                <div class="bg-gradient-to-br from-cyan-50 via-indigo-50 to-cyan-50 rounded-2xl shadow-lg p-6 border-2 border-cyan-200/50">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="p-2 bg-cyan-100 rounded-lg">
                            <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Penulis</h3>
                            <p class="text-xs text-gray-600">Kontributor tips ini</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-5 shadow-sm border border-cyan-100">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="relative">
                                <div class="p-1 bg-gradient-to-br from-cyan-400 to-cyan-600 rounded-xl">
                                    <img
                                        src="{{ asset('storage/' . $suggestion['user']['user_image']) }}"
                                        class="w-16 h-16 rounded-lg object-cover ring-2 ring-white"
                                        alt="{{ $suggestion['user']['user_name'] }}"
                                    >
                                </div>
                                <div class="absolute -bottom-1 -right-1 bg-cyan-500 w-5 h-5 rounded-full border-2 border-white"></div>
                            </div>

                            <div class="flex-1">
                                <p class="font-bold text-gray-900 mb-1">
                                    {{ $suggestion['user']['user_name'] }}
                                </p>
                                <p class="text-sm text-gray-600 flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    {{ $suggestion['user']['department']['department_name'] }}
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('intern.show', $suggestion['user']['user_uuid']) }}" 
                           class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-cyan-600 to-cyan-700 text-white text-sm font-bold rounded-lg hover:from-cyan-700 hover:to-cyan-800 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Lihat Profil
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Related Tips --}}
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-cyan-100 rounded-lg">
                                <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Tips Terkait</h3>
                                <p class="text-xs text-gray-500">Baca juga tips serupa</p>
                            </div>
                        </div>
                        <span class="bg-cyan-100 text-cyan-700 text-sm font-bold px-3 py-1.5 rounded-lg">
                            {{ count($suggestion['related_suggestions']) }}
                        </span>
                    </div>

                    <div class="space-y-3 max-h-[500px] overflow-y-auto pr-2">
                        @forelse ($suggestion['related_suggestions'] as $related)
                            <a href="{{ route('suggestion.show', $related['suggestion_uuid']) }}"
                               class="block border-2 border-gray-100 rounded-xl px-4 py-3.5 hover:border-cyan-300 hover:bg-cyan-50 hover:shadow-md transition-all group">
                                <div class="flex items-start justify-between gap-3">
                                    <span class="text-sm font-semibold text-gray-900 group-hover:text-cyan-700 transition-colors flex-1 line-clamp-2">
                                        {{ $related['suggestion_title'] }}
                                    </span>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-cyan-600 transition-colors flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </a>
                        @empty
                            <div class="flex flex-col items-center justify-center py-10 text-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-600 font-medium">
                                    Tidak ada tips terkait
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    Explore tips lainnya
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </aside>
        </div>
    </div>
</x-layouts.app>