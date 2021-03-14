<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeria;
use App\Models\Preso;
use App\Models\TableCodes;
use App\Models\Unidade;
use Illuminate\Http\Request;

class PresoController extends Controller
{
    public function __construct(Preso $presos, Galeria $galerias,Unidade $unidades, TableCodes $tableCodes)
    {
        $this->preso = $presos;
        $this->galeria = $galerias;
        $this->unidade = $unidades; 
        $this->tableCode = $tableCodes;

        // Default values
        $this->params['titulo']='Galerias Cadastradas';
        $this->params['main_route']='admin.preso';

    }

    public function index()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Presos Cadastrados';
        $this->params['arvore'][0] = [
                     'url' => 'admin/preso',
                     'titulo' => 'Presos'
        ];
 
        $params = $this->params;
        $data = $this->preso  ->select('presos.prontuario','presos.nome', 'galerias.titulo as galeria', 'cubiculos.numero as cubiculo')
                                ->join('preso_alojamentos','preso_alojamentos.preso_id','presos.id')
                                ->join('cubiculos','cubiculos.id','preso_alojamentos.cubiculo_id')
                                ->join('galerias','galerias.id','cubiculos.galeria_id')
                                ->where('preso_alojamentos.data_saida',NULL)
                                ->get();
        return view('admin.preso.index',compact('params','data'));
    }
}
