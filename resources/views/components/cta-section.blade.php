<div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 py-16 md:py-20 overflow-hidden">
    
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-72 h-72 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-300 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        
        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">
            Siap Berbagi Pengalaman?
        </h2>
        
        <p class="text-lg md:text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
            Bergabunglah dengan ratusan alumni intern yang telah berbagi pengalaman mereka. 
            Bantu calon intern berikutnya dengan insights berharga dari pengalaman Anda!
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('intern.index') }}"
                class="px-8 py-4 rounded-lg bg-white text-blue-700 font-bold text-lg shadow-xl hover:shadow-2xl hover:bg-blue-50 transition transform hover:-translate-y-1">
                🔍 Explore Pengalaman Alumni
            </a>
            
            {{-- Optional: Login/Register button if auth is implemented --}}
            {{-- <a href="#"
                class="px-8 py-4 rounded-lg border-2 border-white/50 backdrop-blur-sm text-white font-bold text-lg hover:bg-white/10 hover:border-white transition">
                📝 Bagikan Pengalaman Anda
            </a> --}}
        </div>

        {{-- Additional Info --}}
        <div class="mt-10 flex flex-wrap justify-center gap-8 text-white/90">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-sm font-medium">100% Gratis</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-sm font-medium">Mudah Digunakan</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-sm font-medium">Terpercaya</span>
            </div>
        </div>
    </div>
</div>
