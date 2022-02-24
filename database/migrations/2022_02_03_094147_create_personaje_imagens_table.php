<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonajeImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personaje_imagen', function (Blueprint $table) {
            $table->id();
            $table->string('nombreArchivo',60); 
            $table->string('mimetype',40);  
            $table->bigInteger('idpersonaje')->unsigned(); 
            
            $table->foreign('idpersonaje')->references('id')->on('personaje');
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
        Schema::dropIfExists('personaje_imagens');
    }
}
