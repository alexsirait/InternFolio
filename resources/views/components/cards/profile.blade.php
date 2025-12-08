<div class="p-6 bg-white rounded-xl shadow w-full">
    <div class="flex items-center gap-4">
        <div class="w-16 h-16 bg-gray-300 rounded-full"></div>
        <div>
            <h3 class="font-bold">{{ $name }}</h3>
            <p class="text-sm text-gray-600">{{ $position }}</p>
            <p class="text-xs text-gray-500">{{ $company }}</p>
        </div>
    </div>
    <button class="mt-4 w-full border rounded-lg py-2 hover:bg-black hover:text-white transition">
        Lihat Profil
    </button>
</div>
