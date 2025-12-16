<x-layouts.app bodyClass="bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-10">

        {{-- Back Button --}}
        <a href="{{ route('project.index') }}"
            class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 mb-6 transition-colors group">
            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Project
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT COLUMN --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Project Info Card --}}
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-xs font-semibold px-4 py-2 rounded-full shadow-sm"
                                style="background-color: {{ str_replace('0xFF', '#', $project['category']['bg_color']) }};
                                        color: {{ str_replace('0xFF', '#', $project['category']['txt_color']) }}">
                            {{ $project['category']['category_name'] }}
                        </span>

                        <div class="flex items-center gap-2 bg-blue-50 px-4 py-2 rounded-full border border-blue-200">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-sm font-medium text-blue-700">
                                {{ $project['project_duration'] }} Bulan
                            </span>
                        </div>
                    </div>

                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        {{ $project['project_title'] }}
                    </h1>

                    <div class="prose prose-sm max-w-none">
                        <p class="text-gray-700 leading-relaxed break-words">
                            {{ $project['project_description'] }}
                        </p>
                    </div>
                </div>

                {{-- Gallery Section --}}
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h2 class="text-lg font-semibold text-gray-900">Galeri Project</h2>
                        </div>
                        <span class="bg-purple-100 text-purple-700 text-xs font-semibold px-3 py-1 rounded-full">
                            {{ $project['photos_count'] }} Foto
                        </span>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($project['photos'] as $photo)
                            <button 
                                onclick="openLightbox('{{ asset('storage/' . $photo['photo_url']) }}')"
                                class="group relative aspect-square rounded-xl overflow-hidden border-2 border-gray-100 hover:border-purple-300 transition-all cursor-pointer">
                                <img
                                    src="{{ asset('storage/' . $photo['photo_url']) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                    alt="Project photo"
                                >
                                {{-- Overlay on hover --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                    <div class="absolute bottom-0 left-0 right-0 p-3">
                                        <svg class="w-6 h-6 text-white mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                        </svg>
                                    </div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Lightbox Modal --}}
                <div id="lightbox" class="hidden fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4" onclick="closeLightbox()">
                    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <img id="lightbox-img" src="" class="max-w-full max-h-full object-contain rounded-lg" onclick="event.stopPropagation()">
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

                    // Close lightbox with ESC key
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
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl shadow-lg p-6 border border-blue-100">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Pengembang</h2>
                    </div>

                    <div class="bg-white rounded-xl p-4 shadow-sm">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <img
                                    src="{{ asset('storage/' . $project['user']['user_image']) }}"
                                    class="w-16 h-16 rounded-xl object-cover ring-4 ring-blue-100"
                                    alt="{{ $project['user']['user_name'] }}"
                                >
                                <div class="absolute -bottom-1 -right-1 bg-green-500 w-5 h-5 rounded-full border-2 border-white"></div>
                            </div>

                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 mb-1">
                                    {{ $project['user']['user_name'] }}
                                </p>
                                <p class="text-sm text-gray-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    {{ $project['user']['department']['department_name'] }}
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('intern.show', $project['user']['user_uuid']) }}"
                            class="mt-4 w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Lihat Profil
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Technology Stack --}}
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                            <h3 class="font-semibold text-gray-900">
                                Teknologi yang digunakan
                            </h3>
                        </div>
                        <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                            {{ count(explode(',', $project['project_technology'])) }} tech
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @foreach (explode(',', $project['project_technology']) as $tech)
                            <span class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium rounded-lg bg-gradient-to-r from-green-50 to-emerald-50 text-green-700 border border-green-200 hover:shadow-md transition-all">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
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