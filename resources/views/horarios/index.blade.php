@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/index.css') }}">
@endpush

@section('content')

<div class="escola-page">
    <div class="escola-card">

        <div class="header-flex">
            <h1 class="escola-title">Horários de Atendimento</h1>
        </div>

        <p style="color: #64748b; margin-bottom: 24px;">Selecione um profissional para gerenciar seus horários disponíveis.</p>

        @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Profissão</th>
                        <th>Especialização</th>
                        <th>Status</th>
                        <th style="text-align: right;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profissionais as $profissional)
                    <tr class="{{ $profissional->ativo ? '' : 'row-inativo' }}">
                        <td style="color: #1e293b; font-weight: 600;">{{ $profissional->nome }}</td>
                        <td>{{ $profissional->profissao ?? '—' }}</td>
                        <td>{{ $profissional->especializacao ?? '—' }}</td>
                        <td>
                            <span class="badge-status {{ $profissional->ativo ? 'badge-ativo' : 'badge-inativo' }}">
                                {{ $profissional->ativo ? 'Ativo' : 'Inativo' }}
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('horarios.show', $profissional->id) }}" class="btn-action btn-ver">
                                Gerenciar Horários
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:40px; color: #94a3b8;">
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
