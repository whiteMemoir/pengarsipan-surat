@extends('layouts.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow-sm border-0" style="background: #fff; border-radius: 16px;">
            <div class="card-header bg-white border-0 pb-0">
                <h4 class="mb-0">Tambah Surat Masuk</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('surat-masuk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <!-- 3 columns: Nomor Surat | Pengirim | Nomor Agenda -->
                        <div class="col-md-4">
                            <label for="nomor_surat" class="form-label">Nomor Surat</label>
                            <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="pengirim" class="form-label">Pengirim</label>
                            <input type="text" class="form-control" id="pengirim" name="pengirim" value="{{ old('pengirim') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="nomor_agenda" class="form-label">Nomor Agenda</label>
                            <input type="text" class="form-control" id="nomor_agenda" name="nomor_agenda" value="{{ old('nomor_agenda') }}">
                        </div>
                        <!-- 2 columns: Tanggal Surat | Tanggal Diterima -->
                        <div class="col-md-6">
                            <label for="tanggal_masuk" class="form-label">Tanggal Surat</label>
                            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_diterima" class="form-label">Tanggal Diterima</label>
                            <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" value="{{ old('tanggal_diterima') }}">
                        </div>
                        <!-- 1 column: Ringkasan -->
                        <div class="col-md-12">
                            <label for="perihal" class="form-label">Ringkasan</label>
                            <textarea class="form-control" id="perihal" name="perihal" rows="2" required>{{ old('perihal') }}</textarea>
                        </div>
                        <!-- 3 columns: Kode Klasifikasi | Keterangan | Lampiran -->
                        <div class="col-md-4">
                            <label for="kode_klasifikasi" class="form-label">Kode Klasifikasi</label>
                            <select class="form-select" id="kode_klasifikasi" name="kode_klasifikasi">
                                <option value="">Pilih Klasifikasi</option>
                                <option value="Administrasi">Administrasi</option>
                                <option value="Keuangan">Keuangan</option>
                                <!-- Tambahkan opsi lain sesuai kebutuhan -->
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="file" class="form-label">Lampiran Surat (PDF/JPG, opsional)</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                    </div>
                    <div class="mt-4 text-start">
                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
