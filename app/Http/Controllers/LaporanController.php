<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tipe = $request->get('tipe');
        $tanggalMulai = $request->get('tanggal_mulai');
        $tanggalSelesai = $request->get('tanggal_selesai');

        if ($tipe == 'masuk') {
            $query = SuratMasuk::query();
        } elseif ($tipe == 'keluar') {
            $query = SuratKeluar::query();
        } else {
            // jika tidak pilih tipe, kosongkan data
            $data['surat'] = collect();
            return view('pages.laporan.index', $data);
        }

        // filter range tanggal (opsional)
        if ($tanggalMulai && $tanggalSelesai) {
            $query->whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai]);
        }

        // group by tanggal dan status, hitung total
        $data['surat'] = $query
            ->selectRaw('tanggal, status, COUNT(*) as total')
            ->groupBy('tanggal', 'status')
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('pages.laporan.index', $data);
    }

    public function print(Request $request)
    {
        $tipe = $request->get('tipe');
        $tanggalMulai = $request->get('tanggal_mulai');
        $tanggalSelesai = $request->get('tanggal_selesai');

        if ($tipe == 'masuk') {
            $query = SuratMasuk::query();
        } elseif ($tipe == 'keluar') {
            $query = SuratKeluar::query();
        } else {
            // jika tidak pilih tipe, kosongkan data
            $surat = collect();
            $pdf = Pdf::loadView('pages.laporan.print', compact('surat'))->setPaper('a4', 'portrait');
            return $pdf->download('laporan-surat.pdf');
        }

        if ($tanggalMulai && $tanggalSelesai) {
            $query->whereBetween('tanggal', [$tanggalMulai, $tanggalSelesai]);
        }

        $surat = $query
            ->selectRaw('tanggal, status, COUNT(*) as total')
            ->groupBy('tanggal', 'status')
            ->orderBy('tanggal', 'asc')
            ->get();

        // $pdf = Pdf::loadView('pages.laporan.print', compact('surat'))->setPaper('a4', 'portrait');

        // return $pdf->download('laporan-surat.pdf');

        $pdf = Pdf::loadView('pages.laporan.print', compact('surat'))->setPaper('a4', 'portrait');

        // preview
        return $pdf->stream('laporan-surat.pdf');
    }
}
