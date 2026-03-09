<?php

namespace App\Http\Controllers;
use App\Models\Escola;
use App\Models\DocumentoEscola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EscolaController extends Controller{


    public function store(Request $request){

    $escola = Escola::create([
        'nome' => $request->nome,
        'cnpj' => $request->cnpj,
        'endereco' => $request->endereco,
        'numero' => $request->numero,
        'bairro' => $request->bairro,
        'cidade' => $request->cidade,
        'cep' => $request->cep,
    ]);

    if($request->hasFile('documentos')){

        foreach($request->file('documentos') as $arquivo){

            $path = $arquivo->store('documentos_escolas','public');

            DocumentoEscola::create([
                'escola_id' => $escola->id,
                'arquivo' => $path
            ]);

        }

    }

    return redirect()->route('escolas.index');
    }


    public function index(){
        $escolas = Escola::all();

        return view('escola.index', compact('escolas') );
    }


    public function show($id)
    {
        $escola = Escola::with('documentos')->findOrFail($id);

        return view('escola.showEscola', compact('escola'));
    }

    public function edit(Escola $escola)
    {
        return view('escola.editEscola', compact('escola'));
    }


    public function update(Request $request, Escola $escola)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:20',
            'bairro' => 'nullable|string|max:100',
            'cidade' => 'nullable|string|max:100',
            'cep' => 'nullable|string|max:20',
            'documentos.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        $escola->update($request->only([
            'nome','cnpj','endereco','numero','bairro','cidade','cep'
        ]));

        if($request->hasFile('documentos')){
            foreach($request->file('documentos') as $doc){
                $path = $doc->store('documentos_escolas', 'public'); 

                DocumentoEscola::create([         
                    'escola_id' => $escola->id,
                    'arquivo'   => $path,
                ]);
            }
        }

        return redirect()->route('escolas.index')->with('success', 'Escola atualizada com sucesso!');
    }


    public function destroy(Escola $escola){
        foreach ($escola->documentos as $documento) {
            Storage::disk('public')->delete($documento->arquivo);
            $documento->delete();
        }

        $escola->delete();

        return redirect()->route('escolas.index')->with('success', 'Escola excluída com sucesso!');
    }
}
