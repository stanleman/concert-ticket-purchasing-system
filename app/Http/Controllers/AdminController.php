<?php

namespace App\Http\Controllers;
use App\Models\Organiser;
use App\Models\Venue;
use App\Models\Concert;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $organisers = Organiser::all();
        $venues = Venue::all();
        $seats = Seat::all();
        $users = User::all();
        $concerts = Concert::all();
        return view('admin.dashboard', compact('organisers', 'venues', 'seats', 'users', 'concerts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organisers = Organiser::all();
        $venues = Venue::all();
        return view('admin.add', compact('organisers', 'venues'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
