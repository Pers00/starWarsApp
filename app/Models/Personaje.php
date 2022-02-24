<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personaje extends Model
{
    use HasFactory;
    
    protected $table ='personaje';
    
    public $timestamps= false;
    
    protected $fillable = ['nombre', 'genero','altura', 'peso', 'epoca' , 'idespecie', 'idusuario'];
    
    protected $attributes = ['altura' => 0,'peso' => 0];
    
    function especie(){
        return $this->belongsTo('App\Models\Especie', 'idespecie');
    }
    function usuario(){
        return $this->belongsTo('App\Models\Users', 'idusuario');
    }
    function destacado(){
        return $this->hasMany('App\Models\Users', 'iddestacado');
    }
    function imagen(){
        return $this->hasMany('App\Models\PersonajeImagen', 'idpersonaje');
    }
}
