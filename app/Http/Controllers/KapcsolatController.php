<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KapcsolatController extends Controller
{
    public function All() {
        return view('kapcsolat');
    }
}
