<x-layouts.app bodyClass="bg-gradient-to-br from-gray-50 via-blue-50/20 to-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm mb-6" aria-label="Breadcrumb">
            <a href="{{ route('dashboard.index') }}" class="text-gray-500 hover:text-blue-600 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <a href="{{ route('intern.index') }}" class="text-gray-500 hover:text-blue-600 transition">
                Profil Alumni
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-gray-900 font-medium">{{ $intern['user_name'] }}</span>
        </nav>

        {{-- Back Button --}}
        <a href="{{ route('intern.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm bg-white border border-gray-200 rounded-lg
                  text-gray-700 hover:bg-gray-50 hover:border-blue-300 transition-all group shadow-sm mb-6">
            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Profil Alumni
        </a>

        {{-- Header Card Enhanced --}}
        <div class="bg-gradient-to-r from-white to-blue-50/50 rounded-2xl shadow-lg p-8 mb-8 hover:shadow-xl transition-shadow border border-blue-100">
            <div class="flex flex-col md:flex-row gap-6 items-start md:items-center">
                {{-- Profile Image with Gradient Ring --}}
                <div class="relative">
                    <div class="p-1 bg-gradient-to-br from-blue-400 via-blue-600 to-indigo-600 rounded-2xl">
                        <img
                            src="{{ asset('storage/' . $intern['user_image']) }}"
                            class="w-32 h-32 rounded-xl object-cover ring-4 ring-white"
                            alt="{{ $intern['user_name'] }}"
                        >
                    </div>
                    <div class="absolute -bottom-2 -right-2 bg-green-500 w-8 h-8 rounded-full border-4 border-white flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <div class="flex-1">
                    <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $intern['user_name'] }}</h1>
                    <p class="text-xl text-blue-600 font-semibold mb-3">{{ $intern['position'] }}</p>

                    {{-- Enhanced Rating --}}
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex items-center gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-6 h-6 {{ $i <= $intern['rating']['rating_range'] ? 'text-yellow-400' : 'text-gray-300' }}" 
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.97h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46 1.287 3.97c.3.921-.755 1.688-1.54 1.118L10 13.348l-3.365 2.427c-.784.57-1.838-.197-1.539-1.118l1.286-3.97-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178l1.286-3.97z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-sm font-bold text-yellow-700 bg-gradient-to-r from-yellow-100 to-yellow-200 px-4 py-2 rounded-lg border border-yellow-300 shadow-sm">
                            {{ $intern['rating']['rating_range'] }}/5 Rating
                        </span>
                    </div>

                    {{-- Enhanced Social Links --}}
                    <div class="flex flex-wrap gap-3">
                        @if ($intern['linkedin_url'])
                            <a href="https://{{ $intern['linkedin_url'] }}" target="_blank"
                            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                                LinkedIn
                            </a>
                        @endif
                        @if ($intern['instagram_url'])
                            <a href="https://{{ $intern['instagram_url'] }}" target="_blank"
                            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold bg-gradient-to-r from-pink-500 to-pink-600 text-white rounded-lg hover:from-pink-600 hover:to-pink-700 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
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
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Latar Belakang Akademik</h2>
                            <p class="text-xs text-gray-500">Pendidikan formal</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Institusi</p>
                                <p class="text-lg font-bold text-gray-900">{{ $intern['school'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Program Studi</p>
                                <p class="text-lg font-semibold text-blue-700">{{ $intern['major'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Projects Section --}}
                @if (!empty($intern['projects']))
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow">
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-purple-100 rounded-lg">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Project yang Dikerjakan</h2>
                                    <p class="text-xs text-gray-500">Karya selama magang</p>
                                </div>
                            </div>
                            <span class="bg-purple-100 text-purple-700 text-sm font-bold px-4 py-2 rounded-lg">
                                {{ count($intern['projects']) }} Project
                            </span>
                        </div>

                        <div class="space-y-4">
                            @foreach ($intern['projects'] as $project)
                                <a href="{{ route('project.show', $project['project_uuid']) }}"
                                   class="block p-5 border-2 border-gray-100 rounded-xl hover:border-purple-300 hover:bg-purple-50 hover:shadow-md transition-all group">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-bold text-gray-900 group-hover:text-purple-700 mb-2 transition-colors">
                                                {{ $project['project_title'] }}
                                            </h3>
                                            <p class="text-sm text-gray-600 leading-relaxed line-clamp-2 break-words overflow-wrap-anywhere">
                                                {{ $project['project_description'] }}
                                            </p>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-600 transition-colors flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Suggestions Section --}}
                @if (!empty($intern['suggestions']))
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow">
                        <div class="flex items-center justify-between mb-5">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Tips & Saran</h2>
                                    <p class="text-xs text-gray-500">Kontribusi knowledge</p>
                                </div>
                            </div>
                            <span class="bg-green-100 text-green-700 text-sm font-bold px-4 py-2 rounded-lg">
                                {{ count($intern['suggestions']) }} Tips
                            </span>
                        </div>

                        <div class="space-y-3">
                            @foreach ($intern['suggestions'] as $suggestion)
                                <a href="{{ route('suggestion.show', $suggestion['suggestion_uuid']) }}"
                                   class="block p-4 border-2 border-gray-100 rounded-xl hover:border-green-300 hover:bg-green-50 hover:shadow-md transition-all group">
                                    <div class="flex items-start justify-between gap-3">
                                        <h3 class="font-semibold text-gray-900 group-hover:text-green-700 transition-colors flex-1 line-clamp-2">
                                            {{ $suggestion['suggestion_title'] }}
                                        </h3>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600 transition-colors flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            {{-- RIGHT COLUMN --}}
            <div class="space-y-6">

                {{-- Internship Info --}}
                <div class="bg-gradient-to-br from-blue-50 via-indigo-50 to-blue-50 rounded-2xl shadow-lg p-6 border-2 border-blue-200/50">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Info Magang</h3>
                            <p class="text-xs text-gray-600">Detail internship</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-5 shadow-sm border border-blue-100 space-y-4">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Departemen</p>
                            <p class="font-semibold text-gray-900">{{ $intern['department']['department_name'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Periode</p>
                            <p class="text-sm font-medium text-gray-700">
                                {{ \Carbon\Carbon::parse($intern['join_date'])->format('d M Y') }} -
                                {{ \Carbon\Carbon::parse($intern['end_date'])->format('d M Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Durasi</p>
                            @php
                                $start = \Carbon\Carbon::parse($intern['join_date']);
                                $end = \Carbon\Carbon::parse($intern['end_date']);
                                $totalDays = $start->diffInDays($end);
                                $months = floor($totalDays / 30); // Bulatkan ke bawah untuk bulan
                                $remainingDays = $totalDays - ($months * 30); // Sisa hari
                            @endphp
                            <p class="text-sm font-medium text-gray-700">
                                {{ $months }} Bulan{{ $remainingDays > 0 ? ', ' . $remainingDays . ' Hari' : '' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Statistics --}}
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="p-2 bg-indigo-100 rounded-lg">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Statistik</h3>
                            <p class="text-xs text-gray-500">Kontribusi</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-4 bg-purple-50 rounded-lg border border-purple-200">
                            <span class="text-sm text-gray-700">Total Project</span>
                            <span class="text-2xl font-bold text-purple-600">{{ count($intern['projects'] ?? []) }}</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg border border-green-200">
                            <span class="text-sm text-gray-700">Total Tips</span>
                            <span class="text-2xl font-bold text-green-600">{{ count($intern['suggestions'] ?? []) }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-layouts.app>