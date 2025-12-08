<x-layouts.app>

    <x-sections.hero />

    <x-section title="Profil Alumni" subtitle="sub section">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <x-cards.profile name="Nama Alumni" position="Posisi" company="Perusahaan" />
            <x-cards.profile name="Nama Alumni" position="Posisi" company="Perusahaan" />
            <x-cards.profile name="Nama Alumni" position="Posisi" company="Perusahaan" />
        </div>
    </x-section>

    <x-section title="Project" subtitle="sub section">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <x-cards.project />
            <x-cards.project />
            <x-cards.project />
        </div>
    </x-section>

</x-layouts.app>
