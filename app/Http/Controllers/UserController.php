<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perfil;
use App\Models\Profissional;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::with('perfis')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perfis = Perfil::all();
        $profissionais = Profissional::whereNull('user_id')->where('ativo', true)->orderBy('nome')->get();
        return view('usuarios.create', compact('perfis', 'profissionais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string|max:50',
            'lastName'  => 'required|string|max:50',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6|confirmed',
            'perfis'    => 'required|array',

        ]);

        $usuario = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ativo' => true,
        ]);

        $usuario->perfis()->sync($request->perfis);

        if ($request->filled('profissional_id')) {
            Profissional::where('id', $request->profissional_id)->update(['user_id' => $usuario->id]);
        }

        return redirect()->route('usuarios.index')->with('success', "Usuário $usuario->firstName cadastrado com sucesso");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = User::with('profissional')->findOrFail($id);
        $perfis = Perfil::all();
        $perfisDoUsuario = $usuario->perfis->pluck('id')->toArray();
        $profissionais = Profissional::where(function($q) use ($usuario) {
            $q->whereNull('user_id')->orWhere('user_id', $usuario->id);
        })->where('ativo', true)->orderBy('nome')->get();
        return view('usuarios.edit', compact('usuario', 'perfis', 'perfisDoUsuario', 'profissionais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'firstName' => 'required|string|max:50',
            'lastName'  => 'required|string|max:50',
            'email'     => 'required|email|unique:users,email,' . $usuario->id,
            'password'  => 'nullable|string|min:6|confirmed',
            'perfis'    => 'required|array',
        ]);

        $usuario->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'ativo' => $request->has('ativo'),
        ]);

        if ($request->filled('password')){
            $usuario->update(['password' => Hash::make($request->password)]);
        }

        $usuario->perfis()->sync($request->perfis);

        Profissional::where('user_id', $usuario->id)->update(['user_id' => null]);
        if ($request->filled('profissional_id')) {
            Profissional::where('id', $request->profissional_id)->update(['user_id' => $usuario->id]);
        }

        return redirect()->route('usuarios.index')->with('success', "Usuário $usuario->firstName atualizado com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->update(['ativo' => false]);
        return redirect()->route('usuarios.index')->with('success', "Usuário $usuario->firstName desativado com sucesso");
    }
}