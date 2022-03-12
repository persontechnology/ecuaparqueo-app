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
            $table->string('placa');
            $table->string('color');
            $table->string('numero_chasis');
            $table->string('foto')->nullable();
            $table->string('descripcion')->nullable();
            $table->enum('estado',['Activo','Inactivo','Presente','Ausente'])->default('Activo');

            $table->foreignId('tipo_vehiculo_id')->constrained('tipo_vehiculos');
            $table->integer('kilometraje_id')->nullable();
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
