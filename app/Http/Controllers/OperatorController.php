<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    public function operator(){
        $user = Auth::user();
        $operator = Operator::with(['ships.departureRoute', 'ships.arrivalRoute'])  // Relasi dari Operator ke Ship, lalu ke rute keberangkatan dan kedatangan
        ->select('operators.*')  // Ambil semua kolom dari tabel operators
        ->get();
        // dd($operator[0]->ships[0]->departureRoute->route);
        return view('master.operator.index',compact('operator','user'));
    }
    public function storeOperator(Request $request){
        $operator = new Operator();
        $operator->name = $request->name;
        $operator->address = $request->address;
        $operator->website = $request->website;
        $operator->handphone_number = $request->handphone_number;
        $operator->email = $request->email;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();  // Dapatkan ekstensi file
            $image->move(public_path('images'), $imageName);  // Simpan gambar
        } else {
            $imageName = null;  // Tidak ada gambar yang di-upload
        }
        $operator->image = $imageName;
        $operator->save();

        return redirect()->route('master.operator.index')
                         ->with('success', 'Operator created successfully');
    }
    public function editOperator($id){
        $operator = Operator::find($id);
        $user = Auth::user();
        return view('master.operator.edit', compact('user','operator'));
    }


    public function updateOperator(Request $request,$id){
        $operator = Operator::findOrFail($id);
        $operator->name = $request->name;
        $operator->address = $request->address;
        $operator->website = $request->website;
        $operator->handphone_number = $request->handphone_number;
        $operator->email = $request->email;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();  // Dapatkan ekstensi file
            $image->move(public_path('images'), $imageName);  // Simpan gambar
            $operator->image = $imageName;
        }else{

        }
        $operator->save();

        return redirect()->route('master.operator.index')
                         ->with('success', 'Operator updated successfully');
    }
    public function destroyOperator($id){
        $operator = Operator::findOrFail($id);
        $operator->delete();
        return redirect()->route('master.operator.index')
        ->with('success', 'Operator deleted successfully');
    }
}