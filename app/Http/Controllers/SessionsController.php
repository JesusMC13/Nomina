<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SessionsController extends Controller {
    
    public function create() {
        return view('auth.login');
    }

    public function store() {
        $credentials = request()->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return back()->withErrors(['message' => 'El correo o la contraseña son incorrectos']);
        }

        return auth()->user()->role == 'admin' 
            ? redirect()->route('admin.index') 
            : redirect()->route('empleado.dashboard');
    }

    public function destroy() {
        auth()->logout();
        return redirect('/');
    }
}
