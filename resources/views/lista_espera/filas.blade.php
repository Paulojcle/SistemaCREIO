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

  .btn-agendar {
    background: #16a34a;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px 14px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s;
  }

  .btn-agendar:hover {
    background: #15803d;
    color: #fff;
  }

  .btn-agendar-disabled {
    background: #e2e8f0;
    color: #94a3b8;
    border-radius: 8px;
    padding: 8px 14px;
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    cursor: not-allowed;
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
                      <div style="display:inline-flex; gap:6px; align-items:center;">
                        <a href="{{ route('alunos.show', $aluno->id) }}" class="btn-action btn-editar">Ver aluno</a>
                        @if($aluno->pivot->status === 'aguardando')
                          <button type="button" class="btn-agendar"
                            data-aluno-id="{{ $aluno->id }}"
                            data-aluno-nome="{{ $aluno->nome }}"
                            data-lista-id="{{ $lista->id }}"
                            onclick="abrirModalAgendamento(this)">
                            Agendar
                          </button>
                        @else
                          <span class="btn-agendar-disabled">Agendar</span>
                        @endif
                      </div>
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

{{-- Modal de agendamento --}}
<div class="modal fade" id="modalAgendamento" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Novo Agendamento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('agendamentos.store') }}" method="POST">
        @csrf
        <input type="hidden" name="aluno_id" id="modal-aluno-id">

        <div class="modal-body">

          <p class="la-modal-aluno">
            <i class="bi bi-person-fill me-1"></i>
            <span id="modal-aluno-nome"></span>
          </p>

          <div class="mb-3">
            <label class="form-label">Profissional</label>
            <select name="profissional_id_aux" id="modal-profissional" class="form-select" required>
              <option value="">Selecione...</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Dia e Horário</label>
            <select name="horarios_profissional_id" id="modal-horario" class="form-select" required>
              <option value="">Selecione o profissional primeiro</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Lista de Espera</label>
            <select name="lista_espera_id" id="modal-lista" class="form-select" required>
              <option value="">Selecione o profissional primeiro</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Observações</label>
            <textarea name="observacoes" id="modal-obs" class="form-control" rows="3"></textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Agendar</button>
        </div>
      </form>

    </div>
  </div>
</div>

@push('scripts')
<script>
  const diasSemana = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];

  let todosProfissionais = [];
  let todasListasEspera  = [];
  let listaIdAtual       = null;

  function abrirModalAgendamento(btn) {
    const alunoId = btn.dataset.alunoId;
    listaIdAtual  = parseInt(btn.dataset.listaId);
    const nome    = btn.dataset.alunoNome;

    document.getElementById('modal-aluno-id').value         = alunoId;
    document.getElementById('modal-aluno-nome').textContent = nome;
    document.getElementById('modal-profissional').innerHTML = '<option value="">Carregando...</option>';
    document.getElementById('modal-horario').innerHTML      = '<option value="">Selecione o profissional primeiro</option>';
    document.getElementById('modal-lista').innerHTML        = '<option value="">Selecione o profissional primeiro</option>';

    fetch(`/agendamento/profissionais/${alunoId}`)
      .then(r => r.json())
      .then(({ profissionais, listasEspera }) => {
        todosProfissionais = profissionais;
        todasListasEspera  = listasEspera;

        const profsFila = profissionais.filter(p => p.listas_ids.includes(listaIdAtual));

        document.getElementById('modal-profissional').innerHTML = profsFila.length
          ? '<option value="">Selecione...</option>' + profsFila.map(p => `<option value="${p.id}">${p.nome}</option>`).join('')
          : '<option value="">Nenhum profissional disponível</option>';
      })
      .catch(() => {
        document.getElementById('modal-profissional').innerHTML = '<option value="">Erro ao carregar</option>';
      });

    new bootstrap.Modal(document.getElementById('modalAgendamento')).show();
  }

  document.getElementById('modal-profissional').addEventListener('change', function () {
    const profissionalId = parseInt(this.value);
    const alunoId        = document.getElementById('modal-aluno-id').value;
    const listaSelect    = document.getElementById('modal-lista');
    const horarioSelect  = document.getElementById('modal-horario');

    horarioSelect.innerHTML = '<option value="">Selecione o profissional primeiro</option>';
    listaSelect.innerHTML   = '<option value="">Selecione...</option>';

    if (!profissionalId) return;

    const prof = todosProfissionais.find(p => p.id === profissionalId);
    const listasFiltradas = prof
      ? todasListasEspera.filter(l => prof.listas_ids.includes(l.id))
      : [];

    if (listasFiltradas.length) {
      listaSelect.innerHTML = '<option value="">Selecione...</option>' +
        listasFiltradas.map(l =>
          `<option value="${l.id}" ${l.id === listaIdAtual ? 'selected' : ''}>${l.nome}</option>`
        ).join('');
    } else {
      listaSelect.innerHTML = '<option value="">Nenhuma lista disponível</option>';
    }

    horarioSelect.innerHTML = '<option value="">Carregando...</option>';

    fetch(`/agendamento/horarios?profissional_id=${profissionalId}&aluno_id=${alunoId}`)
      .then(r => r.json())
      .then(horarios => {
        horarioSelect.innerHTML = horarios.length
          ? '<option value="">Selecione...</option>' + horarios.map(h =>
              `<option value="${h.id}">${diasSemana[h.dia_semana]} — ${h.hora_inicio.substring(0,5)} (${h.duracao_minutos} min)</option>`
            ).join('')
          : '<option value="">Nenhum horário disponível</option>';
      })
      .catch(() => {
        horarioSelect.innerHTML = '<option value="">Erro ao buscar horários</option>';
      });
  });
</script>
@endpush

@endsection
