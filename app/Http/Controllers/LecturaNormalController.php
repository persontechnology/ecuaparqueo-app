<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LecturaNormalController extends Controller
{
    
    public function index()
    {
       return view('lecturas.normal.index');
    }
}
