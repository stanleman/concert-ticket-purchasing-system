<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Seat;
use App\Models\Concert;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'concert_id',
        'seat_id',
        'quantity',
        'total_price',
        'purchased_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function concert()
    {
        return $this->belongsTo(Concert::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
