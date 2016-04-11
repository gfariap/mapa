<?php

namespace App\ValueObjects;

class ValueList
{

    protected $_all = [ ];


    /**
     * Retorna uma lista preparada para dropdowns, com os valores como keys e os nomes formatados como values.
     *
     * @return array
     */
    public static function listForDropdown($emptyOption = false)
    {
        return ( $emptyOption ? [ '' => '-' ] : [ ] ) + (new static)->_all;
    }


    /**
     * Retorna um array com todas as possibilidades de valores da lista.
     *
     * @return array
     */
    public static function listOfKeys()
    {
        return array_keys((new static)->_all);
    }


    /**
     * Retorna uma string com todas as possivilidades de valores da lista, separadas pelo separador informado.
     * Caso nenhum separador seja informado, o padrão é usar uma vírgula, sem espaços.
     *
     * @param string $separator
     *
     * @return string
     */
    public static function listOfKeysAsString($separator = ',')
    {
        return implode($separator, array_keys((new static)->_all));
    }


    /**
     * Retorna um array com todas as possibilidades de nomes formatados da lista.
     *
     * @return array
     */
    public static function listOfValues()
    {
        return array_values((new static)->_all);
    }


    /**
     * Retorna o nome formatado referente ao valor informado.
     * Se o valor não for encontrado, retorna null.
     *
     * @param string $key
     *
     * @return string|null
     */
    public static function get($key)
    {
        $instance = new static;

        return ( isset( $instance->_all[$key] ) ? $instance->_all[$key] : null );
    }


    /**
     * Recebe uma lista de valores e retorna uma lista de valores formatados.
     *
     * @param array  $list
     * @param string $separator
     *
     * @return mixed
     */
    public static function getList($list, $separator = ', ')
    {
        $formatted = [ ];

        $keys = explode($separator, $list);
        foreach ($keys as $key) {
            $formatted[] = self::get($key);
        }

        return implode($separator, $formatted);
    }

}