<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Atendimento\AtendimentoRequest;
use App\Models\Atendimento;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    
    public function __construct(Atendimento $atendimentos)
    {
        $this->atendimento = $atendimentos;
    }

   


    public function saveAtendimento(AtendimentoRequest $request){
        $atendimento['url_audio'] = $request->url_audio;
        $atendimento['preso_id'] = $request->preso_id;
        $atendimento['setor_id'] = $request->setor_id;
        
        if($this->atendimento->create($atendimento)){
            return response()->json(['response' => true, 'message' => 'Atendimento registrado com sucesso']);
        }
        return response()->json(['response' => false, 'message' => 'Erro gravar atendimento.']);
    }

    public function atendimentoPresoId($preso_id){
        $atendimentos = $this   ->atendimento
                                ->select('atendimentos.*','setors.titulo')
                                ->join('setors','atendimentos.setor_id','setors.id')
                                ->where('setors.preso_id',$preso_id)
                                ->limit(15)
                                ->get();

                                return response()->json($atendimentos);
    }
    

}
