<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturaInvitadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectura_invitados', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('tipo',['Salida','Entrada','Revisión'])->nullable();
            $table->string('motivo')->nullable();
            $table->boolean('finalizado')->default(false);

            $table->dateTime('fecha_salida')->nullable();
            $table->dateTime('fecha_entrada')->nullable();
            
            $table->foreignId('brazo_id')->nullable()->constrained('brazos');
            $table->foreignId('vehiculo_id')->nullable()->constrained('vehiculos');
            $table->foreignId('guardia_id')->nullable()->constrained('users');
            $table->foreignId('espacio_id')->nullable()->constrained('espacios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lectura_invitados');
    }
}
