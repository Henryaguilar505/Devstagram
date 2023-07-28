<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //comprobar datos del usuario
        if(!auth()->attempt($request->only('email', 'password'), $request->remember))
        {
            //si estan incorrectos retonamos un mensaje de error
            return back()->with('mensaje', 'credendciales incorrectas');
        }

        //si todo sale bien rediregimos al usuario 
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
