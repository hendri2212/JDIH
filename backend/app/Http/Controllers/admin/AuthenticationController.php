<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function createLogin(){
        return view('auth.login');
    }

    public function storeLogin(LoginRequest $request){
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function createRegister(){
        return view('auth.register');
    }
    public function storeRegister(UserRequest $request){
        $user = new User($request->only(['name', 'photo', 'username', 'password', 'type']));
        $user->save();
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }



}
