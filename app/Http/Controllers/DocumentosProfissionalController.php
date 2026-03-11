<?php

namespace App\Http\Controllers;

use App\Models\DocumentosProfissionais;
use Illuminate\Support\Facades\Storage;

class DocumentosProfissionalController extends Controller
{
    public function destroy($id)
    {
        $documento = DocumentosProfissionais::findOrFail($id);

        if (Storage::disk('public')->exists($documento->arquivo)) {
            Storage::disk('public')->delete($documento->arquivo);
        }

        $profissional_id = $documento->profissional_id;
        $documento->delete();

        return redirect()
            ->route('profissionais.edit', $profissional_id)
            ->with('success', 'Documento removido com sucesso.');
    }
}