<?php

namespace App\ValueObjects;

class OpcaoLazer extends ValueList
{

    const SALAO_FESTAS = 'salao_festas';
    const PISCINA = 'piscina';
    const CHURRASQUEIRA = 'churrasqueira';
    const GOURMET = 'gourmet';
    const FITNESS = 'fitness';
    const LAN_HOUSE = 'lan_house';
    const PARQUINHO = 'parquinho';

    protected $_all = [
        self::SALAO_FESTAS  => 'Salão de Festas',
        self::PISCINA       => 'Piscina',
        self::CHURRASQUEIRA => 'Churrasqueira',
        self::GOURMET       => 'Área Gourmet',
        self::FITNESS       => 'Área Fitness',
        self::LAN_HOUSE     => 'Lan House',
        self::PARQUINHO     => 'Parquinho'
    ];

}