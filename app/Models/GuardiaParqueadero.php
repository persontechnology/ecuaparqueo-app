<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardiaParqueadero extends Model
{
    use HasFactory;
    public function guardia()
    {
        return $this->belongsTo(User::class,'guardia_id');
    }
}
