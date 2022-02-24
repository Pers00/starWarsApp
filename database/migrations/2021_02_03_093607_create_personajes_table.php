<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personaje', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $generos=[
                "Masculino",
                "Femenino",
                "Desconocido",
                "No binario",
                ];
            $table->enum('genero', $generos);
            $table->decimal('altura',9 , 2)->default(0);
            $table->decimal('peso',9 , 1)->default(0);
            $epocas=[
                "Era Pre-República",
                "Era de la Antigua Republica",
                "Era del Alzamiento del Imperio",
                "Era de la Rebelión",
                "Era de la Nueva República",
                "Era de la Nueva Orden Jedi",
                ];
            $table->enum('epoca', $epocas);
            
            $table->bigInteger('idespecie')->unsigned();
            $table->bigInteger('idusuario')->unsigned();
            
            $table->foreign('idespecie')->references('id')->on('especie');
            $table->foreign('idusuario')->references('id')->on('users');
             
            $table->timestamps();
            
            $table->unique(['nombre', 'idusuario']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personajes');
    }
}
