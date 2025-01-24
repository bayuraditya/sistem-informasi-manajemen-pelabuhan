<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $user = Auth::user();

        return view('admin.index', compact('user'));
    }

    public function edit($id){
        $allCourt = Pengaduan::all();
        $court = Pengaduan::find($id);
        $user = Auth::user();
        return view('admin.courts.edit', compact('court','allCourt','user'));
    }
    public function update(Request $request, $id){
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->nik = $request->nik;
        $pengaduan->nama = $request->nama;
        $pengaduan->no_hp = $request->no_hp;
        $pengaduan->alamat = $request->email;
        $pengaduan->judul = $request->judul;
        $pengaduan->deskripsi = $request->deskripsi;
        $pengaduan->file = $request->file;
        $pengaduan->status = $request->status;
        $pengaduan->status_keaktifan = $request->status_keaktifan;
        $pengaduan->respon_admin = $request->respon_admin;
        $pengaduan->respon_pengadu = $request->respon_pengadu;
        $pengaduan->save();
        return redirect()->route('pengaduan.index')
                         ->with('success', 'Pengaduan updated successfully');
    }

}
