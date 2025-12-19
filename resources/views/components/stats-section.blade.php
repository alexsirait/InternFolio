<div class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Section Header --}}
        <div class="text-center mb-12">
            <div class="inline-block mb-4">
                <div class="h-1 w-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mx-auto"></div>
            </div>

            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                Statistik Platform
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Data real-time dokumentasi pengalaman magang
            </p>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">

            {{-- Total Alumni --}}
            <div
                class="group bg-white rounded-2xl p-8 border-2 border-blue-200 transition-all duration-300 shadow-lg hover:shadow-2xl hover:border-blue-500 hover:-translate-y-2">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-100 rounded-xl group-hover:bg-blue-500 transition-colors">
                        <svg class="w-8 h-8 text-blue-600 group-hover:text-white transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-4xl font-extrabold text-gray-900 group-hover:text-blue-600 transition-colors mb-2">
                    {{ $totalInterns ?? 0 }}+
                </h3>
                <p class="text-gray-600 group-hover:text-blue-700 transition-colors font-medium">
                    Alumni Terdaftar
                </p>
            </div>

            {{-- Total Projects --}}
            <div
                class="group bg-white rounded-2xl p-8 border-2 border-indigo-200 transition-all duration-300 shadow-lg hover:shadow-2xl hover:border-indigo-500 hover:-translate-y-2">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-indigo-100 rounded-xl group-hover:bg-indigo-500 transition-colors">
                        <svg class="w-8 h-8 text-indigo-600 group-hover:text-white transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-4xl font-extrabold text-gray-900 group-hover:text-indigo-600 transition-colors mb-2">
                    {{ $totalProjects ?? 0 }}+
                </h3>
                <p class="text-gray-600 group-hover:text-indigo-700 transition-colors font-medium">
                    Project Terdokumentasi
                </p>
            </div>

            {{-- Total Suggestions --}}
            <div
                class="group bg-white rounded-2xl p-8 border-2 border-cyan-200 transition-all duration-300 shadow-lg hover:shadow-2xl hover:border-cyan-500 hover:-translate-y-2">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-cyan-100 rounded-xl group-hover:bg-cyan-500 transition-colors">
                        <svg class="w-8 h-8 text-cyan-600 group-hover:text-white transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-4xl font-extrabold text-gray-900 group-hover:text-cyan-600 transition-colors mb-2">
                    {{ $totalSuggestions ?? 0 }}+
                </h3>
                <p class="text-gray-600 group-hover:text-cyan-700 transition-colors font-medium">
                    Tips & Saran
                </p>
            </div>

        </div>

        {{-- Additional Info Banner --}}
        <div class="mt-12 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-8 text-center max-w-4xl mx-auto">
            <div class="flex items-center justify-center gap-3 mb-3">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-white text-lg font-semibold">
                    Platform Knowledge Sharing untuk Dokumentasi Pengalaman Magang
                </p>
            </div>
            <p class="text-blue-100 text-sm">
                Temukan referensi project, tips, dan insight berharga dari para alumni
            </p>
        </div>

    </div>
</div>
