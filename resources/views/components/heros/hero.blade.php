@props([
    'totalInterns' => 0,
    'totalProjects' => 0,
    'totalSuggestions' => 0,
])

<div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 py-20 md:py-28 overflow-hidden">
    
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-300 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            {{-- LEFT TEXT --}}
            <div class="text-white">
                <div class="inline-block mb-4">
                    <span class="bg-blue-500/30 backdrop-blur-sm border border-white/20 text-white text-xs md:text-sm font-semibold px-4 py-2 rounded-full">
                        🎓 Platform Knowledge Sharing Intern
                    </span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                    Dokumentasi & <span class="text-blue-200">Knowledge Sharing</span>
                </h1>

                <p class="text-lg md:text-xl text-blue-100 mb-8 leading-relaxed">
                    Tempat untuk mengumpulkan pengalaman magang mahasiswa secara terstruktur, mudah ditemukan, 
                    dan bermanfaat sebagai referensi untuk generasi selanjutnya.
                </p>

                <div class="flex flex-wrap gap-4 mb-10">
                    <a href="#intern-section"
                        class="px-6 py-3 rounded-lg bg-white text-blue-700 font-semibold shadow-xl hover:shadow-2xl hover:bg-blue-50 transition transform hover:-translate-y-1">
                        Mulai Jelajahi
                    </a>
                    <a href="{{ route('intern.index') }}"
                        class="px-6 py-3 rounded-lg border-2 border-white/30 backdrop-blur-sm text-white font-semibold hover:bg-white/10 hover:border-white/50 transition">
                        Lihat Alumni
                    </a>
                </div>

                {{-- Statistics Cards --}}
                <div class="grid grid-cols-3 gap-4">
                    {{-- Total Interns --}}
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-4 text-center hover:bg-white/20 transition">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-1">
                            {{ $totalInterns }}+
                        </div>
                        <div class="text-xs md:text-sm text-blue-100 font-medium">
                            Alumni Intern
                        </div>
                    </div>

                    {{-- Total Projects --}}
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-4 text-center hover:bg-white/20 transition">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-1">
                            {{ $totalProjects }}+
                        </div>
                        <div class="text-xs md:text-sm text-blue-100 font-medium">
                            Project
                        </div>
                    </div>

                    {{-- Total Suggestions --}}
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-4 text-center hover:bg-white/20 transition">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-1">
                            {{ $totalSuggestions }}+
                        </div>
                        <div class="text-xs md:text-sm text-blue-100 font-medium">
                            Saran
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT ILLUSTRATION --}}
            <div class="flex justify-center relative">
                <div class="absolute w-72 h-72 bg-blue-400/20 blur-3xl rounded-full animate-pulse"></div>

                <img src="{{ asset('image/logo.png') }}" 
                     alt="InternFolio Logo" 
                     class="w-80 md:w-96 drop-shadow-2xl relative z-10 transform hover:scale-105 transition duration-500">
            </div>

        </div>
    </div>
</div>
