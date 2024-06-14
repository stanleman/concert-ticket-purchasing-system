<?php

namespace App\Http\Controllers;
use \App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VenueController extends Controller
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
        $venue = new Venue();
        $venue->name = $request->name;
        $venue->address = $request->address;
        $venue->size = $request->size;

        $request->validate([
            'image' => 'required|image|max:10240' //10MEGABYTES
        ]);
        
        $file = $request->file('image');
        $file_name = time() . '_' . $file->getClientOriginalName();

        $file_path = $file->storeAs('public', $file_name);

        $asset_url = asset(Storage::url($file_path));
        $venue->image = $asset_url;
        
        $venue->save();
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
    public function update(Request $request, Venue $venue)
    {
        $venue->name = $request->input('name');
        $venue->size = $request->input('size');
        $venue->address = $request->input('address');

        if($request->image == null){
            $venue->image = $request->input('imagevalue');
        } else {
            $request->validate([
                'image' => 'required|image|max:10240' //10MEGABYTES
            ]);
            
            $file = $request->file('image');
            $file_name = time() . '_' . $file->getClientOriginalName();
    
            $file_path = $file->storeAs('public', $file_name);
    
            $asset_url = asset(Storage::url($file_path));
            $venue->image = $asset_url;
        }

        $venue->save();

        return redirect('admin/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();

        return redirect('admin/dashboard');
    }
}
