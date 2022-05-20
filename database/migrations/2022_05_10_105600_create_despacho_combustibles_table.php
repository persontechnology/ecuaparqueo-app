<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDespachoCombustiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despacho_combustibles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('numero');
            $table->string('codigo');
            $table->date('fecha')->nullable();
            $table->dateTime('fecha_despacho')->nullable();
            $table->string('kilometraje')->nullable();
            $table->string('destino')->nullable();
            $table->enum('concepto',['Gasolina Extra','Gasolina Super','Diesel'])->nullable();
            $table->decimal('cantidad_galones',9,2)->nullable();
            $table->string('cantidad_letras')->nullable();
            $table->decimal('valor',9,2)->nullable();
            $table->string('valor_letras')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('foto')->nullable();
            $table->enum('estado',['Autorizado','Anulado','Despachado'])->default('Autorizado');
            $table->foreignId('chofer_id')->nullable()->constrained('users');
            $table->foreignId('vehiculo_id')->nullable()->constrained('vehiculos');
            $table->foreignId('despachador_id')->nullable()->constrained('users');
            $table->foreignId('estacion_id')->nullable()->constrained('estacions');
            $table->foreignId('autorizado_id')->constrained('users');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('despacho_combustibles');
    }
}
