<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller {
    
    public function create() {
        // Retorna la vista de registro
        return view('auth.register');
    }

    public function store(Request $request) {
        // Validación de los campos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
        
        // Crear el nuevo usuario
        $user = User::create([
            'name' => $request->nombre . ' ' . $request->apellido_paterno . ' ' . $request->apellido_materno,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encripta la contraseña
            'role' => 'empleado', // Si usas roles
        ]);

        // Redirige al login con un mensaje de éxito
        return redirect()->route('login.index')->with('success', 'Registro exitoso. Inicia sesión.');
    }
}
