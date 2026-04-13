@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/crud.css') }}">
@endpush

@section('content')

<div class="aluno-page">
  <div class="aluno-card">

    <div class="header-flex">
      <h1 class="aluno-title">Perfis de Acesso</h1>
      <button class="btn-nova" onclick="abrirModalCriar()">+ Novo Perfil</button>
    </div>

    @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert-error">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
      <table class="custom-table">
        <thead>
          <tr>
            <th style="width:60px;"></th>
            <th>Nome do Perfil</th>
            <th>Descrição</th>
            <th>Permissões</th>
            <th style="text-align:right;">Ações</th>
          </tr>
        </thead>
        <tbody>
          @forelse($perfis as $index => $perfil)
            <tr>
              <td style="font-weight:700; color:#64748b;">{{ $index + 1 }}</td>
              <td style="font-weight:600; color:#1e293b;">{{ $perfil->nome }}</td>
              <td style="color:#64748b;">{{ $perfil->descricao ?? '—' }}</td>
              <td>
                @forelse($perfil->permissoes as $permissao)
                  <span style="display:inline-block; background:#e0f2fe; color:#0369a1; border-radius:999px; padding:2px 10px; font-size:0.78rem; margin:2px;">
                    {{ $permissao->descricao }}
                  </span>
                @empty
                  <span style="color:#94a3b8; font-size:0.85rem;">—</span>
                @endforelse
              </td>
              <td style="text-align:right;">
                <button class="btn-action btn-editar"
                  onclick="abrirModalEditar({{ $perfil->id }}, '{{ addslashes(e($perfil->nome)) }}', '{{ addslashes(e($perfil->descricao)) }}', {{ Js::from($perfil->permissoes->pluck('id')) }})">
                  Editar
                </button>
                <button class="btn-action btn-excluir"
                  onclick="abrirConfirmacao({{ $perfil->id }}, '{{ addslashes($perfil->nome) }}')">
                  Excluir
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="tabela-vazia">Nenhum perfil cadastrado.</td>
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
    <h2>Novo Perfil</h2>
    <form action="{{ route('perfis.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label fw-semibold mb-2">Nome do perfil <span style="color:#e11d48;">*</span></label>
        <input type="text" name="nome" class="form-control soft-input" placeholder="Ex: Secretaria..." required>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold mb-2">Descrição</label>
        <input type="text" name="descricao" class="form-control soft-input" placeholder="Descreva este perfil...">
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold mb-2">Permissões</label>
        <div style="display:flex; flex-direction:column; gap:8px;">
          @foreach($permissoes as $permissao)
            <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
              <input type="checkbox" name="permissoes[]" value="{{ $permissao->id }}">
              <span>
                <strong style="font-size:0.85rem;">{{ $permissao->descricao }}</strong>
              </span>
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
    <h2>Editar Perfil</h2>
    <form id="formEditar" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label class="form-label fw-semibold mb-2">Nome do perfil <span style="color:#e11d48;">*</span></label>
        <input type="text" id="editarNome" name="nome" class="form-control soft-input" required>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold mb-2">Descrição</label>
        <input type="text" id="editarDescricao" name="descricao" class="form-control soft-input">
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold mb-2">Permissões</label>
        <div style="display:flex; flex-direction:column; gap:8px;">
          @foreach($permissoes as $permissao)
            <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
              <input type="checkbox" class="permissao-editar" name="permissoes[]" value="{{ $permissao->id }}">
              <span>
                <strong style="font-size:0.85rem;">{{ $permissao->descricao }}</strong>
              </span>
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

{{-- Modal confirmar exclusão --}}
<div class="confirm-backdrop" id="confirmBackdrop">
  <div class="confirm-modal">
    <div class="confirm-icon">🗑️</div>
    <h3 class="confirm-title">Excluir perfil?</h3>
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
  function abrirModalCriar() {
    document.getElementById('modalBackdrop').classList.add('open');
  }

  function fecharModal() {
    document.getElementById('modalBackdrop').classList.remove('open');
  }

  document.getElementById('modalBackdrop').addEventListener('click', function (e) {
    if (e.target === this) fecharModal();
  });

  function abrirModalEditar(id, nome, descricao, permissoesIds) {
    document.getElementById('editarNome').value = nome;
    document.getElementById('editarDescricao').value = descricao !== 'null' ? descricao : '';
    document.getElementById('formEditar').action = '/perfis/' + id;

    // Marca os checkboxes das permissões que o perfil já tem
    document.querySelectorAll('.permissao-editar').forEach(function(checkbox) {
      checkbox.checked = permissoesIds.includes(parseInt(checkbox.value));
    });

    document.getElementById('modalBackdropEditar').classList.add('open');
  }

  function fecharModalEditar() {
    document.getElementById('modalBackdropEditar').classList.remove('open');
  }

  document.getElementById('modalBackdropEditar').addEventListener('click', function (e) {
    if (e.target === this) fecharModalEditar();
  });

  function abrirConfirmacao(id, nome) {
    document.getElementById('confirmTexto').textContent =
      'O perfil "' + nome + '" será excluído permanentemente.';
    document.getElementById('formExcluir').action = '/perfis/' + id;
    document.getElementById('confirmBackdrop').classList.add('open');
  }

  function fecharConfirmacao() {
    document.getElementById('confirmBackdrop').classList.remove('open');
  }

  document.getElementById('confirmBackdrop').addEventListener('click', function (e) {
    if (e.target === this) fecharConfirmacao();
  });

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
