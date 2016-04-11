<?php

namespace App;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Eloquent
{

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [ 'deleted_at' ];


    /**
     * Formata a data de criação para DD/MM/YYYY HH:MM
     *
     * @return string
     */
    public function getCreatedAtAttribute()
    {
        return $this->convertDateFromDB('created_at', true);
    }


    /**
     * Formata a data de alteração para DD/MM/YYYY HH:MM
     *
     * @return string
     */
    public function getUpdatedAtAttribute()
    {
        return $this->convertDateFromDB('updated_at', true);
    }


    /**
     * Formata a data de exclusão para DD/MM/YYYY HH:MM
     *
     * @return string
     */
    public function getDeletedAtAttribute()
    {
        return $this->convertDateFromDB('deleted_at', true);
    }


    protected function convertDateToDB($field, $value, $timestamp = false)
    {
        $this->attributes[$field] = $value ? Carbon::createFromFormat('d/m/Y' . ( $timestamp ? ' H:i' : '' ),
            $value)->format('Y-m-d' . ( $timestamp ? ' H:i:s' : '' )) : null;
    }


    protected function convertDateFromDB($field, $timestamp = false)
    {
        return $this->attributes[$field] ? Carbon::createFromFormat('Y-m-d' . ( $timestamp ? ' H:i:s' : '' ),
            $this->attributes[$field])->format('d/m/Y' . ( $timestamp ? ' H:i' : '' )) : '';
    }

}