<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{

    public function __construct()
    {
        //con esto decimos que el usuario debe estar auntenticado para usar cualquiera de estos metodos
        $this->middleware('auth')->except(['show', 'index']); 
        //proteger mediante autenticacion
        //en caso de no estar autenticado laravel redirige al Login automaticamente
    }

    //paginate nos sirve para crear la paginacion segun el # de elementos que le pasemos
    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(12);

        return view('dashboard', [
            'user'=>$user,
            'posts'=>$posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        //validar los post
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        //almacenar en la BBDD
        // Post::create([
        //     'titulo'=> $request->titulo,
        //     'descripcion'=> $request->descripcion,
        //     'imagen'=> $request->imagen,
        //     'user_id'=> auth()->user()->id
        // ]);

        //almacenar en la BBDD con una relacion
        //? user() hace refencia al usuario actual
        //? posts() hace referencia a al relacion que declaramos en el modelo
        $request->user()->posts()->create([
            'titulo'=> $request->titulo,
            'descripcion'=> $request->descripcion,
            'imagen'=> $request->imagen,
            'user_id'=> auth()->user()->id
        ]);

        //redirigir
        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user ,Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' =>$user
        ]);
    }

    public function destroy(Post $post){
        //aplicar el policy
        $this->authorize('delete', $post);

        //eliminar
        $post->delete();

        //eliminar imagen
        $imagen_path = public_path('uploads/' . $post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        //redirigir
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
