@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/index.css') }}">
@endpush

@section('content')

<div class="escola-page">
    <div class="escola-card">

        <div class="header-flex">
            <h1 class="escola-title">Lista de Alunos</h1>
            <a href="{{ route('alunos.create') }}" class="btn-nova">+ Novo Aluno</a>
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
                        <th>Data de Nasc.</th>
                        <th>Celular</th>
                        <th>Escola</th>
                        <th>Filas de Espera</th>
                        <th>Status</th>
                        <th style="text-align:right;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alunos as $index => $aluno)
                    <tr class="{{ $aluno->ativo ? '' : 'row-inativo' }}">
                        <td style="font-weight:700;">#{{ $index + 1 }}</td>
                        <td style="color:#1e293b; font-weight:600;">{{ $aluno->nome }}</td>
                        <td>{{ \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') }}</td>
                        <td>{{ $aluno->celular ?? '—' }}</td>
                        <td>{{ $aluno->escola->nome ?? '—' }}</td>
                        <td>
                            @forelse($aluno->listasEspera as $lista)
                                <span style="display:inline-block; background:#e0f2fe; color:#0369a1; border-radius:999px; padding:2px 10px; font-size:0.8rem; margin:2px;">
                                    {{ $lista->nome }}
                                </span>
                            @empty
                                <span style="color:#94a3b8; font-size:0.85rem;">—</span>
                            @endforelse
                        </td>
                        <td>
                            <span class="badge-status {{ $aluno->ativo ? 'badge-ativo' : 'badge-inativo' }}">
                                {{ $aluno->ativo ? 'Ativo' : 'Inativo' }}
                            </span>
                        </td>
                        <td style="text-align:right; white-space:nowrap;">
                            <a href="{{ route('alunos.show', $aluno->id) }}" class="btn-action btn-ver">Ver</a>
                            <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn-action btn-editar">Editar</a>
                            <form action="{{ route('alunos.toggle', $aluno->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                @if($aluno->ativo)
                                    <button type="submit" class="btn-action btn-desligar"
                                        onclick="return confirm('Deseja desativar {{ addslashes($aluno->nome) }}?')">
                                        Desativar
                                    </button>
                                @else
                                    <button type="submit" class="btn-action btn-reativar"
                                        onclick="return confirm('Deseja reativar {{ addslashes($aluno->nome) }}?')">
                                        Reativar
                                    </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align:center; padding:40px; color:#94a3b8;">
                            <p style="font-size:18px; margin:0;">Nenhum aluno cadastrado.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
