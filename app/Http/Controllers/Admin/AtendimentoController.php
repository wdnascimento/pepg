<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Atendimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtendimentoController extends Controller
{
    public function __construct(Atendimento $atendimentos)
    {
        $this->atendimento = $atendimentos;
       
        // Default values
        $this->params['titulo']='Atendimentos';
        $this->params['main_route']='admin.atendimento';

    }

    public function index()
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Atendimentos Cadastrados';
        $this->params['arvore'][0] = [
                     'url' => 'admin/atendimento',
                     'titulo' => 'Atendimentos'
        ];
 
        $params = $this->params;
        $data = $this->atendimento  ->selectRaw("atendimentos.setor_id as id, setors.titulo as titulo,  count(atendimentos.id) as quantidade".
                                                ", SUM(atendimentos.respondido) AS respondido , ".
                                                "(SUM(atendimentos.respondido)*100)/(count(atendimentos.id)) as percentual")
                                    ->join("setors","setors.id","atendimentos.setor_id")
                                    ->groupBy("atendimentos.setor_id","setors.titulo")
                                    ->get();
        return view('admin.atendimento.index',compact('params','data'));
    }

    public function atendimentoSetor($id)
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Atendimentos Cadastrados';
        $this->params['arvore'][0] = [
                     'url' => 'admin/atendimento',
                     'titulo' => 'Atendimentos'
        ];
 
        $params = $this->params;
        $data = $this->atendimento  ->selectRaw("atendimentos.*, DATE_FORMAT(atendimentos.created_at,'%d/%m/%Y') as data_atendimento , presos.prontuario, presos.nome")
                                    ->join("presos","presos.id","atendimentos.preso_id")
                                    ->where("atendimentos.setor_id",$id)
                                    ->get();
        return view('admin.atendimento.setor',compact('params','data'));
    }

    public function atendimento($id)
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Atendimentos Cadastrados';
        $this->params['arvore'][0] = [
                     'url' => 'admin/atendimento',
                     'titulo' => 'Atendimentos'
        ];
 
        $params = $this->params;
        $data = $this->atendimento  ->selectRaw("atendimentos.*, DATE_FORMAT(atendimentos.created_at,'%d/%m/%Y') as data_atendimento , presos.prontuario, presos.nome")
                                    ->join("presos","presos.id","atendimentos.preso_id")
                                    ->where("atendimentos.setor_id",$id)
                                    ->get();
        return view('admin.atendimento.setor',compact('params','data'));
    }


    public function responder($id)
    {
        // PARAMS DEFAULT
        $this->params['subtitulo']='Atendimento / Preso';
        $this->params['arvore'][0] = [
                     'url' => 'admin/atendimento',
                     'titulo' => 'Atendimentos'
        ];
 
        $params = $this->params;
        $data = $this->atendimento  ->find($id);
        return view('admin.atendimento.atendimento',compact('params','data'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
