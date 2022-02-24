<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonajeImagen extends Model
{
    use HasFactory;

    protected $table ='personaje_imagen';
    
    public $timestamps= false;
    
    protected $fillable = ['nombreArchivo','mimetype', 'idpersonaje'];
    
    // protected $attributes = ['capacity' => 0,'budget' => 0];
    
    function personajeImagen(){
        return $this->belongsTo('App\Models\Personaje', 'idpersonaje');
    }
     
}
