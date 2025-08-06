@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Surat Masuk</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('surat-masuk.update', $suratMasuk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nomor_surat" class="form-label">Nomor Surat</label>
                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat"
                        value="{{ old('nomor_surat', $suratMasuk->nomor_surat) }}" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk"
                        value="{{ old('tanggal_masuk', $suratMasuk->tanggal_masuk) }}" required>
                </div>
                <div class="mb-3">
                    <label for="pengirim" class="form-label">Pengirim</label>
                    <input type="text" class="form-control" id="pengirim" name="pengirim"
                        value="{{ old('pengirim', $suratMasuk->pengirim) }}" required>
                </div>
                <div class="mb-3">
                    <label for="perihal" class="form-label">Perihal</label>
                    <input type="text" class="form-control" id="perihal" name="perihal"
                        value="{{ old('perihal', $suratMasuk->perihal) }}" required>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Lampiran Surat (PDF/JPG, opsional)</label>
                    <input type="file" class="form-control" id="file" name="file">
                    @if ($suratMasuk->file)
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $suratMasuk->file) }}" target="_blank">Lihat file lama</a>
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('surat-masuk.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
