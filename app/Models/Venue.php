<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concert;
use App\Models\Seat;

class Venue extends Model
{
    public function concerts()
    {
        return $this->hasMany(Concert::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
