<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComunidadEditRequest extends FormRequest
{
      public function attributes()
    {
        return [
            'name' => 'nombre del usuario',
            'email' => 'email del usuario',
            'password' => 'contraseña del usuario',
            'rol' => 'rol que va a tener el usuario'
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
            'name.required'       => $required,
            'name.min'            => $min,
            'name.max'            => $max,
            'email.required'       => $required,
            'email.min'            => $min,
            'email.max'            => $max,
            
            'password.min'            => $min,
            'password.max'            => $max,
            'rol' =>$required,
            'rol' => $min,
            'rol' => $max,
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
            'name' => 'required|min:2|max:50',           
            'email' => 'required|min:6|max:50|unique:users,email,' . $this->id, 
            'password' => 'nullable|min:6|max:50', 
            'rol' => 'required|min:1|max:12',
        ];
    }
}
