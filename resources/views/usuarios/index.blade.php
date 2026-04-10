@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/index.css') }}">
@endpush

@section('content')

<div class="escola-page">
    <div class="escola-card">

        <div class="header-flex">
            <h1 class="escola-title">Usuários do Sistema</h1>
            <a href="{{ route('usuarios.create') }}" class="btn-nova">+ Novo Usuário</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Perfis</th>
                        <th>Status</th>
                        <th style="text-align:right;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $index => $usuario)
                    <tr>
                        <td style="font-weight:700;">#{{ $index + 1 }}</td>
                        <td style="color:#1e293b; font-weight:600;">{{ $usuario->firstName }} {{ $usuario->lastName }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            @forelse($usuario->perfis as $perfil)
                                <span style="display:inline-block; background:#e0f2fe; color:#0369a1; border-radius:999px; padding:2px 10px; font-size:0.8rem; margin:2px;">
                                    {{ $perfil->nome }}
                                </span>
                            @empty
                                <span style="color:#94a3b8; font-size:0.85rem;">—</span>
                            @endforelse
                        </td>
                        <td>
                            <span class="badge-status {{ $usuario->ativo ? 'badge-ativo' : 'badge-inativo' }}">
                                {{ $usuario->ativo ? 'Ativo' : 'Inativo' }}
                            </span>
                        </td>
                        <td style="text-align:right; white-space:nowrap;">
                            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn-action btn-editar">Editar</a>
                            @if($usuario->ativo)
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-desligar"
                                        onclick="return confirm('Deseja desativar {{ addslashes($usuario->firstName) }}?')">
                                        Desativar
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:40px; color:#94a3b8;">
                            <p style="font-size:18px; margin:0;">Nenhum usuário cadastrado.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
