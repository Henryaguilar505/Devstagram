@extends('layouts.app')

@section('titulo')
    Crea una nueva publicación
@endsection 

@section('contenido')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone" 
            class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
            @csrf
            </form>
        </div>

        <div class="md:w-1/2 p-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
                    <input type="text" id="titulo" name="titulo"
                        class="border p-2 w-full rounded-lg @error('titulo') border-red-500 @enderror" 
                        placeholder="Titulo de la publicación"
                        value="{{ old('titulo') }}">
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    <textarea 
                     id="descripcion" 
                     name="descripcion"
                     class="border p-2 w-full rounded-lg @error('descripcion') border-red-500 @enderror" 
                     placeholder="Descripción de la publicación">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="hidden" name="imagen" id="imagen" 
                    value="{{old('imagen')}}">
                    @error('imagen')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
                </div>


                <input type="submit" value="Publicar"
                    class="bg-sky-600 hover:bg-sky-800 transition-colors cursor-pointer text-white
                p-3 rounded-lg text-center uppercase w-full font-bold">

            </form>
        </div>
    </div>
@endsection
