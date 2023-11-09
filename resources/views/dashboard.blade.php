@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col md:flex-row items-center">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img class="rounded-full" 
                src="{{ $user->imagen ? asset('perfiles') .'/'. $user->imagen : asset('img/usuario.svg')}}" 
                alt="imagen de usuario">
              
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start md:justify-center py-10">

                <div class="flex items-center gap-2"> 
                    <p class="text-2xl text-gray-700">{{ $user->username }}</p>

                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{route('perfil.index')}}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>

                            </a>
                        @endif
                    @endauth

                </div>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    {{$user->followers->count()}}
                     <span class="font-normal">@choice('Seguidor|Seguidores',$user->followers->count())</span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{$user->followings->count()}}
                    <span class="font-normal">@choice('Seguido|Seguidos',$user->followings->count())</span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count() }} 
                    <span class="font-normal">@choice('Publicación|Publicaciones',$user->posts->count())</span>
                </p>

                @auth()
                @if ($user->id !== auth()->user()->id)
                @if (!$user->siguiendo(auth()->user()))
                                        
                <form action="{{route('users.follow', $user->username)}}" method="POST">
                    @csrf

                    <input type="submit" 
                    class="bg-blue-600 text-white uppercase rounded-lg px-4 py-2 
                    text-xs font-bold cursor-pointer" 
                    value="Seguir">
                </form>

                @else

                <form action="{{route('users.unfollow', $user->username)}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <input type="submit" 
                    class="bg-red-600 text-white uppercase rounded-lg px-4 py-2 
                    text-xs font-bold cursor-pointer" 
                    value="Dejar de seguir">
                </form>

                @endif
                @endif
                @endauth


            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>

        @if ($posts->count())
            <div class="grid p-3 md:p-0 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 ">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}">
                            <img src={{ asset('uploads') . '/' . $post->imagen }} alt="Imagen del post {{ $post->titulo }}">
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="my-10">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay publicaciones aún</p>
        @endif



    </section>
@endsection
