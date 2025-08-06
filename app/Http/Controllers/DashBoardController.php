<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\Disposisi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard', [
            'suratMasukCount' => SuratMasuk::count(),
            'suratKeluarCount' => SuratKeluar::count(),
            'disposisiCount'   => Disposisi::count(),
        ]);
    }
}