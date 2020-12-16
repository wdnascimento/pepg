<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArquivoSigep;
use App\Http\Requests\Admin\ArquivoSigep\ArquivoSigepRequest;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Storage;



class ArquivoSigepController extends Controller
{
    
    public function __construct(ArquivoSigep $arquivo_sigeps, Preso $presos  )
    {
        
        $this->arquivo_sigep = $arquivo_sigeps;
        $this->preso = $presos;
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
                $tmp_presos[$i]['data_nascimento']  =  trim($v[2]);
                $tmp_presos[$i]['mae']              =  trim($v[3]);
                $tmp_presos[$i]['artigos']           =  trim($v[4]);
                $tmp_presos[$i]['situacao']  =  trim($v[5]);
                $alojamento =  preg_split("/(\/\s)/", $v[6]);
                $tmp_presos[$i]['bloco']            =  trim($alojamento[0]);
                $tmp_presos[$i]['galeria']          =  trim($alojamento[1]);
                $tmp_presos[$i]['cubiculo']         =  trim($alojamento[2]);
                $tmp_presos[$i]['origem']           =  trim($v[7]);
                $tmp_presos[$i]['data_prisao']      =  trim($v[8]);
                $tmp_presos[$i]['data_depen']=  trim($v[9]);
                $tmp_presos[$i]['data_entrada']     =  trim($v[10]);

           }

           dd($tmp_presos);
       }
      

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
