@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/crud.css') }}">
@endpush

@section('content')

<div class="aluno-page">
  <div class="aluno-card">

    {{-- Cabeçalho --}}
    <div class="header-flex">
      <h1 class="aluno-title">Origens de Encaminhamento</h1>
      <button class="btn-nova" onclick="abrirModalCriar()">+ Novo cadastro</button>
    </div>

    {{-- Alertas flash --}}
    @if(session('success'))
      <div class="alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert-error">⚠️ {{ session('error') }}</div>
    @endif

    {{-- Tabela --}}
    <div class="table-responsive">
      <table class="custom-table">
        <thead>
          <tr>
            <th style="width:60px;">#</th>
            <th>Nome da Origem</th>
            <th style="text-align:right;">Ações</th>
          </tr>
        </thead>
        <tbody>
          @forelse($origens as $index => $origem)
            <tr>
              <td style="font-weight:700; color:#64748b;">#{{ $index + 1 }}</td>
              <td style="font-weight:600; color:#1e293b;">{{ $origem->nome }}</td>
              <td style="text-align:right;">
                <button class="btn-action btn-editar"
                  onclick="abrirModalEditar({{ $origem->id }}, '{{ addslashes($origem->nome) }}')">
                  ✏️ Editar
                </button>
                <button class="btn-action btn-excluir"
                  onclick="abrirConfirmacao({{ $origem->id }}, '{{ addslashes($origem->nome) }}')">
                  🗑️ Excluir
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="tabela-vazia">Nenhuma origem de encaminhamento cadastrada.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>

{{-- Modal criar --}}
<div class="modal-backdrop-custom" id="modalBackdrop">
  <div class="modal-box">
    <h2 id="modalTitulo">Nova Origem de Encaminhamento</h2>
    <form id="formCriar" action="{{ route('origensEncaminhamento.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label fw-semibold mb-2">Nome da origem</label>
        <input type="text" name="nome"
          class="form-control soft-input"
          placeholder="Ex: UBS / Posto de Saúde..."
          required>
      </div>
      <div class="d-flex justify-content-end gap-2 mt-4">
        <button type="button" class="btn btn-soft-secondary" onclick="fecharModal()">Cancelar</button>
        <button type="submit" class="btn btn-soft-primary">Salvar</button>
      </div>
    </form>
  </div>
</div>

{{-- Modal editar --}}
<div class="modal-backdrop-custom" id="modalBackdropEditar">
  <div class="modal-box">
    <h2>Editar Origem de Encaminhamento</h2>
    <form id="formEditar" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label class="form-label fw-semibold mb-2">Nome da origem</label>
        <input type="text" id="editarNome" name="nome"
          class="form-control soft-input"
          required>
      </div>
      <div class="d-flex justify-content-end gap-2 mt-4">
        <button type="button" class="btn btn-soft-secondary" onclick="fecharModalEditar()">Cancelar</button>
        <button type="submit" class="btn btn-soft-primary">Salvar</button>
      </div>
    </form>
  </div>
</div>

{{-- Modal confirmar exclusão --}}
<div class="confirm-backdrop" id="confirmBackdrop">
  <div class="confirm-modal">
    <div class="confirm-icon">🗑️</div>
    <h3 class="confirm-title">Excluir origem?</h3>
    <p class="confirm-text" id="confirmTexto">Este registro será excluído permanentemente.</p>
    <div class="confirm-btns">
      <button type="button" class="confirm-btn confirm-btn--cancel" onclick="fecharConfirmacao()">Cancelar</button>
      <form id="formExcluir" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="confirm-btn confirm-btn--danger">Sim, excluir</button>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
  // ── Modal criar ─────────────────────────────────────────────────
  function abrirModalCriar() {
    document.getElementById('modalBackdrop').classList.add('open');
    setTimeout(function () {
      document.querySelector('#formCriar input[name="nome"]').focus();
    }, 100);
  }

  function fecharModal() {
    document.getElementById('modalBackdrop').classList.remove('open');
  }

  document.getElementById('modalBackdrop').addEventListener('click', function (e) {
    if (e.target === this) fecharModal();
  });

  // ── Modal editar ────────────────────────────────────────────────
  function abrirModalEditar(id, nome) {
    document.getElementById('editarNome').value = nome;
    document.getElementById('formEditar').action = '/origensEncaminhamento/' + id;
    document.getElementById('modalBackdropEditar').classList.add('open');
    setTimeout(function () {
      document.getElementById('editarNome').focus();
    }, 100);
  }

  function fecharModalEditar() {
    document.getElementById('modalBackdropEditar').classList.remove('open');
  }

  document.getElementById('modalBackdropEditar').addEventListener('click', function (e) {
    if (e.target === this) fecharModalEditar();
  });

  // ── Confirmar exclusão ──────────────────────────────────────────
  function abrirConfirmacao(id, nome) {
    document.getElementById('confirmTexto').textContent =
      'A origem "' + nome + '" será excluída permanentemente.';
    document.getElementById('formExcluir').action = '/origensEncaminhamento/' + id;
    document.getElementById('confirmBackdrop').classList.add('open');
  }

  function fecharConfirmacao() {
    document.getElementById('confirmBackdrop').classList.remove('open');
  }

  document.getElementById('confirmBackdrop').addEventListener('click', function (e) {
    if (e.target === this) fecharConfirmacao();
  });

  // ── Fechar com ESC ──────────────────────────────────────────────
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      fecharModal();
      fecharModalEditar();
      fecharConfirmacao();
    }
  });
</script>
@endpush

@endsection