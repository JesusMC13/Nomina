@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="block mx-auto my-12 p-8 bg-white w-1/3 border border-gray-200 rounded-lg shadow-lg">

  <h1 class="text-3xl text-center font-bold">Registro</h1>

  <form class="mt-4" method="POST" action="{{ route('register.store') }}">
    @csrf

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" 
           placeholder="Nombre" id="nombre" name="nombre" value="{{ old('nombre') }}">

    @error('nombre')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" 
           placeholder="Apellido Paterno" id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}">

    @error('apellido_paterno')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <input type="text" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" 
           placeholder="Apellido Materno" id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno') }}">

    @error('apellido_materno')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <input type="email" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" 
           placeholder="Correo" id="email" name="email" value="{{ old('email') }}">

    @error('email')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <input type="password" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" 
           placeholder="Contraseña" id="password" name="password">

    @error('password')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <input type="password" class="border border-gray-200 rounded-md bg-gray-200 w-full text-lg placeholder-gray-900 p-2 my-2 focus:bg-white" 
           placeholder="Confirmar Contraseña" id="password_confirmation" name="password_confirmation">

    @error('password_confirmation')        
      <p class="border border-red-500 rounded-md bg-red-100 w-full text-red-600 p-2 my-2">* {{ $message }}</p>
    @enderror

    <button type="submit" class="rounded-md bg-indigo-500 w-full text-lg text-white font-semibold p-2 my-3 hover:bg-indigo-600">Registrar</button>

    <a href="{{ url('/home') }}" class="btn btn-secondary">Salir</a>
    
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    @endif
  </form>

</div>

@endsection
