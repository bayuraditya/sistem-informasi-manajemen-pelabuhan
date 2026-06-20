<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Retribution;
use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerController extends Controller
{
    public function passenger(Request $request){
        // $dates = '2024-10-21';
        // $monthName = date('d F Y', strtotime($dates)); // Atau gunakan array untuk bahasa Indonesia
        // dd($monthName);

        $passengerDate = $request->passengerDate;
        $today = date('Y-m-d');
        $ship = Ship::all();
        if (empty($passengerDate)) {
            $passenger = Passenger::with(['ship.arrivalRoute','ship.departureRoute','passengerUser','retributionUser'])->get();

            // $passenger = Passenger::join('ships', 'passengers.ship_id', '=', 'ships.id')
            // ->join('routes AS departure_routes', 'ships.departure_route_id', '=', 'departure_routes.id')
            // ->join('routes AS arrival_routes', 'ships.arrival_route_id', '=', 'arrival_routes.id')
            // ->join('users', 'passengers.user_passenger_id', '=', 'users.id')
            // ->select('*',// Ambil semua kolom dari tabel passengers
            //          'passengers.id AS id',
            //          'ships.id AS ship_id',
            //          'ships.name AS ship_name',
            //          'departure_routes.route AS departure_route',
            //          'arrival_routes.route AS arrival_route',
            //          'users.name AS user_name',
            //          'users.id AS user_id'
            //          ) ->distinct()
            // ->get();
            $date ='';
        } else {
            $date = $passengerDate;
            $passenger = Passenger::with(['ship.arrivalRoute','ship.departureRoute','passengerUser','retributionUser'])
            ->whereDate('passengers.date', '=', $date) // Menambahkan where date
            ->get();
            // $passenger = Passenger::join('ships', 'passengers.ship_id', '=', 'ships.id')
            // ->join('routes AS departure_routes', 'ships.departure_route_id', '=', 'departure_routes.id')
            // ->join('routes AS arrival_routes', 'ships.arrival_route_id', '=', 'arrival_routes.id')
            // ->join('operators', 'ships.operator_id', '=', 'operators.id')
            // ->join('users', 'passengers.user_passenger_id', '=', 'users.id')
            // ->select('*',// Ambil semua kolom dari tabel passengers
            // 'passengers.id AS id',
            // 'ships.id AS ship_id',
            // 'ships.name AS ship_name',
            // 'departure_routes.route AS departure_route',
            // 'arrival_routes.route AS arrival_route',
            // 'operators.name AS operator_name',
            // 'users.name AS user_name',
            // 'users.id AS user_id'
            // )
            // ->whereDate('passengers.date', $date)
            // ->get();
            // dd($date);
        }
        $user = Auth::user();
        // dd($passenger[1]);
        return view('master.passenger.index', compact('passenger','user','date','ship'));
    }
    public function exportPassenger(Request $request){

        // $dates = '2024-10-21';
        // $monthName = date('d F Y', strtotime($dates)); // Atau gunakan array untuk bahasa Indonesia
        // dd($monthName);

        $passengerDate = $request->printPassengerDate;
        $today = date('Y-m-d');
        $ship = Ship::all();
        if (empty($passengerDate)) {
            $passenger = Passenger::with(['ship.arrivalRoute','ship.departureRoute','passengerUser','retributionUser'])->get();
            $totalDeparturePassengers = $passenger->sum('departure_passenger');
            $totalDeparturePassengerRetribution = $passenger->sum('departure_passenger_retribution');
            $totalRetribution = $passenger->sum('retribution');
            $totalArrivalPassengers = $passenger->sum('arrival_passenger');
            // $passenger = Passenger::join('ships', 'passengers.ship_id', '=', 'ships.id')
            // ->join('routes AS departure_routes', 'ships.departure_route_id', '=', 'departure_routes.id')
            // ->join('routes AS arrival_routes', 'ships.arrival_route_id', '=', 'arrival_routes.id')
            // ->join('users', 'passengers.user_passenger_id', '=', 'users.id')
            // ->select('*',// Ambil semua kolom dari tabel passengers
            //          'passengers.id AS id',
            //          'ships.id AS ship_id',
            //          'ships.name AS ship_name',
            //          'departure_routes.route AS departure_route',
            //          'arrival_routes.route AS arrival_route',
            //          'users.name AS user_name',
            //          'users.id AS user_id'
            //          ) ->distinct()
            // ->get();
            $date ='';
        } else {
            $date = $passengerDate;
            $passenger = Passenger::with(['ship.arrivalRoute','ship.departureRoute','passengerUser','retributionUser'])
            ->whereDate('passengers.date', '=', $date) // Menambahkan where date
            ->get();
            $totalDeparturePassengers = $passenger->sum('departure_passenger');
            $totalDeparturePassengerRetribution = $passenger->sum('departure_passenger_retribution');
            $totalRetribution = $passenger->sum('retribution');
            $totalArrivalPassengers = $passenger->sum('arrival_passenger');
            // $passenger = Passenger::join('ships', 'passengers.ship_id', '=', 'ships.id')
            // ->join('routes AS departure_routes', 'ships.departure_route_id', '=', 'departure_routes.id')
            // ->join('routes AS arrival_routes', 'ships.arrival_route_id', '=', 'arrival_routes.id')
            // ->join('operators', 'ships.operator_id', '=', 'operators.id')
            // ->join('users', 'passengers.user_passenger_id', '=', 'users.id')
            // ->select('*',// Ambil semua kolom dari tabel passengers
            // 'passengers.id AS id',
            // 'ships.id AS ship_id',
            // 'ships.name AS ship_name',
            // 'departure_routes.route AS departure_route',
            // 'arrival_routes.route AS arrival_route',
            // 'operators.name AS operator_name',
            // 'users.name AS user_name',
            // 'users.id AS user_id'
            // )
            // ->whereDate('passengers.date', $date)
            // ->get();
            // dd($date);
        }
        $user = Auth::user();


        // dd($tot);
        // total passenger departure
        // total passenger departure retribusi
        // retribusi
        // total passenger arrival

        return view('master.passenger.export', compact('passenger','user','date','ship','totalDeparturePassengers','totalDeparturePassengerRetribution','totalRetribution','totalArrivalPassengers'));
    }
    public function storePassenger(Request $request){
        $passenger = new Passenger();
        $passenger->date = $request->date;
        $passenger->ship_id = $request->ship;
        $passenger->departure_passenger = $request->departurePassenger;
        $passenger->retribution = $request->retribution;
        $passenger->arrival_passenger = $request->arrivalPassenger;
        $passenger->user_passenger_id = Auth::user()->id;
        $passenger->save();

        $date = $passenger->date;
        $dateParts = explode('-', $date);

        // Menggabungkan hanya tahun dan bulan
        $yearMonth = $dateParts[0] . '-' . $dateParts[1];
        // $retributionId = Retribution::where('month',$yearMonth)->get()->first()->id;
        $retributionId = Retribution::where('month', $yearMonth)->get()->first()?->id;
        // dd($retributionId);
        if($retributionId != null){

            $retribution = Retribution::find($retributionId);
            // Menentukan tanggal awal
            $startDate = "$yearMonth-01"; // Hari pertama bulan
            // Menentukan tanggal akhir (hari terakhir bulan)
            $endDate = date("Y-m-t", strtotime($startDate)); // Menggunakan strtotime untuk mendapatkan hari terakhir bulan
            $totalRetribution = Passenger::whereBetween('date', [$startDate, $endDate])->sum('retribution');
            $retribution->total = $totalRetribution;
            $retribution->save();
        }
        return redirect()->route('master.passenger.index')->with('success', 'passenger data created successfully');
    }
    public function editPassenger($id){

        $passenger = Passenger::find($id);
        $ship = Ship::all();
        $user = Auth::user();
        // dd($ship);
        $route = \App\Models\Route::all();
        $operator = \App\Models\Operator::all();
        // dd($passenger);
        return view('master.passenger.edit', compact('ship','user','route','operator','passenger'));
    }
    public function updatePassenger($id,Request $request){
        $passenger = Passenger::findOrFail($id);
        $passenger->date = $request->date;
        $passenger->ship_id = $request->ship;
        $passenger->departure_passenger = $request->departurePassenger;
        // $passenger->retribution = $request->retribution;
        $passenger->arrival_passenger = $request->arrivalPassenger;
        // dd($passenger);
        $passenger->user_passenger_id = Auth::user()->id;

        $passenger->save();
        $date = $passenger->date;
        $dateParts = explode('-', $date);

        // Menggabungkan hanya tahun dan bulan
        $yearMonth = $dateParts[0] . '-' . $dateParts[1];
        $retributionId = Retribution::where('month',$yearMonth)->get()->first()?->id;
        $retribution = Retribution::find($retributionId);
        // Menentukan tanggal awal
        $startDate = "$yearMonth-01"; // Hari pertama bulan
        // Menentukan tanggal akhir (hari terakhir bulan)
        $endDate = date("Y-m-t", strtotime($startDate)); // Menggunakan strtotime untuk mendapatkan hari terakhir bulan
        $totalRetribution = Passenger::whereBetween('date', [$startDate, $endDate])->sum('retribution');
        if($totalRetribution != null && $retribution != null){

            $retribution->total = $totalRetribution;
            $retribution->save();
        }

        return redirect()->route('master.passenger.index')
                         ->with('success', 'Passenger updated successfully');
    }
    public function destroyPassenger($id){
        $passenger = Passenger::findOrFail($id);
        $passenger->delete();
        return redirect()->route('master.passenger.index')
        ->with('success', 'Passenger deleted successfully');
    }
}