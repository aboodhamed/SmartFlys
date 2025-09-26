<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AirlineController extends Controller
{
  
    /**
     * Display a list of all airlines.
     */
    public function index()
    {
        // $airlines = Airline::all();
        return view('components.airlines.index'
        
        // , compact('airlines')
    
    );
    }

}
