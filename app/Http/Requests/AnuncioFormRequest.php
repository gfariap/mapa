<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\ValueObjects\FinalidadeAnuncio;

class AnuncioFormRequest extends Request
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
            'titulo'     => 'required|max:255',
            'valor'      => 'required|numeric',
            'finalidade' => 'required|in:' . FinalidadeAnuncio::listOfKeysAsString(),
            'quartos'    => 'required|integer|min:1|max:9',
            'suites'     => 'required|integer|min:0|max:9',
            'garagem'    => 'required|integer|min:0|max:9',
            'coluna_id'  => 'required|exists:colunas,id'
        ];
    }
}
