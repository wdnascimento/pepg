<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Preso\PresoFotoRequest;
use App\Models\Galeria;
use App\Models\Preso;
use App\Models\TableCodes;
use App\Models\Unidade;

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

    public function fotos()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Presos Cadastrados';
        $this->params['arvore'][0] = [
                     'url' => 'admin/preso',
                     'titulo' => 'Presos'
        ];
 
        $params = $this->params;
        $data = $this->preso  ->select('presos.id','presos.prontuario','presos.nome' ,'presos.url_foto', 'galerias.titulo as galeria', 'cubiculos.numero as cubiculo')
                                ->join('preso_alojamentos','preso_alojamentos.preso_id','presos.id')
                                ->join('cubiculos','cubiculos.id','preso_alojamentos.cubiculo_id')
                                ->join('galerias','galerias.id','cubiculos.galeria_id')
                                ->where('preso_alojamentos.data_saida',NULL)
                                ->get();
        return view('admin.preso.fotos',compact('params','data'));
    }

    public function edit($id)
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Foto dos Presos';
        $this->params['arvore']=[
           [
               'url' => 'admin/preso/foto',
               'titulo' => 'Fotos dos Presos'
           ],
           [
               'url' => '',
               'titulo' => 'Cadastrar'
           ]];
       $params = $this->params;

            
       $preload['preso_id'] = $id;
       return view('admin.preso.create',compact('params','preload'));
    }

    public function store(PresoFotoRequest $request)
    {
        if($request->file()) {
            $fileName = date('YmdHis').'.'.$request->url_foto->getClientOriginalExtension();
            $filePath = $request->url_foto->storeAs('fotos', $request["preso_id"]."_".$fileName,'public');

            if($filePath){
                $data['url_foto']= $filePath;

                $update = $this->preso->find($request["preso_id"])->update($data);
                if($update){
                    return redirect()->route('admin.preso.foto');
                }else{
                    return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao fazer Inserir.']);
                }
            }else{
                return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao fazer Inserir nova Foto.']);
            }
                
            
        }


        
    }
}
