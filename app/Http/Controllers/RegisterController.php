<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller {
    
    public function create() {
        
        return view('auth.register');
    }

    public function store(Request $request) {

        $this->validate(request(), [
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $user = User::create([
            'name' => request('nombre') . ' ' . request('apellido_paterno') . ' ' . request('apellido_materno'),
            'email' => request('email'),
            'password' => request('password'), // Se encripta automáticamente en el modelo
            'role' => 'empleado', // Si usas roles
        ]);
        
    
        return redirect()->route('login.index')->with('success', 'Registro exitoso. Inicia sesión.');
    }
    
}
