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
    use App\Http\Controllers\AdminAsistenciaController;
    use App\Http\Controllers\HorarioTurnoController;
    use App\Http\Controllers\HorarioEmpleadoController;
    use App\Http\Controllers\DiasDescansoEmpleadoController;
    use App\Http\Controllers\JustificacionController;
    use App\Http\Controllers\AdminJustificacionController;
    use App\Http\Controllers\ReportesController;
    use App\Http\Controllers\DescuentosController;
    use App\Http\Controllers\NominaController;

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

    Route::prefix('adminn')->middleware(['auth', 'auth.admin'])->group(function() {
        // Otras rutas...

        // Rutas para asignación de turnos
        Route::get('/asignar-turnos', [AsignarTurnoController::class, 'index'])
            ->name('adminn.asignar.turnos');

        Route::get('/asignar-turnos/{empleado}', [AsignarTurnoController::class, 'show'])
            ->name('adminn.asignar.turnos.show');

        Route::put('/asignar-turnos/{empleado}', [AsignarTurnoController::class, 'asignarTurno'])
            ->name('adminn.asignar.turnos.update');
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



    Route::prefix('adminn')->middleware(['auth'])->group(function () {
        Route::get('/asistencias', [AdminAsistenciaController::class, 'index'])->name('adminn.asistencias.index');
    });


    Route::prefix('adminn')->middleware('auth')->group(function () {
        Route::get('/retardo', [RetardoController::class, 'index'])->name('adminn.retardos.index');
        Route::post('/retardos/actualizar', [RetardoController::class, 'actualizarTodo'])->name('adminn.retardos.actualizar');
    });


    Route::prefix('adminn')->middleware(['auth', 'auth.admin'])->group(function () {
        // Módulo de Descuentos (usando la estructura existente)
        Route::get('/aplicardescuento', [AplicarDescuentoController::class, 'index'])
            ->name('adminn.aplicardescuento.index');

        Route::post('/aplicardescuento/aplicar', [AplicarDescuentoController::class, 'aplicarDescuento'])
            ->name('adminn.aplicardescuento.aplicar');

        // Ruta para resultados
        Route::get('/aplicardescuento/resultado', [AplicarDescuentoController::class, 'resultado'])
            ->name('adminn.aplicardescuento.resultado');

        Route::get('/empleado/{id}/retardos', [AplicarDescuentoController::class, 'getRetardosEmpleado'])
            ->name('adminn.empleado.retardos');
        Route::prefix('adminn')->group(function() {
            Route::get('/aplicardescuento', [AplicarDescuentoController::class, 'index'])->name('adminn.aplicardescuento.index');
            Route::get('/aplicardescuento/detalle/{id}', [AplicarDescuentoController::class, 'detalle'])->name('adminn.aplicardescuento.detalle');
        });
    });


    Route::prefix('adminn')->middleware('auth')->group(function () {
        Route::get('/empleados', [EmpleadoController::class, 'index'])->name('adminn.empleados.index');
    });

    Route::prefix('adminn')->group(function() {
        Route::get('/horarios', [HorarioTurnoController::class, 'index'])->name('adminn.horarios.index');
        Route::get('/horarios/buscar', [HorarioTurnoController::class, 'buscar'])->name('adminn.horarios.buscar');
        Route::post('/horarios/exportar', [HorarioTurnoController::class, 'exportar'])->name('adminn.horarios.exportar');
    });




    Route::prefix('adminn')->group(function() {
        Route::get('/justificaciones', [AdminJustificacionController::class, 'index'])
            ->name('adminn.justificaciones.index');

        Route::post('/justificaciones/{justificacion}/estado', [AdminJustificacionController::class, 'cambiarEstado'])
            ->name('adminn.justificaciones.estado');

        Route::get('/justificaciones/{justificacion}', [AdminJustificacionController::class, 'show'])
            ->name('adminn.justificaciones.show');
    });


    Route::prefix('adminn/reportes')->name('adminn.reportes.')->middleware('auth')->group(function () {
        Route::get('/', [ReportesController::class, 'index'])->name('index');
        Route::get('/generar', [ReportesController::class, 'generar'])->name('generar');
        Route::post('/generar', [ReportesController::class, 'store'])->name('store');
        Route::get('/ver', [ReportesController::class, 'ver'])->name('ver');
        Route::get('/{id}', [ReportesController::class, 'show'])->name('show');

        // Ruta para exportar a Excel (si es necesaria)
        Route::get('/exportar/{id}', [ReportesController::class, 'exportar'])->name('exportar');

        // Ruta para exportar a PDF (corregida)
        Route::get('/{id}/exportar-pdf', [ReportesController::class, 'exportarPdf'])->name('exportar-pdf');

        // Ruta para eliminar
        Route::delete('/{id}', [ReportesController::class, 'destroy'])->name('destroy');
    });






    //dashboard empleado use App\Http\Controllers\Empleado\AsistenciaController;


Route::prefix('empleado')->middleware(['auth'])->group(function () {
    Route::get('/asistencias', [AsistenciaController::class, 'index'])->name('empleado.asistencias.index');
    Route::get('/asistencias/create', [AsistenciaController::class, 'create'])->name('empleado.asistencias.create');
    Route::post('/asistencias', [AsistenciaController::class, 'store'])->name('empleado.asistencias.store');
    Route::delete('/asistencias/{id}', [AsistenciaController::class, 'destroy'])->name('empleado.asistencias.destroy');
});

    Route::prefix('empleado')->middleware(['auth'])->group(function () {
        Route::get('/horarios', [HorarioEmpleadoController::class, 'index'])->name('empleado.horarios.index');
        Route::get('/horarios/create', [HorarioEmpleadoController::class, 'create'])->name('empleado.horarios.create');
        Route::post('/horarios', [HorarioEmpleadoController::class, 'store'])->name('empleado.horarios.store');
        Route::delete('/horarios/{id}', [HorarioEmpleadoController::class, 'destroy'])->name('empleado.horarios.destroy');
    });

    Route::prefix('empleado')->middleware(['auth'])->group(function () {
        // ... otras rutas existentes

        // Ruta única para días de descanso (solo visualización)
        Route::get('/dias-descanso', [DiasDescansoEmpleadoController::class, 'index'])->name('empleado.dias-descanso.index');
    });


    Route::prefix('empleado')->group(function() {
        // Justificaciones
        Route::get('/justificaciones', [JustificacionController::class, 'index'])
            ->name('empleado.justificaciones.index');
        Route::post('/justificaciones', [JustificacionController::class, 'index'])
            ->name('empleado.justificaciones.store');
        Route::get('/justificaciones/{justificacion}', [JustificacionController::class, 'show'])
            ->name('empleado.justificaciones.show');
    });



    // Rutas para empleados (acceso solo a empleados autenticados)
    // Rutas para empleados (consulta de sus descuentos)
    Route::middleware(['auth'])->prefix('empleado')->name('empleado.')->group(function () {
        Route::get('/descuentos', [DescuentosController::class, 'index'])->name('descuentos.index');
        Route::get('/descuentos/{id}', [DescuentosController::class, 'show'])->name('descuentos.show');
    });

    // routes/web.php

    Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
        // Rutas existentes de descuentos
        Route::resource('descuentos', DescuentosController::class)->except(['index', 'show']);

        // Nuevas rutas para nóminas (solo accesibles por admin)
        Route::get('nominas/create', [NominaController::class, 'create'])->name('nominas.create');
        Route::post('nominas/generar', [NominaController::class, 'generarNomina'])->name('nominas.generate');
    });

    Route::middleware(['auth'])->prefix('empleado')->group(function() {
        // ... otras rutas existentes

        // Rutas de visualización (accesibles por empleados)
        Route::get('/nominas', [NominaController::class, 'index'])->name('empleado.nominas.index');
        Route::get('/nominas/{nomina}', [NominaController::class, 'show'])->name('empleado.nominas.show');
    });
    // routes/web.php
    // Para empleados
    Route::middleware(['auth'])->prefix('empleado')->group(function() {
        Route::get('/nominas', [NominaController::class, 'index'])->name('empleado.nominas.index');
        Route::get('/nominas/{nomina}', [NominaController::class, 'show'])->name('empleado.nominas.show');
    });


