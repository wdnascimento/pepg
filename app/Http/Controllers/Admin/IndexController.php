<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeria;
use App\Models\Preso;
use App\Models\Cubiculo;

class IndexController extends Controller
{
    public function __construct(Galeria $galerias,Preso $presos,Cubiculo $cubiculos)
    {
        $this->galeria = $galerias;
        $this->preso = $presos;
        $this->cubiculo = $cubiculos;
        //$this->atendimento = $atendimentos;


        // Default values
        $this->params['titulo']='Bem Vindo';
        $this->params['main_route']='admin';

    }


    public function index()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='';

        $params = $this->params;
        $data['total_presos'] = $this->galeria->totalPresos();
        $data['preso'] = $this->preso->count();
        $data['cubiculo'] = $this->cubiculo->count();

        return view('admin.index',compact('params','data'));
    }
}
