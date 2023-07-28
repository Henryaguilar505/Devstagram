<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file('file');

        //crear un nombre unico para cada imagen
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //aplicar interventionImage
        $imagenServidor = Image::Make($imagen);
        $imagenServidor->fit(1000, 1000); //recortar la imagen

        //mover la imagen al servidor
        $imagenPath = public_path('uploads') . '/' . $nombreImagen; //ruta
        $imagenServidor->save($imagenPath); //guardar


        return  response()->json(['imagen' => $nombreImagen]);
    }
}
