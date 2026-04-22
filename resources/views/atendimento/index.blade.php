@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/crud.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/atendimento/index.css') }}">
@endpush

@section('content')

@php
  $dataCarbon   = \Carbon\Carbon::parse($dataSelecionada);
  $inicioSemana = $dataCarbon->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
  $fimSemana    = $inicioSemana->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);

  $diasSemana = [];
  for ($i = 0; $i < 7; $i++) {
    $diasSemana[] = $inicioSemana->copy()->addDays($i);
  }

  $semanaAnterior = $inicioSemana->copy()->subDays(1)->toDateString();
  $proximaSemana  = $fimSemana->copy()->addDays(1)->toDateString();

  $nomeDia = [
    'Monday'    => 'Segunda-feira',
    'Tuesday'   => 'Terça-feira',
    'Wednesday' => 'Quarta-feira',
    'Thursday'  => 'Quinta-feira',
    'Friday'    => 'Sexta-feira',
    'Saturday'  => 'Sábado',
    'Sunday'    => 'Domingo',
  ];

  $diaSemanaAbrev = [
    'Monday'    => 'Seg',
    'Tuesday'   => 'Ter',
    'Wednesday' => 'Qua',
    'Thursday'  => 'Qui',
    'Friday'    => 'Sex',
    'Saturday'  => 'Sáb',
    'Sunday'    => 'Dom',
  ];

  $meses = [
    1  => 'janeiro', 2  => 'fevereiro', 3  => 'março',
    4  => 'abril',   5  => 'maio',      6  => 'junho',
    7  => 'julho',   8  => 'agosto',    9  => 'setembro',
    10 => 'outubro', 11 => 'novembro',  12 => 'dezembro',
  ];

  $nomeDiaFormatado = $nomeDia[$dataCarbon->format('l')]
    . ', ' . $dataCarbon->day
    . ' de ' . $meses[(int)$dataCarbon->month]
    . ' de ' . $dataCarbon->year;
@endphp

<div class="aluno-page">
<div class="aluno-card">
<div class="ag-page">

  {{-- ===== CABEÇALHO ===== --}}
  <div class="ag-header">
    <h1 class="ag-title">Agendamentos</h1>
    @if(!$profissionalFixo && auth()->user()->temPermissao('agendamentos.gerenciar'))
      <a href="{{ route('agendamentos.create') }}" class="ag-btn-novo">
        <i class="bi bi-plus-lg"></i> Novo agendamento
      </a>
    @endif
  </div>

  {{-- ===== FILTROS ===== --}}
  <div class="ag-filter-bar">
    <form method="GET" action="{{ route('agendamentos') }}" class="ag-filter-form">
      <input type="hidden" name="data" value="{{ $dataSelecionada }}">

      @if($profissionalFixo)
        <input type="hidden" name="profissional_id" value="{{ $profissionalId }}">
        <span class="ag-filter-label">
          <i class="bi bi-person-badge"></i> {{ $profissionais->firstWhere('id', $profissionalId)?->nome }}
        </span>
      @else
        <label class="ag-filter-label" for="profissional_id">
          <i class="bi bi-person-badge"></i> Profissional
        </label>
        <select name="profissional_id" id="profissional_id" class="ag-filter-select" onchange="this.form.submit()">
          <option value="">Todos</option>
          @foreach($profissionais as $prof)
            <option value="{{ $prof->id }}" {{ $profissionalId == $prof->id ? 'selected' : '' }}>
              {{ $prof->nome }}
            </option>
          @endforeach
        </select>
      @endif

      <label class="ag-filter-label" for="aluno_id" style="margin-left:12px;">
        <i class="bi bi-person"></i> Aluno
      </label>
      <select name="aluno_id" id="aluno_id" class="ag-filter-select" onchange="this.form.submit()">
        <option value="">Todos</option>
        @foreach($alunos as $aluno)
          <option value="{{ $aluno->id }}" {{ $alunoId == $aluno->id ? 'selected' : '' }}>
            {{ $aluno->nome }}
          </option>
        @endforeach
      </select>

      @if($alunoId || $profissionalId)
        @if($alunoId)
          <a href="{{ route('agendamentos.relatorio', ['alunoId' => $alunoId, 'profissional_id' => $profissionalId]) }}"
             target="_blank" class="ag-btn-novo" style="margin-left:auto;">
            <i class="bi bi-printer"></i> Imprimir horários
          </a>
        @else
          <a href="{{ route('agendamentos.relatorio.profissional', $profissionalId) }}"
             target="_blank" class="ag-btn-novo" style="margin-left:auto;">
            <i class="bi bi-printer"></i> Imprimir horários
          </a>
        @endif
      @endif

    </form>
  </div>

  {{-- ===== NAVEGAÇÃO SEMANAL ===== --}}
  <div class="ag-semana-wrap">

    <a href="{{ route('agendamentos', array_filter(['data' => $semanaAnterior, 'profissional_id' => $profissionalId, 'aluno_id' => $alunoId])) }}"
       class="ag-semana-nav" title="Semana anterior">
      <i class="bi bi-chevron-left"></i>
    </a>

    <div class="ag-dias">
      @foreach($diasSemana as $dia)
        @php
          $isHoje        = $dia->isToday();
          $isSelecionado = $dia->toDateString() === $dataSelecionada;
          $classes = 'ag-dia';
          if ($isSelecionado)       $classes .= ' ag-dia--ativo';
          elseif ($isHoje)          $classes .= ' ag-dia--hoje';
        @endphp
        <a href="{{ route('agendamentos', array_filter(['data' => $dia->toDateString(), 'profissional_id' => $profissionalId, 'aluno_id' => $alunoId])) }}"
           class="{{ $classes }}">
          <span class="ag-dia-nome">{{ $diaSemanaAbrev[$dia->format('l')] }}</span>
          <span class="ag-dia-num">{{ $dia->day }}</span>
          @if($isHoje && !$isSelecionado)
            <span class="ag-dia-dot"></span>
          @endif
        </a>
      @endforeach
    </div>

    <a href="{{ route('agendamentos', array_filter(['data' => $proximaSemana, 'profissional_id' => $profissionalId, 'aluno_id' => $alunoId])) }}"
       class="ag-semana-nav" title="Próxima semana">
      <i class="bi bi-chevron-right"></i>
    </a>

  </div>

  {{-- ===== LISTA DO DIA ===== --}}
  <div class="ag-lista-wrap">

    <div class="ag-lista-header">
      <span class="ag-lista-data">
        <i class="bi bi-calendar3"></i>
        {{ $nomeDiaFormatado }}
      </span>
      <span class="ag-lista-total">
        {{ $agendamentos->count() }} agendamento{{ $agendamentos->count() !== 1 ? 's' : '' }}
      </span>
    </div>

    @if($agendamentos->isEmpty())
      <div class="ag-vazio">
        <i class="bi bi-calendar-x ag-vazio-icon"></i>
        <p>Nenhum agendamento para este dia.</p>
        @if(!$profissionalFixo && auth()->user()->temPermissao('agendamentos.gerenciar'))
          <a href="{{ route('agendamentos.create') }}" class="ag-btn-novo ag-btn-novo--outline">
            <i class="bi bi-plus-lg"></i> Criar agendamento
          </a>
        @endif
      </div>
    @else
      <div class="ag-cards">
        @foreach($agendamentos as $ag)
          @php
            $statusClass = match($ag->status ?? 'agendado') {
              'realizado'  => 'ag-status--realizado',
              'cancelado'  => 'ag-status--cancelado',
              'falta'      => 'ag-status--falta',
              default      => 'ag-status--agendado',
            };
            $statusLabel = match($ag->status ?? 'agendado') {
              'realizado'  => 'Realizado',
              'cancelado'  => 'Cancelado',
              'falta'      => 'Falta',
              default      => 'Agendado',
            };
          @endphp
          <div class="ag-card">
            <div class="ag-card-hora">
              {{ \Carbon\Carbon::parse($ag->horarioProfissional->hora_inicio)->format('H:i') }}
              <span class="ag-card-duracao">{{ $ag->horarioProfissional->duracao_minutos }}min</span>
            </div>
            <div class="ag-card-info">
              <span class="ag-card-aluno">{{ $ag->aluno->nome }}</span>
              <span class="ag-card-prof">
                <i class="bi bi-person-fill"></i> {{ $ag->horarioProfissional->profissional->nome }}
              </span>
              @if($ag->observacoes)
                <span class="ag-card-obs">{{ $ag->observacoes }}</span>
              @endif
            </div>
            <div class="ag-card-right">
              <span class="ag-status {{ $statusClass }}">{{ $statusLabel }}</span>
              <div class="ag-card-acoes">
                @if(auth()->user()->temPermissao('alunos.gerenciar'))
                  <a href="{{ route('alunos.show', $ag->aluno_id) }}" class="ag-icon-btn" title="Ver aluno">
                    <i class="bi bi-eye"></i>
                  </a>
                @endif
                @if(!$profissionalFixo && auth()->user()->temPermissao('agendamentos.gerenciar'))
                  <a href="{{ route('agendamentos.edit', $ag->id) }}" class="ag-icon-btn" title="Editar agendamento">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <form action="{{ route('agendamentos.destroy', $ag->id) }}" method="POST"
                        onsubmit="return confirm('Remover este agendamento?')" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="ag-icon-btn ag-icon-btn--danger" title="Remover agendamento">
                      <i class="bi bi-x-lg"></i>
                    </button>
                  </form>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif

  </div>

</div>
</div>
</div>

@endsection
