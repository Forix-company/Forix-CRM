<?php

namespace Modules\Proveedores\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProveedoresRequest extends FormRequest
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
            'nit' => 'required',
            'nombreProveedor' => 'required',
            'celular' => 'required',
            'producto_ofrecido' => 'required',
            'country' => 'required',
            'estado' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
        ];
    }
}
