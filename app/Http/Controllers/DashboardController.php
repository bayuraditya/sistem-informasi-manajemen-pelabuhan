<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Ship;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request){
        /*
        - total kapal naik dan turun : count baris passenger where departure>0 - where arrival> 0
        - total penumpang naik dan turun : sum departure passenger - arrival passenger
        - kapal naik per hari = count baris passengers where departure passengers>0 where date='' (1 baris 1 kapal)
        - kapal turun per hari = count baris passengers where arrival passengers>0 where date ='' (1 baris 1 kapal)
        - penumpang naik per hari = sum departure passenger where date =''
        - penumpang turun per hari = sum arrival passenger where date =''
        - rata rata kapal naik per hari = count all baris passenger where departurepassenger>0 dibagi total hari (date terakhir-date terlama)
        - rata rata kapal turun per hari = count all baris passenger where arrivalpassenger>0 dibagi total hari (date terakhir-date terlama)
        - rata rata penumpang naik per hari = sum departure pessanger dibagi total hari(date terakhir - date terlama)
        - rata rata penumpang turunper hari = sum arival pessanger dibagi total hari(date terakhir - date terlama)
         */
        $totalShipsDeparture = Passenger::where('departure_passenger','>',0)->count();
        $totalShipsArrival = Passenger::where('arrival_passenger','>',0)->count();
        $totalPassengersDeparture = Passenger::sum('departure_passenger');
        $totalPassengersArrival = Passenger::sum('arrival_passenger');

        $oldestDate = Passenger::min('date'); // Tanggal paling lama
        $newestDate = Passenger::max('date'); // Tanggal paling baru
        $oldestTimestamp = strtotime($oldestDate);
        $newestTimestamp = strtotime($newestDate);

        // Menghitung selisih detik dan mengonversi ke hari
        $dateDifference = (($newestTimestamp - $oldestTimestamp) / 86400)+1; // 86400 detik dalam sehari

        $averageShipsDeparture = number_format($totalShipsDeparture / $dateDifference , 2);
        $averageShipsArrival = number_format($totalShipsArrival / $dateDifference , 2) ;
        $averagePassengersDeparture = number_format($totalPassengersDeparture / $dateDifference , 2);
        $averagePassengersArrival = number_format(($totalPassengersArrival / $dateDifference ), 2) ;

        if (empty($request->departureShipsMonth)) {
            $departureShipsMonth = date('Y') . '-' .date('m');
            $departureShipsMonthText = date('F') . '-' .date('Y');
        }else{
            $departureShipsMonth = $request->departureShipsMonth;
            $departureShipsMonthString = DateTime::createFromFormat('Y-m', $departureShipsMonth);
            $departureShipsMonthText = $departureShipsMonthString->format('F-Y');
        }
        $allDepartureShips = [];
        for($i = 1; $i <= 31; $i++){
            $day = strval($i);
            $date = $departureShipsMonth . '-'."$i";
            $departureShips = Passenger::where('date', '=', $date)
            ->Where('departure_passenger', '>', 0)
            ->count();
            // dd($arrivalShips);
            $allDepartureShips[$i] = $departureShips;
        }



        if (empty($request->arrivalShipsMonth)) {
            $arrivalShipsMonth = date('Y') . '-' .date('m');
            $arrivalShipsMonthText = date('F') . '-' .date('Y');

        }else{
            $arrivalShipsMonth = $request->arrivalShipsMonth;
            $arrivalShipsMonthString = DateTime::createFromFormat('Y-m', $arrivalShipsMonth );
            $arrivalShipsMonthText =  $arrivalShipsMonthString->format('F-Y');
        }
        $allArrivalShips = [];
        for($i = 1; $i <= 31; $i++){
            $day = strval($i);
            $date = $arrivalShipsMonth . '-'."$i";
            $arrivalShips = Passenger::where('date', '=', $date)
            ->Where('arrival_passenger', '>', 0)
            ->count();
            // dd($arrivalShips);
            $allArrivalShips[$i] = $arrivalShips;
        }



        if (empty($request->departurePassengersMonth)) {
            $departurePassengersMonth = date('Y') . '-' .date('m');
            $departurePassengersMonthText = date('F') . '-' .date('Y');

        }else{
            $departurePassengersMonth = $request->departurePassengersMonth;
            $departurePassengersMonthString = DateTime::createFromFormat('Y-m',  $departurePassengersMonth);
            $departurePassengersMonthText = $departurePassengersMonthString->format('F-Y');
        }
        $allDeparturePassengers = [];
        for($i = 1; $i <= 31; $i++){
            $day = strval($i);
            $date = $departurePassengersMonth . '-'."$i";
            $departurePassengers = Passenger::where('date', '=', $date)->sum('departure_passenger');
            // dd($arrivalShips);
            $allDeparturePassengers[$i] = $departurePassengers;
        }

        $allDeparturePassengersRetribution = [];
        for($i = 1; $i <= 31; $i++){
            $day = strval($i);
            $date = $departurePassengersMonth . '-'."$i";
            $departurePassengersRetribution = Passenger::where('date', '=', $date)->sum('departure_passenger_retribution');
            // dd($arrivalShips);
            $allDeparturePassengersRetribution[$i] = $departurePassengersRetribution;
        }



        if (empty($request->arrivalPassengersMonth)) {
            $arrivalPassengersMonth = date('Y') . '-' .date('m');
            $arrivalPassengersMonthText = date('F') . '-' .date('Y');

        }else{
            $arrivalPassengersMonth = $request->arrivalPassengersMonth;
            $arrivalPassengersMonthString = DateTime::createFromFormat('Y-m' , $arrivalPassengersMonth);
            $arrivalPassengersMonthText = $arrivalPassengersMonthString->format('F-Y');
        }
        $allArrivalPassengers = [];
        for($i = 1; $i <= 31; $i++){
            $day = strval($i);
            $date = $arrivalPassengersMonth . '-'."$i";
            $arrivalPassengers = Passenger::where('date', '=', $date)->sum('arrival_passenger');
            // dd($arrivalShips);
            $allArrivalPassengers[$i] = $arrivalPassengers;
        }

        //myplot7 - chartbar 5
        $shipName = [];
        $ship = Ship::all();
        foreach($ship as $s){
            array_push($shipName, $s->name);
        }

        $ships = [];

        $totalPassengerPerShip =  Ship::leftJoin('passengers', 'ships.id', '=', 'passengers.ship_id')
        ->select('ships.id as id', 'ships.name as name', DB::raw('SUM(passengers.departure_passenger + passengers.arrival_passenger) AS totalPassenger'))
        ->groupBy('ships.id', 'ships.name')
        ->get();

        // Mengisi array dengan data dari query
        foreach ($totalPassengerPerShip as $ship) {
            $ships[] = [
                'name' => $ship->name,                // Menambahkan nama kapal
                'totalPassenger' => $ship->totalPassenger ??0// Menambahkan total penumpang
            ];
        }

        // dd($ships);



        for($i = 1; $i <= 31; $i++){
            $day = strval($i);
            $date = $arrivalPassengersMonth . '-'."$i";
            $arrivalPassengers = Passenger::where('date', '=', $date)->sum('arrival_passenger');
            // dd($arrivalShips);
            $allArrivalPassengers[$i] = $arrivalPassengers;
        }




        $totalShipsDeparture = Passenger::where('departure_passenger','>',0)->count();
        $totalShipsArrival = Passenger::where('arrival_passenger','>',0)->count();
        $totalPassengersDeparture = Passenger::sum('departure_passenger');
        $totalPassengersArrival = Passenger::sum('arrival_passenger');

        $user = Auth::user();
        return view('master.index',compact('user','averageShipsDeparture',
        'averageShipsArrival',
        'averagePassengersDeparture',
        'averagePassengersArrival' ,

        'allDepartureShips',
        'allArrivalShips',
        'allDeparturePassengers',
        'allDeparturePassengersRetribution',
        'allArrivalPassengers',

        'departurePassengersMonth',
        'arrivalPassengersMonth',
        'arrivalShipsMonth',
        'departureShipsMonth',

        'departurePassengersMonthText',
        'arrivalPassengersMonthText',
        'arrivalShipsMonthText',
        'departureShipsMonthText',

        'totalShipsDeparture',
        'totalShipsArrival',
        'totalPassengersDeparture',
        'totalPassengersArrival',
        'ships',
        'shipName'
        ));
    }
    public function exportDashboard(Request $request){
        /*
        - total kapal naik dan turun : count baris passenger where departure>0 - where arrival> 0
        - total penumpang naik dan turun : sum departure passenger - arrival passenger
        - kapal naik per hari = count baris passengers where departure passengers>0 where date='' (1 baris 1 kapal)
        - kapal turun per hari = count baris passengers where arrival passengers>0 where date ='' (1 baris 1 kapal)
        - penumpang naik per hari = sum departure passenger where date =''
        - penumpang turun per hari = sum arrival passenger where date =''
        - rata rata kapal naik per hari = count all baris passenger where departurepassenger>0 dibagi total hari (date terakhir-date terlama)
        - rata rata kapal turun per hari = count all baris passenger where arrivalpassenger>0 dibagi total hari (date terakhir-date terlama)
        - rata rata penumpang naik per hari = sum departure pessanger dibagi total hari(date terakhir - date terlama)
        - rata rata penumpang turunper hari = sum arival pessanger dibagi total hari(date terakhir - date terlama)
         */
        $totalShipsDeparture = Passenger::where('departure_passenger','>',0)->count();
        $totalShipsArrival = Passenger::where('arrival_passenger','>',0)->count();
        $totalPassengersDeparture = Passenger::sum('departure_passenger');
        $totalPassengersArrival = Passenger::sum('arrival_passenger');

        $oldestDate = Passenger::min('date'); // Tanggal paling lama
        $newestDate = Passenger::max('date'); // Tanggal paling baru
        $oldestTimestamp = strtotime($oldestDate);
        $newestTimestamp = strtotime($newestDate);

        // Menghitung selisih detik dan mengonversi ke hari
        $dateDifference = (($newestTimestamp - $oldestTimestamp) / 86400)+1; // 86400 detik dalam sehari

        $averageShipsDeparture = number_format($totalShipsDeparture / $dateDifference , 2);
        $averageShipsArrival = number_format($totalShipsArrival / $dateDifference , 2) ;
        $averagePassengersDeparture = number_format($totalPassengersDeparture / $dateDifference , 2);
        $averagePassengersArrival = number_format(($totalPassengersArrival / $dateDifference ), 2) ;

        if (empty($request->departureShipsMonth)) {
            $departureShipsMonth = date('Y') . '-' .date('m');
            $departureShipsMonthText = date('F') . '-' .date('Y');
        }else{
            $departureShipsMonth = $request->departureShipsMonth;
            $departureShipsMonthString = DateTime::createFromFormat('Y-m', $departureShipsMonth);
            $departureShipsMonthText = $departureShipsMonthString->format('F-Y');
        }
        $allDepartureShips = [];
        for($i = 1; $i <= 31; $i++){
            $day = strval($i);
            $date = $departureShipsMonth . '-'."$i";
            $departureShips = Passenger::where('date', '=', $date)
            ->Where('departure_passenger', '>', 0)
            ->count();
            // dd($arrivalShips);
            $allDepartureShips[$i] = $departureShips;
        }



        if (empty($request->arrivalShipsMonth)) {
            $arrivalShipsMonth = date('Y') . '-' .date('m');
            $arrivalShipsMonthText = date('F') . '-' .date('Y');

        }else{
            $arrivalShipsMonth = $request->arrivalShipsMonth;
            $arrivalShipsMonthString = DateTime::createFromFormat('Y-m', $arrivalShipsMonth );
            $arrivalShipsMonthText =  $arrivalShipsMonthString->format('F-Y');
        }
        $allArrivalShips = [];
        for($i = 1; $i <= 31; $i++){
            $day = strval($i);
            $date = $arrivalShipsMonth . '-'."$i";
            $arrivalShips = Passenger::where('date', '=', $date)
            ->Where('arrival_passenger', '>', 0)
            ->count();
            // dd($arrivalShips);
            $allArrivalShips[$i] = $arrivalShips;
        }



        if (empty($request->departurePassengersMonth)) {
            $departurePassengersMonth = date('Y') . '-' .date('m');
            $departurePassengersMonthText = date('F') . '-' .date('Y');

        }else{
            $departurePassengersMonth = $request->departurePassengersMonth;
            $departurePassengersMonthString = DateTime::createFromFormat('Y-m',  $departurePassengersMonth);
            $departurePassengersMonthText = $departurePassengersMonthString->format('F-Y');
        }
        $allDeparturePassengers = [];
        for($i = 1; $i <= 31; $i++){
            $day = strval($i);
            $date = $departurePassengersMonth . '-'."$i";
            $departurePassengers = Passenger::where('date', '=', $date)->sum('departure_passenger');
            // dd($arrivalShips);
            $allDeparturePassengers[$i] = $departurePassengers;
        }

        $allDeparturePassengersRetribution = [];
        for($i = 1; $i <= 31; $i++){
            $day = strval($i);
            $date = $departurePassengersMonth . '-'."$i";
            $departurePassengersRetribution = Passenger::where('date', '=', $date)->sum('departure_passenger_retribution');
            // dd($arrivalShips);
            $allDeparturePassengersRetribution[$i] = $departurePassengersRetribution;
        }



        if (empty($request->arrivalPassengersMonth)) {
            $arrivalPassengersMonth = date('Y') . '-' .date('m');
            $arrivalPassengersMonthText = date('F') . '-' .date('Y');

        }else{
            $arrivalPassengersMonth = $request->arrivalPassengersMonth;
            $arrivalPassengersMonthString = DateTime::createFromFormat('Y-m' , $arrivalPassengersMonth);
            $arrivalPassengersMonthText = $arrivalPassengersMonthString->format('F-Y');
        }
        $allArrivalPassengers = [];
        for($i = 1; $i <= 31; $i++){
            $day = strval($i);
            $date = $arrivalPassengersMonth . '-'."$i";
            $arrivalPassengers = Passenger::where('date', '=', $date)->sum('arrival_passenger');
            // dd($arrivalShips);
            $allArrivalPassengers[$i] = $arrivalPassengers;
        }

        //myplot7 - chartbar 5
        $shipName = [];
        $ship = Ship::all();
        foreach($ship as $s){
            array_push($shipName, $s->name);
        }

        $ships = [];

        $totalPassengerPerShip =  Ship::leftJoin('passengers', 'ships.id', '=', 'passengers.ship_id')
        ->select('ships.id as id', 'ships.name as name', DB::raw('SUM(passengers.departure_passenger + passengers.arrival_passenger) AS totalPassenger'))
        ->groupBy('ships.id', 'ships.name')
        ->get();

        // Mengisi array dengan data dari query
        foreach ($totalPassengerPerShip as $ship) {
            $ships[] = [
                'name' => $ship->name,                // Menambahkan nama kapal
                'totalPassenger' => $ship->totalPassenger ??0// Menambahkan total penumpang
            ];
        }

        // dd($ships);



        for($i = 1; $i <= 31; $i++){
            $day = strval($i);
            $date = $arrivalPassengersMonth . '-'."$i";
            $arrivalPassengers = Passenger::where('date', '=', $date)->sum('arrival_passenger');
            // dd($arrivalShips);
            $allArrivalPassengers[$i] = $arrivalPassengers;
        }




        $totalShipsDeparture = Passenger::where('departure_passenger','>',0)->count();
        $totalShipsArrival = Passenger::where('arrival_passenger','>',0)->count();
        $totalPassengersDeparture = Passenger::sum('departure_passenger');
        $totalPassengersArrival = Passenger::sum('arrival_passenger');

        $user = Auth::user();
        return view('master.exportDashboard',compact('user','averageShipsDeparture',
        'averageShipsArrival',
        'averagePassengersDeparture',
        'averagePassengersArrival' ,

        'allDepartureShips',
        'allArrivalShips',
        'allDeparturePassengers',
        'allDeparturePassengersRetribution',
        'allArrivalPassengers',

        'departurePassengersMonth',
        'arrivalPassengersMonth',
        'arrivalShipsMonth',
        'departureShipsMonth',

        'departurePassengersMonthText',
        'arrivalPassengersMonthText',
        'arrivalShipsMonthText',
        'departureShipsMonthText',

        'totalShipsDeparture',
        'totalShipsArrival',
        'totalPassengersDeparture',
        'totalPassengersArrival',
        'ships',
        'shipName'
        ));
    }
}