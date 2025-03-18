<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller {

    public function index() {
        // Aquí debes retornar la vista admin.index
        return view('admin.index'); // Esto carga la vista correctamente
    }
}
