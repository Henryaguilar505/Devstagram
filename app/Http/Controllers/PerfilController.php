<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
         //modificar el request para crear url con el nombre de usuario
         $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,'.auth()->user()->id  ,'min:3' ,'max:20', 'not_in:editar-perfil,elon-musk'],
        ]);

        //si hay una nueva imagen
        if($request->imagen){
            $imagen = $request->file('imagen');

            //crear un nombre unico para cada imagen
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            //aplicar interventionImage
            $imagenServidor = Image::Make($imagen);
            $imagenServidor->fit(1000, 1000); //recortar la imagen
    
            //mover la imagen al servidor
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen; //ruta
            $imagenServidor->save($imagenPath); //guardar
        }

          //guardar cambios
          $usuario = User::find(auth()->user()->id);
          $usuario->username = $request->username;
          $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
          $usuario->save(); 

          //redireccionar
          return redirect()->route('posts.index', $usuario->username);
    }
}