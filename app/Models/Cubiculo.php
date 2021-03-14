<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cubiculo extends Model
{
    protected $fillable = ['galeria_id','numero','capacidade']; 

    function getCubiculoIdGaleriaCubiculo($galeria, $cubiculo){
         return $this   ->join('galerias','galerias.id','cubiculos.galeria_id')
                        ->select('cubiculos.id')
                        ->where('galerias.titulo',$galeria)
                        ->where('cubiculos.numero',$cubiculo)
                        ->get();
    }

    public function presos()
    {
        return $this->hasMany(PresoAlojamento::class,'preso_alojamentos.cubiculo_id','id');
    }
}
