<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brazo extends Model
{
    use HasFactory;

    
    protected $fillable = ['codigo','estado','estado_brazo','descripcion','parqueadero_id'];

    // public function getEstadoBrazoAttribute($value)
    // {
    //     switch ($value) {
    //         case 0:
    //             return (bool)$value;
    //             break;
    //         case 1:
    //             return (bool)$value;
    //             break;
    //         case '2':
    //             return (int)$value;
    //             break;
    //     }
        
    // }

    /**
     * This will be called when storing/updating the element.
     */
   

    // public function setEstadoBrazoAttribute($value)
    // {
    //     switch ($value) {
    //         case true:
    //             $this->attributes['estado_brazo'] = '1';        
    //             break;
    //         case false:
    //             $this->attributes['estado_brazo'] = '0';        
    //             break;
    //         case '2':
    //             $this->attributes['estado_brazo'] = '2';        
    //             break;
    //     }
        
    // }
    // Deivid: un brazo tiene un parqueadero
    public function parqueadero()
    {
        return $this->belongsTo(Parqueadero::class);
    }
}
