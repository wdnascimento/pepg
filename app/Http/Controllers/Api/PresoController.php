<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Atendimento\AtendimentoRequest;
use App\Models\Preso;
use App\Models\Atendimento;
use Illuminate\Http\Request;
use PHPUnit\Util\Json;

class PresoController extends Controller
{
    public function index(Preso $presos, $prontuario)
    {
        return $presos->where('prontuario',$prontuario)->get();
    }

    public function uploadFile(Request $request){
        $request->validate([
        'audio' => 'required|mimes:mp3|max:2048'
        ]);

        if($request->file()) {
            $name = time().'_'.$request->audio->getClientOriginalName();
            $filePath = $request->file('audio')->storeAs('uploads', $name, 'public');
            if(!$filePath){
                return response()->json(['response' => false, 'message' => 'Erro ao carregar o arquivo.']);
            }
            
          

            return response()->json(['response' => true, 'data' => $name]);
            
        }
        return response()->json(['response' => false, 'message' => 'Arquivo não informado.']);

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
