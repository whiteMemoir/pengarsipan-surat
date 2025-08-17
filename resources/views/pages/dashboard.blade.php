@extends('layouts.template')

@section('content-app')
    <div class="row">
        <div class="col-12">
            <h4><i class="fa fa-home"></i> Dashboard</h4>
        </div>
    </div>
    <div id="originalDashboardContainer">
        <div class="row" id="contentBox">
            <div class="col-md-3 col-sm-6">
                <div class="card gradient-1 bg-info shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-uppercase text-white">
                            <i class="fa fa-envelope"></i> SURAT MASUK
                        </h6>
                        <h2 class="text-white">{{ $suratMasukCount }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card gradient-2 bg-success shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-uppercase text-white">
                            <i class="fa fa-envelope-open"></i> SURAT KELUAR
                        </h6>
                        <h2 class="text-white">{{ $suratKeluarCount }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card gradient-3 bg-success shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-uppercase text-white">
                            <i class="fa fa-paper-plane"></i> DISPOSISI
                        </h6>
                        <h2 class="text-white">{{ $disposisiCount }}</h2>
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
