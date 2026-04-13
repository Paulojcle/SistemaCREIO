<?php

namespace App\Http\Controllers;

use App\Models\Deficiencia;
use Illuminate\Http\Request;
use App\Traits\RegistraLog;

class DeficienciaController extends Controller
{
    use RegistraLog;
    public function index()
    {
        $deficiencias = Deficiencia::all();
        return view('deficiencia.index', compact('deficiencias'));
    } 

    public function store(Request $request)
    {

        $request->validate([
            'nome'         => 'required|string|max:100',
        ]);

        $deficiencia = Deficiencia::create([
            'nome' => $request->nome,
        ]);

        $this->registrarLog('criou', 'Deficiência', "Cadastrou o tipo de deficiência {$deficiencia->nome}");

        return redirect()->route('deficiencias.index')->with('success', 'Tipo de deficiência cadastrado com sucesso!');
    }

    public function update(Request $request, Deficiencia $deficiencia)
    {
        $request->validate([
            'nome' => 'required|string|max:50',
        ]);

        $deficiencia->update($request->only(['nome']));

        $this->registrarLog('editou', 'Deficiência', "Editou o tipo de deficiência {$deficiencia->nome}");

        return redirect()->route('deficiencias.index')->with('success', 'Tipo de deficiência atualizado com sucesso!');
    }

    public function destroy(Deficiencia $deficiencia)
    {
        $this->registrarLog('excluiu', 'Deficiência', "Excluiu o tipo de deficiência {$deficiencia->nome}");

        $deficiencia->delete();
        return redirect()->route('deficiencias.index')->with('success', 'Tipo de deficiência excluído com sucesso!');
    }
}