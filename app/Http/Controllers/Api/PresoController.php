<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Atendimento\AtendimentoRequest;
use App\Models\Preso;
use App\Models\Atendimento;
use App\Models\PresoAlojamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
            'audio' => 'required|file|mimes:webm,ogg,mp3|max:2048'  // 2 MB para 30s de áudio
        ]);

        if ($request->file()) {
            $file = $request->file('audio');
            $originalExtension = $file->getClientOriginalExtension();
            $timestamp = time();

            // Nome final padrão: mantém extensão original (fallback)
            $finalName = $timestamp . '_audio.' . $originalExtension;
            $tempPath = $file->storeAs('audio/temp', $timestamp . '_temp.' . $originalExtension, 'public');

            // Se não for MP3, converter usando FFmpeg
            if ($originalExtension !== 'mp3') {
                $inputPath = storage_path('app/public/' . $tempPath);
                $mp3Name = $timestamp . '_audio.mp3';
                $outputPath = storage_path('app/public/audio/atendimentos/' . $mp3Name);

                // Criar diretório se não existir
                if (!file_exists(dirname($outputPath))) {
                    mkdir(dirname($outputPath), 0755, true);
                }

                // Converter para MP3 usando FFmpeg
                $ffmpegPath = trim((string) shell_exec('which ffmpeg'));
                if ($ffmpegPath === '') {
                    Storage::disk('public')->move($tempPath, 'audio/atendimentos/' . $finalName);

                    return response()->json([
                        'response' => true,
                        'data' => $finalName,
                        'message' => 'FFmpeg não encontrado no servidor. Áudio salvo no formato original.'
                    ]);
                }

                $command = escapeshellarg($ffmpegPath) . ' -y -i ' . escapeshellarg($inputPath) . ' -vn -ar 44100 -ac 2 -b:a 128k ' . escapeshellarg($outputPath) . ' 2>&1';
                exec($command, $output, $returnCode);

                // Remover arquivo temporário
                @unlink($inputPath);

                if ($returnCode !== 0) {
                    Storage::disk('public')->move($tempPath, 'audio/atendimentos/' . $finalName);

                    return response()->json([
                        'response' => true,
                        'data' => $finalName,
                        'message' => 'Falha na conversão para MP3. Áudio salvo no formato original.',
                        'details' => implode("\n", $output)
                    ]);
                }

                $finalName = $mp3Name;
            } else {
                // Se já for MP3, apenas mover
                Storage::disk('public')->move($tempPath, 'audio/atendimentos/' . $finalName);
            }

            return response()->json(['response' => true, 'data' => $finalName]);
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
