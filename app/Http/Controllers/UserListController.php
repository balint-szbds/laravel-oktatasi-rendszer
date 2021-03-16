<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\UserModel;
use Illuminate\Support\Facades\Auth;

class UserListController extends Controller
{
    public function __construct()
    {
        $this->user =  \Auth::user();
    }

    public function indexAll() {
        if(Auth::user()){
           return redirect()->route('home');
        }
        $lists = UserModel::all();
        return view('users')->with('lists', $lists);
    }

    public function indexItem($id) {
        $userList = UserModel::find($id);

        return view('users')
                ->with('id', $id)
                ->with('name', $name)
                ->with('email', $email);
    }

    public function profil($id) {
        $user = UserModel::find($id);

        return view('profil');
    }
}
