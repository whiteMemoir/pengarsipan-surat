@extends('layouts.template')

@section('content-app')
    <div class="row">
        <div class="col-12">
            <h4><i class="fa fa-home"></i> Beranda</h4>
        </div>
    </div>
    <div id="originalDashboardContainer">
        <div class="row justify-content-center text-center mb-5">

            <div class="col-md-3 col-6 mb-3">
                <a href="{{ url('surat-masuk') }}" class="btn btn-outline-dark w-100 py-4">
                    <div class="h1 fw-bold">{{ $suratMasukCount }}</div>
                    <div class="text-uppercase">Surat Masuk</div>
                </a>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <a href="{{ url('surat-keluar') }}" class="btn btn-outline-dark w-100 py-4">
                    <div class="h1 fw-bold">{{ $suratKeluarCount }}</div>
                    <div class="text-uppercase">Surat Keluar</div>
                </a>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <a href="{{ url('surat-masuk') }}" class="btn btn-outline-dark w-100 py-4">
                    <div class="h1 fw-bold">{{ $userCount }}</div>
                    <div class="text-uppercase">User</div>
                </a>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <a href="{{ url('laporan') }}" class="btn btn-outline-dark w-100 py-4">
                    <div class="text-uppercase h1 fw-bold" style="padding: 10px 0px">Laporan</div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center my-5">
                <h1 class="fw-bold text-uppercase">
                    Sistem Pengarsipan<br>
                    Surat Menyurat
                </h1>
            </div>
        </div>


        <div class="row">
            <div class="col-12 text-center mt-5">
                <h5 class="text-uppercase h2 fw-bold">
                    Selamat Datang {{ auth()->user()->nama }}
                </h5>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Chart.js CDN -->
    <script src="{{ asset('theme/js') }}/chart.js"></script>
@endsection
