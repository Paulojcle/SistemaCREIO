<?php

namespace App\Http\Controllers;

use App\Models\DocumentoAluno;
use Illuminate\Support\Facades\Storage;
use App\Traits\RegistraLog;

class DocumentoAlunoController extends Controller
{
    use RegistraLog;

    public function destroy($id){
        $documento = DocumentoAluno::findOrFail($id);

        abort_unless(\App\Models\Aluno::where('id', $documento->aluno_id)->exists(), 403);

        Storage::disk('public')->delete($documento->arquivo);

        $this->registrarLog('excluiu', 'Documento Aluno', "Removeu o documento {$documento->nome_original} do aluno {$documento->aluno->nome}");

        $documento->delete();

        return back()->with('success', 'Documento excluído com sucesso!');
    }
}
