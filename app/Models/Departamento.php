<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    // Deivid, un departaemnto tiene un usuario Supervisor
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
