<?php

namespace CEPROZAC\Http\Requests;

use CEPROZAC\Http\Requests\Request;

class EntradasAlmacenLimpiezaRequest extends Request
{
     protected $redirect = "almacen/entradas/limpieza/create";
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
        'imagen'=>'mimes:jpeg,jpg,png,bmp',
        'codigo' => 'unique:almacenagroquimicos,codigo',
           'factura' => 'unique:entradasalmacenlimpieza,factura',
            //
        ];
    }
     public function messages(){
        return [
        /**
            'nombre.required' => 'El campo nombre es requerido',
            'nombre.unique'=> 'El Campo Nombre ya ha sido insertado antes',
            'nombre.min' => 'El mínimo permitido son 3 caracteres',
            'nombre.max' => 'El máximo permitido son 12 caracteres',
            'nombre.regex' => 'Sólo se aceptan letras',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El formato de email es incorrecto',
             'email.unique'=> 'El Campo Email ya ha sido insertado antes',
             */
             'codigo.unique' => 'El CODIGO DE BARRAS ya ha sido registrado anteriormente, Verifique el campo',
             'factura.unique' => 'La Factura Insertada,  ya ha sido registrada anteriormente, Verifique el Campo',
        ];
    }
    public function response(array $errors){
        if ($this->ajax()){
            return response()->json($errors, 200);
        }
        else
        {
        return redirect($this->redirect)
                ->withErrors($errors, 'formulario')
                ->withInput();
        }
    }
}
