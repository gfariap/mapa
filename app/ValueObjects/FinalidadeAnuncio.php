<?php

namespace App\ValueObjects;

class FinalidadeAnuncio extends ValueList
{

    const ALUGUEL = 'aluguel';
    const COMPRA = 'compra';

    protected $_all = [
        self::ALUGUEL => 'Aluguel',
        self::COMPRA  => 'Compra'
    ];

}