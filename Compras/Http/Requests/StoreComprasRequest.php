<?php

namespace Modules\Compras\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComprasRequest extends FormRequest
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
            'TipoCompra' => 'required',
            'Proveedor' => 'required',
            'ProveedorProducto' => 'required',
            'Estado' => 'required',
            'Precio' => 'required',
            'Total' => 'required',
            'Cantidad' => 'required',
            'brochure' => 'required',
        ];
    }
}
