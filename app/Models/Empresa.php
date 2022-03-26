<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Empresa extends Model
{
    use HasFactory;

    public function getLogoLinkAttribute()
    {
        if(Storage::exists($this->logo)){
            return Storage::url($this->logo) ;
        }
        
    }
}
