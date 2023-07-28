@extends('layouts.app')

@section('titulo')
    Editar perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" action="{{route('perfil.store')}}" class="mt-1- md:mt-0" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text" id="username" name="username"
                     class="border p-2 w-full rounded-lg @error('username') border-red-500 @enderror" 
                     placeholder="Tu nombre de usuario"
                     value="{{auth()->user()->username}}"
                     >
                     @error('username')
                         <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                         </p>
                     @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen de perfil
                    </label>
                    <input type="file" id="imagen" name="imagen"
                     class="border p-2 w-full rounded-lg" 
                     value=""
                     accept=".jpg, .jppeg, .png"
                     >
                </div>

                <input type="submit" value="Guardar cambios"
                class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer text-white
                p-3 rounded-lg text-center uppercase w-full font-bold">
            </form>
        </div>
    </div>    
@endsection