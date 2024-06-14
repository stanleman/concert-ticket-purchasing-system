@extends('layout')

@section('main')
    
<div class="grid grid-cols-2 max-[815px]:grid-cols-1">
    <form method="POST" action="{{ route('concerts.store') }}" class="cool-form border rounded-2xl bg-white border-slate-400 m-5" enctype="multipart/form-data">
        @csrf 
        <p class="title">Concert</p>

        <div class="m-5">
            <label>Name</label>
            <input type="text" name="name" />
        </div>

        <div class="flex items-center">
            <div class="m-5 w-full">
                <label>Artist</label>
                <input type="text" name="artist"/>
            </div>
    
            <div class="m-5 w-full">
                <label>Genre</label>
                <input type="text" name="genre"/>
            </div>
        </div>

        <div class="m-5">
            <label>Description</label>
            <input type="text" name="description"/>
        </div>

        <div class="flex items-center">
            <div class="m-5 w-full">
                <label>Date</label>
                <input type="text" name="date"/>
            </div>
    
            <div class="m-5 w-full">
                <label>Time</label>
                <input type="text" name="time"/>
            </div>
        </div>

        <div class="m-5">
            <label for="organiser">Organiser</label>
            <select id="organiser" name="organiser_id" >
                @foreach ($organisers as $organiser)
                    <option value="{{ $organiser->id }}">{{ $organiser->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="m-5">
            <label for="venue">Venue</label>
            <select id="venue" name="venue_id" class="block w-full mt-2">
                @foreach ($venues as $venue)
                    <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center">
            <div class="m-5">
                <label>Image</label>
                <input type="file" name="image" class="w-full">
            </div>
    
            <button class="primary-btn">Add New Concert</button>
        </div>
    </form>

    <div>
        <form method="POST" action="{{ route('organisers.store') }}" class="cool-form border rounded-2xl bg-white border-slate-400 m-5">
            @csrf 
            <p class="title">Organiser</p>
            
            <div class="m-5">
                <label>Name</label>
                <input type="text" name="name" />
            </div>
    
            <div class="m-5">
                <label>Description</label>
                <input type="text" name="description" />
            </div>
    
            <button class="primary-btn">Add New Organiser</button>
        </form>
    
        <form method="POST" action="{{ route('venues.store') }}" class="cool-form border rounded-2xl bg-white border-slate-400 m-5" enctype="multipart/form-data">
            @csrf 
            <p class="title">Venue</p>
            
            <div class="m-5">
                <label>Name</label>
                <input type="text" name="name" />
            </div>
    
            <div class="m-5">
                <label>Address</label>
                <input type="text" name="address">
            </div>
    
            <div class="flex max-[1144px]:flex-col">
                <div class="m-5">
                    <label>Size</label>
                    <input type="number" name="size" />
                </div>
        
                <div class="m-5">
                    <label>Image</label>
                    <input type="file" name="image" class="w-full">
                </div>
            </div>
    
            <button class="primary-btn">Add New Venue</button>
        </form>
    </div>
</div>

<form method="POST" action="{{ route('seats.store') }}" class="cool-form border rounded-2xl bg-white border-slate-400 m-5">
    @csrf
    <p class="title">Seat</p>

    <div class="flex max-[815px]:flex-col items-center max-[815px]:p-5">
        <div class="m-5 w-[25%] max-[815px]:w-full">
            <label for="venue">Venue</label>
            <select id="venue" name="venue_id" class="block mt-2">
                @foreach ($venues as $venue)
                    <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="m-5 max-[815px]:w-full">
            <label>Seat</label>
            <input type="text" name="seat" />
        </div>

        <div class="m-5 max-[815px]:w-full">
            <label>Price</label>
            <input type="number" name="price"/>
        </div>
    
        <div class="m-5 max-[815px]:w-full">
            <label>Quantity</label>
            <input type="number" name="quantity"/>
        </div>

        <button class="primary-btn">Add New Seat</button>
    </div>
</form>

@endsection