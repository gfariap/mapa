<?php

namespace App;

class Anuncio extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'anuncios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'valor',
        'finalidade',
        'quartos',
        'suites',
        'garagem',
        'observacoes',
        'coluna_id'
    ];


    /**
     * Pertence a uma coluna de um empreendimento
     */
    public function coluna()
    {
        return $this->belongsTo(Coluna::class, 'coluna_id');
    }


    /**
     * Possui várias fotos avulsas
     */
    public function fotos()
    {
        return $this->morphMany(Foto::class, 'related');
    }
}
