<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numero_movil')->unique();
            $table->string('placa');
            $table->string('color')->nullable();
            $table->string('modelo')->nullable();
            $table->string('marca')->nullable();
            $table->string('foto')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('imei')->nullable();
            $table->string('codigo_tarjeta')->nullable();
            $table->enum('estado',['Activo','Inactivo','Presente','Ausente'])->default('Activo');
            $table->enum('tipo',['Normal','Invitados','Especial'])->default('Normal');

            $table->foreignId('conductor_id')->nullable()->constrained('users');
            $table->foreignId('tipo_vehiculo_id')->nullable()->constrained('tipo_vehiculos');
            $table->bigInteger('user_create')->nullable();
            $table->bigInteger('user_update')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
