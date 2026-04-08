<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ContaController extends Controller
{

    public function index()
    {
        return view('conta.index', ['user' => Auth::user()]);
    }

    public function updatePerfil(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName'  => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . Auth::id(),
            'foto'      => 'nullable|image|max:2048',
        ], [
            'firstName.required' => 'O nome é obrigatório.',
            'lastName.required'  => 'O sobrenome é obrigatório.',
            'email.required'     => 'O e-mail é obrigatório.',
            'email.email'        => 'Informe um e-mail válido.',
            'email.unique'       => 'Este e-mail já está em uso.',
            'foto.image'         => 'O arquivo deve ser uma imagem.',
            'foto.max'           => 'A imagem deve ter no máximo 2MB.',
        ]);


        if ($request->hasFile('foto')) {
            $request->file(('foto'), $validated);
            $path = $request->file('foto')->store('fotos/usuarios', 'public');
            $validated['foto'] = $path;
        } else{
            unset($validated['foto']);
        }

        $user = \App\Models\User::find(Auth::id());
        $user->fill($validated);
        $user->save();

        return back()->with('success', 'Dados atualizados com sucesso');
    }

    public function updateSenha(Request $request)
    {
        $request->validate([
            'senha_atual' => 'required',
            'nova_senha'  => [
                'required',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
        ], [
            'nova_senha.min'       => 'A senha deve ter no mínimo 8 caracteres.',
            'nova_senha.regex'     => 'A senha deve conter ao menos uma letra maiúscula, um número e um caractere especial (@$!%*#?&).',
            'nova_senha.confirmed' => 'A confirmação da senha não confere.',
        ]);

        if (!Hash::check($request->senha_atual, Auth::user()->password)) {
            return back()->withErrors(['senha_atual' => 'Senha atual incorreta']);
        }

        $user = \App\Models\User::find(Auth::id());
        $user->password = $request->nova_senha;
        $user->save();

        return back()->with('success', 'Senha alterada com sucesso');
    }
}
