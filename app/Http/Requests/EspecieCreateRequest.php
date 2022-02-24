<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EspecieCreateRequest extends FormRequest
{
     public function attributes()
    {
        return [
            'nombre' => 'nombre de la especie',
            'idioma' => 'idioma de la especie',
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
            'idioma.required'       => $required,
            'idioma.min'            => $min,
            'idioma.max'            => $max,
            'idioma.unique'         => $unique,
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
            Rule::unique('especie')->where('nombre', $this->nombre)->where('idusuario', auth()->user()->id)
            ], 
            'idioma' => 'required|min:2|max:50', 
        ];
    }
}
