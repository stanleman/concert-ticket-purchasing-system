<?php

namespace App\Http\Controllers;
use \App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    function store(Request $request) {
        $seat = new Seat();
        $seat->seat = $request->seat;
        $seat->price = $request->price;
        $seat->quantity = $request->quantity;
        $seat->venue_id = $request->venue_id;

        $seat->save();
        return redirect('admin/dashboard/create');
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
    public function update(Request $request, Seat $seat)
    {
        $seat->venue_id = $request->input('venue_id');
        $seat->seat = $request->input('seat');
        $seat->price = $request->input('price');
        $seat->quantity = $request->input('quantity');
        $seat->save();

        return redirect('admin/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seat $seat)
    {
        $seat->delete();
        return redirect('admin/dashboard');
    }
}
