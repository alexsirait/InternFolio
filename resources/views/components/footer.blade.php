<footer class="w-full bg-blue-600 text-white mt-5 px-10 py-14">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">

        {{-- Logo + Deskripsi --}}
        <div>
            <a href="/" class="flex items-center gap-2">
                <img src="{{ asset('image/logo.png') }}" alt="InternFolio Logo" class="h-12 w-auto">
            </a>
            <p class="text-blue-100 mt-3 leading-relaxed">
                Platform dokumentasi dan showcase magang intern di berbagai departemen perusahaan secara profesional.
            </p>
        </div>

        {{-- Halaman --}}
        <div>
            <h3 class="font-bold text-lg mb-3">Halaman</h3>
            <ul class="space-y-2 text-blue-100">
                <li><a href="/" class="hover:text-white transition">Beranda</a></li>
                <li><a href="{{ route('intern.index') }}" class="hover:text-white transition">Profil Alumni</a></li>
                <li><a href="{{ route('project.index') }}" class="hover:text-white transition">Project</a></li>
                <li><a href="{{ route('suggestion.index') }}" class="hover:text-white transition">Tips & Saran</a></li>
            </ul>
        </div>

        {{-- Kontak --}}
        <div>
            <h3 class="font-bold text-lg mb-3">Kontak Kami</h3>
            <p class="text-blue-100">Batam, Kepulauan Riau</p>
            <p class="text-blue-100 mt-2">
                Email:
                <a href="mailto:rianabdullah1504@gmail.com" class="underline text-blue-200 hover:text-blue-300">
                    rianabdullah1504@gmail.com
                </a>
            </p>
            {{-- Sosial Media --}}
            <div class="flex items-center gap-4 mt-4">
                {{-- Instagram --}}
                <a href="https://instagram.com/rian1504_" target="_blank" class="hover:opacity-80 transition">
                    <img src="{{ asset('image/logo.png') }}" alt="Instagram" class="w-6 h-6 object-contain">
                </a>

                {{-- LinkedIn --}}
                <a href="https://linkedin.com/in/rianabdullah" target="_blank" class="hover:opacity-80 transition">
                    <img src="{{ asset('image/logo.png') }}" alt="LinkedIn" class="w-6 h-6 object-contain">
                </a>
            </div>
        </div>

    </div>

    <hr class="border-blue-400/30 mt-10">

    <p class="text-center text-blue-200 mt-6">
        © {{ date('Y') }} InternFolio. All rights reserved.
    </p>
</footer>
