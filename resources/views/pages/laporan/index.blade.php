@extends('layouts.template')

@section('content-app')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h4 class="mb-3"><i class="fa fa-file"></i> Laporan Surat {{ request('tipe') == 'masuk' ? 'Masuk' : 'Keluar' }}</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <form action="{{ url()->current() }}" method="GET" class="form-inline">
                        <select name="tipe" class="form-control mr-2">
                            <option value="" disabled selected>Pilih Tipe Surat</option>
                            <option value="masuk" {{ request('tipe') == 'masuk' ? 'selected' : '' }}>Surat Masuk</option>
                            <option value="keluar" {{ request('tipe') == 'keluar' ? 'selected' : '' }}>Surat Keluar</option>
                        </select>

                        <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                            class="form-control mr-2">
                        <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}"
                            class="form-control mr-2">

                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fa fa-filter"></i> Filter
                        </button>

                        <a href="{{ url()->current() }}/print?tipe={{ request('tipe') }}&tanggal_mulai={{ request('tanggal_mulai') }}&tanggal_selesai={{ request('tanggal_selesai') }}" target="_blank" class="btn btn-info">
                            <i class="fa fa-print"></i> Print
                        </a>
                    </form>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-hover table-bordered bg-light" id="datatable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($surat as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->tanggal }}</td>
                                    <td>{{ strtoupper($s->status) }}</td>
                                    <td>{{ $s->total }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Data tidak tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
