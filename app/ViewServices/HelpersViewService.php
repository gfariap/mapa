<?php

namespace App\ViewServices;

class HelpersViewService
{

    public function verificaRotaAtual($route, $active = 'active')
    {
        if ( ! \Route::current()) {
            return '';
        }

        $current = \Route::current()->getName();

        if ( ! is_array($route)) {
            $route = explode(' ', $route);
        }

        $match = false;

        foreach ($route as $value) {
            if ($this->comparaArraysSeparadosPorPontos($value, $current)) {
                $match = true;
                break;
            }
        }

        return $match ? $active : '';
    }


    public function comparaArraysSeparadosPorPontos($dot1, $dot2)
    {
        $array1 = explode('.', $dot1);
        $array2 = explode('.', $dot2);

        if (count($array1) > count($array2)) {
            $count = count($array1);
        } else {
            $count = count($array2);
        }

        $match = true;

        for ($i = 0; $i < $count; $i++) {
            if ( ! isset( $array2[$i] )) {
                if ($array1[$i] !== '*') {
                    $match = false;
                }
                break;
            }

            if ( ! isset( $array1[$i] )) {
                if ($array1[$i - 1] !== '*') {
                    $match = false;
                }
                break;
            }

            if ($array1[$i] !== $array2[$i] && $array1[$i] !== '*') {
                $match = false;
            }
        }

        return $match;
    }


    public function get_dot_notation($entity, $fields)
    {
        $result = $entity;
        $path   = explode('.', $fields);
        foreach ($path as $field) {
            $result = $result->$field;
        }

        return $result;
    }


    public function link_ordenar($route, $field, $name)
    {
        $order = 'asc';
        if (\Request::has('order') && \Request::has('order_by') && \Request::get('order') === 'asc' && \Request::get('order_by') === $field) {
            $order = 'desc';
        }
        $params = array_merge(\Request::all(), [ 'order_by' => $field, 'order' => $order ]);
        $html   = link_to_route($route, $name, $params);
        if (\Request::has('order') && \Request::has('order_by') && \Request::get('order_by') === $field) {
            if (\Request::get('order') === 'asc') {
                $html = $html . " <i class='fa fa-chevron-up'></i>";
            } else {
                $html = $html . " <i class='fa fa-chevron-down'></i>";
            }
        }

        return $html;
    }

}