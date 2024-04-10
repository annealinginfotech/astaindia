<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use Mail;
use Hash;
use App\Mail\ForgotPassword;

class AuthController extends Controller
{
    protected $redirectTo   =   '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('login.index');
    }

    public function authenticate(LoginRequest $request){
        $credentials = $request->except('_token');
        $user   =   Auth::attempt($credentials);
        if ($user) {
            return redirect()->route('home');
        }
        else{
            return redirect()->back()->with('loginError','Invalid credentials detected.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function forgotPassword(){
        $data = [
            'title' =>  'Forgot Password - Annealing Academy'
        ];

        return view('login.adminForgotPassword')->with($data);
    }

    public function forgotPasswordRequest(Request $request) {
        $request->validate([
            'email'     =>  'required|email|exists:users'
        ]);

        $token  =   Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::to($request->email)->send(new ForgotPassword('Hi Dear', $token));

        if(Mail::failures() != 0) {
            return back()->with('success', 'password reset link has been sent to your email');
        }
        return back()->with('error', 'There is some issue with email provider');
    }

    public function resetPassword($token){
        $resetToken  =   DB::table('password_resets')->where(DB::raw("BINARY token"), $token);
        if($resetToken->count()) {
            $email  =   $resetToken->value('email');
            $resetToken->delete();
            return view('login.recover')->with(['email' => $email]);
        }
        else{
            return redirect()->route('login.admin')->with('error', 'Illegal attempt detected.');
        }
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'email'     =>  'required|email|exists:users',
            'password'  =>  'required|string|min:8|confirmed',
            'password_confirmation' =>  'required'
        ]);

        $user = User::where('email', $request->email)->update(['password'   =>  Hash::make($request->password)]);

        return redirect()->route('login.admin')->with('edited', 'Your password has been changed. Login now.');
    }
}
