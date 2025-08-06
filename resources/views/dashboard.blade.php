<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pengarsipan Surat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="p-4 bg-white rounded shadow">
                    <div class="font-semibold">Surat Masuk</div>
                    <div class="text-2xl mt-2 mb-2">{{ $suratMasukCount ?? 0 }}</div>
                    <a href="{{ route('surat-masuk.index') }}" class="text-blue-500 hover:underline">Lihat Surat Masuk</a>
                </div>
                <div class="p-4 bg-white rounded shadow">
                    <div class="font-semibold">Surat Keluar</div>
                    <div class="text-2xl mt-2 mb-2">{{ $suratKeluarCount ?? 0 }}</div>
                    <a href="{{ route('surat-keluar.index') }}" class="text-blue-500 hover:underline">Lihat Surat Keluar</a>
                </div>
                <div class="p-4 bg-white rounded shadow">
                    <div class="font-semibold">Disposisi</div>
                    <div class="text-2xl mt-2 mb-2">{{ $disposisiCount ?? 0 }}</div>
                    <a href="{{ route('disposisi.index') }}" class="text-blue-500 hover:underline">Lihat Disposisi</a>
                </div>
            </div>
            {{-- Bisa tambah shortcut menu lain di sini --}}
        </div>
    </div>
</x-app-layout>
