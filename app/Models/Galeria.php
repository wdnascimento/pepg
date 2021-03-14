<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $fillable = ["unidade_id","titulo","tipo"];


    public function cubiculos()
    {
        return $this->hasMany(Cubiculo::class);

    }
    
    
}
