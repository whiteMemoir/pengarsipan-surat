<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // check current_password dan password di user apakah sama
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            // password salah
            return back()->with('warning', 'Password salah');
        }

        try {
            $user = User::find(Auth::user()->id);
            $user->nama = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            if ($request->new_password != '') {
                $user->password = Hash::make($request->new_password);
            }

            $user->save();

            return Redirect::route('profile.edit')->with('success', 'Berhasil menyimpan data');
        } catch (Exception $e) {
            return Redirect::route('profile.edit')->with('error', 'Gagal menyimpan data');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
