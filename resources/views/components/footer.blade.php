<footer class="relative w-full bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white overflow-hidden">
    
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-300 rounded-full blur-3xl"></div>
    </div>

    <div class="relative z-10 container mx-auto px-6 md:px-10 py-14 md:py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-12">

            {{-- Logo + Deskripsi --}}
            <div class="space-y-4">
                <a href="/" class="flex items-center gap-3 group">
                    <img src="{{ asset('image/logo.png') }}" 
                         alt="InternFolio Logo" 
                         class="h-12 w-auto transform group-hover:scale-110 transition-transform duration-300">
                    <span class="font-bold text-2xl">InternFolio</span>
                </a>
                <p class="text-blue-100 leading-relaxed text-sm">
                    Platform dokumentasi dan knowledge sharing pengalaman magang mahasiswa. 
                    Berbagi insight, project, dan tips untuk generasi berikutnya.
                </p>
                
                {{-- Stats --}}
                <div class="flex gap-4 pt-2">
                    <div class="text-center">
                        <div class="text-2xl font-bold">100+</div>
                        <div class="text-xs text-blue-200">Alumni</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">50+</div>
                        <div class="text-xs text-blue-200">Projects</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">75+</div>
                        <div class="text-xs text-blue-200">Tips</div>
                    </div>
                </div>
            </div>

            {{-- Halaman --}}
            <div>
                <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Navigasi Cepat
                </h3>
                <ul class="space-y-2.5 text-blue-100">
                    <li>
                        <a href="/" 
                           class="flex items-center gap-2 hover:text-white hover:translate-x-1 transition-all duration-200 group">
                            <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('intern.index') }}" 
                           class="flex items-center gap-2 hover:text-white hover:translate-x-1 transition-all duration-200 group">
                            <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Profil Alumni
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('project.index') }}" 
                           class="flex items-center gap-2 hover:text-white hover:translate-x-1 transition-all duration-200 group">
                            <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Project
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('suggestion.index') }}" 
                           class="flex items-center gap-2 hover:text-white hover:translate-x-1 transition-all duration-200 group">
                            <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Tips & Saran
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div>
                <h3 class="font-bold text-lg mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Hubungi Kami
                </h3>
                
                <div class="space-y-3 text-blue-100 text-sm">
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Batam, Kepulauan Riau, Indonesia</span>
                    </div>
                    
                    <div class="flex items-start gap-2">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <a href="mailto:rianabdullah1504@gmail.com" 
                           class="hover:text-white hover:underline transition-colors">
                            rianabdullah1504@gmail.com
                        </a>
                    </div>
                </div>

                {{-- Social Media --}}
                <div class="mt-6">
                    <p class="text-sm text-blue-100 mb-3 font-medium">Follow Us:</p>
                    <div class="flex items-center gap-3">
                        {{-- Instagram --}}
                        <a href="https://instagram.com/rian1504_" 
                           target="_blank" 
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm border border-white/20
                                  hover:bg-pink-500 hover:border-pink-500 hover:scale-110 
                                  transform transition-all duration-200 group">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        
                        {{-- LinkedIn --}}
                        <a href="https://linkedin.com/in/rianabdullah" 
                           target="_blank" 
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm border border-white/20
                                  hover:bg-blue-500 hover:border-blue-500 hover:scale-110 
                                  transform transition-all duration-200 group">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>

                        {{-- GitHub --}}
                        <a href="https://github.com/rian1504" 
                           target="_blank" 
                           class="flex items-center justify-center w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm border border-white/20
                                  hover:bg-gray-800 hover:border-gray-800 hover:scale-110 
                                  transform transition-all duration-200 group">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <hr class="border-white/20 my-8">

        {{-- Bottom Section --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-blue-100">
            <p class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                </svg>
                © {{ date('Y') }} InternFolio. All Rights Reserved.
            </p>
            
            <div class="flex items-center gap-4">
                <span class="text-xs">Made with ❤️ by Rian Abdullah</span>
            </div>
        </div>
    </div>
</footer>
