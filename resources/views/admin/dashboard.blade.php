@extends('layout')

@section('main')
    <div class="overflow-auto px-7 py-2">
        <h1 class="title">Concert</h1>
        <table class="cool-form">
            <thead>
                <tr>
                    <th class="px-6 py-4 text-center">ID</th>
                    <th class="px-6 py-4 text-center">Name</th>
                    <th class="px-6 py-4 text-center">Artist</th>
                    <th class="px-6 py-4 text-center">Image</th>
                    <th class="px-6 py-4 text-center">Genre</th>
                    <th class="px-6 py-4 text-center">Description</th>
                    <th class="px-6 py-4 text-center">Date</th>
                    <th class="px-6 py-4 text-center">Time</th>
                    <th class="px-6 py-4 text-center">Organiser</th>
                    <th class="px-6 py-4 text-center">Venue</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($concerts as $concert)
                    <tr>
                        <td class="px-6 py-4 w-[50px]">{{ $concert->id }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('concerts.update', $concert->id) }}" method="POST" class="inline-block w-full" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $concert->name }}" class="border border-gray-300 p-1 rounded w-full">
                        </td>
                        <td class="px-6 py-4">
                            <input type="text" name="artist" value="{{ $concert->artist }}" class="border border-gray-300 p-1 rounded w-full">
                        </td>
                        <td class="px-6 py-4">
                            <img src="{{ $concert->image }}" class="w-42 h-18">
                            <input type="file" name="image" class="border border-gray-300 p-1 rounded">
                            <input type="hidden" value="{{ $concert->image }}" name="imagevalue"/>
                        </td>
                        <td class="px-6 py-4">
                            <input type="text" name="genre" value="{{ $concert->genre }}" class="border border-gray-300 p-1 rounded w-full">
                        </td>
                        <td class="px-6 py-4">
                            <input type="text" name="description" value="{{ $concert->description }}" class="border border-gray-300 p-1 rounded w-full">
                        </td>
                        <td class="px-6 py-4">
                            <input type="text" name="date" value="{{ $concert->date }}" class="border border-gray-300 p-1 rounded w-full">
                        </td>
                        <td class="px-6 py-4">
                            <input type="text" name="time" value="{{ $concert->time }}" class="border border-gray-300 p-1 rounded w-full">
                        </td>
                        <td class="px-6 py-4">
                            <select name="organiser_id" class="border border-gray-300 p-1 rounded w-full">
                                @foreach ($organisers as $organiser)
                                    <option value="{{ $organiser->id }}" {{ $organiser->id == $concert->organiser_id ? 'selected' : '' }}>
                                        {{ $organiser->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4">
                            <select name="venue_id" class="border border-gray-300 p-1 rounded w-full">
                                @foreach ($venues as $venue)
                                    <option value="{{ $venue->id }}" {{ $venue->id == $concert->venue_id ? 'selected' : '' }}>
                                        {{ $venue->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4 w-[230px]">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-900 text-white px-3 py-1 rounded mx-2">Update</button>
                            </form>
                            <form action="{{ route('concerts.destroy', $concert->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this concert?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-900 text-white px-3 py-1 rounded mx-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    

    <div class="overflow-auto px-7 py-2">
        <h1 class="title">Organiser</h1>
        <table class="cool-form">
            <thead>
                <tr>
                    <th class="px-6 py-4 text-center">ID</th>
                    <th class="px-6 py-4 text-center">Name</th>
                    <th class="px-6 py-4 text-center">Description</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($organisers as $organiser)
                    <tr>
                        <td class="px-6 py-4 w-[50px]">{{ $organiser->id }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('organisers.update', $organiser->id) }}" method="POST" class="inline-block w-full">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $organiser->name }}" class="border border-gray-300 p-1 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="text" name="description" value="{{ $organiser->description }}" class="border border-gray-300 p-1 rounded">
                        </td>
                        <td class="px-6 py-4 w-[230px]">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-900 text-white px-3 py-1 rounded mx-2">Update</button>
                            </form>
                            <form action="{{ route('organisers.destroy', $organiser->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this organiser?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-900 text-white px-3 py-1 rounded mx-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="overflow-auto px-7 py-2">
        <h1 class="title">Venue</h1>
        <table class="cool-form">
            <thead>
                <tr>
                    <th class="px-6 py-4 text-center">ID</th>
                    <th class="px-6 py-4 text-center">Name</th>
                    <th class="px-6 py-4 text-center">Size</th>
                    <th class="px-6 py-4 text-center">Image</th>
                    <th class="px-6 py-4 text-center">Address</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venues as $venue)
                    <tr>
                        <td class="px-6 py-4 w-[50px]">{{ $venue->id }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('venues.update', $venue->id) }}" method="POST" enctype="multipart/form-data" class="inline-block w-full">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $venue->name }}" class="border border-gray-300 p-1 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" name="size" value="{{ $venue->size }}" class="border border-gray-300 p-1 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <img src="{{ $venue->image }}" class="w-42 h-36">
                            <input type="file" name="image" class="border border-gray-300 p-1 rounded">
                            <input type="hidden" value="{{ $venue->image }}" name="imagevalue"/>
                        </td>
                        <td class="px-6 py-4">
                            <input type="text" name="address" value="{{ $venue->address }}" class="border border-gray-300 p-1 rounded">
                        </td>
                        <td class="px-6 py-4 w-[230px]">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-900 text-white px-3 m-1 py-1 rounded mx-2">Update</button>
                            </form>
                            <form action="{{ route('venues.destroy', $venue->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this venue?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-900 text-white px-3 py-1 rounded mx-2 my-1">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="overflow-auto px-7 py-2">
        <h1 class="title">Seat</h1>
        <table class="cool-form">
            <thead>
                <tr>
                    <th class="px-6 py-4 text-center">ID</th>
                    <th class="px-6 py-4 text-center">Venue</th>
                    <th class="px-6 py-4 text-center">Seat</th>
                    <th class="px-6 py-4 text-center">Price</th>
                    <th class="px-6 py-4 text-center">Quantity</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seats as $seat)
                    <tr>
                        <td class="px-6 py-4 w-[50px]">{{ $seat->id }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('seats.update', $seat->id) }}" method="POST" class="inline-block w-full">
                                @csrf
                                @method('PUT')
                                <select name="venue_id" class="border border-gray-300 p-1 rounded w-full">
                                    @foreach ($venues as $venue)
                                        <option value="{{ $venue->id }}" {{ $venue->id == $seat->venue_id ? 'selected' : '' }}>
                                            {{ $venue->name }}
                                        </option>
                                    @endforeach
                                </select>
                        </td>
                        <td class="px-6 py-4">
                            <input type="text" name="seat" value="{{ $seat->seat }}" class="border border-gray-300 p-1 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" name="price" value="{{ $seat->price }}" class="border border-gray-300 p-1 rounded">
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" name="quantity" value="{{ $seat->quantity }}" class="border border-gray-300 p-1 rounded">
                        </td>
                        <td class="px-6 py-4 w-[230px]">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-900 text-white px-3 py-1 rounded my-1 mx-2">Update</button>
                            </form>
                            <form action="{{ route('seats.destroy', $seat->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this seat?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-900 text-white px-3 py-1 rounded my-1 mx-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    
@endsection
