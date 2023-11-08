<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request){

        //modificar el request para crear url con el nombre de usuario
        $request->request->add(['username' => Str::slug($request->username)]);
       
        $this->validate($request, [
            'name' => 'required | max:30',
            'username' => 'required | unique:users| min:3 | max:20',
            'email' => 'required | unique:users| email | max:60',
            'password' => 'required | confirmed | min:6 '
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        auth()->attempt($request->only('email', 'password'));

        //redireccionar al usuario
        return redirect()->route('posts.index');
         
    }
}
