    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\RegisterController;
    use App\Http\Controllers\SessionsController;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\DiaDescansoController;
    use App\Http\Controllers\TurnoController;
    use App\Http\Controllers\AsignarTurnoController;
    use App\Http\Controllers\ModificarTurnoController;
    use App\Http\Controllers\AsignarDiasDescansoController;
    use App\Http\Controllers\AsistenciaController;
    use App\Http\Controllers\EmpleadoAsistenciaController;
    use App\Http\Controllers\RetardoController;
    use App\Http\Controllers\AplicarDescuentoController;
    use App\Http\Controllers\EmpleadoController;
    use App\Http\Controllers\PuestoController;


    Route::get('/', function () {
        return view('home'); // Redirige a home.blade.php
    })->name('home');


    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login'); // Redirige a la vista "login"
    })->name('logout');



    Route::get('/register', [RegisterController::class, 'create'])
        ->middleware('guest')
        ->name('register.index');

    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');



        Route::get('/login', [SessionsController::class, 'create'])->middleware('guest')->name('login.index');
        Route::post('/login', [SessionsController::class, 'store'])->name('login.store');
        Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
        
        Route::middleware('auth')->group(function () {
            Route::get('/empleado/dashboard', function () {
                return view('user_dashboard');
            })->name('empleado.dashboard');
        });
        


    Route::get('/admin', [AdminController::class, 'index'])
        ->middleware('auth.admin')
        ->name('admin.index');

    Route::middleware(['auth', 'auth.admin'])->prefix('adminn')->name('adminn.')->group(function () {
        Route::resource('dias_descanso', DiaDescansoController::class);
    });

    Route::middleware(['auth', 'auth.admin'])->prefix('adminn')->name('adminn.')->group(function () {
        Route::resource('turnos', TurnoController::class);
    });

    Route::middleware(['auth', 'auth.admin'])->prefix('adminn')->name('adminn.')->group(function () {
        Route::get('/asignar-turnos', [AsignarTurnoController::class, 'index'])->name('asignar.turnos');  // Listado de empleados
        Route::get('/asignar-turno/{ID_empleado}', [AsignarTurnoController::class, 'show'])->name('asignar.turno.form');  // Mostrar formulario de asignación de turno
        Route::post('/asignar-turno/{ID_empleado}', [AsignarTurnoController::class, 'asignarTurno'])->name('asignar.turno');  // Procesar asignación de turno
    });

    Route::middleware(['auth', 'auth.admin'])->prefix('adminn')->name('adminn.')->group(function () {
        // Rutas de puestos
        Route::get('/puestos', [PuestoController::class, 'index'])->name('puestos.index');
        Route::get('/puestos/create', [PuestoController::class, 'create'])->name('puestos.create');
        Route::post('/puestos', [PuestoController::class, 'store'])->name('puestos.store');
        Route::get('/puestos/edit/{id}', [PuestoController::class, 'edit'])->name('puestos.edit');
        Route::put('/puestos/{id}', [PuestoController::class, 'update'])->name('puestos.update');
        Route::delete('/puestos/{id}', [PuestoController::class, 'destroy'])->name('puestos.destroy');
        
        // Ruta para mostrar el formulario de asignación de puestos
        Route::get('/asignar/puestos', [PuestoController::class, 'assignPuestoForm'])->name('asignar.puestos');
    
        // Ruta para asignar un puesto a un empleado
        Route::post('/asignar/puestos', [PuestoController::class, 'assignPuesto'])->name('asignar.puestos.assign');
        
        // Ruta para ver empleados con sus puestos asignados
        Route::get('/empleados/puestos', [PuestoController::class, 'showEmpleadosWithPuestos'])->name('empleados.puestos');
    });
    

    Route::get('/empleados/asignar-turnos', [AsignarTurnoController::class, 'index'])->name('adminn.asignar.turnos');
Route::get('/empleados/{ID_empleado}/asignar-turno', [AsignarTurnoController::class, 'show'])->name('adminn.asignar.turno.form');
Route::post('/empleados/{ID_empleado}/asignar-turno', [AsignarTurnoController::class, 'asignarTurno'])->name('adminn.asignar.turno');




    Route::middleware(['auth', 'auth.admin'])->prefix('adminn')->name('adminn.')->group(function () {
        Route::get('/modificar-turnos', [ModificarTurnoController::class, 'index'])->name('modificar.turnos');
        Route::get('/modificar-turno/{ID_empleado}', [ModificarTurnoController::class, 'showModificarTurnoForm'])->name('modificar.turno.form');
        Route::post('/modificar-turno/{ID_empleado}', [ModificarTurnoController::class, 'modificarTurno'])->name('modificar.turno');
    });

    Route::prefix('adminn/asignardiasdescanso')->group(function () {
        Route::get('/', [AsignarDiasDescansoController::class, 'index'])->name('adminn.asignardiasdescanso.index');
        Route::get('/create', [AsignarDiasDescansoController::class, 'create'])->name('adminn.asignardiasdescanso.create');
        Route::post('/store', [AsignarDiasDescansoController::class, 'store'])->name('adminn.asignardiasdescanso.store');
        Route::get('/edit/{id}', [AsignarDiasDescansoController::class, 'edit'])->name('adminn.asignardiasdescanso.edit');
        Route::put('/update/{id}', [AsignarDiasDescansoController::class, 'update'])->name('adminn.asignardiasdescanso.update');
        Route::delete('/destroy/{id}', [AsignarDiasDescansoController::class, 'destroy'])->name('adminn.asignardiasdescanso.destroy');
    });
    


    Route::prefix('adminn/asignardiasdescanso')->group(function () {
        Route::get('/', [AsignarDiasDescansoController::class, 'index'])->name('adminn.asignardiasdescanso.index');
        Route::get('/create', [AsignarDiasDescansoController::class, 'create'])->name('adminn.asignardiasdescanso.create');
        Route::post('/store', [AsignarDiasDescansoController::class, 'store'])->name('adminn.asignardiasdescanso.store');
        Route::get('/edit/{id}', [AsignarDiasDescansoController::class, 'edit'])->name('adminn.asignardiasdescanso.edit');
        Route::put('/update/{id}', [AsignarDiasDescansoController::class, 'update'])->name('adminn.asignardiasdescanso.update');
        Route::delete('/destroy/{id}', [AsignarDiasDescansoController::class, 'destroy'])->name('adminn.asignardiasdescanso.destroy');
    });

    Route::prefix('adminn')->name('adminn.')->group(function() {
        Route::get('/asistencias', [AsistenciaController::class, 'index'])->name('asistencias.index');
    });



    Route::prefix('adminn')->middleware('auth')->group(function () {
        Route::get('/retardo', [RetardoController::class, 'index'])->name('adminn.retardos.index');
    });


    Route::prefix('adminn')->middleware('auth')->group(function () {
        Route::get('/aplicardescuento', [AplicarDescuentoController::class, 'index'])->name('adminn.aplicardescuento.index');
        Route::post('/aplicardescuento/aplicar', [AplicarDescuentoController::class, 'aplicarDescuento'])->name('adminn.aplicardescuento.aplicarDescuento');
    });

    Route::prefix('adminn')->middleware('auth')->group(function () {
        Route::get('/empleados', [EmpleadoController::class, 'index'])->name('adminn.empleados.index');
    });
    

    

    

//dashboard empleado use App\Http\Controllers\Empleado\AsistenciaController;

Route::prefix('empleado')->middleware(['auth'])->group(function () {
    Route::get('/asistencias', [AsistenciaController::class, 'index'])->name('empleado.asistencias.index');
    Route::get('/asistencias/create', [AsistenciaController::class, 'create'])->name('empleado.asistencias.create');
    Route::post('/asistencias', [AsistenciaController::class, 'store'])->name('empleado.asistencias.store');
    Route::delete('/asistencias/{id}', [AsistenciaController::class, 'destroy'])->name('empleado.asistencias.destroy');
});







        
        
        
        
        
        
