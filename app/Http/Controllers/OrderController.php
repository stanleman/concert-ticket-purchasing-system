<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\OrganiserController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\SeatController;
use App\Models\Order;
use App\Models\Seat;
use App\Models\Concert;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organisers = Organiser::all();
        $venues = Venue::all();
        $seats = Seat::all();
        $users = User::all();
        $concerts = Concert::all();
        return view('user.order', compact('organisers', 'venues', 'seats', 'users', 'concerts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function ticket(Request $request)
    {
        $userId = auth()->user()->id; 
        $sortField = $request->query('sort_field', 'created_at'); 
        $sortOrder = $request->query('sort_order', 'asc'); 

        $tickets = Order::where('user_id', $userId)
                        ->with(['concert', 'seat']) 
                        ->orderBy($sortField, $sortOrder)
                        ->get();

        return view('user.ticket', compact('tickets', 'sortField', 'sortOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'concert_id' => 'required|exists:concerts,id',
            'seats' => 'required|array',
            'seats.*' => 'integer|min:0|max:10',
        ]);

        $userId = auth()->user()->id; 
        $concertId = $request->input('concert_id'); 
        $concert = Concert::find($concertId);
        $seats = $request->input('seats');

        $orderDetails = []; 

        $totalQuantity = array_sum($request->seats);

        if ($totalQuantity === 0) {
            return back()->withErrors(['seats' => 'Please select a quantity greater than 0 for at least one seat.'])->withInput();
        }


        foreach ($seats as $seatId => $quantity) {
            if ($quantity > 0) {
                $seat = Seat::find($seatId);

                $order = Order::create([
                    'user_id' => $userId,
                    'concert_id' => $concertId,
                    'seat_id' => $seatId,
                    'quantity' => $quantity,
                    'total_price' => $seat->price * $quantity,
                    'purchased_date' => Carbon::now(),
                ]);

                $seat->quantity -= $quantity;
                $seat->save();

                $orderDetails[] = [
                    'seat' => $seat->seat,
                    'price' => $seat->price,
                    'quantity' => $quantity,
                    'total_price' => $seat->price * $quantity,
                ];
            }
        }

        return redirect()->route('order.success')->with([
            'concert' => $concert,
            'orderDetails' => $orderDetails,
            'totalPrice' => array_sum(array_column($orderDetails, 'total_price')),
        ]);
    }

    public function success()
    {
        return view('user.success', [
            'user' => auth()->user(),
            'concert' => session('concert'),
            'orderDetails' => session('orderDetails'),
            'totalPrice' => session('totalPrice'),
        ]);
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
