@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/index.css') }}">
@endpush

@section ('content')

<div class="escola-page">
    <div class="escola-card">

        <div class="header-flex">
            <h1 class="escola-title">Lista de Profissionais</h1>

            <a href="{{ route('profissionais.create') }}" class="btn-nova">
                + Novo Profissional
            </a>
        </div>

        @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Profissão</th>
                        <th>Especialização</th>
                        <th>Celular</th>
                        <th>Status</th>
                        <th style="text-align: right;">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($profissionais as $index => $profissional)
                    <tr class="{{ $profissional->ativo ? '' : 'row-inativo' }}">
                        <td style="font-weight: 700;">#{{ $index + 1 }}</td>
                        <td style="color: #1e293b; font-weight: 600;">{{ $profissional->nome }}</td>
                        <td>{{ $profissional->profissao ?? '—' }}</td>
                        <td>{{ $profissional->especializacao ?? '—' }}</td>
                        <td>{{ $profissional->celular ?? '—' }}</td>

                        <td>
                            <span class="badge-status {{ $profissional->ativo ? 'badge-ativo' : 'badge-inativo' }}">
                                {{ $profissional->ativo ? 'Ativo' : 'Inativo' }}
                            </span>
                        </td>

                        <td style="text-align: right; white-space: nowrap;">
                            <a href="{{ route('profissionais.show', $profissional->id) }}" class="btn-action btn-ver">
                                Ver
                            </a>

                            <a href="{{ route('profissionais.edit', $profissional->id) }}" class="btn-action btn-editar">
                                Editar
                            </a>

                            <form action="{{ route('profissionais.toggle', $profissional->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                @if($profissional->ativo)
                                    <button type="submit" class="btn-action btn-desligar"
                                        onclick="return confirm('Deseja desligar {{ addslashes($profissional->nome) }}?')">
                                        Desligar
                                    </button>
                                @else
                                    <button type="submit" class="btn-action btn-reativar"
                                        onclick="return confirm('Deseja reativar {{ addslashes($profissional->nome) }}?')">
                                        Reativar
                                    </button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:40px; color: #94a3b8;">
                            <p style="font-size: 18px; margin: 0;">Nenhum profissional cadastrado.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection