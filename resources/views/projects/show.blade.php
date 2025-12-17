<x-layouts.app bodyClass="bg-gradient-to-br from-gray-50 via-purple-50/30 to-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm mb-6" aria-label="Breadcrumb">
            <a href="{{ route('dashboard.index') }}" class="text-gray-500 hover:text-blue-600 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <a href="{{ route('project.index') }}" class="text-gray-500 hover:text-purple-600 transition">
                Project
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-gray-900 font-medium">Detail</span>
        </nav>

        {{-- Back Button --}}
        <a href="{{ route('project.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm bg-white border border-gray-200 rounded-lg
                   text-gray-700 hover:bg-gray-50 hover:border-purple-300 transition-all group shadow-sm mb-6">
            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Project
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT COLUMN --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Project Header Card --}}
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-2xl transition-shadow">
                    <div class="p-8">
                        <div class="flex flex-wrap justify-between items-start gap-4 mb-6">
                            <span class="text-sm font-bold px-4 py-2 rounded-lg shadow-md"
                                    style="background-color: {{ str_replace('0xFF', '#', $project['category']['bg_color']) }};
                                            color: {{ str_replace('0xFF', '#', $project['category']['txt_color']) }}">
                                {{ $project['category']['category_name'] }}
                            </span>

                            <div class="flex items-center gap-2 bg-purple-50 px-4 py-2 rounded-lg border-2 border-purple-200">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm font-bold text-purple-700">
                                    {{ $project['project_duration'] }} Bulan
                                </span>
                            </div>
                        </div>

                        <h1 class="text-4xl font-extrabold text-gray-900 mb-4 leading-tight">
                            {{ $project['project_title'] }}
                        </h1>

                        <p class="text-lg text-gray-700 leading-relaxed">
                            {{ $project['project_description'] }}
                        </p>
                    </div>
                </div>

                {{-- Gallery Section --}}
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Galeri Project</h2>
                                <p class="text-sm text-gray-500">Klik untuk memperbesar gambar</p>
                            </div>
                        </div>
                        <span class="bg-purple-100 text-purple-700 text-sm font-bold px-4 py-2 rounded-lg">
                            {{ $project['photos_count'] }} Foto
                        </span>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($project['photos'] as $photo)
                            <button 
                                onclick="openLightbox('{{ asset('storage/' . $photo['photo_url']) }}')"
                                class="group relative aspect-square rounded-xl overflow-hidden border-2 border-gray-200 hover:border-purple-400 hover:shadow-lg transition-all cursor-pointer">
                                <img
                                    src="{{ asset('storage/' . $photo['photo_url']) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                    alt="Project photo"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                    </svg>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Lightbox Modal --}}
                <div id="lightbox" class="hidden fixed inset-0 bg-black/95 z-50 flex items-center justify-center p-4" onclick="closeLightbox()">
                    <button onclick="closeLightbox()" class="absolute top-4 right-4 p-2 bg-white/10 backdrop-blur-sm rounded-full text-white hover:bg-white/20 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <img id="lightbox-img" src="" class="max-w-full max-h-full object-contain rounded-xl shadow-2xl" onclick="event.stopPropagation()">
                </div>

                <script>
                    function openLightbox(imageSrc) {
                        document.getElementById('lightbox').classList.remove('hidden');
                        document.getElementById('lightbox-img').src = imageSrc;
                        document.body.style.overflow = 'hidden';
                    }

                    function closeLightbox() {
                        document.getElementById('lightbox').classList.add('hidden');
                        document.body.style.overflow = 'auto';
                    }

                    document.addEventListener('keydown', function(e) {
                        if (e.key === 'Escape') {
                            closeLightbox();
                        }
                    });
                </script>

            </div>

            {{-- RIGHT COLUMN --}}
            <div class="space-y-6">

                {{-- Developer Info --}}
                <div class="bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-50 rounded-2xl shadow-lg p-6 border-2 border-purple-200/50">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-gray-900">Developer</h2>
                    </div>

                    <div class="bg-white rounded-xl p-5 shadow-sm border border-purple-100">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="relative">
                                <div class="p-1 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl">
                                    <img
                                        src="{{ asset('storage/' . $project['user']['user_image']) }}"
                                        class="w-16 h-16 rounded-lg object-cover ring-2 ring-white"
                                        alt="{{ $project['user']['user_name'] }}"
                                    >
                                </div>
                                <div class="absolute -bottom-1 -right-1 bg-green-500 w-5 h-5 rounded-full border-2 border-white"></div>
                            </div>

                            <div class="flex-1">
                                <p class="font-bold text-gray-900 mb-1">
                                    {{ $project['user']['user_name'] }}
                                </p>
                                <p class="text-sm text-gray-600 flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    {{ $project['user']['department']['department_name'] }}
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('intern.show', $project['user']['user_uuid']) }}"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white text-sm font-bold rounded-lg hover:from-purple-700 hover:to-purple-800 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Lihat Profil
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Technology Stack --}}
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-green-100 rounded-lg">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Tech Stack</h3>
                                <p class="text-xs text-gray-500">Teknologi yang digunakan</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-700 text-sm font-bold px-3 py-1.5 rounded-lg">
                            {{ count(explode(',', $project['project_technology'])) }}
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @foreach (explode(',', $project['project_technology']) as $tech)
                            <span class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-semibold rounded-lg bg-gradient-to-r from-green-50 to-emerald-50 text-green-700 border-2 border-green-200 hover:shadow-md hover:scale-105 transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                {{ trim($tech) }}
                            </span>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-layouts.app>