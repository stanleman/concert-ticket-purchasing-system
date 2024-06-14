<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Venue;

class Seat extends Model
{
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
