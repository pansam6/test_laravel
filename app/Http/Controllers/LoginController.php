<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Environment\Console;
use Illuminate\Routing\Redirector;

class LoginController extends Controller
{
    public function login() {
        $user = User::all();
        if (session()->has("user")) { //เช็คว่ามี ข้อมูลชื่อ user ไหม
            return back();
        }
        return view('login', ['user' => $user]);
    }

    public function logout() {
        session()->flush(); //ลบข้อมูล session all
        return redirect('/login');
    }

    public function signin(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required']
        ]);
        if ($validator->fails()) {
            return 1;
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();
            return 2;
        }
    }

    public function loginsuccess(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required'],
        ]);
        if ($validator->fails()) {
            return 1;
        } else {
            $user = User::where('email', $request->email)->get();

            if($user[0]->password == $request->password) {
                session()->put('user', $user[0]); //เพิ่มข้อมูล user
                return response()->json(action([Productcontroller::class, 'product']));
            } else {
                return 1;
            }
        }
    }
}
