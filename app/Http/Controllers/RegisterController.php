<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create() {
        $puestos = Puesto::all(); // Obtener los puestos de la BD
        return view('auth.register', compact('puestos'));
    }

    // Validar datos
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email', // Asegurarse que el email es único
            'password' => 'required|confirmed|min:8', // Validar que la contraseña tenga al menos 8 caracteres
        ]);

        // Crear usuario
        $user = User::create([
            'name' => $request->nombre . ' ' . $request->apellido_paterno . ' ' . $request->apellido_materno,
            'email' => $request->email, // El email viene del formulario
            'password' => Hash::make($request->password), // Encriptar la contraseña antes de almacenarla
            'role' => 'empleado', // Asignar el rol como empleado
        ]);

        // Crear empleado asociado al usuario
        Empleado::create([
            'user_id' => $user->id,// El puesto viene del formulario
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
        ]);

        // Iniciar sesión inmediatamente después del registro
        auth()->login($user);

        // Redirigir al dashboard del empleado
        return redirect()->route('empleado.dashboard')->with('success', 'Registro exitoso. Bienvenido al sistema.');
    }
}
