<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturaNormalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectura_normals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->enum('tipo',['Salida','Entrada','Revisión'])->nullable();
            $table->boolean('finalizado')->default(false);
            $table->integer('porcentaje_combustible')->nullable();
            $table->string('kilometraje')->nullable();
            $table->string('observacion')->nullable();
            $table->enum('proceso_orden_movilizacion',['FINALIZADO','FUERA HORARIO','INCUMPLIDA'])->nullable();
            $table->dateTime('fecha_salida')->nullable();
            $table->dateTime('fecha_entrada')->nullable();
            $table->foreignId('brazo_id')->nullable()->constrained('brazos');
            $table->foreignId('vehiculo_id')->nullable()->constrained('vehiculos');
            $table->foreignId('guardia_id')->nullable()->constrained('users');
            $table->foreignId('orden_movilizacion_id')->nullable()->constrained('orden_movilizacions');
            $table->foreignId('chofer_id')->nullable()->constrained('users');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lectura_normals');
    }
}
