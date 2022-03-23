<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brazo extends Model
{
    use HasFactory;
    protected $fillable = ['codigo','estado','estado_brazo','descripcion','parqueadero_id'];
}
