<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idcategoria'=> 'required',
            'nombre'=>'required|min:5|max:30',
            'precio_venta'=>'numeric',
            'stock'=>'numeric|min:2',
            'codigo'=>'required',
            'descripcion'=>'min:5|max:50',
        ];
    }

    public function messages()
    {
        return [
        'idcategoria.required'   => 'El campo :attribute es obligatorio.',

        'nombre.required'    =>  'El campo :attribute  es obligatoria.',
        'nombre.min'        => 'El campo :attribute debe contener mas un caracter.',
        'nombre.max'        => 'El campo :attribute debe contener max 30 letras.',
 
        'stock.numeric'   => 'El campo :attribute de contener solo numeros.',

        'codigo.required'        => 'El campo :attribute es obligatoria.',

        'codigo.required'        => 'El campo :attribute es obligatoria.',

        'descripcion.min'        => 'El campo :attribute debe contener mas de un caracter.',
        'descripcion.max'        => 'El campo :attribute debe contener max 50 caracteres.',
        ];
    }

    public function attributes()
    {
        return [
            'idcategoria'   => 'categoria',
            'nombre'        => 'nombre',
            'stock'        => 'stock',
            'precio_venta' => 'precio',
            'codigo'        => 'codigo',
            'descripcion'    => 'descripcion',
        ];
    }
}
