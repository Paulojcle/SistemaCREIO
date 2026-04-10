<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Permissao;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index()
    {
        $perfis = Perfil::with('permissoes')->get();
        $permissoes = Permissao::all();
        return view('perfil.index', compact('perfis', 'permissoes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'      => 'required|string|max:50|unique:perfis,nome',
            'descricao' => 'nullable|string|max:255',
        ]);

        $perfil = Perfil::create($request->only('nome', 'descricao'));
        $perfil->permissoes()->sync($request->input('permissoes', []));

        return redirect()->route('perfis.index')->with('success', 'Perfil cadastrado com sucesso');
    }

    public function update(Request $request, Perfil $perfil)
    {
        $request->validate([
            'nome'      => 'required|string|max:50|unique:perfis,nome,' . $perfil->id,
            'descricao' => 'nullable|string|max:255',
        ]);
        $perfil->update($request->only('nome', 'descricao'));
        $perfil->refresh();

        $perfil->permissoes()->sync($request->input('permissoes', []));


        return redirect()->route('perfis.index')->with('success', 'Perfil atualizado com sucesso');
    }

    public function destroy(Perfil $perfil)
    {
        $perfil->delete();
        return redirect()->route('perfis.index')->with('success', 'Perfil excluído com sucesso');
    }
}
