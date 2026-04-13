<?php

namespace App\Http\Controllers;

use App\Models\ListaEspera;
use App\Models\Profissional;
use Illuminate\Http\Request;
use App\Traits\RegistraLog;

class ListaEsperaController extends Controller
{
    use RegistraLog;
    public function filas()
    {
        $listas = ListaEspera::with(['alunos' => function ($q) {
            $q->where('alunos.ativo', true)
              ->wherePivot('status', 'aguardando')
              ->orderBy('lista_espera_aluno.data_entrada');
        }, 'profissionais'])->where('ativo', true)->get();

        return view('lista_espera.filas', compact('listas'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listas = ListaEspera::with('profissionais')->get();
        $profissionais = Profissional::where ('ativo', true)->get();
        return view('lista_espera.index', compact('listas', 'profissionais'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nome'        => 'required|string|max:100',
        ]);

        $lista = ListaEspera::create([
            'nome' => $request->nome,
        ]);

        $lista->profissionais()->sync($request->profissionais ?? []);

        $this->registrarLog('criou', 'Lista de Espera', "Cadastrou a lista de espera {$lista->nome}");

        return redirect()->route('listasEspera.index')->with('success', 'Lista de espera cadastrada com sucesso');
    }


    public function toggle(ListaEspera $lista){
        $lista -> update([
            'ativo' => !$lista->ativo,
        ]);

        $acao = $lista->ativo ? 'reativou' : 'desativou';
        $this->registrarLog($acao, 'Lista de Espera', ucfirst($acao) . " a lista de espera {$lista->nome}");

        $status = $lista->ativo ? 'reativada' : 'desligada';
        return redirect()->route('listasEspera.index')->with('success', "lista {$status} com sucesso");
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request  $request, ListaEspera $lista)
    {
        $request -> validate([
            'nome'            => 'required|string|max:50', 
        ]);

        $lista -> update([
            'nome' =>$request->nome,
        ]);

        $lista->profissionais()->sync($request->profissionais ?? []);

        $this->registrarLog('editou', 'Lista de Espera', "Editou a lista de espera {$lista->nome}");

        return redirect()->route('listasEspera.index')->with('success', "lista de espera {$lista->nome} atualizada com sucesso");
 
    }

}
