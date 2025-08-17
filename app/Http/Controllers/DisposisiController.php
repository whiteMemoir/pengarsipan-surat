<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisposisiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();
            if ($request->surat == 'masuk') {
                $suratMasuk = SuratMasuk::findOrFail($request->id_surat);

                $suratMasuk = $suratMasuk->load(['toUser', 'fromUser']);

                $disposisi = new Disposisi();
                $disposisi->id_surat = $suratMasuk->id;
                $disposisi->kepada = $suratMasuk->toUser->id;
                $disposisi->oleh = $suratMasuk->fromUser->id;
                $disposisi->isi_disposisi = $request->isi_disposisi;
                $disposisi->status_disposisi = $request->status_disposisi;
                $disposisi->waktu_disposisi = now();
                $disposisi->waktu_dibaca = now();
                $disposisi->jenis_surat = 'surat_masuk';
                $disposisi->save();

                $suratMasuk->status = 'didisposisi';
                $suratMasuk->save();

                $route = 'surat-masuk.index';
            } else if ($request->surat == 'keluar') {
                $suratKeluar = SuratKeluar::findOrFail($request->id_surat);

                $suratKeluar = $suratKeluar->load(['knowUser', 'fromUser']);

                $disposisi = new Disposisi();
                $disposisi->id_surat = $suratKeluar->id;
                $disposisi->kepada = $suratKeluar->knowUser->id;
                $disposisi->oleh = $suratKeluar->fromUser->id;
                $disposisi->isi_disposisi = $request->isi_disposisi;
                $disposisi->status_disposisi = $request->status_disposisi;
                $disposisi->waktu_disposisi = now();
                $disposisi->jenis_surat = 'surat_keluar';
                $disposisi->waktu_dibaca = now();
                $disposisi->save();

                $route = 'surat-keluar.index';
            }


            DB::commit();

            return redirect()->route($route)->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal menyimpan data');
        }
    }
}
