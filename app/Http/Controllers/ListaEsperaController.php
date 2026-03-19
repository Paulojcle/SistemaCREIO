<?php

namespace App\Http\Controllers;

use App\Models\ListaEspera;
use App\Models\Profissional;
use Illuminate\Http\Request;

class ListaEsperaController extends Controller
{
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
        $lista = ListaEspera::create([
            'nome' => $request->nome,
        ]);

        $lista->profissionais()->sync($request->profissionais ?? []);

        return redirect()->route('listasEspera.index')->with('success', 'Lista de espera cadastrada com sucesso');
    }


    public function toggle(ListaEspera $lista){
        $lista -> update([
            'ativo' => !$lista->ativo,
        ]);

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

        return redirect()->route('listasEspera.index')->with('success', "lista de espera {$lista->nome} atualizada com sucesso");
 
    }

}
