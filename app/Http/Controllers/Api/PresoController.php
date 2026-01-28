<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Atendimento\AtendimentoRequest;
use App\Models\Preso;
use App\Models\Atendimento;
use App\Models\PresoAlojamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;

class PresoController extends Controller
{
    public $kit;
    public $preso;

    public function index(Preso $presos, $prontuario)
    {
        return $presos->where('prontuario', $prontuario)->first();
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'audio' => 'required|file|mimes:webm,ogg|max:2048'  // 2 MB para 30s de áudio
        ]);

        if ($request->file()) {
            $file = $request->file('audio');
            $originalExtension = $file->getClientOriginalExtension();

            // Nome do arquivo MP3 final
            $mp3Name = time() . '_audio.mp3';
            $tempPath = $file->storeAs('audio/temp', time() . '_temp.' . $originalExtension, 'public');

            // Se não for MP3, converter usando FFmpeg
            if ($originalExtension !== 'mp3') {
                $inputPath = storage_path('app/public/' . $tempPath);
                $outputPath = storage_path('app/public/audio/atendimentos/' . $mp3Name);

                // Criar diretório se não existir
                if (!file_exists(dirname($outputPath))) {
                    mkdir(dirname($outputPath), 0755, true);
                }

                // Converter para MP3 usando FFmpeg
                $command = "ffmpeg -i {$inputPath} -vn -ar 44100 -ac 2 -b:a 128k {$outputPath} 2>&1";
                exec($command, $output, $returnCode);

                // Remover arquivo temporário
                @unlink($inputPath);

                if ($returnCode !== 0) {
                    return response()->json([
                        'response' => false,
                        'message' => 'Erro ao converter áudio para MP3.'
                    ], 500);
                }
            } else {
                // Se já for MP3, apenas mover
                $file->storeAs('audio/atendimentos', $mp3Name, 'public');
                @unlink(storage_path('app/public/' . $tempPath));
            }

            return response()->json(['response' => true, 'data' => $mp3Name]);
        }

        return response()->json(['response' => false, 'message' => 'Arquivo não informado.']);
    }

    public function kit(Preso $presos, $kit)
    {
        $this->kit = $kit;
        return $presos->select('presos.*')
            ->join('preso_kits', function ($join) {
                $join->on('preso_kits.preso_id', '=', 'presos.id')
                    ->where('preso_kits.kit', $this->kit)
                    ->where('preso_kits.data_final', NULL);
            })
            ->first();
    }

    public function presoalojamento(Preso $presos, $preso_id)
    {
        return $presos
            ->select('presos.id', 'presos.prontuario', 'presos.nome'
                      , 'galerias.titulo as galeria', 'cubiculos.numero as cubiculo'
                      , 'presos.url_foto')
            ->join('preso_alojamentos', 'preso_alojamentos.preso_id', 'presos.id')
            ->join('cubiculos', 'cubiculos.id', 'preso_alojamentos.cubiculo_id')
            ->join('galerias', 'galerias.id', 'cubiculos.galeria_id')
            ->where('preso_alojamentos.data_saida', NULL)
            ->where('presos.id', $preso_id)
            ->first();

    }
}
