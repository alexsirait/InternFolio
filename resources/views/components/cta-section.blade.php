{{-- Wave Divider --}}
<div class="relative">
    <svg class="w-full h-12 md:h-16 text-gray-50" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path
            d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
            fill="currentColor"></path>
    </svg>
</div>

<div class="relative bg-gradient-to-br from-blue-600 via-indigo-600 to-indigo-700 py-20 md:py-24 overflow-hidden">

    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-300 rounded-full blur-3xl animate-pulse"
            style="animation-delay: 1s;"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 text-center relative z-10">

        {{-- Decorative Accent --}}
        <div class="inline-block mb-6">
            <div class="h-1 w-20 bg-white/50 rounded-full mx-auto"></div>
        </div>

        <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white mb-6 leading-tight">
            Jelajahi InternFolio
        </h2>

        <p class="text-lg md:text-xl text-blue-100 mb-10 max-w-3xl mx-auto leading-relaxed">
            Akses dokumentasi lengkap pengalaman magang dari alumni-alumni sebelumnya.
            Temukan insights, project references, dan tips berharga untuk persiapan magang Anda.
        </p>

        {{-- Action Buttons --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-4xl mx-auto mb-12">
            <a href="{{ route('intern.index') }}"
                class="px-6 py-4 rounded-xl bg-white text-blue-700 font-bold shadow-2xl hover:shadow-3xl hover:bg-blue-50 transition-all transform hover:-translate-y-1 hover:scale-105 duration-300 group">
                <div class="flex flex-col items-center gap-2">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="text-sm">Profil Alumni</span>
                </div>
            </a>

            <a href="{{ route('project.index') }}"
                class="px-6 py-4 rounded-xl bg-white text-blue-700 font-bold shadow-2xl hover:shadow-3xl hover:bg-blue-50 transition-all transform hover:-translate-y-1 hover:scale-105 duration-300 group">
                <div class="flex flex-col items-center gap-2">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-sm">Daftar Project</span>
                </div>
            </a>

            <a href="{{ route('suggestion.index') }}"
                class="px-6 py-4 rounded-xl bg-white text-blue-700 font-bold shadow-2xl hover:shadow-3xl hover:bg-blue-50 transition-all transform hover:-translate-y-1 hover:scale-105 duration-300 group">
                <div class="flex flex-col items-center gap-2">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                    <span class="text-sm">Tips & Saran</span>
                </div>
            </a>
        </div>

        {{-- Additional Info --}}
        <div class="flex flex-wrap justify-center gap-8 text-white/90">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm font-semibold">Database Lengkap</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm font-semibold">Mudah Dicari</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm font-semibold">Terupdate</span>
            </div>
        </div>
    </div>
</div>
