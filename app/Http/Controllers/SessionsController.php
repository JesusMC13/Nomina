<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SessionsController extends Controller {

    public function create() {
        return view('auth.login');
    }

    public function store() {
        // Intenta autenticar al usuario
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'The email or password is incorrect, please try again',
            ]);
        } else {
            // Redirige según el rol del usuario
            if (auth()->user()->role == 'admin') {
                return redirect()->route('admin.index'); // Redirige al dashboard del administrador
            } else {
                return redirect()->route('empleado.dashboard'); // Redirige al dashboard del empleado
            }
        }
    }

    public function destroy() {
        auth()->logout();
        return redirect()->to('/');
    }
}
