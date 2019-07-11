<?php

namespace Gastos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagamentosRequest extends FormRequest
{
    /**
     * Determine if the tipo is authorized to make this request.
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
            'valor' => 'required',
            'data_referencia' => 'required'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'The :attribute field can not be empty.',
        ];
    }
}
