<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Galeria\GaleriaRequest;
use App\Models\Cubiculo;
use Illuminate\Http\Request;
use App\Models\Galeria;
use App\Models\PresoAlojamento;
use App\Models\TableCodes;
use App\Models\Unidade;

class GaleriaController extends Controller
{
    public function __construct(Galeria $galerias,Unidade $unidades,Cubiculo $cubiculos, PresoAlojamento $preso_alojamentos, TableCodes $tableCodes)
    {
        $this->galeria = $galerias;
        $this->unidade = $unidades; 
        $this->cubiculo = $cubiculos; 
        $this->preso_alojamento = $preso_alojamentos;
        $this->tableCode = $tableCodes;

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

    public function create(TableCodes $codes)
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Cadastrar Gelerias';
        $this->params['arvore']=[
           [
               'url' => 'admin/galeria',
               'titulo' => 'Galeria'
           ],
           [
               'url' => '',
               'titulo' => 'Cadastrar'
           ]];
       $params = $this->params;
            
       $preload["unidade"] = $this->unidade->get()->pluck('titulo','id');
       $preload['tipo'] = $codes->select(1);

       return view('admin.galeria.create',compact('params','preload')); 
    }

   
    public function store(GaleriaRequest $request)
    {
        $dataForm  = $request->all();

        $insert = $this->galeria->create($dataForm);
        if($insert){
            return redirect()->route($this->params['main_route'].'.index');
        }else{
            return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao fazer Inserir.']);
        }
    }

    public function show($id,TableCodes $codes)
    {
        $this->params['subtitulo']='Deletar Galeria';
        $this->params['arvore']=[
           [
               'url' => 'admin/galeria',
               'titulo' => 'Galeria'
           ],
           [
               'url' => '',
               'titulo' => 'Deletar'
           ]];
       $params = $this->params;
       $preload["unidade"] = $this->unidade->get()->pluck('titulo','id');
       $preload['tipo'] = $codes->select(1);
       $data = $this->galeria->find($id);

       return view('admin.galeria.show',compact('params','data','preload'));
    }

    public function galerias()
    {
        $this->params['subtitulo']='Ver Galeria';
        $this->params['arvore']=[
           [
               'url' => 'admin/galeria',
               'titulo' => 'Galerias'
           ],
           [
               'url' => '',
               'titulo' => 'Ver'
           ]];
        $params = $this->params;
       
        // $data["total"] = $this  ->select('galerias.titulo',DB::raw('COUNT(preso_alojamentos.cubiculo_id)')->preso_lojamento
        //                         ->join('cubiculos','cubiculos.id','preso_alojamentos.cubiculos_id')
        //                         ->join('galerias','galerias.id','cubiculos.galeria_id')
        //                         ->where('preso_alojamentos.data_saida', NULL)
        //                         ->groupBy('galerias.id')
        //                         ->get();
        
        //  $data = $this->galeria->find($id);

        return view('admin.galeria.galerias', compact('params'));
    }

    public function galeria($id, TableCodes $codes)
    {
        $this->params['subtitulo']='Ver Galeria';
        $this->params['arvore']=[
           [
               'url' => 'admin/galeria',
               'titulo' => 'Galeria'
           ],
           [
               'url' => '',
               'titulo' => 'Galeria'
           ]];
       $params = $this->params;
    //    $data["unidade"] = $this  ->cubiculo
    //                                 ->where('cubiculos.galeria_id',$id)
    //                                 ->presos()
    //                                 ->orderBy('cubiculos.numero')
    //                                 ->get()
    //                                 ->toArray();
    //      
    
    $data["unidade"] = $this  ->cubiculo->find(50)->with('presos')->get();
    //                                 ->where('cubiculos.galeria_id',$id)
    //                                 ->presos()
    //                                 ->orderBy('cubiculos.numero')
    //                                 ->get()
    //                                 ->toArray();
    //      
    

    dd($data);                       
 
    return view('admin.ver_galeria.galeria',compact('params', 'data'));
    }

    public function edit($id, TableCodes $codes)
    {
        $this->params['subtitulo']='Editar Galeria';
        $this->params['arvore']=[
           [
               'url' => 'admin/galeria',
               'titulo' => 'Galeria'
           ],
           [
               'url' => '',
               'titulo' => 'Editar'
           ]];
       $params = $this->params;
       $preload["unidade"] = $this->unidade->get()->pluck('titulo','id');
       $preload['tipo'] = $codes->select(1);
       $data = $this->galeria->find($id);

       return view('admin.galeria.create',compact('params', 'data','preload'));
    }

    public function update(GaleriaRequest $request, $id)
    {
        $data = $this->galeria->find($id);

        $dataForm  = $request->all();

        if($data->update($dataForm)){
            return redirect()->route($this->params['main_route'].'.index');
        }else{
            return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao editar.']);
        }
    }

    public function destroy($id)
    {
        $data = $this->galeria->find($id);

        if($data->delete()){
            return redirect()->route($this->params['main_route'].'.index');
        }else{
            return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao deletar.']);
        }
    }
}
