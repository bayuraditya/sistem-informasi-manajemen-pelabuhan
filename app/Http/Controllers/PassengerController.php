<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Retribution;
use App\Models\Ship;
use App\Exports\PassengerExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class PassengerController extends Controller
{
    public function passenger(Request $request){
        $ship = Ship::all();
        $user = Auth::user();
        $date = $request->passengerDate ?? '';

        return view('master.passenger.index', compact('user', 'date', 'ship'));
    }

    /**
     * Handle DataTables AJAX request for server-side processing
     */
    public function datatable(Request $request)
    {
        $passengerDate = $request->passengerDate;

        // Use joins for proper sorting on all columns including relationships
        $query = Passenger::select('passengers.*')
            ->with([
                'ship.arrivalRoute',
                'ship.departureRoute',
                'passengerUser',
                'retributionUser'
            ])
            ->leftJoin('ships', 'passengers.ship_id', '=', 'ships.id')
            ->leftJoin('routes as departure_routes', 'ships.departure_route_id', '=', 'departure_routes.id')
            ->leftJoin('routes as arrival_routes', 'ships.arrival_route_id', '=', 'arrival_routes.id')
            ->leftJoin('users as passenger_users', 'passengers.user_passenger_id', '=', 'passenger_users.id');

        // Apply date filter if provided
        if (!empty($passengerDate)) {
            $query->whereDate('passengers.date', '=', $passengerDate);
        }

        return DataTables::eloquent($query)
            ->addIndexColumn()
            // Define sorting for calculated columns
            ->orderColumn('date_formatted', 'date $1')
            ->orderColumn('ship_name', 'ships.name $1')
            ->orderColumn('departure_route', 'departure_routes.route $1')
            ->orderColumn('departure_time', 'ships.departure_time $1')
            ->orderColumn('arrival_route', 'arrival_routes.route $1')
            ->orderColumn('arrival_time', 'ships.arrival_time $1')
            ->orderColumn('passenger_user_name', 'passenger_users.name $1')
            // Define filtering for calculated columns (global search)
            ->filterColumn('date_formatted', function($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(passengers.date, '%d %M %Y') LIKE ?", ["%$keyword%"])
                      ->orWhere('passengers.date', 'LIKE', "%$keyword%");
            })
            ->filterColumn('ship_name', function($query, $keyword) {
                $query->whereRaw("ships.name LIKE ?", ["%$keyword%"]);
            })
            ->filterColumn('departure_route', function($query, $keyword) {
                $query->whereRaw("departure_routes.route LIKE ?", ["%$keyword%"]);
            })
            ->filterColumn('departure_time', function($query, $keyword) {
                $query->whereRaw("ships.departure_time LIKE ?", ["%$keyword%"]);
            })
            ->filterColumn('arrival_route', function($query, $keyword) {
                $query->whereRaw("arrival_routes.route LIKE ?", ["%$keyword%"]);
            })
            ->filterColumn('arrival_time', function($query, $keyword) {
                $query->whereRaw("ships.arrival_time LIKE ?", ["%$keyword%"]);
            })
            ->filterColumn('passenger_user_name', function($query, $keyword) {
                $query->whereRaw("passenger_users.name LIKE ?", ["%$keyword%"]);
            })
            ->addColumn('date_formatted', function ($passenger) {
                return date('d F Y', strtotime($passenger->date));
            })
            ->addColumn('ship_name', function ($passenger) {
                return $passenger->ship->name ?? '-';
            })
            ->addColumn('departure_route', function ($passenger) {
                return $passenger->ship->departureRoute->route ?? '-';
            })
            ->addColumn('departure_time', function ($passenger) {
                return $passenger->ship->departure_time ?? '-';
            })
            ->addColumn('arrival_route', function ($passenger) {
                return $passenger->ship->arrivalRoute->route ?? '-';
            })
            ->addColumn('arrival_time', function ($passenger) {
                return $passenger->ship->arrival_time ?? '-';
            })
            ->addColumn('passenger_user_name', function ($passenger) {
                return $passenger->passengerUser->name ?? '-';
            })
            ->addColumn('action', function ($passenger) {
                $user = Auth::user();
                if ($user->role == 'master' || $user->role == 'operator') {
                    return '
                        <a href="/master/passenger/' . $passenger->id . '"
                           class="btn btn-warning btn-sm">Edit</a>
                        <form action="' . route('master.passenger.destroy', ['id' => $passenger->id]) . '"
                              method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <input type="submit"
                                   class="btn btn-danger btn-sm"
                                   value="DELETE"
                                   onclick="return confirm(\'Are you sure you want delete transaction ' . $passenger->id . ' ?\')">
                        </form>
                    ';
                }
                return '';
            })
            ->rawColumns(['action'])
            ->make(true);
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

    /**
     * Export passenger data to Excel
     */
    public function exportExcel(Request $request)
    {
        // Validate request
        $request->validate([
            'year' => 'required|integer|min:2020|max:2099',
            'month' => 'nullable|integer|min:1|max:12',
        ], [
            'year.required' => 'Tahun wajib dipilih untuk export data.',
            'year.integer' => 'Tahun harus berupa angka.',
            'year.min' => 'Tahun tidak valid.',
            'year.max' => 'Tahun tidak valid.',
            'month.integer' => 'Bulan harus berupa angka.',
            'month.min' => 'Bulan tidak valid.',
            'month.max' => 'Bulan tidak valid.',
        ]);

        // Increase memory limit and execution time for large exports
        ini_set('memory_limit', '512M');
        set_time_limit(300); // 5 minutes

        $month = $request->input('month');
        $year = $request->input('year');

        // Generate filename based on filter
        $fileName = 'passenger_data_';

        if ($month) {
            // Both month and year provided
            $fileName .= date('F_Y', mktime(0, 0, 0, $month, 1, $year)) . '.xlsx';
        } else {
            // Only year provided
            $fileName .= 'year_' . $year . '.xlsx';
        }

        try {
            return Excel::download(new PassengerExport($month, $year), $fileName);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan export: ' . $e->getMessage());
        }
    }
}