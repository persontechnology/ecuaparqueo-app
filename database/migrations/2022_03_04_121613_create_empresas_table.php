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
            $table->string('codigo')->default('codigo');
            $table->string('version')->default('1.0');
            $table->string('norma')->default('ISO 9001:2015');
            $table->date('fecha_caducidad_inicio')->default(now());
            $table->date('fecha_caducidad_fin')->default(now());
            $table->enum('estado',['Activo','Inactivo'])->default('Activo');
            $table->enum('tipo',['Pública','Privada'])->default('Pública');
            $table->string('url_web_gps')->nullable();
            $table->string('token')->nullable();
            $table->string('codigo_tarjeta_vehiculo_invitado')->default('');
            $table->integer('minutos_extras_entrada_vehiculos')->default(0);

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
