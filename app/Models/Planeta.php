<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planeta extends Model
{
    use HasFactory;
        
    protected $table ='planeta';
    
    public $timestamps= false;
    
    protected $fillable = ['nombre', 'poblacion','region', 'idusuario'];
    
    protected $attributes = ['poblacion' => 0];
    
    function especies(){
        return $this->hasMany('App\Models\Especie', 'idplaneta');
    }
    function usuario(){
        return $this->belongsTo('App\Models\Usuario', 'idusuario');
    }
}
