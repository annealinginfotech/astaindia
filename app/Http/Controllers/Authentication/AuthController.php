<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' =>  'required',
            'password'  =>  'required'
        ]);

        $checkLogin =   Auth::attempt($request->only(['email', 'password']));
        if($checkLogin) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('loginError', 'Invalid credentials detected.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
