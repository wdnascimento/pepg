<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cubiculo extends Model
{
    protected $fillable = ['galeria_id','numero','capacidade']; 

    public function getCubiculoIdGaleriaCubiculo($galeria, $cubiculo){
         return $this   ->join('galerias','galerias.id','cubiculos.galeria_id')
                        ->select('cubiculos.id')
                        ->where('galerias.titulo',$galeria)
                        ->where('cubiculos.numero',$cubiculo)
                        ->get();
    }

    public function presos()
    {
        return $this    ->select('presos.nome')
                        ->join('preso_alojamentos', 'cubiculos.id','preso_alojamentos.cubiculo_id')
                        ->join('presos', 'preso_alojamentos.preso_id','presos.id')
                        ->where('preso_alojamentos.data_saida',NULL);
    }
}
