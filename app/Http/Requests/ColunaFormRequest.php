<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ColunaFormRequest extends Request
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
        $rules = [
            'titulo'  => 'required|max:255',
            'planta'  => 'required|image',
            'area'    => 'required|numeric',
            'quartos' => 'required|integer|min:1|max:9',
            'suites'  => 'required|integer|min:0|max:9',
            'garagem' => 'required|integer|min:0|max:9'
        ];

        switch ($this->method()) {
            case 'DELETE':
                return [ ];
            case 'PUT':
            case 'PATCH':
                $rules['planta'] = 'image';
                break;
            default:
                break;
        }

        return $rules;
    }
}
