<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('template.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if(!Auth::attempt($request->only('username', 'password'), $request->has('remember'))) {
            return redirect()->back()->with('info', 'Neteisingas slapyvardis arba slaptažodis!');
        }

        return redirect()->route('home')->with('info', 'Sėkmingai prisijungta!');
    }

    public function getRegister()
    {
        return view('template.register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|alpha_dash|unique:users|min:4',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('auth.login')->with('info', 'Sėkmingai užsiregistravot. Dabar galit prisijungti');
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect()->route('home')->with('info', 'Sėkmingai atsijungei!');
    }

}
