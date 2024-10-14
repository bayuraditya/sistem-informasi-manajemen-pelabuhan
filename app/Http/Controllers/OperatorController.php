<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\Passenger;
use App\Models\Route;
use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class OperatorController extends Controller
{
    public function index(){
        // dashboard
        $user = Auth::user();

        return view('operator.index',compact('user'));
    }

    public function passenger(Request $request){
        $passengerDate = $request->passengerDate;
        $today = date('Y-m-d');
        $ship = Ship::all();
        if (empty($passengerDate)) {
            $passenger = Passenger::with('ship')->whereDate('date', $today)
            ->join('ships', 'passengers.ship_id', '=', 'ships.id')
            ->select( 'courts.*', 'users.*', 'rental_sessions.*', 'transactions.*','reservations.*')
            ->select('passengers.*','ships.*')
            ->get();
            $date = $today;
        } else {
            $passenger = Passenger::with('ship')->whereDate('date', $passengerDate)
            ->join('ships', 'passengers.ship_id', '=', 'ships.id')
            ->select( 'courts.*', 'users.*', 'rental_sessions.*', 'transactions.*','reservations.*')
            ->select('passengers.*','ships.*')
            ->get();
            $date = $passengerDate;
        }
        $user = Auth::user();
        return view('operator.passenger', compact('passenger','user','date','ship'));
    }

    public function storePassenger(Request $request){
        $passenger = new Passenger();
        $passenger->date = $request->date;
        $passenger->ship_id = $request->selectShip;
        $passenger->departing_passenger = $request->departingPassenger;
        $passenger->arrival_passenger = $request->arrivalPassenger;
        // dd($passenger);       
        $passenger->save();
        return redirect()->route('operator.passenger.index')
                         ->with('success', 'passenger data created successfully');
    }
    public function editPassenger(){}
    public function updatePassenger(){}
    public function destroyPassenger(){}

    public function ship(){
        $user = Auth::user();
        $operator = Operator::all();
        $route = Route::all();
        // $ship = Ship::with('operator','route')
        // ->join('operator','ships.operator_id','=','operators.id')
        // ->join('route','ship.departure_route_id','=','routes.id')
        // ->join('route','ship.arrival_route_id','=','routes.id')
        // ->get();

        $ship = Ship::with('operator', 'departureRoute', 'arrivalRoute')  // Sesuaikan relasi jika ada
        ->join('operators', 'ships.operator_id', '=', 'operators.id')
        ->join('routes as departure_route', 'ships.departure_route_id', '=', 'departure_route.id')  // Alias untuk rute keberangkatan
        ->join('routes as arrival_route', 'ships.arrival_route_id', '=', 'arrival_route.id')  // Alias untuk rute kedatangan
        ->get();
        dd($ship);
        // $reservations = Reservation::with('court', 'user', 'rentalSession', 'transactions')
        // ->join('courts', 'reservations.court_id', '=', 'courts.id')
        // ->join('users', 'reservations.user_id', '=', 'users.id')
        // ->join('rental_sessions', 'reservations.rental_session_id', '=', 'rental_sessions.id')
        // ->join('reservation_transaction', 'reservations.id', '=', 'reservation_transaction.reservation_id')
        // ->join('transactions', 'reservation_transaction.transaction_id', '=', 'transactions.id')
        // ->select( 'courts.*', 'users.*', 'rental_sessions.*', 'transactions.*','reservations.*')
        // ->selectRaw('reservations.id AS reservation_id, courts.id AS court_id, users.id AS user_id, rental_sessions.id AS rental_session_id, transactions.id AS transaction_id')    
        // ->where('users.id', $user->id)
        // ->orderBy('date', 'desc') 
        // ->get();
        return view('operator.ship.index',compact('route','operator','user'));
    }
    public function storeShip(){}
    public function editShip(){}
    public function updateShip(){}
    public function destroyShip(){}

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
