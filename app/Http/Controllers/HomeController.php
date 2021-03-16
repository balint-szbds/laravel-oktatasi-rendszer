<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Targy;
use Illuminate\Support\Facades\Auth;

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
        $this->user =  \Auth::user();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $targyak = Targy::all();
        

        
        if (Auth::user()->foglalkozas == "tanar"){
            return view('users')->with('targyak', $targyak);
        }
        else if (Auth::user()->foglalkozas == "diak") { //később kell amikor nem csak tárgyakat írok ki a diákhoz
            return view('users')->with('targyak', $targyak);
        }
        else {
            $lists = UserModel::all();
            return view('users')->with('lists', $lists);
        }
        

    }
}
