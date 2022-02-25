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
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->unsigned()->index()->comment('id del usuario que envio el correo');
            $table->foreign('user_id')
                 ->references('id')
                 ->on('users')
                 ->onDelete('CASCADE');
            $table->string('destino');
            $table->string('asunto');
            $table->string('contenido');
            $table->string('estado');
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
        Schema::dropIfExists('emails');
    }
};
