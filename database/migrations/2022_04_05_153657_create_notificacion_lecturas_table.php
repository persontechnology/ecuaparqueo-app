<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionLecturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacion_lecturas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('lectura_id')->constrained('lecturas');
            $table->foreignId('guardia_id')->constrained('users');
            $table->foreignId('brazo_id')->constrained('brazos');
            $table->string('mensaje')->nullable();
            $table->boolean('visto')->default(false);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificacion_lecturas');
    }
}
