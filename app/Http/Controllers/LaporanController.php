<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

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
}
