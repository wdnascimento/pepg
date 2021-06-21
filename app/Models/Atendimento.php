<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    protected $fillable = ['preso_id','setor_id','url_audio', 'url_audio_resposta', 'resposta_texto', 'respondido', 'lido','created_at']; 
}
