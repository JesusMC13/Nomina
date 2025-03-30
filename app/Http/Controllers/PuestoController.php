<?php
namespace App\Http\Controllers;

use App\Models\Puesto;
use App\Models\Empleado;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    // Método para ver la lista de puestos
    public function index()
    {
        $puestos = Puesto::all();
        return view('adminn.puestos.index', compact('puestos'));
    }

    // Método para crear un nuevo puesto
    public function create()
    {
        return view('adminn.puestos.create');
    }

    // Método para almacenar un nuevo puesto
    public function store(Request $request)
    {
        $request->validate([
            'nombre_puesto' => 'required|string|max:255',
            'salario_base' => 'required|numeric',
        ]);

        Puesto::create($request->all());

        return redirect()->route('adminn.puestos.index')->with('success', 'Puesto creado correctamente');
    }

    // Método para editar un puesto
    public function edit($id)
    {
        $puesto = Puesto::findOrFail($id);
        return view('adminn.puestos.edit', compact('puesto'));
    }

    // Método para actualizar un puesto
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_puesto' => 'required|string|max:255',
            'salario_base' => 'required|numeric',
        ]);

        $puesto = Puesto::findOrFail($id);
        $puesto->update($request->all());

        return redirect()->route('adminn.puestos.index')->with('success', 'Puesto actualizado correctamente');
    }

    // Método para eliminar un puesto
    public function destroy($id)
    {
        $puesto = Puesto::findOrFail($id);
        $puesto->delete();

        return redirect()->route('adminn.puestos.index')->with('success', 'Puesto eliminado correctamente');
    }

    // Método para mostrar el formulario de asignación de puesto
    public function assignPuestoForm()
    {
        // Obtener todos los empleados y puestos
        $empleados = Empleado::all();
        $puestos = Puesto::all();

        // Mostrar la vista con los datos
        return view('adminn.puestos.asignar', compact('empleados', 'puestos'));
    }
    public function assignPuesto(Request $request)
    {
        // Verificar si el request contiene los valores necesarios
        $empleado = Empleado::find($request->empleado_id);
        
        if ($empleado) {
            $empleado->id_puesto = $request->puesto_id;  // Asegúrate de que el campo sea 'id_puesto'
            $empleado->save();
    
            return redirect()->route('adminn.empleados.puestos')->with('success', 'Puesto asignado correctamente');
        }
    
        return redirect()->route('adminn.empleados.puestos')->with('error', 'Empleado no encontrado');
    }
    

    // Método para ver empleados con sus puestos asignados
    public function showEmpleadosWithPuestos()
    {
        // Obtener todos los empleados con sus puestos asignados
        $empleados = Empleado::with('puesto')->get();
        
        // Mostrar la vista con los empleados y sus puestos
        return view('adminn.puestos.verEmpleados', compact('empleados'));
    }
}

