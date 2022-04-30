<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenMovilizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_movilizacions', function (Blueprint $table) {
            
            $table->id();
            $table->timestamps();

            $table->string('numero')->unique();
            $table->dateTime('fecha_salida');
            $table->dateTime('fecha_retorno');
            $table->integer('numero_ocupantes');
            $table->string('procedencia');
            $table->string('destino');
            $table->string('comision_cumplir');
            $table->enum('estado',['SOLICITADO','ACEPTADA','DENEGADA','RECORRIDO','FINALIZADO','INCUMPLIDA','FUERA DE HORARIO'])->default('SOLICITADO');

            $table->foreignId('conductor_id')->nullable()->constrained('users');
            $table->foreignId('solicitante_id')->nullable()->constrained('users');
            $table->foreignId('autorizado_id')->nullable()->constrained('users');
            $table->foreignId('vehiculo_id')->constrained('vehiculos');

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
        Schema::dropIfExists('orden_movilizacions');
    }
}
