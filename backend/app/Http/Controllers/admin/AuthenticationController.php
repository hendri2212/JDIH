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
        $is_login = true;
        return view('layout.before-login', compact('is_login'));
    }

    public function storeLogin(LoginRequest $request){
        $request->authenticate();

        $request->session()->regenerate();

        return redirect('/');
    }

    public function createRegister(){
        $is_login = false;
        return view('layout.before-login', compact('is_login'));
    }
    public function storeRegister(UserRequest $request){
        $request->type = 'superadmin';
        $inserted = $request->only(['name', 'photo', 'username', 'password', 'type']);
        $user = new User($inserted);
        $user->save();
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }



}
