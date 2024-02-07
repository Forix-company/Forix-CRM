<?php

namespace Modules\Productos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductosRequest extends FormRequest
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
            'categoria_id' => 'required',
            'etiqueta_id' => 'required',
            'fabricante_id' => 'required',
            'inventarioMin' => 'required',
            'NombreProducto' => 'required',
            'DescripcionProducto' => 'required'
        ];
    }
}
