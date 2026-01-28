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
                <a href="{{ url('surat-masuk') }}" class="btn gradient-1 w-100 py-4">
                    <div class="h1 font-weight-bold text-white">{{ $suratMasukCount }}</div>
                    <div class="text-uppercase">Surat Masuk</div>
                </a>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <a href="{{ url('surat-keluar') }}" class="btn gradient-2  w-100 py-4">
                    <div class="h1 font-weight-bold text-white">{{ $suratKeluarCount }}</div>
                    <div class="text-uppercase">Surat Keluar</div>
                </a>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <a href="{{ url('surat-masuk') }}" class="btn gradient-3 w-100 py-4">
                    <div class="h1 font-weight-bold text-white">{{ $userCount }}</div>
                    <div class="text-uppercase">User</div>
                </a>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <a href="{{ url('laporan') }}" class="btn gradient-4 w-100 py-4">
                    <div class="text-uppercase h1 font-weight-bold text-white" style="padding: 10px 0px">Laporan</div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center my-5">
                <h1 class="font-weight-bold text-uppercase">
                    Sistem Pengarsipan<br>
                    Surat Menyurat
                </h1>
            </div>
        </div>


        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card shadow-lg" style="background-color:#ca3e00; border-radius:12px;">
                    <div class="card-body text-center py-4">
                        <h3 class="text-white font-weight-bold text-uppercase mb-0">
                            Selamat Datang {{ auth()->user()->nama }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <!-- Chart.js CDN -->
    <script src="{{ asset('theme/js') }}/chart.js"></script>
@endsection
