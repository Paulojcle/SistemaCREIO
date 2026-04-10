@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/crud.css') }}">
<style>
  .filtros-form {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    align-items: flex-end;
    margin-bottom: 28px;
  }
  .filtros-form label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: .4px;
    margin-bottom: 6px;
  }
  .filtros-form input[type="date"],
  .filtros-form select {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 9px 12px;
    font-size: 14px;
    color: #374151;
    background: #f8fafc;
    outline: none;
    transition: border-color .2s;
  }
  .filtros-form input[type="date"]:focus,
  .filtros-form select:focus {
    border-color: #163C25;
    background: #fff;
  }
  .totalizadores {
    display: flex;
    gap: 16px;
    margin-bottom: 20px;
    flex-wrap: wrap;
  }
  .total-pill {
    background: #f1f5f9;
    border-radius: 10px;
    padding: 10px 18px;
    font-size: 14px;
    color: #475569;
  }
  .total-pill strong { color: #163C25; }
  .msg-vazia {
    text-align: center;
    padding: 48px;
    color: #94a3b8;
    font-size: 15px;
  }
</style>
@endpush

@section('content')
<div class="aluno-page">
<div class="aluno-card">

  <div class="header-flex">
    <h2 class="aluno-title">Relatório de Atendimentos</h2>
  </div>

  {{-- Formulário de filtros --}}
  <form method="GET" action="{{ route('relatorios.atendimentos') }}" class="filtros-form">

    <div>
      <label>Data início</label>
      <input type="date" name="data_inicio" value="{{ request('data_inicio') }}">
    </div>

    <div>
      <label>Data fim</label>
      <input type="date" name="data_fim" value="{{ request('data_fim') }}">
    </div>

    <div>
      <label>Profissional</label>
      <select name="profissional_id">
        <option value="">Todos</option>
        @foreach($profissionais as $p)
          <option value="{{ $p->id }}" {{ request('profissional_id') == $p->id ? 'selected' : '' }}>
            {{ $p->nome }}
          </option>
        @endforeach
      </select>
    </div>

    <div>
      <label>Aluno</label>
      <select name="aluno_id">
        <option value="">Todos</option>
        @foreach($alunos as $a)
          <option value="{{ $a->id }}" {{ request('aluno_id') == $a->id ? 'selected' : '' }}>
            {{ $a->nome }}
          </option>
        @endforeach
      </select>
    </div>

    <div>
      <button type="submit" class="btn-nova">Filtrar</button>
    </div>

  </form>

  {{-- Resultados --}}
  @if($registros->isNotEmpty())

    @php
      $total     = $registros->count();
      $presencas = $registros->where('faltou', false)->count();
      $faltas    = $registros->where('faltou', true)->count();
    @endphp

    <div class="totalizadores">
      <div class="total-pill">Total: <strong>{{ $total }}</strong></div>
      <div class="total-pill">Presenças: <strong>{{ $presencas }}</strong></div>
      <div class="total-pill">Faltas: <strong>{{ $faltas }}</strong></div>
    </div>

    <div style="margin-bottom:16px;">
      <button class="btn-nova" onclick="window.print()">🖨 Imprimir / Salvar PDF</button>
    </div>

    <table class="custom-table">
      <thead>
        <tr>
          <th>Data</th>
          <th>Aluno</th>
          <th>Profissional</th>
          <th>Situação</th>
          <th>Observações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($registros as $r)
          <tr>
            <td>{{ $r->data_atendimento->format('d/m/Y') }}</td>
            <td>{{ $r->aluno->nome }}</td>
            <td>{{ $r->profissional->nome }}</td>
            <td>{{ $r->faltou ? 'Faltou' : 'Presente' }}</td>
            <td>{{ $r->observacoes ?? '—' }}</td>
            <td>
              <a href="{{ route('alunos.show', $r->aluno_id) }}" class="btn-action btn-editar">Ver histórico</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

  @elseif(request()->hasAny(['data_inicio','data_fim','profissional_id','aluno_id']))
    <p class="msg-vazia">Nenhum atendimento encontrado para os filtros selecionados.</p>
  @else
    <p class="msg-vazia">Use os filtros acima para buscar atendimentos.</p>
  @endif

</div>
</div>
@endsection
