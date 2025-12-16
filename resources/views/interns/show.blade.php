<x-layouts.app>
    <div class="bg-gradient-to-br from-gray-50 to-gray-100 py-10 min-h-screen">
        <div class="max-w-7xl mx-auto px-6">

            {{-- Back Button --}}
            <a href="{{ route('intern.index') }}"
               class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 mb-6 transition-colors group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Profil Alumni
            </a>

            {{-- Header Card with Shadow --}}
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 hover:shadow-xl transition-shadow">
                <div class="flex flex-col md:flex-row gap-6 items-start md:items-center">
                    {{-- Profile Image with Ring --}}
                    <div class="relative">
                        <img
                            src="{{ asset('storage/' . $intern['user_image']) }}"
                            class="w-32 h-32 rounded-2xl object-cover ring-4 ring-blue-100"
                            alt="{{ $intern['user_name'] }}"
                        >
                        <div class="absolute -bottom-2 -right-2 bg-green-500 w-8 h-8 rounded-full border-4 border-white"></div>
                    </div>

                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900 mb-1">{{ $intern['user_name'] }}</h1>
                        <p class="text-lg text-gray-600 mb-3">{{ $intern['position'] }}</p>

                        {{-- Enhanced Rating --}}
                        <div class="flex items-center gap-2 mb-4">
                            <div class="flex items-center gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $intern['rating']['rating_range'] ? 'text-yellow-400' : 'text-gray-300' }} 
                                         transition-all duration-200 hover:scale-110"
                                         fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46 1.287 3.97c.3.921-.755 1.688-1.54 1.118L10 13.348l-3.365 2.427c-.784.57-1.838-.197-1.539-1.118l1.286-3.97-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178l1.286-3.97z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-sm font-semibold text-gray-700 bg-yellow-50 px-3 py-1 rounded-full">
                                {{ $intern['rating']['rating_range'] }}/5
                            </span>
                        </div>

                        {{-- Enhanced Social Links --}}
                        <div class="flex gap-3">
                            @if ($intern['linkedin_url'])
                                <a href="https://{{ $intern['linkedin_url'] }}" target="_blank"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition-all">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                    LinkedIn
                                </a>
                            @endif
                            @if ($intern['instagram_url'])
                                <a href="https://{{ $intern['instagram_url'] }}" target="_blank"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-pink-600 bg-pink-50 border border-pink-200 rounded-lg hover:bg-pink-100 hover:border-pink-300 transition-all">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                    Instagram
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- LEFT COLUMN --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Academic Background --}}
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <h2 class="text-lg font-semibold text-gray-900">Latar Belakang Akademis</h2>
                        </div>
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-100">
                            <p class="font-medium text-gray-900">{{ $intern['school'] }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ $intern['major'] }}</p>
                        </div>
                    </div>

                    {{-- Projects Section --}}
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-shadow">
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <h2 class="text-lg font-semibold text-gray-900">Proyek yang dikerjakan</h2>
                            </div>
                            <span class="bg-purple-100 text-purple-700 text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $intern['projects_count'] }} Proyek
                            </span>
                        </div>

                        <div class="space-y-4 pr-2 {{ $intern['projects_count'] > 2 ? 'max-h-[600px] overflow-y-auto' : '' }}">
                            @foreach ($intern['projects'] as $project)
                                <a href="{{ route('project.show', $project) }}" 
                                   class="block border-2 border-gray-100 rounded-xl p-5 hover:border-purple-200 hover:shadow-md transition-all cursor-pointer group">
                                    <div class="flex items-start justify-between mb-3">
                                        <span class="text-xs font-semibold px-3 py-1.5 rounded-full"
                                              style="background-color: {{ str_replace('0xFF', '#', $project['category']['bg_color']) }};
                                                     color: {{ str_replace('0xFF', '#', $project['category']['txt_color']) }}">
                                            {{ $project['category']['category_name'] }}
                                        </span>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </div>
                                    <h3 class="font-semibold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">
                                        {{ $project['project_title'] }}
                                    </h3>
                                    <p class="text-sm text-gray-600 leading-relaxed line-clamp-2">
                                        {{ $project['project_description'] }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Tips Section --}}
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition-shadow">
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                                <h2 class="text-lg font-semibold text-gray-900">Tips yang dibagikan</h2>
                            </div>
                            <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $intern['suggestions_count'] }} Tips
                            </span>
                        </div>

                        <div class="space-y-3 pr-2 {{ $intern['suggestions_count'] > 3 ? 'max-h-[200px] overflow-y-auto' : '' }}">
                            @foreach ($intern['suggestions'] as $tip)
                                <a href="{{ route('suggestion.show', $tip) }}" 
                                   class="border-2 border-gray-100 rounded-xl p-4 hover:border-green-200 hover:shadow-md transition-all flex justify-between items-center gap-4 cursor-pointer group">
                                    <span class="text-sm font-medium text-gray-900 flex-1 group-hover:text-green-600 transition-colors">
                                        {{ $tip['suggestion_title'] }}
                                    </span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-semibold px-3 py-1.5 rounded-full whitespace-nowrap"
                                              style="background-color: {{ str_replace('0xFF', '#', $tip['category']['bg_color']) }};
                                                     color: {{ str_replace('0xFF', '#', $tip['category']['txt_color']) }}">
                                            {{ $tip['category']['category_name'] }}
                                        </span>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>

                {{-- RIGHT COLUMN --}}
                <div class="space-y-6">

                    {{-- Internship Info --}}
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl shadow-md p-6 border border-blue-100">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h2 class="text-lg font-semibold text-gray-900">Informasi Magang</h2>
                        </div>
                        <div class="bg-white rounded-lg p-4 space-y-3">
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Periode</p>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($intern['join_date'])->format('d M Y') }}
                                    <span class="text-gray-400">–</span>
                                    {{ \Carbon\Carbon::parse($intern['end_date'])->format('d M Y') }}
                                </p>
                            </div>
                            <div class="border-t pt-3">
                                <p class="text-xs text-gray-500 mb-1">Department</p>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $intern['department']['department_name'] }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Statistics --}}
                    <div class="bg-white rounded-2xl shadow-md p-6">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            <h2 class="text-lg font-semibold text-gray-900">Statistik</h2>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 text-center border border-purple-200">
                                <p class="text-3xl font-bold text-purple-700">{{ $intern['projects_count'] }}</p>
                                <p class="text-xs text-purple-600 font-medium mt-1">Proyek</p>
                            </div>
                            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 text-center border border-green-200">
                                <p class="text-3xl font-bold text-green-700">{{ $intern['suggestions_count'] }}</p>
                                <p class="text-xs text-green-600 font-medium mt-1">Tips</p>
                            </div>
                            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-4 text-center border border-yellow-200">
                                <p class="text-3xl font-bold text-yellow-700">{{ $intern['rating']['rating_range'] }}</p>
                                <p class="text-xs text-yellow-600 font-medium mt-1">Rating</p>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 text-center border border-blue-200">
                                <p class="text-3xl font-bold text-blue-700">{{ $intern['duration_months'] }}</p>
                                <p class="text-xs text-blue-600 font-medium mt-1">Bulan</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-layouts.app>