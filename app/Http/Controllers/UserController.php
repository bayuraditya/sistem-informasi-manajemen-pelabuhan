<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function users(){
        $user = Auth::user();
        $allUser = User::all();
        return view('master.user.index',compact('allUser','user'));
    }
    public function storeUser(Request $request){

        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make( $request->password);
        $user->email =  $request->email;
        $user->role =  $request->role;
        $user->sector =  $request->sector;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();  // Dapatkan ekstensi file
            $image->move(public_path('images'), $imageName);  // Simpan gambar
        } else {
            $imageName = null;  // Tidak ada gambar yang di-upload
        }
        $user->image = $imageName;
        $existingEmail = User::where('email', $request->email)->first();
        $existingName = User::where('name', $request->name)->first();
        if ($existingEmail||$existingName) {
            // Jika user sudah ada, kembalikan pesan error
            return redirect()->back()->with('error', 'Email or Name already exists!');
        }else{
            $user->save();
            return redirect()->route('master.user.index')
            ->with('success', 'Users created successfully');
        }

    }
    public function editUser(Request $request,$id){
        $editUser = User::find($id);
        $user = Auth::user();
        return view('master.user.edit', compact('user','editUser'));
    }
    public function updateUser(Request $request,$id){
        $updateUser = User::findOrFail($id);
        $updateUser->name = $request->name;
        $updateUser->password = Hash::make( $request->password);
        $updateUser->email =  $request->email;
        $updateUser->role =  $request->role;
        $updateUser->sector =  $request->sector;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();  // Dapatkan ekstensi file
            $image->move(public_path('images'), $imageName);  // Simpan gambar
            $updateUser->image = $imageName;
        } else {
            // $imageName = null;  // Tidak ada gambar yang di-upload
        }
        $updateUser->save();


        return redirect()->route('master.user.index')
                         ->with('success', 'User updated successfully');
    }
    public function destroyUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('master.user.index')
        ->with('success', 'User deleted successfully');
    }
}