<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArquivoSigep;
use App\Http\Requests\Admin\ArquivoSigep\ArquivoSigepRequest;
use App\Models\Cubiculo;
use App\Models\Galeria;
use App\Models\Preso;
use App\Models\PresoAlojamento;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Storage;



class ArquivoSigepController extends Controller
{
    
    public function __construct(ArquivoSigep $arquivo_sigeps, Preso $presos, PresoAlojamento $presos_alojamentos, Galeria $galerias, Cubiculo $cubiculos)
    {
        
        $this->arquivo_sigep = $arquivo_sigeps;
        $this->preso = $presos;
        $this->preso_alojamento = $presos_alojamentos;
        $this->galeria = $galerias;
        $this->cubiculo = $cubiculos;
        // Default values
        $this->params['titulo']='Arquivo Sigep';
        $this->params['main_route']='admin.arquivo_sigep';

    }

    public function index()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Arquivo Sigep Cadastrados';
        $this->params['arvore'][0] = [
                    'url' => 'admin/arquivo_sigep',
                    'titulo' => 'Arquivo Sigep'
        ];

        $params = $this->params;
        $data = $this->arquivo_sigep->all();
        return view('admin.arquivo_sigep.index',compact('params','data'));
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

    public function store(ArquivoSigepRequest $request)
    {
       
        if($request->file()) {
            $fileName = date('YmdHis').'.'.$request->file->getClientOriginalExtension();
            $filePath = $request->file->storeAs('uploads', $fileName,'public');

            //id, titulo, data_hora, importado, usuario,
            $data['titulo'] = $filePath;
            $data['data_hora'] = \Carbon\Carbon::now()->setTimezone('America/Sao_Paulo');
            $data['importado'] = 0;
            $data['usuario'] =Auth()->user()->email;
            
            $insert = $this->arquivo_sigep->create($data);
            if($insert){
                return redirect()->route($this->params['main_route'].'.index');
            }else{
                return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao fazer Inserir.']);
            }
            
        }


        
    }

    public function show($id,TableCode $codes)
    {
        $this->params['subtitulo']='Deletar Arquivo Sigep';
        $this->params['arvore']=[
           [
               'url' => 'admin/arquivo_sigep',
               'titulo' => 'Arquivo Sigep'
           ],
           [
               'url' => '',
               'titulo' => 'Deletar'
           ]];
       $params = $this->params;

       $data = $this->arquivo_sigep->find($id);
       $preload['controla_estoque'] = $codes->select(1);
       $preload['tipo'] = $codes->select(3);
       $preload['unidade_medida'] = $codes->select(4);

       return view('admin.arquivo_sigep.show',compact('params','data','preload'));
    }

    public function import($id)
    {
        $preso = 

        $this->params['subtitulo']='Importar Arquivo Sigep';
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
       $data = $this->arquivo_sigep->find($id);
       if($data->importado == 0){
            $url = Storage::url($data->titulo);
            
           $csv = array_map('str_getcsv', file($url));
           array_shift($csv);
           
           $tmp_presos = [];

            foreach ($csv as $i => $v){
                $nome_prontuario = preg_split("/[\-]/", $v[0]);
                $tmp_presos[$i]['prontuario'] = trim($nome_prontuario[0]);
                $tmp_presos[$i]['nome']             = trim($nome_prontuario[1]);
                $tmp_presos[$i]['rg']               =  trim($v[1]);
                $tmp_presos[$i]['data_nascimento']  =  \Carbon\Carbon::parse(strtotime(trim($v[2])))->format('Y-m-d') ;
                $tmp_presos[$i]['mae']              =  trim($v[3]);
                $tmp_presos[$i]['artigos']           =  trim($v[4]);
                $tmp_presos[$i]['situacao']  =  trim($v[5]);
                $alojamento =  preg_split("/(\/\s)/", $v[6]);
                $tmp_presos[$i]['bloco']            =  trim($alojamento[0]);
                $tmp_presos[$i]['galeria']          =  trim($alojamento[1]);
                $tmp_presos[$i]['cubiculo']         =  trim($alojamento[2]);
                $tmp_presos[$i]['origem']           =  trim($v[7]);
                $tmp_presos[$i]['data_prisao']      =  \Carbon\Carbon::parse(strtotime(trim($v[8])))->format('Y-m-d') ;
                $tmp_presos[$i]['data_depen']       =  \Carbon\Carbon::parse(strtotime(trim($v[9])))->format('Y-m-d') ;
                $tmp_presos[$i]['data_entrada']     =  \Carbon\Carbon::parse(strtotime(trim($v[10])))->format('Y-m-d') ;
               
                $galerias = $this->galeria->where('titulo',$tmp_presos[$i]['galeria'])->first();


                if($galerias){
                    $presos = $this->preso->select('id')->where('prontuario',$tmp_presos[$i]['prontuario'])->first();

                    if($presos){
                        $this->preso->find($presos["id"])->update($tmp_presos[$i]);
                        $tmp_presos[$i]['id'] = $presos["id"];
                    }else{
                        $result = $this->preso->create($tmp_presos[$i]);
                        if($result){
                            $tmp_presos[$i]['id'] = $result->id;
                        }
                    }

                    dd($this->cubiculo->getCubiculoIdGaleriaCubiculo('GALERIA A','205'));

                    // if($tmp_presos[$i]['id']){
                    //     $alojamento = $this->preso_alojamento->select('id','cubiculo_id')->where('preso_id',$tmp_presos[$i]['id'])->where('data_saida',NULL)->first();
                    //     if($alojamento){
                    //         $cubiculo =  $this
                    //                     ->galeria->select('titulo, numero')
                    //                     ->join('cubiculos','galerias.id','cubiculos.galeria_id')
                    //                     ->where('cubiculos.id',$alojamento['cubiculo_id'])
                    //                     ->first();
                    //         if((!$cubiculo['titulo'] ==  $tmp_presos[$i]['galeria']) || (!$cubiculo['numero'] ==   $tmp_presos[$i]['cubiculo'])){
                    //             // SE O CUBÍCULO FOR DIFERENTE DO ATUAL;
                    //             if($this->preso_alojamento->find($alojamento["id"])->update(['data_saida' => \Carbon\Carbon::now() ])){
                                    
                    //                 $result = $this->preso->create($tmp_presos[$i]);
                    //             }else{
                    //                 echo('erro');
                    //             }
                    //         }

                    //         $cubiculo =  $this->galeria->where('titulo',$tmp_presos[$i]['galeria'])->with('cubiculos')->where('id',1)->first();
                    //     }else{
                    //         $cubiculo =  $this
                    //                     ->galeria->select('cubiculos.id')
                    //                     ->join('cubiculos','galerias.id','cubiculos.galeria_id')
                    //                     ->where('galerias.titulo',$tmp_presos[$i]['galeria'])
                    //                     ->where('cubiculos.numero',$tmp_presos[$i]['cubiculo'])
                    //                     ->first();

                    //        // $this->alojamento->create();
                    //     }
                }else{
                    echo('erros');
                }
               
            }
        }
        dd();
        return view('admin.arquivo_sigep.create',compact('params', 'data','preload'));
    }

    public function update(ArquivoSigepRequest $request, $id)
    {
        $data = $this->arquivo_sigep->find($id);

        $dataForm  = $request->all();

        if($data->update($dataForm)){
            return redirect()->route($this->params['main_route'].'.index');
        }else{
            return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao editar.']);
        }
    }

    public function destroy($id)
    {
        $data = $this->arquivo_sigep->find($id);

        if($data->delete()){
            return redirect()->route($this->params['main_route'].'.index');
        }else{
            return redirect()->route($this->params['main_route'].'.create')->withErrors(['Falha ao deletar.']);
        }
    }
}
