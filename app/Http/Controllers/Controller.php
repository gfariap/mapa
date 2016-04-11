<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * Verifica se existe o parâmetro que indica qual o campo da ordenação na requisição.
     * Caso não exista, retorna o valor default.
     *
     * @param $params
     * @param $default
     *
     * @return mixed
     */
    public function getOrderBy($params, $default)
    {
        return isset( $params['order_by'] ) ? $params['order_by'] : $default;
    }


    /**
     * Verifica se existe o parãmetro que indica qual a direção da ordenação na requisição.
     * Caso não exista, retorna o valor default.
     *
     * @param        $params
     * @param string $default
     *
     * @return string
     */
    public function getOrder($params, $default = 'asc')
    {
        return isset( $params['order'] ) ? $params['order'] : $default;
    }
}
