<?php

namespace App\Http\Controllers;

use App\Models\OrigemEncaminhamento;
use Illuminate\Http\Request;
use App\Traits\RegistraLog;

class OrigemEncaminhamentoController extends Controller
{
    use RegistraLog;
    public function index()
    {
        $origens = OrigemEncaminhamento::all();
        return view('origem_encaminhamento.index', compact('origens'));
    }

    public function store(Request $request)
    {

        $request->validate([ 
            'nome'       => 'required|string|max:100',
        ]);
        
            

        $origem = OrigemEncaminhamento::create([
            'nome' => $request->nome,
        ]);

        $this->registrarLog('criou', 'Origem de Encaminhamento', "Cadastrou a origem {$origem->nome}");

        return redirect()->route('origensEncaminhamento.index')->with('success', 'Origem de encaminhamento cadastrada com sucesso!');
    }

    public function update(Request $request, OrigemEncaminhamento $origensEncaminhamento)
    {
        $request->validate(['nome' => 'required|string|max:50']);

        $origensEncaminhamento->update($request->only(['nome']));
        
        $this->registrarLog('editou', 'Origem de Encaminhamento', "Editou a origem {$origensEncaminhamento->nome}");

        return redirect()->route('origensEncaminhamento.index')->with('success', 'Origem atualizada com sucesso!');
    }

    public function destroy(OrigemEncaminhamento $origensEncaminhamento)
    {
        $this->registrarLog('excluiu', 'Origem de Encaminhamento', "Excluiu a origem {$origensEncaminhamento->nome}");

        $origensEncaminhamento->delete();
        return redirect()->route('origensEncaminhamento.index')->with('success', 'Origem excluída com sucesso!');
    }

}
