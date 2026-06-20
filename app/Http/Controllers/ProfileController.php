<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function editProfile(){
        $user = Auth::user();
        return view('master.profile.edit',compact('user'));
    }

    public function updateProfile(Request $request, $id){
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->sector = $request->sector;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();  // Dapatkan ekstensi file
            $image->move(public_path('images'), $imageName);  // Simpan gambar
            $user->image = $imageName;
        } else {
            // $imageName = null;  // Tidak ada gambar yang di-upload
        }
        $user->save();
        if ($user->save()) {
            return redirect()->route('master.profile.edit')->with('success', 'User updated successfully');
        } else {
            return redirect()->route('master.profile.edit')->with('error', 'Failed to update user');
        }
    }
    public function showChangePasswordForm(){
        $user = Auth::user();
        return view('master.profile.change-password',compact('user'))->with('success', 'Profile updated successfully');
    }
    public function changePassword(Request $request,$id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password|confirmed',
        ], [
            'new_password.different' => 'Kata sandi baru harus berbeda dengan kata sandi saat ini.',
            'new_password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);
        // Dapatkan pengguna yang sedang login
        $user = User::findOrFail($id);
        // Cek apakah password saat ini cocok dengan yang diinputkan
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            // Kembali ke halaman sebelumnya dengan pesan error
            return redirect()->back()->with('error', 'Kata sandi saat ini salah.');
        }
        // Update password pengguna dengan password baru
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('master.profile.showChangePasswordForm')->with('success', 'Kata sandi berhasil diubah.');
    }
}