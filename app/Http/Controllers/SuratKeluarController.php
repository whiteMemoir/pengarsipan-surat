<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['suratKeluar'] = SuratKeluar::with(['knowUser', 'fromUser'])
            ->where('mengetahui', Auth::user()->id)
            ->orWhere('dibuat_oleh', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $data['users'] = User::where('level_user', '!=', 'super_admin')->get();

        return view('pages.surat-keluar.index', $data);
    }

    public function disposisi($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);

        $suratKeluar->status = 'dibaca';
        $suratKeluar->save();

        $suratKeluar = $suratKeluar->load(['knowUser', 'fromUser']);

        return view('pages.surat-keluar.disposisi', compact('suratKeluar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // lihat halaman 59 dokumen lebih jelas
        try {
            $suratKeluar = new SuratKeluar;
            $suratKeluar->mengetahui = $request->input('mengetahui');
            $suratKeluar->dibuat_oleh = Auth::user()->id;
            $suratKeluar->no_surat = $this->generateNoSurat();
            $suratKeluar->tanggal = $request->input('tanggal');
            $suratKeluar->perihal = $request->input('perihal');
            $suratKeluar->penerima = $request->input('penerima');
            $suratKeluar->alamat_penerima = $request->input('alamat_penerima');
            $suratKeluar->file_surat = $this->getPathFileSurat($request);
            $suratKeluar->status = 'baru';
            $suratKeluar->save();

            return response()->json([
                'status' => 'success',
                'messag' => 'Berhasil menyimpan data'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $suratKeluar = SuratKeluar::findOrFail($id);
            $suratKeluar->kepada = $request->input('kepada');
            $suratKeluar->dibuat_oleh = Auth::user()->id;
            $suratKeluar->no_surat = $this->generateNoSurat();
            $suratKeluar->tanggal = $request->input('tanggal');
            $suratKeluar->perihal = $request->input('perihal');
            $suratKeluar->pengirim = $request->input('pengirim');
            $suratKeluar->alamat_pengirim = $request->input('alamat_pengirim');
            $suratKeluar->file_surat = $this->getPathFileSurat($request);
            $suratKeluar->status = $request->input('status');
            $suratKeluar->waktu_dibuat = now();
            $suratKeluar->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menyimpan data'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = SuratKeluar::findOrFail($id);

            if ($user->file_surat) {
                Storage::delete($user->file_surat);
            }

            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menghapus data'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data',
                'error' => $e->getMessage()
            ]);
        }
    }

    private function generateNoSurat()
    {
        $suratKeluar = SuratKeluar::latest()->first();
        $no_surat = $suratKeluar ? $suratKeluar->no_surat + 1 : 1;

        return str_pad($no_surat, 5, '0', STR_PAD_LEFT);
    }

    public function getPathFileSurat(Request $request)
    {
        if (!$request->hasFile('file_surat')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $file = $request->file('file_surat');

        // Nama file baru
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Tentukan path tujuan manual
        $destinationPath = storage_path('app/public/surat_keluar');

        // Pastikan folder ada
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Pindahkan file
        $file->move($destinationPath, $fileName);

        // Buat path relatif dan absolut
        $relativePath = 'surat_keluar/' . $fileName;
        $fullPath = $destinationPath . '/' . $fileName;

        // $data = [
        //     'originalName' => $file->getClientOriginalName(),
        //     'extension'    => $file->getClientOriginalExtension(),
        //     'generatedFileName' => $fileName,
        //     'storagePath'  => $relativePath,
        //     'fullPath'     => $fullPath,
        //     'url'          => asset('storage/' . $relativePath),
        // ];

        return $relativePath;
    }
}
