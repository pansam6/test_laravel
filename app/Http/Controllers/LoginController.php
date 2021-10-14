<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login() {
        $user = User::all();
        return view('login', ['user' => $user]);
    }
}
