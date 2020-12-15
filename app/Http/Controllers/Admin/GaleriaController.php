<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeria;
class GaleriaController extends Controller
{
    public function __construct(Galeria $galerias)
    {
        $this->galeria = $galerias;

        // Default values
        $this->params['titulo']='Galerias Cadastradas';
        $this->params['main_route']='admin.galeria';

    }

    public function index()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Galerias Cadastradas';
        $this->params['arvore'][0] = [
                     'url' => 'admin/galeria',
                     'titulo' => 'Galerias'
        ];
 
        $params = $this->params;
        $data = $this->galeria->select('unidades.titulo as unidade','galerias.*')->join('unidades','unidades.id','galerias.unidade_id')->get();
        return view('admin.galeria.index',compact('params','data'));
    }

    public function create()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Cadastrar Arquivo Sigep';
        $this->params['arvore']=[
           [
               'url' => 'admin/arquivo_sigep',
               'titulo' => 'Arquivo Sigep'
           ],
           [
               'url' => '',
               'titulo' => 'Cadastrar'
           ]];
       $params = $this->params;
            
       $preload = null;
       return view('admin.arquivo_sigep.create',compact('params','preload')); 
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
