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

            $table->string('servidor_publico');
            $table->string('direccion');
            $table->string('lugar_comision');
            $table->string('motivo');
            $table->dateTime('fecha_retorno');
            $table->enum('estado',['SOLICITADO','ACEPTADA','DENEGADA','OCUPADO','FINALIZADO'])->default('SOLICITADO');

            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('vehiculo_id')->constrained('vehiculos');

            $table->bigInteger('user_create')->nullable();
            $table->bigInteger('user_update')->nullable();

            $table->bigInteger('user_acepted')->nullable();
            $table->bigInteger('user_denegated')->nullable();
            
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
