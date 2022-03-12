<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardiaParqueaderosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardia_parqueaderos', function (Blueprint $table) {
            $table->id();
            $table->enum('estado',['Activo','Inactivo'])->default('Activo');
            $table->foreignId('parqueadero_id')->constrained('parqueaderos');
            $table->foreignId('guardia_id')->constrained('users');
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
        Schema::dropIfExists('guardia_parqueaderos');
    }
}
