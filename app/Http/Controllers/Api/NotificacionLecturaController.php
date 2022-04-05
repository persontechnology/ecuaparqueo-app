<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificacionLecturaController extends Controller
{
    public function lista(Request $request)
    {
        return response()->json([
            'ok'=>'mens '
        ]);
    }
}
