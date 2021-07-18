<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if(Auth::attempt($request->only('email','password')))
        {
            return redirect('/home');
        }
        return redirect('/login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('auth');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postregister(Request $request)
    {
    //    dd($request->all());

        User::create([
            'name' => $request->name,
            'level' => 'Karyawan',
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);
        return redirect('/auth');
    }
}
