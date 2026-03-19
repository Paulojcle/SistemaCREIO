<?php

namespace App\Http\Controllers;

use App\Models\OrigemEncaminhamento;
use Illuminate\Http\Request;

class OrigemEncaminhamentoController extends Controller
{
    public function index()
    {
        $origens = OrigemEncaminhamento::all();
        return view('origem_encaminhamento.index', compact('origens'));
    }

    public function store(Request $request)
    {
        OrigemEncaminhamento::create([
            'nome' => $request->nome,
        ]);

        return redirect()->route('origensEncaminhamento.index')->with('success', 'Origem de encaminhamento cadastrada com sucesso!');
    }

    public function update(Request $request, OrigemEncaminhamento $origensEncaminhamento)
    {
        $request->validate(['nome' => 'required|string|max:50']);
        $origensEncaminhamento->update($request->only(['nome']));
        return redirect()->route('origensEncaminhamento.index')->with('success', 'Origem atualizada com sucesso!');
    }

    public function destroy(OrigemEncaminhamento $origensEncaminhamento)
    {
        $origensEncaminhamento->delete();
        return redirect()->route('origensEncaminhamento.index')->with('success', 'Origem excluída com sucesso!');
    }

}
