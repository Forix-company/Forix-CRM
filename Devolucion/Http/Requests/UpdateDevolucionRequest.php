<?php

namespace Modules\Devolucion\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDevolucionRequest extends FormRequest
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
            'Proveedor' => 'required',
            'Producto' => 'required',
            'Stock' => 'required',
            'solicitud' => 'required',
            'MotivoDevolucion' => 'required',
            'SoporteGarantia' => 'required|mimes:pdf',
            'observacion' => 'required',

        ];
    }
}
