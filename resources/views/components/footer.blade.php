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
                <a href="https://instagram.com/rian1504_" target="_blank" class="hover:opacity-80 text-pink-600 bg-pink-50 border border-pink-200 rounded-lg hover:bg-pink-100 hover:border-pink-300 transition-all">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                </a>
                
                {{-- LinkedIn --}}
                <a href="https://linkedin.com/in/rianabdullah" target="_blank" class="hover:opacity-80 text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 hover:border-blue-300 transition-all">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                </a>
            </div>
        </div>

    </div>

    <hr class="border-blue-400/30 mt-10">

    <p class="text-center text-blue-200 mt-6">
        © {{ date('Y') }} InternFolio. All rights reserved.
    </p>
</footer>
