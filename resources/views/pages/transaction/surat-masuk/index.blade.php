@extends('layouts.main')
@section('content')
    <h4>Daftar Surat Masuk</h4>
    <a href="{{ route('surat-masuk.create') }}" class="btn btn-primary">Tambah Surat Masuk</a>
    <table class="table">
        <thead>...</thead>
        <tbody>
        @foreach($suratMasuk as $surat)
            <tr>
                <td>{{ $surat->nomor_surat }}</td>
                <td>{{ $surat->tanggal_surat }}</td>
                <td>...</td>
                <td>
                    <a href="{{ route('surat-masuk.show', $surat->id) }}">Detail</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
