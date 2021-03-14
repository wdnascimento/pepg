<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresoAlojamento extends Model
{
    
    protected $fillable = ['preso_id','cubiculo_id','data_entrada','data_saida']; 
    
    public function presos()
    {
        return $this->belongsTo(Preso::class);
    }

}
