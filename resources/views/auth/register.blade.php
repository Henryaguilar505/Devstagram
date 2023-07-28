@extends('layouts.app')

@section('titulo')
    Regístrate en Devstagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-8 md:items-center">
        <div class="md:w-6/12">
            <img src="{{ asset('img/registrar.jpg')}}" alt="registrar.jpg">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{route('register')}}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input type="text" id="name" name="name"
                     class="border p-2 w-full rounded-lg @error('name') border-red-500 @enderror" 
                     placeholder="Tu nombre"
                     value="{{ old('name')}}"
                     >
                     @error('name')
                         <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{$message}}
                         </p>
                     @enderror
                </div>


                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input type="text" id="username" name="username"
                     class="border p-2 w-full rounded-lg @error('username') border-red-500 @enderror" 
                     placeholder="Tu Nombre de usuario"
                     value="{{ old('username')}}"
                     >

                     @error('username')
                     <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{$message}}
                     </p>
                     @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input type="email" id="email" name="email"
                     class="border p-2 w-full rounded-lg @error('email') border-red-500 @enderror" 
                     placeholder="Tu Email de Registro"
                     value="{{ old('email')}}"
                     >
                     @error('email')
                     <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{$message}}
                     </p>
                     @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input type="password" id="password" name="password"
                     class="border p-2 w-full rounded-lg @error('password') border-red-500 @enderror" 
                     placeholder="Tu password de registro"
                     >
                     @error('password')
                     <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{$message}}
                     </p>
                     @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                     class="border p-2 w-full rounded-lg" 
                     placeholder="repite tu password"
                     >
                </div>

                <input type="submit" value="crear cuenta"
                class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer text-white
                p-3 rounded-lg text-center uppercase w-full font-bold">

            </form>
        </div>
    </div>
    
@endsection