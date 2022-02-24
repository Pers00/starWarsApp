<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanetaEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function attributes()
    {
        return [
            'nombre' => 'nombre del planeta',
            'poblacion' => 'poblacion del planeta',
            'region' => 'region del planeta',
            
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
            'nombre.required'       => $required, // mensaje que vas a enseñar si falla esa regla
            'nombre.min'            => $min,
            'nombre.max'            => $max,
            'nombre.unique'         => $unique,
            'poblacion.required'       => $required,
            'poblacion.numeric'        => $numeric,
            'poblacion.gte'            => $gte,
            'poblacion.lte'            => $lte,
            'region.required'       => $required,
            'region.min'            => $min,
            'region.max'            => $max,
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
            Rule::unique('planeta')->ignore($this->id)->where('nombre', $this->nombre)->where('idusuario', auth()->user()->id)
            ],
            'poblacion' => 'required|gte:0|lte:99999999999999999999|numeric',
            'region' => 'required|min:2|max:170', 
        ];
    }
}
