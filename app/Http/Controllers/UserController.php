<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perfil;
use App\Models\Profissional;
use Illuminate\Support\Facades\Hash;
use App\Traits\RegistraLog;

class UserController extends Controller
{
    use RegistraLog;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::with('perfis')
            ->when(!auth()->user()->is_super, fn($q) => $q->where('is_super', false))
            ->get();
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
            'password'  => ['required', 'string', 'min:8', 'confirmed', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'perfis'    => 'required|array',
        ], [
            'firstName.required' => 'O nome é obrigatório.',
            'firstName.max'      => 'O nome deve ter no máximo 50 caracteres.',
            'lastName.required'  => 'O sobrenome é obrigatório.',
            'lastName.max'       => 'O sobrenome deve ter no máximo 50 caracteres.',
            'email.required'     => 'O e-mail é obrigatório.',
            'email.email'        => 'Informe um e-mail válido.',
            'email.unique'       => 'Este e-mail já está em uso.',
            'password.required'  => 'A senha é obrigatória.',
            'password.min'       => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não coincide.',
            'password.regex'     => 'A senha deve conter pelo menos uma letra maiúscula, um número e um caractere especial (@$!%*#?&).',
            'perfis.required'    => 'Selecione pelo menos um perfil.',
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

        $this->registrarLog('criou', 'Usuário', "Cadastrou o usuário {$usuario->firstName} {$usuario->lastName}");

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

        if ($usuario->is_super && auth()->id() !== $usuario->id) {
            return redirect()->route('usuarios.index')->with('error', 'Acesso negado.');
        }
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

        if ($usuario->is_super && auth()->id() !== $usuario->id) {
            return redirect()->route('usuarios.index')->with('error', 'Acesso negado.');
        }

        $request->validate([
            'firstName' => 'required|string|max:50',
            'lastName'  => 'required|string|max:50',
            'email'     => 'required|email|unique:users,email,' . $usuario->id,
            'password'  => ['nullable', 'string', 'min:8', 'confirmed', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'perfis'    => 'required|array',
        ], [
            'firstName.required' => 'O nome é obrigatório.',
            'firstName.max'      => 'O nome deve ter no máximo 50 caracteres.',
            'lastName.required'  => 'O sobrenome é obrigatório.',
            'lastName.max'       => 'O sobrenome deve ter no máximo 50 caracteres.',
            'email.required'     => 'O e-mail é obrigatório.',
            'email.email'        => 'Informe um e-mail válido.',
            'email.unique'       => 'Este e-mail já está em uso.',
            'password.min'       => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não coincide.',
            'password.regex'     => 'A senha deve conter pelo menos uma letra maiúscula, um número e um caractere especial (@$!%*#?&).',
            'perfis.required'    => 'Selecione pelo menos um perfil.',
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

        $this->registrarLog('editou', 'Usuário', "Editou o usuário {$usuario->firstName} {$usuario->lastName}");

        return redirect()->route('usuarios.index')->with('success', "Usuário $usuario->firstName atualizado com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::findOrFail($id);

        if ($usuario->is_super) {
            return redirect()->route('usuarios.index')->with('error', 'Acesso negado.');
        }

        $usuario->update(['ativo' => false]);
        $this->registrarLog('desativou', 'Usuário', "Desativou o usuário {$usuario->firstName} {$usuario->lastName}");

        return redirect()->route('usuarios.index')->with('success', "Usuário $usuario->firstName desativado com sucesso");
    }
}