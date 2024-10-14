<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index(){
        return view('operator.index');
    }

    public function passenger(){
        $passenger = Passenger::all();
        return view('operator.passenger', compact('passenger'));
    }

    public function addPassenger(Request $request){
        
        return view('operator.passenger');
    }
}
