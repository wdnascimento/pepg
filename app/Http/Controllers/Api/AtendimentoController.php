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

    public function store(AtendimentoRequest $request)
    {
    //     public function uploadFile(Request $request){
    //         $request->validate([
    //         'audio' => 'required|mimes:mp3|max:2048'
    //         ]);
    
    //         if($request->file()) {
    //             $name = time().'_'.$request->audio->getClientOriginalName();
    //             $filePath = $request->file('audio')->storeAs('uploads', $name, 'public');
    
    //             return back()
    //             ->with('success','File has uploaded to the database.')
    //             ->with('file', $name);
    //         }
    //    }
    }

    public function show($id)
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
