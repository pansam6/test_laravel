<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login() {
        $logins = Login::all();
        return view('login', ['logins' => $logins]);
    }

    public function singin(Request $request) {
        $validated = $request->validate([
            'username' => 'required|max:255',
            'password' => 'required|max:255',
        ]);
    }

}
