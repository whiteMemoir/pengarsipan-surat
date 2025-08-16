<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::where('level_user', '!=', 'super_admin')->with('bagian')->get();
        $data['bagians'] = Bagian::get();

        return view('pages.user.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
            $user = new User;
            $user->nama = $request->input('name');
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->password = bcrypt($request->input('password'));
            $user->level_user = $request->input('level_user');
            $user->id_bagian = $request->input('bagian');
            $user->status = $request->input('status');
            $user->save();

            return response()->json([
                'status' => 'success',
                'messag' => 'Berhasil menyimpan data'
            ]);
        }
        catch (Exception $e)
        {
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
        try
        {
            $user = User::findOrFail($id);
            $user->nama = $request->input('name');
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->password = bcrypt($request->input('password'));
            $user->level_user = $request->input('level_user');
            $user->id_bagian = $request->input('bagian');
            $user->status = $request->input('status');
            $user->save();

            return response()->json([
                'status' => 'success',
                'messag' => 'Berhasil menyimpan data'
            ]);
        }
        catch (Exception $e)
        {
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
        try
        {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menghapus data'
            ]);

        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data',
                'error' => $e->getMessage()
            ]);
        }
    }
}
