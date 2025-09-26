<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Trip;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get statistics
        $dailyTrips = Trip::whereDate('flight_date', today())->count();
        $airlinesCount = Airline::count();
        $destinationsCount = Trip::distinct('destination')->count('destination');
        
        // Get featured trips (latest 6 trips)
        $featuredTrips = Trip::with('airline')
            ->where('status', 'Available')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('components.Home.index', compact('dailyTrips', 'airlinesCount', 'destinationsCount', 'featuredTrips'));
    }
}