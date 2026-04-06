@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/crud.css') }}">
@endpush

@section('content')
<div class="aluno-page">
<div class="aluno-card">

    <div class="aluno-card-header">
        <h2>Editar Agendamento</h2>
        <span>{{ $agendamento->aluno->nome }}</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <form action="{{ route('agendamentos.update', $agendamento->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Profissional</label>
                <select name="profissional_id_aux" id="edit-profissional" class="form-select" required>
                    <option value="">Selecione...</option>
                    @foreach($profissionais as $prof)
                        <option value="{{ $prof->id }}"
                            {{ $agendamento->horarioProfissional->profissional_id == $prof->id ? 'selected' : '' }}>
                            {{ $prof->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Dia e Horário</label>
                <select name="horarios_profissional_id" id="edit-horario" class="form-select" required>
                    <option value="">Selecione o profissional primeiro</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Lista de Espera</label>
                <select name="lista_espera_id" id="edit-lista" class="form-select" required>
                    <option value="">Selecione...</option>
                    @foreach($listasEspera as $lista)
                        <option value="{{ $lista->id }}"
                            {{ $agendamento->lista_espera_id == $lista->id ? 'selected' : '' }}>
                            {{ $lista->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

<div class="col-md-12">
                <label class="form-label">Observações</label>
                <textarea name="observacoes" class="form-control" rows="3">{{ $agendamento->observacoes }}</textarea>
            </div>

        </div>

        <div class="mt-3 d-flex gap-2">
            <a href="{{ route('agendamentos') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
        </div>

    </form>

</div>
</div>
@endsection

@push('scripts')
<script>
    const diasSemana = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
    const horarioAtualId = {{ $agendamento->horarios_profissional_id }};
    const alunoId = {{ $agendamento->aluno_id }};
    const agendamentoId = {{ $agendamento->id }};

    document.getElementById('edit-profissional').addEventListener('change', function () {
        buscarHorarios(this.value);
    });

    function buscarHorarios(profissionalId) {
        const horarioSelect = document.getElementById('edit-horario');

        if (!profissionalId) {
            horarioSelect.innerHTML = '<option value="">Selecione o profissional primeiro</option>';
            return;
        }

        horarioSelect.innerHTML = '<option value="">Carregando...</option>';

        fetch(`/agendamento/horarios?profissional_id=${profissionalId}&aluno_id=${alunoId}&excluir_id=${agendamentoId}`)
            .then(r => r.json())
            .then(horarios => {
                horarioSelect.innerHTML = horarios.length
                    ? horarios.map(h =>
                        `<option value="${h.id}" ${h.id === horarioAtualId ? 'selected' : ''}>
                            ${diasSemana[h.dia_semana]} — ${h.hora_inicio.substring(0,5)} (${h.duracao_minutos} min)
                        </option>`
                      ).join('')
                    : '<option value="">Nenhum horário disponível</option>';
            });
    }

    // Carrega horários do profissional atual ao abrir a página
    buscarHorarios(document.getElementById('edit-profissional').value);
</script>
@endpush
