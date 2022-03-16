<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('nombre')->default('nombre');
            $table->string('logo')->default('logo');
            $table->string('descripcion')->default('descripcion');
            $table->date('fecha_caducidad_inicio')->default(now());
            $table->date('fecha_caducidad_fin')->default(now());
            $table->enum('estado',['Activo','Inactivo'])->default('Activo');
            $table->enum('tipo',['Pública','Privada'])->default('Pública');
            $table->string('token')->nullable();

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
        Schema::dropIfExists('empresas');
    }
}
