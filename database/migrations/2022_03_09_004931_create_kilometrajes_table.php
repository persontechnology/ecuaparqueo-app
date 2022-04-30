<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKilometrajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kilometrajes', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->foreignId('vehiculo_id')->constrained('vehiculos');
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
        Schema::dropIfExists('kilometrajes');
    }
}
