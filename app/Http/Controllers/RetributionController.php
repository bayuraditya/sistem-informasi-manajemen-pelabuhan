<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Retribution;
use App\Models\Ship;
use App\Exports\RetributionTargetExport;
use App\Exports\RetributionPassengerExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class RetributionController extends Controller
{
    public function retribution(){
        $ship = Ship::all();
        $user = Auth::user();

        return view('master.retribution.index', compact('user', 'ship'));
    }

    /**
     * Handle DataTables AJAX request for Retribution Targets (Table 1: Data Pencapaian Retribusi)
     */
    public function datatableTargets(Request $request)
    {
        $query = Retribution::query();

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->orderColumn('month_formatted', 'month $1')
            ->filterColumn('month_formatted', function($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(month, '%M %Y') LIKE ?", ["%$keyword%"])
                      ->orWhere('retributions.month', 'LIKE', "%$keyword%");
            })
            ->addColumn('month_formatted', function ($retribution) {
                return date('F Y', strtotime($retribution->month . '-01')); // Add -01 to make it a valid date
            })
            ->addColumn('target_formatted', function ($retribution) {
                return number_format($retribution->target, 0, ',', '.');
            })
            ->addColumn('total_formatted', function ($retribution) {
                return number_format($retribution->total, 0, ',', '.');
            })
            ->addColumn('status', function ($retribution) {
                if ($retribution->total >= $retribution->target) {
                    return '<span class="badge bg-success">Tercapai</span>';
                } else {
                    return '<span class="badge bg-warning">Belum Tercapai</span>';
                }
            })
            ->addColumn('action', function ($retribution) {
                $user = Auth::user();
                if ($user->role == 'master' || $user->sector == 'retribusi') {
                    return '
                        <a href="/master/retribution/target/' . $retribution->id . '"
                           class="btn btn-warning btn-sm">Edit</a>
                        <form action="' . route('master.target.retribution.destroy', $retribution->id) . '"
                              method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <input type="submit"
                                   class="btn btn-danger btn-sm"
                                   value="DELETE"
                                   onclick="return confirm(\'Are you sure you want delete ' . $retribution->id . ' ?\')">
                        </form>
                    ';
                }
                return '';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * Handle DataTables AJAX request for Passenger Retributions (Table 2: Kelola Retribusi)
     */
    public function datatablePassengers(Request $request)
    {
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
            ->leftJoin('users as retribution_users', 'passengers.user_retribution_id', '=', 'retribution_users.id');

        return DataTables::eloquent($query)
            ->addIndexColumn()
            // Define sorting for calculated columns
            ->orderColumn('date_formatted', 'date $1')
            ->orderColumn('ship_name', 'ships.name $1')
            ->orderColumn('departure_route', 'departure_routes.route $1')
            ->orderColumn('departure_time', 'ships.departure_time $1')
            ->orderColumn('arrival_route', 'arrival_routes.route $1')
            ->orderColumn('arrival_time', 'ships.arrival_time $1')
            ->orderColumn('retribution_user_name', 'retribution_users.name $1')
            ->orderColumn('retribution_status', 'retribution_status $1')
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
            ->filterColumn('retribution_user_name', function($query, $keyword) {
                $query->whereRaw("retribution_users.name LIKE ?", ["%$keyword%"]);
            })
            ->filterColumn('retribution_status', function($query, $keyword) {
                $query->whereRaw("passengers.retribution_status LIKE ?", ["%$keyword%"]);
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
            ->addColumn('retribution_user_name', function ($passenger) {
                return $passenger->retributionUser->name ?? '-';
            })
            ->addColumn('retribution_status_badge', function ($passenger) {
                if ($passenger->retribution_status == 'lunas') {
                    return '<span class="badge bg-success">Lunas</span>';
                } else {
                    return '<span class="badge bg-warning">Belum Lunas</span>';
                }
            })
            ->addColumn('action', function ($passenger) {
                $user = Auth::user();
                if ($user->role == 'master' || $user->sector == 'retribusi') {
                    return '
                        <button type="button"
                                class="btn btn-primary btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#edit_' . $passenger->id . '">
                                Edit Retribusi
                        </button>
                    ';
                }
                return '';
            })
            ->rawColumns(['retribution_status_badge', 'action'])
            ->make(true);
    }

    /**
     * Load modal content for editing passenger retribution
     */
    public function loadModal($id)
    {
        $passenger = Passenger::with(['ship', 'retributionUser'])->findOrFail($id);
        $ship = Ship::all();
        $user = Auth::user();

        return view('master.retribution.partials.edit-modal', compact('passenger', 'ship', 'user'))->render();
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

    /**
     * Export Retribution Targets data to Excel
     */
    public function exportTargets(Request $request)
    {
        // Increase memory limit and execution time for large exports
        ini_set('memory_limit', '512M');
        set_time_limit(300); // 5 minutes

        // Validate request
        $request->validate([
            'year' => 'required|integer|min:2020|max:2099',
        ], [
            'year.required' => 'Tahun wajib dipilih untuk export data.',
            'year.integer' => 'Tahun harus berupa angka.',
            'year.min' => 'Tahun tidak valid.',
            'year.max' => 'Tahun tidak valid.',
        ]);

        $year = $request->input('year');
        $fileName = 'retribution_targets_year_' . $year . '.xlsx';

        try {
            return Excel::download(new RetributionTargetExport($year), $fileName);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan export: ' . $e->getMessage());
        }
    }

    /**
     * Export Passenger Retributions data to Excel
     */
    public function exportPassengers(Request $request)
    {
        // Increase memory limit and execution time for large exports
        ini_set('memory_limit', '512M');
        set_time_limit(300); // 5 minutes

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

        $month = $request->input('month');
        $year = $request->input('year');

        // Generate filename based on filter
        $fileName = 'retribution_passengers_';

        if ($month) {
            // Both month and year provided
            $fileName .= date('F_Y', mktime(0, 0, 0, $month, 1, $year)) . '.xlsx';
        } else {
            // Only year provided
            $fileName .= 'year_' . $year . '.xlsx';
        }

        try {
            return Excel::download(new RetributionPassengerExport($month, $year), $fileName);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan export: ' . $e->getMessage());
        }
    }
}