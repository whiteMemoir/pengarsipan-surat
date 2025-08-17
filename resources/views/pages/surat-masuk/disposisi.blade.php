@extends('layouts.template')

@section('content-app')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h4 class="mb-3"><i class="fa fa-paper-plane"></i> Disposisi Surat Masuk</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ url('surat-masuk') }}" class="btn btn-danger">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <form method="POST" action="{{ url('disposisi/store?surat=masuk') }}">
                                @csrf
                                <input type="hidden" name="id_surat" value="{{ $suratMasuk->id }}">
                                <div class="form row mb-3">
                                    <div class="col-12 text-center">
                                        <a href="{{ asset($suratMasuk->file_surat) }}" class="btn btn-primary btn-sm" target="_blank">Link Lampiran</a>
                                    </div>
                                </div>
                                <div class="form row mb-3">
                                    <label class="col-md-3 text-right" for="kepada">Kepada</label>
                                    <div class="form col-md-9">
                                        <input type="text" value="{{ $suratMasuk->toUser->nama ?? '' }}"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form row mb-3">
                                    <label class="col-md-3 text-right" for="kepada">Dari</label>
                                    <div class="form col-md-9">
                                        <input type="text" value="{{ $suratMasuk->fromUser->nama ?? '' }}"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form row mb-3">
                                    <label class="col-md-3 text-right" for="isi_disposisi">Isi Disposisi</label>
                                    <div class="form col-md-9">
                                        <textarea name="isi_disposisi" id="isi_disposisi" class="form-control" required rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="form row mb-3">
                                    <label class="col-md-3 text-right" for="status_disposisi">Status Disposisi</label>
                                    <div class="form col-md-9">
                                        <select name="status_disposisi" id="status_disposisi" class="form-control" required>
                                            <option value="belum">Belum</option>
                                            <option value="sudah">Sudah</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="form row mb-3">
                                    <label class="col-md-3 text-right" for="waktu_disposisi">Waktu Disposisi</label>
                                    <div class="form col-md-9">
                                        <input type="time" name="waktu_disposisi" id="waktu_disposisi"
                                            class="form-control" value="{{ date('H:i') }}" required>
                                    </div>
                                </div> --}}
                                {{-- <div class="form row mb-3">
                                    <label class="col-md-3 text-right" for="waktu_dibaca">Waktu Dibaca</label>
                                    <div class="form col-md-9">
                                        <input type="time" name="waktu_dibaca" id="waktu_dibaca" class="form-control" value="{{ date('H:i') }}" required>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-send"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script></script>
@endsection
