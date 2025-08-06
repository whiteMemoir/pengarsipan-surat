<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{

    // Menampilkan daftar surat masuk
    public function index()
    {
        $suratMasuk = SuratMasuk::all();
        return view('pages.transaction.surat-masuk.index', compact('suratMasuk'));
    }

    // Form tambah surat masuk
    public function create()
    {
        return view('pages.transaction.surat-masuk.create');
    }

    // Form edit surat masuk
    public function edit($id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);
        return view('pages.transaction.surat-masuk.edit', compact('suratMasuk'));
    }
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
