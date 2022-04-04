<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('tipo',['Salida','Entrada'])->nullable();
            $table->string('porcentaje_combustible')->nullable();
            $table->string('kilometraje')->nullable();
            
            $table->foreignId('brazo_salida_id')->constrained('brazos');
            $table->foreignId('brazo_entrada_id')->nullable()->constrained('brazos');
            
            $table->foreignId('orden_movilizacion_id')->nullable()->constrained('orden_movilizacions');

            $table->foreignId('guardia_id')->nullable()->constrained('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lecturas');
    }
}
