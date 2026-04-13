<?php

namespace App\Http\Controllers;

use App\Models\DocumentosProfissionais;
use Illuminate\Support\Facades\Storage;
use App\Traits\RegistraLog;

class DocumentosProfissionalController extends Controller
{
    use RegistraLog;

    public function destroy($id)
    {
        $documento = DocumentosProfissionais::findOrFail($id);

        abort_unless(\App\Models\Profissional::where('id', $documento->profissional_id)->exists(), 403);

        if (Storage::disk('public')->exists($documento->arquivo)) {
            Storage::disk('public')->delete($documento->arquivo);
        }

        $this->registrarLog('excluiu', 'Documento Profissional', "Removeu o documento {$documento->nome_original} do profissional {$documento->profissional->nome}");

        $profissional_id = $documento->profissional_id;
        $documento->delete();

        return redirect()
            ->route('profissionais.edit', $profissional_id)
            ->with('success', 'Documento removido com sucesso.');
    }
}