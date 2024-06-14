<?php

namespace App\Http\Controllers;
use \App\Models\Organiser;
use Illuminate\Http\Request;

class OrganiserController extends Controller
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
        $organiser = new Organiser();
        $organiser->name = $request->name;
        $organiser->description = $request->description;
        $organiser->tnc = $request->tnc;
        $organiser->save();
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
    public function update(Request $request, Organiser $organiser)
    {
        $organiser->name = $request->input('name');
        $organiser->description = $request->input('description');
        $organiser->tnc = $request->input('tnc');
        $organiser->save();

        return redirect('admin/dashboard');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organiser $organiser)
    {
        $organiser->delete();

        return redirect('admin/dashboard');
    }
}
