<?php

namespace App\Http\Controllers;

use App\Models\Deficiencia;
use Illuminate\Http\Request;

class DeficienciaController extends Controller
{
    public function index()
    {
        $deficiencias = Deficiencia::all();
        return view('deficiencia.index', compact('deficiencias'));
    } 

    public function store(Request $request)
    {
        Deficiencia::create([
            'nome' => $request->nome,
        ]);

        return redirect()->route('deficiencias.index')->with('success', 'Tipo de deficiência cadastrado com sucesso!');
    }

    public function update(Request $request, Deficiencia $deficiencia)
    {
        $request->validate([
            'nome' => 'required|string|max:50',
        ]);

        $deficiencia->update($request->only(['nome']));

        return redirect()->route('deficiencias.index')->with('success', 'Tipo de deficiência atualizado com sucesso!');
    }

    public function destroy(Deficiencia $deficiencia)
    {
        $deficiencia->delete();
        return redirect()->route('deficiencias.index')->with('success', 'Tipo de deficiência excluído com sucesso!');
    }
}