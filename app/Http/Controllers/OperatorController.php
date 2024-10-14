<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index(){
        return view('operator.index');
    }

    public function passenger(){
        return view('operator.passenger');
    }

    public function addPassenger(Request $request){
        
        return view('operator.passenger');
    }
}
