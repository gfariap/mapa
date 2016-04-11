<?php

namespace App;

class Coluna extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'colunas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'planta',
        'area',
        'quartos',
        'suites',
        'garagem',
        'observacoes',
        'empreendimento_id'
    ];


    /**
     * Pertence a um empreendimento
     */
    public function empreendimento()
    {
        return $this->belongsTo(Empreendimento::class, 'empreendimento_id');
    }


    /**
     * Possui vários anúncios de apartamentos
     */
    public function anuncios()
    {
        return $this->hasMany(Anuncio::class, 'coluna_id');
    }


    /**
     * Possui várias fotos avulsas
     */
    public function fotos()
    {
        return $this->morphMany(Foto::class, 'related');
    }


    /**
     * Retorna o caminho para a foto da planta da coluna.
     *
     * @return string
     */
    public function getPlantaComCaminhoAttribute()
    {
        return '/img/plantas/' . $this->attributes['planta'];
    }


    /**
     * Retorna o caminho para o thumbnail da foto da planta da coluna.
     *
     * @return string
     */
    public function getPlantaThumbnailAttribute()
    {
        return '/img/plantas/thumb/' . $this->attributes['planta'];
    }
}
