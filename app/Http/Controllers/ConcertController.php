<?php

namespace App\Http\Controllers;
use App\Models\Organiser;
use App\Models\Venue;
use App\Models\Concert;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ConcertController extends Controller
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
        $concert = new Concert();
        $concert->name = $request->name;
        $concert->artist = $request->artist;
        $concert->genre = $request->genre;
        $concert->description = $request->description;
        $concert->date = $request->date;
        $concert->time = $request->time;
        $concert->organiser_id = $request->organiser_id;
        $concert->venue_id = $request->venue_id;

        $request->validate([
            'image' => 'required|image|max:10240' //10MEGABYTES
        ]);
        
        $file = $request->file('image');
        $file_name = time() . '_' . $file->getClientOriginalName();

        $file_path = $file->storeAs('public', $file_name);

        $asset_url = asset(Storage::url($file_path));
        $concert->image = $asset_url;

        $concert->save();
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
    public function update(Request $request, Concert $concert)
    {
        $concert->name = $request->input('name');
        $concert->artist = $request->input('artist');
        $concert->genre = $request->input('genre');
        $concert->description = $request->input('description');
        $concert->date = $request->input('date');
        $concert->time = $request->input('time');
        $concert->venue_id = $request->input('venue_id');
        $concert->organiser_id = $request->input('organiser_id');

        if($request->image == null){
            $concert->image = $request->input('imagevalue');
        } else {
            $request->validate([
                'image' => 'required|image|max:10240' //10MEGABYTES
            ]);
            
            $file = $request->file('image');
            $file_name = time() . '_' . $file->getClientOriginalName();
    
            $file_path = $file->storeAs('public', $file_name);
    
            $asset_url = asset(Storage::url($file_path));
            $concert->image = $asset_url;
        }

        $concert->save();

        return redirect('admin/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Concert $concert)
    {
        $concert->delete();

        return redirect('admin/dashboard');
    }
}
