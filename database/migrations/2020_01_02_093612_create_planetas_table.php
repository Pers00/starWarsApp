<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planeta', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->bigInteger('poblacion')->default(0); 
            $regiones=[
                "Nucleo profundo",
                "Mundos del Núcleo",
                "Colonias",
                "Territorios del Borde Interior",
                "Territorios del Borde Medio",
                "Territorios del Borde Exterior",
                "Regiones Desconocidas",
                ];
            $table->enum('region', $regiones);
            
            $table->bigInteger('idusuario')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('idusuario')->references('id')->on('users');
            $table->unique(['nombre', 'idusuario']); // crearlos juntos unique 
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planeta');
    }
}
