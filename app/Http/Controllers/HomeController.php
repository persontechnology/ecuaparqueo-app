<?php

namespace App\Http\Controllers;

use App\Events\RealTimeMessage;
use App\Models\User;
use App\Notifications\RealTimeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=User::find(Auth::id());
        $user->notify( new RealTimeNotification("HOLA MUNDO DESDE CONTROLER HOME"));
        return view('home');
    }
}
