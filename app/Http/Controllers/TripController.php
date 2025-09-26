<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Booking;
use App\Models\Trip;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Auth as SupportFacadesAuth;
use Illuminate\Support\Facades\Auth as IlluminateSupportFacadesAuth;

class TripController extends Controller
{
     /**
     * Display a listing of trips with search and filter.
     */
   public function index(Request $request)
    {
        $query = Trip::with('airline');

        // Apply filters
        if ($request->filled('airline')) {
            $query->where('airline_id', $request->airline);
        }
        if ($request->filled('origin')) {
            $query->where('origin', 'like', '%' . $request->origin . '%');
        }
        if ($request->filled('destination')) {
            $query->where('destination', 'like', '%' . $request->destination . '%');
        }

        $trips = $query->get();
        $airlines = Airline::all();

        return view('components.trips.index', compact('trips', 'airlines'));
    }

    /**
     * Show the form for creating a new trip.
     */
    public function create()
    {
        $airlines = Airline::all();
        return view('components.trips.create', compact('airlines'));
    }

    /**
     * Store a newly created trip in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_number' => 'required|string|max:255|unique:trips',
            'airline_id' => 'required|exists:airlines,id',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255|different:origin',
            'flight_date' => 'required|date|after_or_equal:today',
            'flight_time' => 'required|date_format:H:i',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'aircraft_type' => 'required|string|max:255',
            'status' => 'required|in:Available,Fully Booked,Cancelled,Delayed',
        ]);

        Trip::create($validated + ['created_by' => FacadesAuth::id()]);

        return redirect()->route('trips.index')->with('success', 'Flight created successfully!');
    }

    /**
     * Display the specified trip.
     */
         /**
     * Display the specified trip.
     */
    public function show($id)
    {
        $trip = Trip::with('airline')->findOrFail($id);
        return view('components.trips.show', compact('trip')); // Changed to match standard Laravel structure
    }

    public function book(Request $request)
    {
        try {
            $validated = $request->validate([
                'trip_id' => 'required|exists:trips,id',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'passport_number' => 'required|string|max:20',
                'date_of_birth' => 'required|date',
                'seat' => 'required|string|max:10',
            ]);

            $trip = Trip::findOrFail($validated['trip_id']);

            // Check if trip is available
            if ($trip->status !== 'Available') {
                return response()->json(['success' => false, 'message' => 'This trip is not available for booking.'], 400);
            }

            // Check capacity
            if ($trip->capacity <= 0) {
                return response()->json(['success' => false, 'message' => 'This trip is fully booked.'], 400);
            }

        ;
            // Create booking
            Booking::create([
                'trip_id' => $trip->id,
              'user_id' => IlluminateSupportFacadesAuth::id(),
                'booked_at' => now(),
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'passport_number' => $validated['passport_number'],
                'date_of_birth' => $validated['date_of_birth'],
                'seat' => $validated['seat'],
            ]);

            // Update capacity
            $trip->decrement('capacity');

            return response()->json([
                'success' => true,
                'message' => 'Trip booked successfully!',
                'redirect' => route('trips.index')
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . collect($e->errors())->flatten()->implode(', ')
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
    

}
