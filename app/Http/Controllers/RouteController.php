<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
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
}