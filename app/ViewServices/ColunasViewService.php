<?php

namespace App\ViewServices;

use App\Coluna;

class ColunasViewService
{

    public function dropdownOptions($emptyOption = false)
    {
        return ($emptyOption ? [ '' => '-' ] : []) +
            Coluna::join('empreendimentos', 'empreendimentos.id', '=', 'colunas.empreendimento_id')
            ->select(\DB::raw("CONCAT(empreendimentos.nome, CONCAT(' - ', colunas.titulo)) as nome"), 'colunas.id')
            ->lists('nome', 'id')->toArray();
    }

}