@extends('layouts.main')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold">Dashboard Pengarsipan Surat</h1>
        <div class="text-gray-600 mt-1">
            Selamat datang, {{ Auth::user()->nama ?? Auth::user()->name }}!
            <span class="text-sm">Role: {{ Auth::user()->level_user ?? '-' }}</span>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-dashboard-card-simple
            title="Surat Masuk"
            :count="$suratMasukCount"
            url="{{ route('surat-masuk.index') }}"
        />
        <x-dashboard-card-simple
            title="Surat Keluar"
            :count="$suratKeluarCount"
            url="{{ route('surat-keluar.index') }}"
        />
        <x-dashboard-card-simple
            title="Disposisi"
            :count="$disposisiCount"
            url="{{ route('disposisi.index') }}"
        />
    </div>
@endsection
