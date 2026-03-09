@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/atendimento/createAtendimento.css') }}">
@endpush

@section('content')
<div class="la-page">

  {{-- ====== TOPO / BUSCA ====== --}}
  <div class="la-search-wrap">
    <div class="la-search-card">
      {{-- (Opcional) Ícone/logo --}}
      <div class="la-search-icon">
        <i class="bi bi-calendar-plus"></i>
      </div>

      {{-- Front-only: sem rota para não dar erro --}}
      <form class="la-search-form" action="#" method="GET">
        <input
          class="la-input"
          type="text"
          name="q"
          placeholder="Nome do aluno"
        >
        <button class="la-btn" type="submit">Buscar</button>
      </form>
    </div>
  </div>

  {{-- ====== QUADRO / TABELA ====== --}}
  <section class="la-board">

    <header class="la-board-head">
      <h2 class="la-board-title">Alunos matriculados</h2>

      {{-- Quando tiver back-end, você pode trocar por um contador real --}}
      <span class="la-pill">Lista</span>
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
          {{-- Front-only: linhas de exemplo (você pode duplicar/remover) --}}
          @for($i=1; $i<=7; $i++)
            <tr>
              <td class="col-id">{{ $i }}</td>
              <td class="col-nome">Nome do aluno {{ $i }}</td>
              <td class="col-escola">Escola Municipal Professor Sebastião Costa</td>
              <td class="col-filiacao">
                Sicrano de Tal<br>
                Fulano de Tal
              </td>

              <td class="col-acoes">
                {{-- Ver mais (perfil do aluno / detalhes) --}}
                <a href="#" class="la-icon" title="Ver mais">
                  <i class="bi bi-eye"></i>
                </a>

                {{-- Lançar/Agendar atendimento (opcional) --}}
                <a href="#" class="la-icon" title="Lançar agendamento">
                  <i class="bi bi-calendar-plus"></i>
                </a>
              </td>
            </tr>
          @endfor
        </tbody>
      </table>
    </div>

  </section>

</div>
@endsection