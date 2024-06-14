<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concert;

class Organiser extends Model
{
    public function concerts()
    {
        return $this->hasMany(Concert::class);
    }
}
