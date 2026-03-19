@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/crud.css') }}">
@endpush

@section('content')

<div class="aluno-page">
  <div class="aluno-card">

    {{-- Cabeçalho --}}
    <div class="header-flex">
      <h1 class="aluno-title">Listas de Espera</h1>
      <button class="btn-nova" onclick="abrirModalCriar()">+ Nova lista</button>
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
            <th>Nome da Lista</th>
            <th>Profissionais Vinculados</th>
            <th style="text-align:right;">Ações</th>
          </tr>
        </thead>
        <tbody>
          @forelse($listas as $index => $lista)
            <tr>
              <td style="font-weight:700; color:#64748b;">#{{ $index + 1 }}</td>
              <td style="font-weight:600; color:#1e293b;">{{ $lista->nome }}</td>
              <td>
                @forelse($lista->profissionais as $prof)
                  <span style="display:inline-block; background:#e0f2fe; color:#0369a1; border-radius:999px; padding:2px 10px; font-size:0.82rem; margin:2px;">
                    {{ $prof->nome }}
                  </span>
                @empty
                  <span style="color:#94a3b8; font-size:0.85rem;">Nenhum vinculado</span>
                @endforelse
              </td>
              <td style="text-align:right;">
                <button class="btn-action btn-editar"
                  onclick="abrirModalEditar({{ $lista->id }}, '{{ addslashes($lista->nome) }}', [{{ $lista->profissionais->pluck('id')->join(',') }}])">
                  ✏️ Editar
                </button>
                <form action="{{ route('listasEspera.toggle', $lista->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="btn-action {{ $lista->ativo ? 'btn-excluir' : 'btn-editar' }}">
                    {{ $lista->ativo ? '🔴 Desativar' : '🟢 Reativar' }}
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="tabela-vazia">Nenhuma lista de espera cadastrada.</td>
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
    <h2>Nova Lista de Espera</h2>
    <form id="formCriar" action="{{ route('listasEspera.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label fw-semibold mb-2">Nome da lista</label>
        <input type="text" name="nome"
          class="form-control soft-input"
          placeholder="Ex: Fila de Fonoaudiologia..."
          required>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold mb-2">Profissionais que atendem nesta fila</label>
        <div style="display:flex; flex-direction:column; gap:6px; max-height:200px; overflow-y:auto; padding:4px;">
          @foreach($profissionais as $prof)
            <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
              <input type="checkbox" name="profissionais[]" value="{{ $prof->id }}">
              {{ $prof->nome }} — {{ $prof->profissao }}
            </label>
          @endforeach
        </div>
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
    <h2>Editar Lista de Espera</h2>
    <form id="formEditar" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label class="form-label fw-semibold mb-2">Nome da lista</label>
        <input type="text" id="editarNome" name="nome"
          class="form-control soft-input"
          required>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold mb-2">Profissionais que atendem nesta fila</label>
        <div style="display:flex; flex-direction:column; gap:6px; max-height:200px; overflow-y:auto; padding:4px;">
          @foreach($profissionais as $prof)
            <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
              <input type="checkbox" name="profissionais[]" value="{{ $prof->id }}"
                class="checkbox-profissional" data-id="{{ $prof->id }}">
              {{ $prof->nome }} — {{ $prof->profissao }}
            </label>
          @endforeach
        </div>
      </div>
      <div class="d-flex justify-content-end gap-2 mt-4">
        <button type="button" class="btn btn-soft-secondary" onclick="fecharModalEditar()">Cancelar</button>
        <button type="submit" class="btn btn-soft-primary">Salvar</button>
      </div>
    </form>
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
  function abrirModalEditar(id, nome, profissionaisVinculados) {
    document.getElementById('editarNome').value = nome;
    document.getElementById('formEditar').action = '/listasEspera/' + id;

    document.querySelectorAll('.checkbox-profissional').forEach(function (checkbox) {
      checkbox.checked = profissionaisVinculados.includes(parseInt(checkbox.dataset.id));
    });

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

  // ── Fechar com ESC ──────────────────────────────────────────────
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      fecharModal();
      fecharModalEditar();
    }
  });
</script>
@endpush

@endsection
