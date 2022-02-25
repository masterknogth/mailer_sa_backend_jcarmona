<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rol');
            $table->string('nombre', 100);
            $table->string('telefono', 10);
            $table->string('cedula', 11);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('fecha_nacimiento');
            $table->string('codigo_ciudad');
            $table->integer('city_id')->unsigned()->index();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities');

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
        Schema::dropIfExists('users');
    }
};
