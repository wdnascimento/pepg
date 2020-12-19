<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cubiculo extends Model
{
    protected $fillable = ['galeria_id','numero','capacidade']; 

    function getCubiculoIdGaleriaCubiculo($galeria, $cubiculo){
         return $this->join('galeria')->where('galerias.titulo',$galeria)->where('cubiculos.numero',$cubiculo);
    }
}
