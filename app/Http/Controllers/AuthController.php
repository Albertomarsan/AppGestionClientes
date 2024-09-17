<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function authenticate(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)){
            return redirect('/home');
        }

        return back()->with('error', 'Email o contraseña equivocada');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
