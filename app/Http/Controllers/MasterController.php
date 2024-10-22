<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\Passenger;
use App\Models\Review;
use App\Models\Route;
use App\Models\Ship;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use PHPUnit\Event\Test\Passed;

class MasterController extends Controller
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
        'totalPassengersArrival'
        ));
    }
   
    public function passenger(Request $request){
        $passengerDate = $request->passengerDate;
        $today = date('Y-m-d');
        $ship = Ship::all();
        if (empty($passengerDate)) {
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
            $date ='';
        } else {
            $date = $passengerDate;
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
                     ) ->whereDate('passengers.date', '=', $date) // Menambahkan where date
            ->get();
        }
      
        
      
        $user = Auth::user();
        // dd($passenger);
        
        return view('master.passenger.index', compact('passenger','user','date','ship'));
    }

    public function storePassenger(Request $request){
        $passenger = new Passenger();
        $passenger->date = $request->date;
        $passenger->ship_id = $request->ship;
        $passenger->departure_passenger = $request->departurePassenger;
        $passenger->arrival_passenger = $request->arrivalPassenger;
        // dd($passenger);       
        $passenger->save();
        return redirect()->route('master.passenger.index')
                         ->with('success', 'passenger data created successfully');
    }
    public function editPassenger($id){
        
        $passenger = Passenger::find($id);
        $ship = Ship::all();
        $user = Auth::user();
        // dd($ship);
        $route = Route::all();
        $operator = Operator::all();
        // dd($passenger);
        return view('master.passenger.edit', compact('ship','user','route','operator','passenger'));
    }
    public function updatePassenger($id,Request $request){
        $passenger = Passenger::findOrFail($id);
        $passenger->date = $request->date;
        $passenger->ship_id = $request->ship;
        $passenger->departure_passenger = $request->departurePassenger;
        $passenger->arrival_passenger = $request->arrivalPassenger;
        // dd($passenger);
        $passenger->save();

        return redirect()->route('master.passenger.index')
                         ->with('success', 'Passenger updated successfully');
    }
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
        ->selectRaw('ships.id AS ship_id, ships.name AS ship_name, operators.id AS operator_id, operators.name AS operator_name, departure_route.route AS departure_route, arrival_route.route AS arrival_route , ships.image AS ship_image, operators.image as operator_image ')
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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();  // Dapatkan ekstensi file
            $image->move(public_path('images'), $imageName);  // Simpan gambar
        } else {
            $imageName = null;  // Tidak ada gambar yang di-upload
        }
        $ship->image = $imageName;
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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();  // Dapatkan ekstensi file
            $image->move(public_path('images'), $imageName);  // Simpan gambar
        } else {
            $imageName = null;  // Tidak ada gambar yang di-upload
        }
        $ship->image = $imageName;
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

    public function operator(){
        $user = Auth::user();
        $operator = Operator::with(['ships.departureRoute', 'ships.arrivalRoute'])  // Relasi dari Operator ke Ship, lalu ke rute keberangkatan dan kedatangan
        ->select('operators.*')  // Ambil semua kolom dari tabel operators
        ->get();
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

    public function route(){
        $user = Auth::user();
        $route = Route::all();
        return view('master.route.index',compact('route','user'));
    }
    public function storeRoute(Request $request){
        $route = new Route();
        $route->route = $request->route;
        $route->save();
        
        return redirect()->route('master.route.index')
                         ->with('success', 'Route created successfully');
    }
    public function editRoute($id){
        $route = Route::find($id);
        $user = Auth::user();
        return view('master.route.edit', compact('user','route'));
    }
    public function updateRoute(Request $request, $id){
        $route = Route::findOrFail($id);
        $route->route = $request->route;
        $route->save();

        return redirect()->route('master.route.index')
                         ->with('success', 'Route updated successfully');
    }
    public function destroyRoute($id){
        $route = Route::findOrFail($id);
        $route->delete();
        return redirect()->route('master.route.index')
        ->with('success', 'Route deleted successfully');
    }
    public function users(){
        $user = Auth::user();
        $allUser = User::all();
        return view('master.user.index',compact('allUser','user'));
    }
    public function editUser(){}
    public function updateUser(){}
    public function destroyUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('master.user.index')
        ->with('success', 'User deleted successfully');
    }

    public function editProfile(){
        $user = Auth::user();     
        return view('master.profile.edit',compact('user'));
    }
    
    public function updateProfile(Request $request, $id){
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        if ($user->save()) {
            return redirect()->route('master.profile.edit')->with('success', 'User updated successfully');
        } else {
            return redirect()->route('master.profile.edit')->with('error', 'Failed to update user');
        }
    }
    public function showChangePasswordForm(){
        $user = Auth::user();
        return view('master.profile.change-password',compact('user'))->with('success', 'Profile updated successfully');
    }
    public function changePassword(Request $request,$id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password|confirmed',
        ], [
            'new_password.different' => 'Kata sandi baru harus berbeda dengan kata sandi saat ini.',
            'new_password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);
        // Dapatkan pengguna yang sedang login
        $user = User::findOrFail($id);
        // Cek apakah password saat ini cocok dengan yang diinputkan
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            // Kembali ke halaman sebelumnya dengan pesan error
            return redirect()->back()->with('error', 'Kata sandi saat ini salah.');
        }
        // Update password pengguna dengan password baru
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('master.profile.showChangePasswordForm')->with('success', 'Kata sandi berhasil diubah.');
    }

    public function review(){
        $user = Auth::user();
        $review = Review::all();
        return view('master.review.index',compact('review','user'));
    }

    public function updateReview(Request $request, $id){
        // update dari default(pending) ke aprove/declined
        $review = Review::findOrFail($id);
        $review->status = $request->status;
        $review->save();

        return redirect()->route('master.review.index')
                         ->with('success', 'Review updated successfully');
    }



 
}
