<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrazosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brazos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->integer('estado_brazo')->default(0);
            $table->string('descripcion');
            $table->enum('estado',['Activo','Inactivo'])->default('Activo');
            $table->foreignId('parqueadero_id')->constrained('parqueaderos');
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
        Schema::dropIfExists('brazos');
    }
}
