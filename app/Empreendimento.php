<?php

namespace App;

class Empreendimento extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'empreendimentos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'fachada',
        'apartamentos_andar',
        'construido_em',
        'marinha',
        'lazer',
        'observacoes',
        'latitude',
        'longitude'
    ];


    /**
     * Possui várias colunas que representam a estrutura dos apartamentos
     */
    public function colunas()
    {
        return $this->hasMany(Coluna::class, 'empreendimento_id');
    }


    /**
     * Possui vários anúncios de apartamentos, independente das colunas
     */
    public function anuncios()
    {
        return $this->hasManyThrough(Anuncio::class, Coluna::class, 'empreendimento_id', 'coluna_id');
    }


    /**
     * Possui várias fotos avulsas
     */
    public function fotos()
    {
        return $this->morphMany(Foto::class, 'related');
    }


    /**
     * Retorna a lista de opções de lazer para utilização em dropdowns.
     *
     * @return array
     */
    public function getListaLazerAttribute()
    {
        return explode(', ', $this->lazer);
    }


    /**
     * Retorna o caminho para a foto da fachada do empreendimento.
     *
     * @return string
     */
    public function getFachadaComCaminhoAttribute()
    {
        return '/img/fachadas/' . $this->attributes['fachada'];
    }


    /**
     * Retorna o caminho para o thumbnail da foto da fachada do empreendimento.
     *
     * @return string
     */
    public function getFachadaThumbnailAttribute()
    {
        return '/img/fachadas/thumb/' . $this->attributes['fachada'];
    }

}
