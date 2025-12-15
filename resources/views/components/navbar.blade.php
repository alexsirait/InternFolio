<nav x-data="{ open: false }" class="w-full bg-blue-600 text-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center px-6 py-4">

        {{-- Logo --}}
        <a href="{{ route('dashboard.index') }}" class="flex items-center gap-2">
            <img src="{{ asset('image/logo.png') }}"
                 alt="InternFolio Logo"
                 class="h-10 w-auto">
        </a>

        {{-- Menu Desktop --}}
        <ul class="hidden md:flex gap-8 font-medium">
            <li>
                <a href="{{ route('dashboard.index') }}"
                   class="{{ request()->routeIs('dashboard.index') 
                        ? 'text-white border-b-2 border-white pb-1' 
                        : 'text-white/80 hover:text-white transition' }}">
                    Beranda
                </a>
            </li>

            <li>
                <a href="{{ route('intern.index') }}"
                   class="{{ request()->routeIs('intern.*') 
                        ? 'text-white border-b-2 border-white pb-1' 
                        : 'text-white/80 hover:text-white transition' }}">
                    Profil Alumni
                </a>
            </li>

            <li>
                <a href="{{ route('project.index') }}"
                   class="{{ request()->routeIs('project.*') 
                        ? 'text-white border-b-2 border-white pb-1' 
                        : 'text-white/80 hover:text-white transition' }}">
                    Project
                </a>
            </li>

            <li>
                <a href="{{ route('suggestion.index') }}"
                   class="{{ request()->routeIs('suggestion.*') 
                        ? 'text-white border-b-2 border-white pb-1' 
                        : 'text-white/80 hover:text-white transition' }}">
                    Tips & Saran
                </a>
            </li>
        </ul>

        {{-- Login Desktop --}}
        <a href="/intern"
           class="hidden md:block px-4 py-2 bg-white text-blue-600 font-medium rounded-lg
                  hover:bg-blue-100 transition shadow-sm">
            Login
        </a>

        {{-- Hamburger Button --}}
        <button @click="open = !open" class="md:hidden focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-7 h-7"
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
    <div x-show="open" x-transition class="md:hidden bg-blue-700 text-white px-6 pb-4 space-y-3">

        <a href="{{ route('dashboard.index') }}"
           @click="open = false"
           class="block py-2 border-b border-blue-500
                  {{ request()->routeIs('dashboard.index') ? 'font-semibold bg-blue-600 rounded px-2' : '' }}">
            Beranda
        </a>

        <a href="{{ route('intern.index') }}"
           @click="open = false"
           class="block py-2 border-b border-blue-500
                  {{ request()->routeIs('intern.*') ? 'font-semibold bg-blue-600 rounded px-2' : '' }}">
            Profil Alumni
        </a>

        <a href="{{ route('project.index') }}"
           @click="open = false"
           class="block py-2 border-b border-blue-500
                  {{ request()->routeIs('project.*') ? 'font-semibold bg-blue-600 rounded px-2' : '' }}">
            Project
        </a>

        <a href="{{ route('suggestion.index') }}"
           @click="open = false"
           class="block py-2 border-b border-blue-500
                  {{ request()->routeIs('suggestion.*') ? 'font-semibold bg-blue-600 rounded px-2' : '' }}">
            Tips & Saran
        </a>

        {{-- Login Mobile --}}
        <a href="/intern"
           @click="open = false"
           class="mt-2 block w-full text-center bg-white text-blue-600 py-2 rounded-lg font-medium">
            Login
        </a>
    </div>
</nav>
