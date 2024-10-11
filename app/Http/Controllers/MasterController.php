<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class MasterController extends Controller
{
    public function index(){
        return view('master.index');
    }
}
