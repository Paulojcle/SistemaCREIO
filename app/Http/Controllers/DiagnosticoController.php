<?php

namespace App\Http\Controllers;

use App\Models\Diagnostico;
use Illuminate\Http\Request;
use App\Traits\RegistraLog;

class DiagnosticoController extends Controller
{
    use RegistraLog;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diagnosticos = Diagnostico::all();
        return view('diagnostico.index', compact('diagnosticos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nome'       =>'required|string|max:100',
        ])

        $diagnostico = Diagnostico::create([
            'nome' => $request->nome,
        ]);

        $this->registrarLog('criou', 'Diagnóstico', "Cadastrou o tipo de diagnóstico {$diagnostico->nome}");

        return redirect()->route('diagnosticos.index')->with('success', 'diagnóstico cadastrado com sucesso');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diagnostico $diagnostico)
    {
        $request->validate([
            'nome'             => 'required|string|max:50',
        ]);

        $diagnostico->update($request->only([
            'nome',
        ]));

        $this->registrarLog('editou', 'Diagnóstico', "Editou o tipo de diagnóstico {$diagnostico->nome}");

        return redirect()->route('diagnosticos.index', $diagnostico->id)->with('success', 'diagnóstico atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnostico $diagnostico)
    {
        $this->registrarLog('excluiu', 'Diagnóstico', "Excluiu o tipo de diagnóstico {$diagnostico->nome}");

        $diagnostico->delete();
        return redirect()->route('diagnosticos.index')->with('success', 'Diagnóstico excluído com sucesso');
    }
}
