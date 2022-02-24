<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especie', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->string('idioma',50);
            
            $table->bigInteger('idplaneta')->unsigned(); 
            $table->bigInteger('idusuario')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('idplaneta')->references('id')->on('planeta');
            $table->foreign('idusuario')->references('id')->on('users');
            
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
        Schema::dropIfExists('especie');
    }
}
