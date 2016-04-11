<?php

namespace App;

class Foto extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fotos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'caminho',
        'descricao',
        'related_id',
        'related_type'
    ];


    /**
     * Pertence a um tipo de entidade específico
     */
    public function related()
    {
        return $this->morphTo();
    }
}
