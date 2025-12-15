<div class="bg-gradient-to-b from-white to-blue-50 py-24">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

        {{-- LEFT TEXT --}}
        <div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                Dokumentasi & <span class="text-blue-600">Knowledge Sharing</span>
            </h1>

            <p class="text-lg text-gray-600 mt-6 md:mt-4 md:w-11/12">
                Tempat untuk mengumpulkan pengalaman magang mahasiswa secara terstruktur, mudah ditemukan, 
                dan bermanfaat sebagai referensi untuk generasi selanjutnya.
            </p>

            <div class="mt-8 flex gap-4">
                <a href="#intern-section"
                    class="px-6 py-3 rounded-lg bg-blue-600 text-white font-semibold shadow-lg hover:bg-blue-700 transition">
                    Mulai Jelajahi
                </a>
                <a href="{{ route('intern.index') }}"
                    class="px-6 py-3 rounded-lg border border-blue-600 text-blue-600 font-semibold hover:bg-blue-100 transition">
                    Lihat Alumni
                </a>
            </div>
        </div>

        {{-- RIGHT ILLUSTRATION --}}
        <div class="flex justify-center relative">
            <div class="absolute w-72 h-72 bg-blue-200/40 blur-3xl rounded-full -z-10"></div>

            <img src="{{ asset('image/logo.png') }}" 
                 alt="Hero Illustration" 
                 class="w-72 md:w-96 drop-shadow-2xl">
        </div>

    </div>
</div>
