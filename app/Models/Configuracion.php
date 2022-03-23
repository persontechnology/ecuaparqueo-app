<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;

    public function getColorTemaAttribute(){
        return ['Default','primary','secondary','danger','success','warning','info','dark','pink','purple','indigo','teal','yellow'];
    }
    
}
