<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    use HasFactory;
        
    protected $table ='especie';
    
    public $timestamps= false;
    
    protected $fillable = ['nombre', 'idioma','idplaneta', 'idusuario'];
    
    // protected $attributes = ['capacity' => 0,'budget' => 0];
    
  
    function planeta(){
        return $this->belongsTo('App\Models\Planeta', 'idplaneta');
    }
     function usuario(){
        return $this->belongsTo('App\Models\Users', 'idusuario');
    }
    function personajes(){
        return $this->hasMany('App\Models\Personaje', 'idespecie');
    }
}
