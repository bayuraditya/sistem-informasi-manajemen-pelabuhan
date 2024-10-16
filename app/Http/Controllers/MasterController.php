<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\Passenger;
use App\Models\Route;
use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterController extends Controller
{
    public function index(){
        // dashboard
        $user = Auth::user();
        return view('master.index',compact('user'));
    }
    public function passenger(Request $request){
        $passengerDate = $request->passengerDate;
        $today = date('Y-m-d');
        $ship = Ship::all();
       
        $passenger = Passenger::join('ships', 'passengers.ship_id', '=', 'ships.id')
            ->join('routes AS departure_routes', 'ships.departure_route_id', '=', 'departure_routes.id')
            ->join('routes AS arrival_routes', 'ships.arrival_route_id', '=', 'arrival_routes.id')
            ->join('operators', 'ships.operator_id', '=', 'operators.id')
            ->select('*',// Ambil semua kolom dari tabel passengers
                     'passengers.id AS id',
                     'ships.id AS ship_id',
                     'ships.name AS ship_name',
                     'departure_routes.route AS departure_route',
                     'arrival_routes.route AS arrival_route',
                     'operators.name AS operator_name',
                     )
            ->get();
        if (empty($passengerDate)) {
            $date = $today;
        } else {
            $date = $passengerDate;
        }
      
        $user = Auth::user();
        // dd($passenger);
        
        return view('master.passenger.index', compact('passenger','user','date','ship'));
    }

    public function storePassenger(Request $request){
        $passenger = new Passenger();
        $passenger->date = $request->date;
        $passenger->ship_id = $request->selectShip;
        $passenger->departing_passenger = $request->departingPassenger;
        $passenger->arrival_passenger = $request->arrivalPassenger;
        // dd($passenger);       
        $passenger->save();
        return redirect()->route('master.passenger.index')
                         ->with('success', 'passenger data created successfully');
    }
    public function editPassenger($id){

    }
    public function updatePassenger(){}
    public function destroyPassenger($id){
        $passenger = Passenger::findOrFail($id);
        $passenger->delete();
        return redirect()->route('master.passenger.index')
        ->with('success', 'Passenger deleted successfully');
    }

    public function ship(){
        $user = Auth::user();
        $operator = Operator::all();
        $route = Route::all();
    
        $ship = Ship::with('operator', 'departureRoute','arrivalRoute')  // Sesuaikan relasi jika ada
        ->join('operators', 'ships.operator_id', '=', 'operators.id')
        ->join('routes as departure_route', 'ships.departure_route_id', '=', 'departure_route.id')  // Alias untuk rute keberangkatan
        ->join('routes as arrival_route', 'ships.arrival_route_id', '=', 'arrival_route.id')  // Alias untuk rute kedatangan
        ->select('ships.*','operators.*','departure_route.*','arrival_route.*')
        ->selectRaw('ships.id AS ship_id, ships.name AS ship_name, operators.id AS operator_id, operators.name AS operator_name, departure_route.route AS departure_route, arrival_route.route AS arrival_route')
        ->get();
        // dd($ship);
        return view('master.ship.index',compact('route','operator','user','ship'));
    }
    public function storeShip(Request $request){
        
        $ship = new Ship();
        $ship->name = $request->name;
        $ship->departure_route_id = $request->departureRoute;
        $ship->departure_time = $request->departureTime;
        $ship->arrival_route_id = $request->arrivalRoute;
        $ship->arrival_time = $request->arrivalTime;
        $ship->type = $request->type;
        $ship->operator_id = $request->operator;
        $ship->save();
        
        return redirect()->route('master.ship.index')
                         ->with('success', 'Ship created successfully');
    }
   
    public function editShip($id){
        // $allCourt = Court::all();
        $ship = Ship::find($id);
        $user = Auth::user();
        // dd($ship);
        $route = Route::all();
        $operator = Operator::all();
        return view('master.ship.edit', compact('ship','user','route','operator'));
    }
    public function updateShip(Request $request, $id){
        $ship = Ship::findOrFail($id);
        $ship->name = $request->name;
        $ship->departure_route_id = $request->departureRoute;
        $ship->departure_time = $request->departureTime;
        $ship->arrival_route_id = $request->arrivalRoute;
        $ship->arrival_time = $request->arrivalTime;
        $ship->type = $request->type;
        $ship->operator_id = $request->operator;
        $ship->save();

        return redirect()->route('master.ship.index')
                         ->with('success', 'Ship updated successfully');
    }
    public function destroyShip($id){
        $ship = Ship::findOrFail($id);
        $ship->delete();
        return redirect()->route('master.ship.index')
        ->with('success', 'Ship deleted successfully');
    }

    public function operator(){}
    public function storeOperator(){}
    public function editOperator(){}
    public function updateOperator(){}
    public function deleteOperator(){}

    public function route(){}
    public function storeRoute(){}
    public function editRoute(){}
    public function updateRoute(){}
    public function deleteRoute(){}

    public function user(){}
    public function storeUser(){}
    public function editUser(){}
    public function updateUser(){}
    public function destroyUser(){}

    public function review(){
        // return view review
    }

    public function updateReview(){
        // update dari default(pending) ke aprove/declined
    }



 
}
