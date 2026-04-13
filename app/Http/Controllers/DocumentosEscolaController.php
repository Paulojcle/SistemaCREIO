<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentoEscola;
use Illuminate\Support\Facades\Storage;
use App\Traits\RegistraLog;

class DocumentosEscolaController extends Controller
{
    use RegistraLog;

    public function destroy($id)
    {
        $documento = DocumentoEscola::findOrFail($id);

        abort_unless(\App\Models\Escola::where('id', $documento->escola_id)->exists(), 403);

        if (Storage::disk('public')->exists($documento->arquivo)) {
            Storage::disk('public')->delete($documento->arquivo);
        }

        $this->registrarLog('excluiu', 'Documento Escola', "Removeu o documento {$documento->nome_original} da escola {$documento->escola->nome}");

        $documento->delete();

        return back()->with('success', 'Documento excluído com sucesso!');
    }
}
