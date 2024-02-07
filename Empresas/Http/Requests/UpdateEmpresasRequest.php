<?php

namespace Modules\Empresas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpresasRequest extends FormRequest
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
            'business_name' => 'required',
            'mail' => 'required',
            'country' => 'required',
            'department' => 'required',
            'city' => 'required',
            'address' => 'required'
        ];
    }
}