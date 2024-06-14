<?php

namespace App\Http\Controllers;
use App\Models\Organiser;
use App\Models\Venue;
use App\Models\Concert;
use App\Models\Seat;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organisers = Organiser::all();
        $venues = Venue::all();
        $seats = Seat::all();
        $concerts = Concert::all();
        return view('user.home', compact('organisers', 'venues', 'seats', 'concerts'));
    }

    public function showConcert($id)
    {
        $organisers = Organiser::all();
        $venues = Venue::all();
        $seats = Seat::all();
        $concert = Concert::findOrFail($id); // Fetch the specific concert by ID
        return view('user.concert', compact('concert', 'organisers', 'venues', 'seats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
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
