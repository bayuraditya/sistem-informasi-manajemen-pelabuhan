<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\Route;
use App\Models\Ship;
use App\Models\ShipImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipController extends Controller
{
    public function ship(){
        $user = Auth::user();
        $operator = Operator::all();
        $route = Route::all();

        // $ship = Ship::with('operator', 'departureRoute','arrivalRoute','shipImages')  // Sesuaikan relasi jika ada
        // ->join('operators', 'ships.operator_id', '=', 'operators.id')
        // ->join('routes as departure_route', 'ships.departure_route_id', '=', 'departure_route.id')  // Alias untuk rute keberangkatan
        // ->join('routes as arrival_route', 'ships.arrival_route_id', '=', 'arrival_route.id')  // Alias untuk rute kedatangan
        // // ->join('ship_images','ship_images.ship_id','ships.id')
        // ->select('ships.*','operators.*','departure_route.*','arrival_route.*')
        // ->select('ships.*','operators.*','departure_route.*','arrival_route.*','ship_images.*')
        // ->selectRaw('ships.id AS ship_id, ships.name AS ship_name, operators.id AS operator_id, operators.name AS operator_name, departure_route.route AS departure_route, arrival_route.route AS arrival_route , operators.image as operator_image ')
        // ->get();

        $ship = Ship::with(['departureRoute', 'arrivalRoute', 'operator', 'shipImages'])
        // ->select('ships.*','operators.*','departure_route.*','arrival_route.*','ship_images.*')
        // ->selectRaw('ships.id AS ship_id, ships.name AS ship_name, operators.id AS operator_id, operators.name AS operator_name, departure_route.route AS departure_route, arrival_route.route AS arrival_route , operators.image as operator_image ')
        // ->selectRaw('ships.id AS ship_id, ships.name AS ship_name, operators.id AS operator_id, operators.name AS operator_name, departure_route.route AS departure_route, arrival_route.route AS arrival_route , operators.image as operator_image ')
        ->get();

        // dd($ship[4]->shipImages);
        return view('master.ship.index',compact('route','operator','user','ship'));
    }
    public function storeShip(Request $request){
        // dd($request->hasFile('image'));
        $ship = new Ship();
        $ship->name = $request->name;
        $ship->departure_route_id = $request->departureRoute;
        $ship->departure_time = $request->departureTime;
        $ship->arrival_route_id = $request->arrivalRoute;
        $ship->arrival_time = $request->arrivalTime;
        $ship->type = $request->type;
        $ship->operator_id = $request->operator;
        $ship->save();
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach($images as $image){
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                // Move the image to the desired location
                $image->move(public_path('images'), $imageName);

                $shipImage = new ShipImage();
                $shipImage->image = $imageName;
                $shipImage->ship_id = $ship->id;
                $shipImage->save();

            }
        } else {
            $imageName = null;  // Tidak ada gambar yang di-upload
        }


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
            $deleteShipImage = ShipImage::where('ship_id',$ship->id)->get();
            foreach($deleteShipImage as $d){
                $d->delete();
            }
            $images = $request->file('image');
            foreach($images as $image){
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                // Move the image to the desired location
                $image->move(public_path('images'), $imageName);

                $shipImage = new ShipImage();
                $shipImage->image = $imageName;
                $shipImage->ship_id = $ship->id;
                $shipImage->save();

            }
        } else {
            $imageName = null;  // Tidak ada gambar yang di-upload
        }
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
}