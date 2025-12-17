<nav x-data="{ open: false, scrolled: false }" 
     @scroll.window="scrolled = window.scrollY > 10"
     :class="scrolled ? 'bg-white/95 backdrop-blur-lg shadow-lg' : 'bg-blue-600'"
     class="w-full text-white sticky top-0 z-50 transition-all duration-300">
    
    <div class="container mx-auto flex justify-between items-center px-6 py-4">

        {{-- Logo & Brand --}}
        <a href="{{ route('dashboard.index') }}" 
           class="flex items-center gap-3 group">
            <img src="{{ asset('image/logo.png') }}"
                 alt="InternFolio Logo"
                 class="h-10 w-auto transform group-hover:scale-110 transition-transform duration-300">
            <span class="hidden md:block font-bold text-xl"
                  :class="scrolled ? 'text-blue-600' : 'text-white'">
                InternFolio
            </span>
        </a>

        {{-- Menu Desktop --}}
        <ul class="hidden md:flex gap-2 font-medium">
            <li>
                <a href="{{ route('dashboard.index') }}"
                   :class="scrolled ? 
                       '{{ request()->routeIs('dashboard.index') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50' }}' : 
                       '{{ request()->routeIs('dashboard.index') ? 'bg-white/20' : 'hover:bg-white/10' }}'"
                   class="px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard.index') ? '' : '' }}">
                    🏠 Beranda
                </a>
            </li>

            <li>
                <a href="{{ route('intern.index') }}"
                   :class="scrolled ? 
                       '{{ request()->routeIs('intern.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50' }}' : 
                       '{{ request()->routeIs('intern.*') ? 'bg-white/20' : 'hover:bg-white/10' }}'"
                   class="px-4 py-2 rounded-lg transition-all duration-200">
                    👥 Profil Alumni
                </a>
            </li>

            <li>
                <a href="{{ route('project.index') }}"
                   :class="scrolled ? 
                       '{{ request()->routeIs('project.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50' }}' : 
                       '{{ request()->routeIs('project.*') ? 'bg-white/20' : 'hover:bg-white/10' }}'"
                   class="px-4 py-2 rounded-lg transition-all duration-200">
                    💼 Project
                </a>
            </li>

            <li>
                <a href="{{ route('suggestion.index') }}"
                   :class="scrolled ? 
                       '{{ request()->routeIs('suggestion.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50' }}' : 
                       '{{ request()->routeIs('suggestion.*') ? 'bg-white/20' : 'hover:bg-white/10' }}'"
                   class="px-4 py-2 rounded-lg transition-all duration-200">
                    💡 Tips & Saran
                </a>
            </li>
        </ul>

        {{-- Login Desktop --}}
        <a href="/intern"
           class="hidden md:flex items-center gap-2 px-5 py-2.5 rounded-lg font-semibold shadow-md
                  bg-gradient-to-r from-white to-blue-50 hover:from-blue-50 hover:to-blue-100
                  transform hover:scale-105 transition-all duration-200"
           :class="scrolled ? 'text-blue-600' : 'text-blue-600'">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
            Login
        </a>

        {{-- Hamburger Button --}}
        <button @click="open = !open" 
                class="md:hidden focus:outline-none p-2 rounded-lg hover:bg-white/10 transition"
                :class="scrolled ? 'text-blue-600' : 'text-white'">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-6 h-6 transition-transform duration-300"
                 :class="open ? 'rotate-90' : ''"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round"
                      d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="open" stroke-linecap="round" stroke-linejoin="round"
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden bg-gradient-to-b from-blue-700 to-blue-800 shadow-2xl border-t border-white/10"
         :class="scrolled ? 'from-white to-gray-50 border-gray-200' : ''">
        
        <div class="px-6 py-4 space-y-2">
            <a href="{{ route('dashboard.index') }}"
               @click="open = false"
               class="flex items-center gap-3 py-3 px-4 rounded-lg font-medium transition-all
                      {{ request()->routeIs('dashboard.index') ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/10' }}"
               :class="scrolled ? 
                   '{{ request()->routeIs('dashboard.index') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50' }}' : 
                   'text-white'">
                <span class="text-xl">🏠</span>
                Beranda
            </a>

            <a href="{{ route('intern.index') }}"
               @click="open = false"
               class="flex items-center gap-3 py-3 px-4 rounded-lg font-medium transition-all
                      {{ request()->routeIs('intern.*') ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/10' }}"
               :class="scrolled ? 
                   '{{ request()->routeIs('intern.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50' }}' : 
                   'text-white'">
                <span class="text-xl">👥</span>
                Profil Alumni
            </a>

            <a href="{{ route('project.index') }}"
               @click="open = false"
               class="flex items-center gap-3 py-3 px-4 rounded-lg font-medium transition-all
                      {{ request()->routeIs('project.*') ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/10' }}"
               :class="scrolled ? 
                   '{{ request()->routeIs('project.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50' }}' : 
                   'text-white'">
                <span class="text-xl">💼</span>
                Project
            </a>

            <a href="{{ route('suggestion.index') }}"
               @click="open = false"
               class="flex items-center gap-3 py-3 px-4 rounded-lg font-medium transition-all
                      {{ request()->routeIs('suggestion.*') ? 'bg-white/20 text-white shadow-lg' : 'hover:bg-white/10' }}"
               :class="scrolled ? 
                   '{{ request()->routeIs('suggestion.*') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-blue-50' }}' : 
                   'text-white'">
                <span class="text-xl">💡</span>
                Tips & Saran
            </a>

            {{-- Login Mobile --}}
            <a href="/intern"
               @click="open = false"
               class="flex items-center justify-center gap-2 mt-4 py-3 px-4 rounded-lg font-bold
                      bg-gradient-to-r from-white to-blue-50 text-blue-600
                      hover:from-blue-50 hover:to-blue-100 shadow-lg
                      transform hover:scale-105 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                Login
            </a>
        </div>
    </div>
</nav>
