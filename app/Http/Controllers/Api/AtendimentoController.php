<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Atendimento\AtendimentoRequest;
use App\Http\Requests\Api\Atendimento\AtendimentoRespostaRequest;
use App\Models\Atendimento;
use Illuminate\Support\Facades\DB;

class AtendimentoController extends Controller
{
    protected Atendimento $atendimento;

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

    public function saveRespostaAtendimento(AtendimentoRespostaRequest $request){

        $id = $request->only('atendimento_id');
        $request = $request->except('atendimento_id');



        if($this->atendimento->find($id["atendimento_id"])->update($request)){
          return response()->json(['response' => true, 'message' => 'Atendimento registrado com sucesso']);
        }
        return response()->json(['response' => false, 'message' => 'Erro gravar atendimento.']);
    }

    public function atendimentoPresoId($preso_id){
        $atendimentos = $this   ->atendimento
                                ->select('atendimentos.*', 'setors.titulo',DB::raw("DATE_FORMAT(atendimentos.created_at,'%d/%m/%Y') as data_atendimento"))
                                ->join('setors','atendimentos.setor_id','setors.id')
                                ->where('atendimentos.preso_id',$preso_id)
                                ->limit(10)
                                ->orderBy('created_at','DESC')
                                ->get();
                                return response()->json($atendimentos);
    }

    public function totalRespondidasNaoLidas($preso_id)
    {
        $total = $this->atendimento
            ->where('preso_id', $preso_id)
            ->where('lido', 0)
            ->where(function ($query) {
                $query->whereNotNull('resposta_texto')
                    ->orWhereNotNull('url_audio_resposta');
            })
            ->count();

        return response()->json(['total' => $total]);
    }

    public function marcarComoLido($id)
    {
        $atendimento = $this->atendimento->find($id);

        if (!$atendimento) {
            return response()->json(['response' => false, 'message' => 'Atendimento não encontrado.'], 404);
        }

        $atendimento->lido = 1;
        $atendimento->save();

        return response()->json(['response' => true, 'message' => 'Mensagem marcada como lida.']);
    }

}
