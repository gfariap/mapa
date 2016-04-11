<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EmpreendimentoFormRequest extends Request
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
            'nome'               => 'required|max:255',
            'fachada'            => 'required|image',
            'apartamentos_andar' => 'required|integer|min:1|max:20',
            'construido_em'      => 'date_format:Y',
            'marinha'            => 'in:1,0'
        ];

        switch ($this->method()) {
            case 'DELETE':
                return [ ];
            case 'PUT':
            case 'PATCH':
                $rules['fachada'] = 'image';
                break;
            default:
                break;
        }

        return $rules;
    }
}
