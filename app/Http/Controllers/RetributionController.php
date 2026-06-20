<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Retribution;
use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetributionController extends Controller
{
    public function retribution(){
        $retribution = Retribution::all();

        $ship = Ship::all();
        $passenger = Passenger::with(['ship.arrivalRoute','ship.departureRoute','passengerUser','retributionUser'])->get();

        // $passenger = Passenger::join('ships', 'passengers.ship_id', '=', 'ships.id')
        // ->join('routes AS departure_routes', 'ships.departure_route_id', '=', 'departure_routes.id')
        // ->join('routes AS arrival_routes', 'ships.arrival_route_id', '=', 'arrival_routes.id')
        // ->join('users', 'passengers.user_retribution_id', '=', 'users.id')
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
        $user = Auth::user();

        return view('master.retribution.index',compact('user','retribution','passenger','ship'));
    }

    public function updateRetribution(Request $request , $id){
        // dd($request);
        $passenger = Passenger::findOrFail($id);
        // $passenger->date = $request->date;
        // $passenger->ship_id = $request->ship;
        $passenger->departure_passenger_retribution = $request->departurePassengerRetribution;
        $passenger->retribution = $request->retribution;
        $passenger->retribution_status = $request->retributionStatus;
        $passenger->user_retribution_id = Auth::user()->id;//penginput retribusi
        // $passenger->arrival_passenger = $request->arrivalPassenger;
        // dd($passenger);
        // $passenger->user_id = Auth::user()->id;

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
        //  dd($retribution);
        return redirect()->route('master.retribution.index')->with('success', 'Retribution updated successfully');

    }

    public function storeTargetRetribution(Request $request){
        $retribution = new Retribution();
        $retribution->month = $request->month;
        $retribution->target = $request->target;

        [$year, $month] = explode('-', $retribution->month);
        // Menentukan tanggal awal
        $startDate = "$year-$month-01"; // Hari pertama bulan
        // Menentukan tanggal akhir (hari terakhir bulan)
        $endDate = date("Y-m-t", strtotime($startDate)); // Menggunakan strtotime untuk mendapatkan hari terakhir bulan
        $totalRetribution = Passenger::whereBetween('date', [$startDate, $endDate])->sum('retribution');
        // dd($totalRetribution);
        $retribution->total = $totalRetribution;
        $retribution->save();

        return redirect()->route('master.retribution.index')
                         ->with('success', 'Retribution data created successfully');
    }
    public function editTargetRetribution($id){
            // $allCourt = Court::all();
            $retribution = Retribution::find($id);
            $user = Auth::user();
            // dd($ship);
            return view('master.retribution.edit', compact('user','retribution'));

    }

    public function updateTargetRetribution(Request $request, $id){
        $retribution = Retribution::findOrFail($id);
        $retribution->month = $request->month;
        $retribution->target = $request->target;

        [$year, $month] = explode('-', $retribution->month);

        // Menentukan tanggal awal
        $startDate = "$year-$month-01"; // Hari pertama bulan

        // Menentukan tanggal akhir (hari terakhir bulan)
        $endDate = date("Y-m-t", strtotime($startDate)); // Menggunakan strtotime untuk mendapatkan hari terakhir bulan


        $totalRetribution = Passenger::whereBetween('date', [$startDate, $endDate])->sum('retribution');
        // dd($totalRetribution);
        $retribution->total = $totalRetribution;

        $retribution->save();

        return redirect()->route('master.retribution.index')
                         ->with('success', 'Retribution target updated successfully');
    }

    public function destroyTargetRetribution($id){
        $retribution = Retribution::findOrFail($id);
        $retribution->delete();

        return redirect()->route('master.retribution.index')
        ->with('success', 'Retribution deleted successfully');
    }
}