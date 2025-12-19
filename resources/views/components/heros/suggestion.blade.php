@props([
    'totalSuggestions' => 0,
])

<div class="relative bg-gradient-to-br from-slate-700 via-cyan-800 to-slate-900 py-20 md:py-28 overflow-hidden">
    
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 left-10 w-72 h-72 bg-cyan-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-slate-400 rounded-full blur-3xl"></div>
    </div>

    {{-- Quote Decoration --}}
    <div class="absolute inset-0 opacity-5">
        <div class="text-white text-9xl font-serif absolute top-10 left-1/4">"</div>
        <div class="text-white text-9xl font-serif absolute bottom-10 right-1/4">"</div>
        <div class="text-white text-6xl absolute top-1/3 right-20">💡</div>
        <div class="text-white text-5xl absolute bottom-1/3 left-20">✨</div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="text-white text-center">
            
            <div class="inline-block mb-4">
                <span class="bg-white/10 backdrop-blur-sm border border-white/20 text-white text-sm font-semibold px-4 py-2 rounded-full">
                    💡 Tips & Saran Berharga
                </span>
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                Belajar dari <span class="text-cyan-300">Pengalaman Nyata</span>
            </h1>

            <p class="text-lg md:text-xl text-slate-200 mb-10 leading-relaxed max-w-3xl mx-auto">
                Kumpulan tips, saran, dan insight berharga dari para alumni intern. 
                Pelajari hal-hal penting yang perlu diperhatikan selama magang.
            </p>

            {{-- Stats Row --}}
            <div class="flex flex-wrap justify-center gap-6 mb-10">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl px-6 py-4 hover:bg-white/15 transition">
                    <div class="text-3xl font-bold text-white">{{ $totalSuggestions ?? '75' }}+</div>
                    <div class="text-sm text-slate-200">Total Tips</div>
                </div>

                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl px-6 py-4 hover:bg-white/15 transition">
                    <div class="text-3xl font-bold text-white">8+</div>
                    <div class="text-sm text-slate-200">Categories</div>
                </div>

                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl px-6 py-4 hover:bg-white/15 transition">
                    <div class="text-3xl font-bold text-white">50+</div>
                    <div class="text-sm text-slate-200">Contributors</div>
                </div>
            </div>

            {{-- CTA Buttons --}}
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="#suggestion-list"
                    class="px-6 py-3 rounded-lg bg-white text-cyan-900 font-semibold shadow-xl hover:shadow-2xl hover:bg-cyan-50 transition transform hover:-translate-y-1">
                    📖 Baca Tips
                </a>
                <a href="{{ route('dashboard.index') }}"
                    class="px-6 py-3 rounded-lg border-2 border-white/30 backdrop-blur-sm text-white font-semibold hover:bg-white/10 hover:border-white/50 transition">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>
</div>
