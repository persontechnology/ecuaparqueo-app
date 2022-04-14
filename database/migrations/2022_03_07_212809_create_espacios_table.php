<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspaciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espacios', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->enum('estado',['Activo','Inactivo','Presente','Ausente','Solicitado','Reservado'])->default('Activo');
            $table->foreignId('parqueadero_id')->constrained('parqueaderos');
            $table->foreignId('vehiculo_id')->nullable()->constrained('vehiculos');
            $table->bigInteger('user_create')->nullable();
            $table->bigInteger('user_update')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('espacios');
    }
}
