@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/crud.css') }}">
<style>
  .fila-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    margin-bottom: 24px;
    overflow: hidden;
  }

  .fila-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 24px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
  }

  .fila-header-left {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .fila-titulo {
    font-size: 1.05rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
  }

  .fila-badge-total {
    background: #3b82f6;
    color: #fff;
    border-radius: 999px;
    padding: 2px 10px;
    font-size: 0.78rem;
    font-weight: 600;
  }

  .fila-profissionais {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
  }

  .badge-prof {
    background: #e0f2fe;
    color: #0369a1;
    border-radius: 999px;
    padding: 2px 10px;
    font-size: 0.78rem;
  }

  .status-badge {
    border-radius: 999px;
    padding: 2px 10px;
    font-size: 0.78rem;
    font-weight: 600;
  }

  .status-aguardando {
    background: #fef9c3;
    color: #854d0e;
  }

  .status-atendendo {
    background: #dcfce7;
    color: #166534;
  }

  .status-outro {
    background: #f1f5f9;
    color: #475569;
  }

  .fila-vazia {
    padding: 32px;
    text-align: center;
    color: #94a3b8;
    font-size: 0.9rem;
  }
</style>
@endpush

@section('content')

<div class="aluno-page">
  <div class="aluno-card">

    <div class="header-flex">
      <h1 class="aluno-title">Filas de Espera</h1>
    </div>

    @if(session('success'))
      <div class="alert-success">✅ {{ session('success') }}</div>
    @endif

    @forelse($listas as $lista)
      <div class="fila-card">

        {{-- Cabeçalho da fila --}}
        <div class="fila-header">
          <div class="fila-header-left">
            <h2 class="fila-titulo">{{ $lista->nome }}</h2>
            <span class="fila-badge-total">{{ $lista->alunos->count() }} aluno(s)</span>
          </div>
          <div class="fila-profissionais">
            @forelse($lista->profissionais as $prof)
              <span class="badge-prof">{{ $prof->nome }}</span>
            @empty
              <span style="color:#94a3b8; font-size:0.82rem;">Nenhum profissional vinculado</span>
            @endforelse
          </div>
        </div>

        {{-- Tabela de alunos --}}
        @if($lista->alunos->isEmpty())
          <div class="fila-vazia">Nenhum aluno nesta fila de espera.</div>
        @else
          <div class="table-responsive">
            <table class="custom-table">
              <thead>
                <tr>
                  <th style="width:50px;">#</th>
                  <th>Aluno</th>
                  <th>Data de Entrada</th>
                  <th>Status</th>
                  <th style="text-align:right;">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach($lista->alunos as $i => $aluno)
                  <tr>
                    <td style="font-weight:700; color:#64748b;">{{ $i + 1 }}</td>
                    <td style="font-weight:600; color:#1e293b;">{{ $aluno->nome }}</td>
                    <td style="color:#475569;">
                      {{ \Carbon\Carbon::parse($aluno->pivot->data_entrada)->format('d/m/Y') }}
                    </td>
                    <td>
                      @php $status = $aluno->pivot->status; @endphp
                      <span class="status-badge {{ $status === 'aguardando' ? 'status-aguardando' : ($status === 'atendendo' ? 'status-atendendo' : 'status-outro') }}">
                        {{ ucfirst($status) }}
                      </span>
                    </td>
                    <td style="text-align:right;">
                      <a href="{{ route('alunos.show', $aluno->id) }}" class="btn-action btn-editar">
                        Ver aluno
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif

      </div>
    @empty
      <div style="text-align:center; color:#94a3b8; padding:48px 0;">
        Nenhuma fila de espera ativa cadastrada.
      </div>
    @endforelse

  </div>
</div>

@endsection
