@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/index.css') }}">
@endpush

@section('content')

<div class="escola-page">
    <div class="escola-card">

        <div class="header-flex">
            <h1 class="escola-title">Lista de Alunos</h1>
            <a href="{{ route('alunos.create') }}" class="btn-nova">+ Novo Aluno</a>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('alunos.index') }}" class="mb-4">
            <div style="display:flex; flex-wrap:wrap; gap:12px; align-items:flex-end;">

                <div style="flex:1; min-width:160px;">
                    <label style="font-size:0.8rem; color:#64748b;">Nome do aluno</label>
                    <input type="text" name="nome" value="{{ request('nome') }}"
                        class="form-control form-control-sm" placeholder="Buscar por nome...">
                </div>

                <div style="min-width:130px;">
                    <label style="font-size:0.8rem; color:#64748b;">Status</label>
                    <select name="ativo" class="form-select form-select-sm">
                        <option value="">Todos</option>
                        <option value="1" {{ request('ativo') === '1' ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ request('ativo') === '0' ? 'selected' : '' }}>Inativo</option>
                    </select>
                </div>

                <div style="min-width:160px;">
                    <label style="font-size:0.8rem; color:#64748b;">Escola</label>
                    <select name="escola_id" class="form-select form-select-sm">
                        <option value="">Todas</option>
                        @foreach($escolas as $escola)
                            <option value="{{ $escola->id }}" {{ request('escola_id') == $escola->id ? 'selected' : '' }}>
                                {{ $escola->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="flex:1; min-width:160px;">
                    <label style="font-size:0.8rem; color:#64748b;">Nome do pai/mãe</label>
                    <input type="text" name="filiacao" value="{{ request('filiacao') }}"
                        class="form-control form-control-sm" placeholder="Buscar por filiação...">
                </div>

                <div style="min-width:180px;">
                    <label style="font-size:0.8rem; color:#64748b;">Tipo de deficiência</label>
                    <select name="deficiencia_id" class="form-select form-select-sm">
                        <option value="">Todas</option>
                        @foreach($deficiencias as $def)
                            <option value="{{ $def->id }}" {{ request('deficiencia_id') == $def->id ? 'selected' : '' }}>
                                {{ $def->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="min-width:180px;">
                    <label style="font-size:0.8rem; color:#64748b;">Tipo de diagnóstico</label>
                    <select name="diagnostico_id" class="form-select form-select-sm">
                        <option value="">Todos</option>
                        @foreach($diagnosticos as $diag)
                            <option value="{{ $diag->id }}" {{ request('diagnostico_id') == $diag->id ? 'selected' : '' }}>
                                {{ $diag->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="display:flex; gap:8px;">
                    <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
                    <a href="{{ route('alunos.index') }}" class="btn btn-outline-secondary btn-sm">Limpar</a>
                </div>

            </div>
        </form>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Data de Nasc.</th>
                        <th>Celular</th>
                        <th>Escola</th>
                        <th>Filas de Espera</th>
                        <th>Status</th>
                        <th style="text-align:right;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alunos as $index => $aluno)
                    <tr class="{{ $aluno->ativo ? '' : 'row-inativo' }}">
                        <td style="font-weight:700;">#{{ $index + 1 }}</td>
                        <td style="color:#1e293b; font-weight:600;">{{ $aluno->nome }}</td>
                        <td>{{ \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') }}</td>
                        <td>{{ $aluno->celular ?? '—' }}</td>
                        <td>{{ $aluno->escola->nome ?? '—' }}</td>
                        <td>
                            @forelse($aluno->listasEspera as $lista)
                                <span style="display:inline-block; background:#e0f2fe; color:#0369a1; border-radius:999px; padding:2px 10px; font-size:0.8rem; margin:2px;">
                                    {{ $lista->nome }}
                                </span>
                            @empty
                                <span style="color:#94a3b8; font-size:0.85rem;">—</span>
                            @endforelse
                        </td>
                        <td>
                            <span class="badge-status {{ $aluno->ativo ? 'badge-ativo' : 'badge-inativo' }}">
                                {{ $aluno->ativo ? 'Ativo' : 'Inativo' }}
                            </span>
                        </td>
                        <td style="text-align:right; white-space:nowrap;">
                            <a href="{{ route('alunos.show', $aluno->id) }}" class="btn-action btn-ver">Ver</a>
                            <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn-action btn-editar">Editar</a>
                            @if($aluno->ativo)
                                <button type="button" class="btn-action btn-desligar"
                                    onclick="abrirModalDesligamento({{ $aluno->id }}, '{{ addslashes($aluno->nome) }}')">
                                    Desativar
                                </button>
                            @else
                                <form action="{{ route('alunos.toggle', $aluno->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-action btn-reativar"
                                        onclick="return confirm('Deseja reativar {{ addslashes($aluno->nome) }}?')">
                                        Reativar
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align:center; padding:40px; color:#94a3b8;">
                            <p style="font-size:18px; margin:0;">Nenhum aluno cadastrado.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

{{-- Modal de desligamento --}}
<div class="modal fade" id="modalDesligamento" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Desativar Aluno</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form id="formDesligamento" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="modal-body">
          <p id="modalDesligamentoNome" style="font-weight:600; margin-bottom:16px;"></p>

          <div class="mb-3">
            <label class="form-label">Justificativa do desligamento <span style="color:red">*</span></label>
            <textarea name="justificativa" class="form-control" rows="4" required
              placeholder="Descreva o motivo do desligamento..."></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Documento assinado pelos pais (opcional)</label>
            <input type="file" name="documento" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
            <small class="text-muted">PDF ou imagem • máx. 10MB</small>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Confirmar desligamento</button>
        </div>

      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
  function abrirModalDesligamento(alunoId, alunoNome) {
    document.getElementById('formDesligamento').action = `/alunos/${alunoId}/toggle`;
    document.getElementById('modalDesligamentoNome').textContent = `Aluno: ${alunoNome}`;
    document.querySelector('#formDesligamento textarea[name="justificativa"]').value = '';
    document.querySelector('#formDesligamento input[name="documento"]').value = '';
    new bootstrap.Modal(document.getElementById('modalDesligamento')).show();
  }
</script>
@endpush

@endsection
