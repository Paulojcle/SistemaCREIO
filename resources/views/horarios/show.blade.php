@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/profissional/showProfissional.css') }}">
<style>
    .dia-group {
        margin-bottom: 28px;
    }
    .dia-header {
        font-size: 13px;
        font-weight: 700;
        color: #2f5b77;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 6px 14px;
        background: #f0f6fb;
        border-left: 4px solid #2f5b77;
        border-radius: 6px;
        margin-bottom: 10px;
    }
    .horario-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 18px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        margin-bottom: 8px;
        transition: box-shadow 0.2s;
    }
    .horario-row:hover {
        box-shadow: 0 4px 12px rgba(47,91,119,0.08);
        border-color: #bdd5e5;
    }
    .horario-info {
        font-size: 15px;
        font-weight: 600;
        color: #1e293b;
    }
    .horario-info span {
        font-weight: 400;
        color: #64748b;
        font-size: 13px;
        margin-left: 8px;
    }
    .horario-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    .btn-edit {
        background: #e0f0ff;
        color: #1d4ed8;
        border-radius: 8px;
        padding: 5px 14px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-edit:hover {
        background: #bfdbfe;
        color: #1d4ed8;
    }
    .btn-soft-warning, .btn-soft-success, .btn-soft-danger {
        font-size: 13px;
        padding: 5px 14px;
        border-radius: 8px;
    }
</style>
@endpush

@section('content')
<div class="prof-page">
    <div class="prof-card">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="prof-title mb-0">HORÁRIOS DE ATENDIMENTO</h1>
                <p style="color: #64748b; margin: 4px 0 0;">{{ $profissional->nome }} — {{ $profissional->profissao ?? 'Profissional' }}</p>
            </div>
            <a href="{{ route('horarios.index') }}" class="btn-soft-secondary text-decoration-none">
                Voltar
            </a>
        </div>

        @if(session('success'))
        <div class="alert-success mb-4">
            {{ session('success') }}
        </div>
        @endif

        {{-- Horários agrupados por dia --}}
        @php
            $dias = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
            $horariosPorDia = $profissional->horarios->sortBy('hora_inicio')->groupBy('dia_semana');
        @endphp

        @if($horariosPorDia->isNotEmpty())
            @foreach($dias as $num => $nomeDia)
                @if($horariosPorDia->has($num))
                <div class="dia-group">
                    <div class="dia-header">{{ $nomeDia }}</div>

                    @foreach($horariosPorDia[$num]->sortBy('hora_inicio') as $horario)
                    <div class="horario-row">
                        <div class="horario-info">
                            {{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}
                            <span>{{ $horario->duracao_minutos }} min</span>
                            <span style="margin-left: 12px;">
                                <span class="badge-status {{ $horario->ativo ? 'badge-ativo' : 'badge-inativo' }}" style="font-size: 11px; padding: 3px 10px;">
                                    {{ $horario->ativo ? 'Ativo' : 'Inativo' }}
                                </span>
                            </span>
                        </div>
                        <div class="horario-actions">
                            <a href="{{ route('horarios.edit', [$profissional->id, $horario->id]) }}" class="btn-edit">
                                Editar
                            </a>
                            <form action="{{ route('horarios.toggle', [$profissional->id, $horario->id]) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="{{ $horario->ativo ? 'btn-soft-warning' : 'btn-soft-success' }}">
                                    {{ $horario->ativo ? 'Desativar' : 'Ativar' }}
                                </button>
                            </form>
                            <form action="{{ route('horarios.destroy', [$profissional->id, $horario->id]) }}" method="POST"
                                onsubmit="return confirm('Remover este horário?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-soft-danger">Excluir</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            @endforeach
        @else
            <p style="color: #94a3b8; font-style: italic; margin-bottom: 24px;">Nenhum horário cadastrado para este profissional.</p>
        @endif

        {{-- Formulário para adicionar novo horário --}}
        <div class="section-docs">
            <p class="info-label mb-3">Adicionar Novo Horário</p>

            @if($errors->any())
            <div style="background:#fee2e2; color:#b91c1c; border-radius:10px; padding:12px 18px; margin-bottom:16px; font-weight:600;">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('horarios.store', $profissional->id) }}" method="POST" class="row g-2 align-items-end">
                @csrf
                <div class="col-12 col-md-3">
                    <label class="info-label">Dia da Semana</label>
                    <select name="dia_semana" class="form-select form-select-sm" required>
                        <option value="">Selecione...</option>
                        <option value="0">Domingo</option>
                        <option value="1">Segunda-feira</option>
                        <option value="2">Terça-feira</option>
                        <option value="3">Quarta-feira</option>
                        <option value="4">Quinta-feira</option>
                        <option value="5">Sexta-feira</option>
                        <option value="6">Sábado</option>
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <label class="info-label">Hora de Início</label>
                    <input type="time" name="hora_inicio" class="form-control form-control-sm" required>
                </div>
                <div class="col-12 col-md-3">
                    <label class="info-label">Duração (minutos)</label>
                    <input type="number" name="duracao_minutos" class="form-control form-control-sm" min="1" placeholder="Ex: 50" required>
                </div>
                <div class="col-12 col-md-3">
                    <button type="submit" class="btn-soft-primary w-100">Adicionar Horário</button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
