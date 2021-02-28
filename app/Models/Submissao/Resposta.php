<?php

namespace App\Models\Submissao;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{

    protected $fillable = ['resposta', 'pergunta_id'];

    public function pergunta()
    {
        return $this->belongsTo('App\Models\Submissao\Pergunta');
    }

    public function opcoes()
    {
        return $this->hasMany('App\Models\Submissao\Opcao');
    }
}
