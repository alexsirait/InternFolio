@props([
    'shortLink',
    'title' => 'Share',
    'description' => '',
    'color' => 'blue', // blue, purple, green
])

@php
    $colorClasses = [
        'blue' => [
            'button' => 'from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800',
            'icon' => 'text-blue-600',
            'badge' => 'bg-blue-50 text-blue-700 border-blue-200',
        ],
        'purple' => [
            'button' => 'from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800',
            'icon' => 'text-purple-600',
            'badge' => 'bg-purple-50 text-purple-700 border-purple-200',
        ],
        'green' => [
            'button' => 'from-green-600 to-green-700 hover:from-green-700 hover:to-green-800',
            'icon' => 'text-green-600',
            'badge' => 'bg-green-50 text-green-700 border-green-200',
        ],
    ];
    $colors = $colorClasses[$color] ?? $colorClasses['blue'];
    $shareUrl = $shortLink->short_url ?? url()->current();
    $shareText = $title . ($description ? ' - ' . $description : '');
@endphp

{{-- Share Button --}}
<button 
    onclick="openShareModal{{ $shortLink->id }}()"
    class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold bg-gradient-to-r {{ $colors['button'] }} text-white rounded-lg transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
    </svg>
    Share
</button>

{{-- Share Modal --}}
<div id="shareModal{{ $shortLink->id }}" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4" onclick="closeShareModal{{ $shortLink->id }}(event)">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform transition-all" onclick="event.stopPropagation()">
        
        {{-- Modal Header --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="p-2 {{ $colors['badge'] }} rounded-lg border-2">
                    <svg class="w-6 h-6 {{ $colors['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Share Link</h3>
                    <p class="text-xs text-gray-500">Bagikan ke teman-teman</p>
                </div>
            </div>
            <button onclick="closeShareModal{{ $shortLink->id }}(event)" class="p-2 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Shortlink Display --}}
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Short Link</label>
            <div class="flex items-center gap-2">
                <input 
                    type="text" 
                    id="shortlink{{ $shortLink->id }}" 
                    value="{{ $shareUrl }}" 
                    readonly
                    class="flex-1 px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg text-sm font-mono text-gray-700 focus:outline-none focus:border-{{ $color }}-400"
                >
                <button 
                    onclick="copyShortLink{{ $shortLink->id }}()"
                    class="px-4 py-3 bg-gradient-to-r {{ $colors['button'] }} text-white rounded-lg font-semibold hover:shadow-md transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>Copy
                </button>
            </div>
            <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                {{ $shortLink->clicks }} kali diklik
            </p>
        </div>

        {{-- Social Media Buttons --}}
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-3">Share via Social Media</label>
            <div class="grid grid-cols-3 gap-3">
                
                {{-- WhatsApp --}}
                <a href="https://wa.me/?text={{ urlencode($shareText . ' ' . $shareUrl) }}" 
                   target="_blank"
                   class="flex flex-col items-center gap-2 p-4 border-2 border-gray-200 hover:border-green-400 hover:bg-green-50 rounded-xl transition group">
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-700 group-hover:text-green-600">WhatsApp</span>
                </a>

                {{-- Telegram --}}
                <a href="https://t.me/share/url?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareText) }}" 
                   target="_blank"
                   class="flex flex-col items-center gap-2 p-4 border-2 border-gray-200 hover:border-blue-400 hover:bg-blue-50 rounded-xl transition group">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-700 group-hover:text-blue-600">Telegram</span>
                </a>

                {{-- Facebook --}}
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" 
                   target="_blank"
                   class="flex flex-col items-center gap-2 p-4 border-2 border-gray-200 hover:border-blue-600 hover:bg-blue-50 rounded-xl transition group">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-700 group-hover:text-blue-600">Facebook</span>
                </a>

                {{-- Twitter/X --}}
                <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareText) }}" 
                   target="_blank"
                   class="flex flex-col items-center gap-2 p-4 border-2 border-gray-200 hover:border-gray-800 hover:bg-gray-50 rounded-xl transition group">
                    <div class="w-12 h-12 bg-gray-900 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-700 group-hover:text-gray-900">Twitter</span>
                </a>

                {{-- LinkedIn --}}
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}" 
                   target="_blank"
                   class="flex flex-col items-center gap-2 p-4 border-2 border-gray-200 hover:border-blue-700 hover:bg-blue-50 rounded-xl transition group">
                    <div class="w-12 h-12 bg-blue-700 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-700 group-hover:text-blue-700">LinkedIn</span>
                </a>

                {{-- Email --}}
                <a href="mailto:?subject={{ urlencode($shareText) }}&body={{ urlencode($shareUrl) }}" 
                   class="flex flex-col items-center gap-2 p-4 border-2 border-gray-200 hover:border-red-400 hover:bg-red-50 rounded-xl transition group">
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-gray-700 group-hover:text-red-600">Email</span>
                </a>

            </div>
        </div>

    </div>
</div>

{{-- Toast Notification --}}
<div id="copyToast{{ $shortLink->id }}" class="hidden fixed bottom-4 right-4 bg-gray-900 text-white px-6 py-3 rounded-lg shadow-2xl z-50 flex items-center gap-3 animate-slide-up">
    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    <span class="font-medium">Link berhasil disalin!</span>
</div>

<script>
    function openShareModal{{ $shortLink->id }}() {
        document.getElementById('shareModal{{ $shortLink->id }}').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeShareModal{{ $shortLink->id }}(event) {
        if (event) event.stopPropagation();
        document.getElementById('shareModal{{ $shortLink->id }}').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function copyShortLink{{ $shortLink->id }}() {
        const input = document.getElementById('shortlink{{ $shortLink->id }}');
        input.select();
        input.setSelectionRange(0, 99999); // For mobile devices
        
        navigator.clipboard.writeText(input.value).then(() => {
            // Show toast
            const toast = document.getElementById('copyToast{{ $shortLink->id }}');
            toast.classList.remove('hidden');
            
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        });
    }

    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeShareModal{{ $shortLink->id }}(e);
        }
    });
</script>

<style>
    @keyframes slide-up {
        from {
            transform: translateY(100px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    .animate-slide-up {
        animation: slide-up 0.3s ease-out;
    }
</style>
