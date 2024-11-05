<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\Review;
use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function index(){
        $user = Auth::user();
        $review = Review::where('status', 'approve')->take(3)->get();
        $operator = Operator::take(4)->get();
        
        $ship = Ship::with('operator', 'departureRoute','arrivalRoute','shipImages')  // Sesuaikan relasi jika ada
        // ->join('operators', 'ships.operator_id', '=', 'operators.id')
        // ->join('routes as departure_route', 'ships.departure_route_id', '=', 'departure_route.id')  // Alias untuk rute keberangkatan
        // ->join('routes as arrival_route', 'ships.arrival_route_id', '=', 'arrival_route.id')  // Alias untuk rute kedatangan
        // ->select('ships.*','operators.*','departure_route.*','arrival_route.*')
        // ->selectRaw('ships.id AS ship_id, ships.name AS ship_name, operators.id AS operator_id, operators.name AS operator_name, departure_route.route AS departure_route, arrival_route.route AS arrival_route ,  operators.image as operator_image ')
        ->take(3)
        ->get();
        // dd($ship[0]->operator->name);
        return view('guest.index',compact('user','review','ship','operator'));
    }
    public function storeReview(Request $request){
        $user = Auth::user();
        
        $review = new Review();
        $review->name = $request->name;
        $review->email = $request->email;
        $review->review = $request->review;
        $review->point = $request->point;
        $review->save();
        
        return redirect()->route('home')
                         ->with('success', 'Review added successfully');

    }

    public function boats(){
        $user = Auth::user();

        $boat = Ship::with('operator', 'departureRoute','arrivalRoute','shipImages')  // Sesuaikan relasi jika ada
        // ->join('operators', 'ships.operator_id', '=', 'operators.id')
        // ->join('routes as departure_route', 'ships.departure_route_id', '=', 'departure_route.id')  // Alias untuk rute keberangkatan
        // ->join('routes as arrival_route', 'ships.arrival_route_id', '=', 'arrival_route.id')  // Alias untuk rute kedatangan
        // ->select('ships.*','operators.*','departure_route.*','arrival_route.*')
        // ->selectRaw('ships.id AS ship_id, ships.name AS ship_name, operators.id AS operator_id, operators.name AS operator_name, departure_route.route AS departure_route, arrival_route.route AS arrival_route , operators.image as operator_image ')
        ->get();
        // dd($boat->operator);
        return view('guest.boats',compact('user','boat'));

    }

    public function reviews(){
        $user = Auth::user();
        $review = Review::where('status','=','approve')->get();
        return view('guest.reviews',compact('user','review'));

    }
    public function operators(){
        $user = Auth::user();
        $operator = Operator::with(['ships.departureRoute', 'ships.arrivalRoute'])  // Relasi dari Operator ke Ship, lalu ke rute keberangkatan dan kedatangan
        ->select('operators.*')  // Ambil semua kolom dari tabel operators
        ->get();
        return view('guest.operators',compact('user','operator'));
    }
    
}
