<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('pageadmin.profil.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        $data = $request->only(['name', 'username', 'email']);

        if($request->password) {
            if($request->password != $request->confirm_password) {
                Alert::error('Error', 'Password dan konfirmasi password tidak sama');
                return back();
            }
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
        Alert::success('Success', 'Data berhasil diubah');
        return redirect()->route('profil.index');
    }
}
