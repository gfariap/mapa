<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    "accepted"         => "O campo :attribute deve ser aceito.",
    "active_url"       => "O campo :attribute não contém uma URL válida.",
    "after"            => "O campo :attribute deve conter uma data posterior a :date.",
    "alpha"            => "O campo :attribute deve conter apenas letras.",
    "alpha_dash"       => "O campo :attribute deve conter apenas letras, números e traços.",
    "alpha_num"        => "O campo :attribute deve conter apenas letras e números .",
    "array"            => "O campo :attribute precisa ser uma lista.",
    "before"           => "O campo :attribute deve conter uma data anterior a :date.",
    "between"          => [
        "numeric" => "O campo :attribute deve ter um valor entre :min e :max.",
        "file"    => "O arquivo :attribute deve ter um tamanho entre :min e :max kilobytes.",
        "string"  => "O campo :attribute deve conter entre :min e :max caracteres.",
        "array"   => "A lista de :attribute precisa ter entre :min e :max itens.",
    ],
    "boolean"          => "O campo :attribute deve ter o valor verdadeiro ou falso.",
    "confirmed"        => "A confirmação para o campo :attribute não coincide.",
    "date"             => "O campo :attribute não contém uma data válida.",
    "date_format"      => "A data indicada para o campo :attribute não respeita o formato :format.",
    "different"        => "Os campos :attribute e :other deverão conter valores diferentes.",
    "digits"           => "O campo :attribute deve conter :digits dígitos.",
    "digits_between"   => "O campo :attribute deve conter entre :min e :max dígitos.",
    "email"            => "O campo :attribute não contém um endereço de email válido.",
    "exists"           => "O valor selecionado para o campo :attribute é inválido.",
    "filled"           => "É obrigatória a indicação de um valor para o campo :attribute.",
    "image"            => "O campo :attribute deve conter uma imagem.",
    "in"               => "O campo :attribute não contém um valor válido.",
    "integer"          => "O campo :attribute deve conter um número inteiro.",
    "ip"               => "O campo :attribute deve conter um IP válido.",
    "max"              => [
        "numeric" => "O campo :attribute não deve conter um valor superior a :max.",
        "file"    => "O arquivo :attribute não deve ter um tamanho superior a :max kilobytes.",
        "string"  => "O campo :attribute não deve conter mais de :max caracteres.",
        "array"   => "A lista de :attribute deve ter no máximo :max itens.",
    ],
    "mimes"            => "O campo :attribute deve conter um arquivo do tipo: :values.",
    "min"              => [
        "numeric" => "O campo :attribute deve ter um valor superior ou igual a :min.",
        "file"    => "O arquivo :attribute deve ter no mínimo :min kilobytes.",
        "string"  => "O campo :attribute deve conter no mínimo :min caracteres.",
        "array"   => "A lista de :attribute deve ter no mínimo :min itens.",
    ],
    "not_in"           => "O campo :attribute contém um valor inválido.",
    "numeric"          => "O campo :attribute deve conter um valor numérico.",
    "regex"            => "O formato do valor para o campo :attribute é inválido.",
    "required"         => "É obrigatória a indicação de um valor para o campo :attribute.",
    "required_if"      => "É obrigatória a indicação de um valor para o campo :attribute quando o valor do campo :other é igual a :value.",
    "required_with"    => "É obrigatória a indicação de um valor para o campo :attribute quando :values está presente.",
    "required_with_all" => "É obrigatória a indicação de um valor para o campo :attribute quando um dos :values está presente.",
    "required_without" => "É obrigatória a indicação de um valor para o campo :attribute quando :values não está presente.",
    "required_without_all" => "É obrigatória a indicação de um valor para o campo :attribute quando nenhum dos :values está presente.",
    "same"             => "Os campos :attribute e :other devem conter valores iguais.",
    "size"             => [
        "numeric" => "O campo :attribute deve conter o valor :size.",
        "file"    => "O arquivo :attribute deve ter o tamanho de :size kilobytes.",
        "string"  => "O campo :attribute deve conter :size caracteres.",
        "array"   => "A lista de :attribute deve ter :size itens.",
    ],
    "string"           => "O campo :attribute deve ser uma string.",
    "timezone"         => "O campo :attribute deve ter um fuso horário válido.",
    "unique"           => "O valor indicado para o campo :attribute já se encontra utilizado.",
    "url"              => "O formato de URL indicado para o campo :attribute é inválido.",
    "phone"            => "O valor informado não é um telefone válido.",
    "cpf"              => "O valor informado não é um CPF válido.",
    "cnpj"             => "O valor informado não é um CNPJ válido.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];