<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return redirect('/login')->with('success','Registration successful');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials=$request->only('email','password');

        if(Auth::attempt($credentials)){
            return redirect('/admin');
        }

        return back()->with('error','Invalid login details');
    }

    public function dashboard()
    {
        return view('layouts.admin');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

}
