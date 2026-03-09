<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentoEscola;
use Illuminate\Support\Facades\Storage;

class DocumentosEscolaController extends Controller
{

    public function destroy($id)
    {
        $documento = DocumentoEscola::findOrFail($id);
        $documento->delete();

        return back()->with('success', 'Documento excluído com sucesso!');
    }

}