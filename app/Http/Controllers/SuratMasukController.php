<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratMasuk = SuratMasuk::with(['toUser', 'fromUser']);

        if (Auth::user()->level_user == 'kepala_bagian')
        {
            $suratMasuk->where('kepada', Auth::user()->id);
        }
        else
        {
            $suratMasuk->where('dibuat_oleh', Auth::user()->id);
        }

        $data['suratMasuk'] = $suratMasuk->orderBy('created_at', 'desc')->get();
        $data['users'] = User::where('level_user', '!=', 'super_admin')->get();

        return view('pages.surat-masuk.index', $data);
    }

    public function disposisi($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);

        $suratMasuk->status = 'dibaca';
        $suratMasuk->save();

        $suratMasuk = $suratMasuk->load(['toUser', 'fromUser']);

        return view('pages.surat-masuk.disposisi', compact('suratMasuk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $suratMasuk = new SuratMasuk;
            $suratMasuk->kepada = $request->input('kepada');
            $suratMasuk->dibuat_oleh = Auth::user()->id;
            $suratMasuk->no_surat = $this->generateNoSurat();
            $suratMasuk->tanggal = $request->input('tanggal');
            $suratMasuk->perihal = $request->input('perihal');
            $suratMasuk->pengirim = $request->input('pengirim');
            $suratMasuk->alamat_pengirim = $request->input('alamat_pengirim');
            $suratMasuk->file_surat = $this->getPathFileSurat($request);
            $suratMasuk->status = 'baru';
            $suratMasuk->save();

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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = SuratMasuk::findOrFail($id);

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
        $suratMasuk = SuratMasuk::latest()->first();
        $no_surat = $suratMasuk ? $suratMasuk->no_surat + 1 : 1;

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
        $destinationPath = storage_path('app/public/surat_masuk');

        // Pastikan folder ada
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Pindahkan file
        $file->move($destinationPath, $fileName);

        // Buat path relatif dan absolut
        $relativePath = 'surat_masuk/' . $fileName;
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
