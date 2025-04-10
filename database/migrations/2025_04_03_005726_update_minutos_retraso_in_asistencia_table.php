<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateMinutosRetrasoInAsistenciaTable extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * @return void
     */
    public function up()
    {
        // Verificar explícitamente que la columna existe antes de actualizar
        if (Schema::hasColumn('asistencia', 'minutos_retraso')) {
            DB::table('asistencia')
                ->whereNotNull('minutos_retraso')
                ->where('minutos_retraso', '>', 1440)
                ->update([
                    'minutos_retraso' => DB::raw('LEAST(minutos_retraso, 1440)')
                ]);
        }
    }

    public function down()
    {
        // No es necesario revertir esta operación
        // (no podemos determinar los valores originales)
    }
}
