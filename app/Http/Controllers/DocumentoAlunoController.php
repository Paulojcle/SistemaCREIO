<?php

namespace App\Http\Controllers;

use App\Models\DocumentoAluno;
use Illuminate\Support\Facades\Storage;

class DocumentoAlunoController extends Controller
{
    public function destroy($id)
    {
        $documento = DocumentoAluno::findOrFail($id);
        Storage::disk('public')->delete($documento->arquivo);
        $documento->delete();

        return back()->with('success', 'Documento excluído com sucesso!');
    }
}
