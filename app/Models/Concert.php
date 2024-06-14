<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organiser;
use App\Models\Venue;

class Concert extends Model
{
    protected $fillable = ['name', 'artist', 'date', 'date','image', 'description', 'organiser_id', 'venue_id'];

    public function organiser()
    {
        return $this->belongsTo(Organiser::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }


}
