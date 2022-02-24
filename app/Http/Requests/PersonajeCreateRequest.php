<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonajeCreateRequest extends FormRequest
{
    public function attributes()
    {
        return [
            'nombre' => 'nombre del personaje',
            'genero' => 'genero del personaje',
            'altura' => 'altura del personaje',
            'peso' => 'peso del personaje',
            'epoca' => 'epoca delp personaje',
            ];
    }
    
    public function authorize()
    {
        return true;
    }
    
    
     public function messages() {
        $gte = 'El campo :attribute debe ser igual o superior :value';
        $lte = 'El campo :attribute debe ser igual o menor :value';
        $max = 'El campo :attribute no puede ser mas de :max caracteres';
        $min = 'El campo :attribute no puede tener menos de :min caracteres';
        $required = 'El campo :attribute es requerido';
        $unique = 'El campo :attribute debe ser unico';
        $numeric = 'El campo :attribute debe ser númerico';
        
        return [
            'nombre.required'       => $required,
            'nombre.min'            => $min,
            'nombre.max'            => $max,
            'genero.required'       => $required,
            'genero.min'            => $min,
            'genero.max'            => $max,
            'altura.required'       => $required,
            'altura.numeric'        => $numeric,
            'altura.gte'            => $gte,
            'altura.lte'            => $lte,
            'peso.required'       => $required,
            'peso.numeric'        => $numeric,
            'peso.gte'            => $gte,
            'peso.lte'            => $lte,
            'epoca.required'       => $required,
            'epoca.min'            => $min,
            'epoca.max'            => $max,
        ];
        
}
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'=> [
            'required',
            'min:2',
            'max:50',
            Rule::unique('personaje')->where('nombre', $this->nombre)->where('idusuario', auth()->user()->id)
            ], 
            'genero' => 'required|min:2|max:80', 
            'altura' => 'required|gte:0.00|lte:999999999.00|numeric',
            'peso' => 'required|gte:0.00|lte:999999999.0|numeric',
            'epoca' => 'required|min:2|max:170', 
        ];
    }
}
