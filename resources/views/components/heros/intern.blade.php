@props([
    'totalInterns' => 0,
])

<div class="relative bg-gradient-to-br from-slate-700 via-blue-800 to-slate-900 py-20 md:py-28 overflow-hidden">
    
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 left-10 w-72 h-72 bg-blue-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-slate-400 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-blue-300 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- LEFT CONTENT --}}
            <div class="text-white text-center lg:text-left">
                <div class="inline-block mb-4">
                    <span class="bg-white/10 backdrop-blur-sm border border-white/20 text-white text-sm font-semibold px-4 py-2 rounded-full">
                        👥 Alumni Intern Directory
                    </span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                    Temukan <span class="text-blue-300">Alumni Terbaik</span>
                </h1>

                <p class="text-lg md:text-xl text-slate-200 mb-8 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    Jelajahi profil lengkap alumni intern dari berbagai departemen dan jurusan. 
                    Lihat pengalaman, project, dan tips mereka.
                </p>

                <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                    <a href="#intern-list"
                        class="px-6 py-3 rounded-lg bg-white text-blue-900 font-semibold shadow-xl hover:shadow-2xl hover:bg-blue-50 transition transform hover:-translate-y-1">
                        🔍 Mulai Jelajahi
                    </a>
                    <a href="{{ route('dashboard.index') }}"
                        class="px-6 py-3 rounded-lg border-2 border-white/30 backdrop-blur-sm text-white font-semibold hover:bg-white/10 hover:border-white/50 transition">
                        ← Kembali
                    </a>
                </div>
            </div>

            {{-- RIGHT STATS --}}
            <div class="grid grid-cols-2 gap-4">
                {{-- Total Interns Card --}}
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 text-center hover:bg-white/15 transition transform hover:scale-105">
                    <div class="text-5xl font-bold text-white mb-2">
                        {{ $totalInterns ?? '100' }}+
                    </div>
                    <div class="text-sm text-slate-200 font-medium">
                        Total Alumni
                    </div>
                </div>

                {{-- Departments Card --}}
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 text-center hover:bg-white/15 transition transform hover:scale-105">
                    <div class="text-5xl font-bold text-white mb-2">
                        10+
                    </div>
                    <div class="text-sm text-slate-200 font-medium">
                        Departments
                    </div>
                </div>

                {{-- Average Duration Card--}}
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 text-center hover:bg-white/15 transition transform hover:scale-105">
                    <div class="text-5xl font-bold text-white mb-2">
                        3-6
                    </div>
                    <div class="text-sm text-slate-200 font-medium">
                        Bulan Rata-rata
                    </div>
                </div>

                {{-- Top Rated Card --}}
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 text-center hover:bg-white/15 transition transform hover:scale-105">
                    <div class="text-5xl font-bold text-amber-300 mb-2">
                        ★ 4.5
                    </div>
                    <div class="text-sm text-slate-200 font-medium">
                        Rating Rata-rata
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
