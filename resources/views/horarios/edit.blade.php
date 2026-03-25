@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/profissional/showProfissional.css') }}">
@endpush

@section('content')
<div class="prof-page">
    <div class="prof-card" style="max-width: 560px;">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="prof-title mb-0">EDITAR HORÁRIO</h1>
                <p style="color: #64748b; margin: 4px 0 0;">{{ $profissional->nome }} — {{ $profissional->profissao ?? 'Profissional' }}</p>
            </div>
            <a href="{{ route('horarios.show', $profissional->id) }}" class="btn-soft-secondary text-decoration-none">
                Cancelar
            </a>
        </div>

        @if($errors->any())
        <div style="background:#fee2e2; color:#b91c1c; border-radius:10px; padding:12px 18px; margin-bottom:16px; font-weight:600;">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('horarios.update', [$profissional->id, $horario->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="info-label">Dia da Semana</label>
                <select name="dia_semana" class="form-select" required>
                    <option value="0" {{ $horario->dia_semana == 0 ? 'selected' : '' }}>Domingo</option>
                    <option value="1" {{ $horario->dia_semana == 1 ? 'selected' : '' }}>Segunda-feira</option>
                    <option value="2" {{ $horario->dia_semana == 2 ? 'selected' : '' }}>Terça-feira</option>
                    <option value="3" {{ $horario->dia_semana == 3 ? 'selected' : '' }}>Quarta-feira</option>
                    <option value="4" {{ $horario->dia_semana == 4 ? 'selected' : '' }}>Quinta-feira</option>
                    <option value="5" {{ $horario->dia_semana == 5 ? 'selected' : '' }}>Sexta-feira</option>
                    <option value="6" {{ $horario->dia_semana == 6 ? 'selected' : '' }}>Sábado</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="info-label">Hora de Início</label>
                <input type="time" name="hora_inicio" class="form-control"
                    value="{{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}" required>
            </div>

            <div class="mb-4">
                <label class="info-label">Duração (minutos)</label>
                <input type="number" name="duracao_minutos" class="form-control"
                    value="{{ $horario->duracao_minutos }}" min="1" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn-soft-primary">Salvar Alterações</button>
                <a href="{{ route('horarios.show', $profissional->id) }}" class="btn-soft-secondary text-decoration-none">Cancelar</a>
            </div>
        </form>

    </div>
</div>
@endsection
