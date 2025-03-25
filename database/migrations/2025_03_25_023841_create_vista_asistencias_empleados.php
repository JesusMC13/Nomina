<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVistaAsistenciasEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
        {
            DB::statement('
                CREATE VIEW vista_asistencias_empleados AS
                SELECT 
                    e.ID_empleado,
                    CONCAT(e.nombre, " ", e.apellido_paterno, " ", e.apellido_materno) AS nombre_completo,
                    a.fecha,
                    a.hora_inicio,
                    a.hora_fin
                FROM 
                    empleados e
                JOIN 
                    asistencia a ON e.ID_empleado = a.ID_empleado
            ');
        }
        
        public function down()
        {
            DB::statement('DROP VIEW IF EXISTS vista_asistencias_empleados');
        }
    
}
