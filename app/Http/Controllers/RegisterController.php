<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller {
    
    public function create() {
        
        return view('auth.register');
    }

    public function store() {

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = User::create(request(['name', 'email', 'password']));

        return redirect()->route('login.index')->with('success', 'Registro exitoso. Inicia sesión.');
    }
}
