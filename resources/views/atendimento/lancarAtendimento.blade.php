@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/atendimento/createAtendimento.css') }}">
@endpush

@section('content')
<div class="la-page">

  {{-- ====== BUSCA ====== --}}
  <div class="la-search-wrap">
    <div class="la-search-card">
      <div class="la-search-icon">
        <i class="bi bi-clipboard2-pulse"></i>
      </div>
      <form class="la-search-form" action="{{ route('atendimento.lancar') }}" method="GET">
        <input class="la-input" type="text" name="q" value="{{ request('q') }}" placeholder="Pesquisar pelo nome do aluno...">
        <button class="la-btn" type="submit">Buscar</button>
      </form>
    </div>
  </div>

  {{-- ====== QUADRO / TABELA ====== --}}
  <section class="la-board">

    <header class="la-board-head">
      <h2 class="la-board-title">Alunos ativos</h2>
      <span class="la-pill">{{ $alunos->count() }}</span>
    </header>

    <div class="la-table-wrap">
      <table class="la-table">
        <thead>
          <tr>
            <th class="col-id">ID</th>
            <th class="col-nome">Nome</th>
            <th class="col-escola">Escola</th>
            <th class="col-filiacao">Filiação</th>
            <th class="col-acoes">Ações</th>
          </tr>
        </thead>
        <tbody>
          @forelse($alunos as $aluno)
            <tr>
              <td class="col-id">{{ $aluno->id }}</td>
              <td class="col-nome">{{ $aluno->nome }}</td>
              <td class="col-escola">{{ $aluno->escola?->nome ?? '—' }}</td>
              <td class="col-filiacao">
                {{ $aluno->filiacao1 ?? '—' }}<br>
                {{ $aluno->filiacao2 ?? '' }}
              </td>
              <td class="col-acoes">
                <a href="{{ route('alunos.show', $aluno->id) }}" class="la-icon" title="Ver aluno">
                  <i class="bi bi-eye"></i>
                </a>
                <a
                  href="{{ route('atendimento.form', $aluno->id) }}"
                  class="la-icon"
                  title="Lançar atendimento"
                >
                  <i class="bi bi-clipboard2-plus"></i>
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="la-vazio">Nenhum aluno encontrado.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </section>

</div>
@endsection
