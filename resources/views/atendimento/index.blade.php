@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/atendimento/index.css') }}">
@endpush

@section('content')
<div class="ag-page">

  {{-- ====== FILTRO (topo) ====== --}}
  <div class="ag-filter-wrap">
    <div class="ag-filter-card">
      <div class="ag-filter-title">Filtro</div>
      <form class="ag-filter-form" action="#" method="GET">
        <input class="ag-input" type="text" name="profissional" placeholder="Profissional">
        <input class="ag-input" type="date" name="data">
        <button class="ag-btn" type="submit">Filtrar</button>
      </form>
    </div>
  </div>

  {{-- ====== QUADRO DE HORÁRIOS ====== --}}
  <section class="ag-board">
    <header class="ag-board-head">
      <div class="ag-board-left">
        <h2 class="ag-board-title">Horários agendados</h2>
      </div>

      <div class="ag-board-right">
        {{-- Front-only: texto fixo --}}
        <div class="ag-date">29 de outubro de 2025</div>
      </div>
    </header>

    {{-- Grade (colunas por horário) --}}
    <div class="ag-grid">

      {{-- COLUNA 1 --}}
      <div class="ag-col">
        <div class="ag-col-time">07:30 - 08:00</div>

        <div class="ag-card">
          <div class="ag-row"><span>Nome:</span> Fernanda Araújo Gonçalves</div>
          <div class="ag-row"><span>Profissional:</span> Psicólogo(a)</div>
          <div class="ag-row"><span>Aluno:</span> Gabriel Almeida Bastos</div>

          <div class="ag-actions">
            <button class="ag-icon" type="button" title="Ver"><i class="bi bi-eye"></i></button>
            <button class="ag-icon" type="button" title="Editar"><i class="bi bi-pencil-square"></i></button>
            <button class="ag-icon danger" type="button" title="Excluir"><i class="bi bi-trash"></i></button>
          </div>
        </div>

        <div class="ag-card">
          <div class="ag-row"><span>Nome:</span> Fernanda Araújo Gonçalves</div>
          <div class="ag-row"><span>Profissional:</span> Psicólogo(a)</div>
          <div class="ag-row"><span>Aluno:</span> Gabriel Almeida Bastos</div>

          <div class="ag-actions">
            <button class="ag-icon" type="button" title="Ver"><i class="bi bi-eye"></i></button>
            <button class="ag-icon" type="button" title="Editar"><i class="bi bi-pencil-square"></i></button>
            <button class="ag-icon danger" type="button" title="Excluir"><i class="bi bi-trash"></i></button>
          </div>
        </div>

        <div class="ag-card">
          <div class="ag-row"><span>Nome:</span> Fernanda Araújo Gonçalves</div>
          <div class="ag-row"><span>Profissional:</span> Psicólogo(a)</div>
          <div class="ag-row"><span>Aluno:</span> Gabriel Almeida Bastos</div>

          <div class="ag-actions">
            <button class="ag-icon" type="button" title="Ver"><i class="bi bi-eye"></i></button>
            <button class="ag-icon" type="button" title="Editar"><i class="bi bi-pencil-square"></i></button>
            <button class="ag-icon danger" type="button" title="Excluir"><i class="bi bi-trash"></i></button>
          </div>
        </div>
      </div>

      {{-- COLUNA 2 --}}
      <div class="ag-col">
        <div class="ag-col-time">08:10 - 08:40</div>

        <div class="ag-card">
          <div class="ag-row"><span>Nome:</span> Fernanda Araújo Gonçalves</div>
          <div class="ag-row"><span>Profissional:</span> Psicólogo(a)</div>
          <div class="ag-row"><span>Aluno:</span> Gabriel Almeida Bastos</div>

          <div class="ag-actions">
            <button class="ag-icon" type="button" title="Ver"><i class="bi bi-eye"></i></button>
            <button class="ag-icon" type="button" title="Editar"><i class="bi bi-pencil-square"></i></button>
            <button class="ag-icon danger" type="button" title="Excluir"><i class="bi bi-trash"></i></button>
          </div>
        </div>

        <div class="ag-card">
          <div class="ag-row"><span>Nome:</span> Fernanda Araújo Gonçalves</div>
          <div class="ag-row"><span>Profissional:</span> Psicólogo(a)</div>
          <div class="ag-row"><span>Aluno:</span> Gabriel Almeida Bastos</div>

          <div class="ag-actions">
            <button class="ag-icon" type="button" title="Ver"><i class="bi bi-eye"></i></button>
            <button class="ag-icon" type="button" title="Editar"><i class="bi bi-pencil-square"></i></button>
            <button class="ag-icon danger" type="button" title="Excluir"><i class="bi bi-trash"></i></button>
          </div>
        </div>

        <div class="ag-card">
          <div class="ag-row"><span>Nome:</span> Fernanda Araújo Gonçalves</div>
          <div class="ag-row"><span>Profissional:</span> Psicólogo(a)</div>
          <div class="ag-row"><span>Aluno:</span> Gabriel Almeida Bastos</div>

          <div class="ag-actions">
            <button class="ag-icon" type="button" title="Ver"><i class="bi bi-eye"></i></button>
            <button class="ag-icon" type="button" title="Editar"><i class="bi bi-pencil-square"></i></button>
            <button class="ag-icon danger" type="button" title="Excluir"><i class="bi bi-trash"></i></button>
          </div>
        </div>
      </div>

      {{-- COLUNA 3 --}}
      <div class="ag-col">
        <div class="ag-col-time">08:45 - 09:15</div>

        <div class="ag-card">
          <div class="ag-row"><span>Nome:</span> Fernanda Araújo Gonçalves</div>
          <div class="ag-row"><span>Profissional:</span> Psicólogo(a)</div>
          <div class="ag-row"><span>Aluno:</span> Gabriel Almeida Bastos</div>

          <div class="ag-actions">
            <button class="ag-icon" type="button" title="Ver"><i class="bi bi-eye"></i></button>
            <button class="ag-icon" type="button" title="Editar"><i class="bi bi-pencil-square"></i></button>
            <button class="ag-icon danger" type="button" title="Excluir"><i class="bi bi-trash"></i></button>
          </div>
        </div>

        <div class="ag-card">
          <div class="ag-row"><span>Nome:</span> Fernanda Araújo Gonçalves</div>
          <div class="ag-row"><span>Profissional:</span> Psicólogo(a)</div>
          <div class="ag-row"><span>Aluno:</span> Gabriel Almeida Bastos</div>

          <div class="ag-actions">
            <button class="ag-icon" type="button" title="Ver"><i class="bi bi-eye"></i></button>
            <button class="ag-icon" type="button" title="Editar"><i class="bi bi-pencil-square"></i></button>
            <button class="ag-icon danger" type="button" title="Excluir"><i class="bi bi-trash"></i></button>
          </div>
        </div>

        <div class="ag-card">
          <div class="ag-row"><span>Nome:</span> Fernanda Araújo Gonçalves</div>
          <div class="ag-row"><span>Profissional:</span> Psicólogo(a)</div>
          <div class="ag-row"><span>Aluno:</span> Gabriel Almeida Bastos</div>

          <div class="ag-actions">
            <button class="ag-icon" type="button" title="Ver"><i class="bi bi-eye"></i></button>
            <button class="ag-icon" type="button" title="Editar"><i class="bi bi-pencil-square"></i></button>
            <button class="ag-icon danger" type="button" title="Excluir"><i class="bi bi-trash"></i></button>
          </div>
        </div>
      </div>

    </div>
  </section>

</div>
@endsection