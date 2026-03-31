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
        <i class="bi bi-calendar-plus"></i>
      </div>
      <form class="la-search-form" action="{{ route('atendimento.lancar') }}" method="GET">
        <input class="la-input" type="text" name="q" value="{{ request('q') }}" placeholder="Nome do aluno">
        <button class="la-btn" type="submit">Buscar</button>
      </form>
    </div>
  </div>

  {{-- ====== QUADRO / TABELA ====== --}}
  <section class="la-board">

    <header class="la-board-head">
      <h2 class="la-board-title">Alunos esperando atendimento</h2>
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
                <button
                  type="button"
                  class="la-icon"
                  title="Lançar agendamento"
                  data-bs-toggle="modal"
                  data-bs-target="#modalAgendamento"
                  data-aluno-id="{{ $aluno->id }}"
                  data-aluno-nome="{{ $aluno->nome }}"
                >
                  <i class="bi bi-calendar-plus"></i>
                </button>
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

{{-- ====== MODAL DE AGENDAMENTO ====== --}}
<div class="modal fade" id="modalAgendamento" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content la-modal-content">

      <div class="modal-header la-modal-header">
        <h5 class="modal-title">
          <i class="bi bi-calendar-plus me-2"></i>Novo Agendamento
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('agendamentos.store') }}" method="POST">
        @csrf
        <input type="hidden" name="aluno_id" id="modal-aluno-id">

        <div class="modal-body la-modal-body">

          <p class="la-modal-aluno">
            <i class="bi bi-person-fill me-1"></i>
            <span id="modal-aluno-nome"></span>
          </p>

          <div class="mb-3">
            <label class="form-label la-label" for="modal-profissional">Profissional</label>
            <select name="profissional_id_aux" id="modal-profissional" class="form-select la-select" required>
              <option value="">Selecione...</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label la-label" for="modal-horario">Dia e Horário</label>
            <select name="horarios_profissional_id" id="modal-horario" class="form-select la-select" required>
              <option value="">Selecione o profissional primeiro</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label la-label" for="modal-lista">Lista de Espera</label>
            <select name="lista_espera_id" id="modal-lista" class="form-select la-select" required>
              <option value="">Selecione...</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label la-label" for="modal-obs">Observações</label>
            <textarea name="observacoes" id="modal-obs" class="form-control la-select" rows="3"></textarea>
          </div>

        </div>

        <div class="modal-footer la-modal-footer">
          <button type="button" class="la-btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="la-btn-salvar">
            <i class="bi bi-check-lg me-1"></i>Agendar
          </button>
        </div>
      </form>

    </div>
  </div>
</div>

@push('scripts')
<script>
  const modalEl = document.getElementById('modalAgendamento');
  const diasSemana = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];

  let todasListasEspera  = [];
  let todosProfissionais = [];

  modalEl.addEventListener('show.bs.modal', function (e) {
    const btn = e.relatedTarget;
    document.getElementById('modal-aluno-id').value         = btn.dataset.alunoId;
    document.getElementById('modal-aluno-nome').textContent = btn.dataset.alunoNome;
    document.getElementById('modal-profissional').innerHTML = '<option value="">Carregando...</option>';
    document.getElementById('modal-lista').innerHTML        = '<option value="">Selecione o profissional primeiro</option>';
    document.getElementById('modal-horario').innerHTML      = '<option value="">Selecione o profissional primeiro</option>';

    fetch(`/agendamento/profissionais/${btn.dataset.alunoId}`)
      .then(r => r.json())
      .then(({ profissionais, listasEspera }) => {
        todosProfissionais = profissionais;
        todasListasEspera  = listasEspera;

        document.getElementById('modal-profissional').innerHTML = profissionais.length
          ? '<option value="">Selecione...</option>' + profissionais.map(p => `<option value="${p.id}">${p.nome}</option>`).join('')
          : '<option value="">Nenhum profissional disponível</option>';
      })
      .catch(() => {
        document.getElementById('modal-profissional').innerHTML = '<option value="">Erro ao carregar</option>';
      });
  });

  document.getElementById('modal-profissional').addEventListener('change', function () {
    const profissionalId = parseInt(this.value);
    const listaSelect    = document.getElementById('modal-lista');

    document.getElementById('modal-horario').innerHTML = '<option value="">Selecione o profissional primeiro</option>';
    listaSelect.innerHTML = '<option value="">Selecione...</option>';

    if (!profissionalId) return;

    // Filtra listas de espera vinculadas ao profissional selecionado
    const prof = todosProfissionais.find(p => p.id === profissionalId);
    const listasFiltradas = prof
      ? todasListasEspera.filter(l => prof.listas_ids.includes(l.id))
      : [];

    if (!listasFiltradas.length) {
      listaSelect.innerHTML = '<option value="">Nenhuma lista disponível</option>';
    } else {
      listaSelect.innerHTML = '<option value="">Selecione...</option>' +
        listasFiltradas.map(l => `<option value="${l.id}">${l.nome}</option>`).join('');

      // Auto-seleciona se só houver uma opção
      if (listasFiltradas.length === 1) listaSelect.value = listasFiltradas[0].id;
    }

    buscarHorarios();
  });

  function buscarHorarios() {
    const profissionalId = document.getElementById('modal-profissional').value;
    const horarioSelect  = document.getElementById('modal-horario');

    if (!profissionalId) {
      horarioSelect.innerHTML = '<option value="">Selecione o profissional primeiro</option>';
      return;
    }

    horarioSelect.innerHTML = '<option value="">Carregando...</option>';

    const alunoId = document.getElementById('modal-aluno-id').value;
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
  }
</script>
@endpush

@endsection
