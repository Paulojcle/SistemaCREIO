@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/aluno/createAluno.css') }}">
@endpush

@section('content')

<div class="aluno-page">
  <div class="aluno-card">

    <h1 class="aluno-title">CADASTRO DE NOVO ALUNO</h1>

    <form action="" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="row g-4 justify-content-center mb-4">
        <div class="col-12 col-lg-4">
          <label class="upload-box" for="foto">
            <div class="upload-icon">📷</div>
            <div class="upload-text">Upload de imagem</div>

            <img
              id="previewFoto"
              alt="Pré-visualização"
              style="display:none; width:100%; height:100%; object-fit:cover; border-radius:12px;"
            >

            <input id="foto" name="foto" type="file" accept="image/*" class="d-none">
          </label>
        </div>
      </div>

      {{-- Dados do aluno --}}
      <h2 class="section-title">Dados do aluno</h2>

      <div class="row g-3">
        <div class="col-12 col-md-8">
          <label class="form-label">Nome completo</label>
          <input type="text" name="nome" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Veio por ordem judicial?</label>
          <input
            type="text"
            name="ordem_judicial"
            class="form-control soft-input"
            placeholder="Digite: Sim ou Não"
          >
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Data de Nascimento</label>
          <input type="date" name="data_nascimento" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Sexo</label>
          <div class="soft-radio">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="sexo" id="sexo_m" value="M">
              <label class="form-check-label" for="sexo_m">Masculino</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="sexo" id="sexo_f" value="F">
              <label class="form-check-label" for="sexo_f">Feminino</label>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-5">
          <label class="form-label">Endereço</label>
          <input type="text" name="endereco" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Número</label>
          <input type="text" name="numero" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Bairro</label>
          <input type="text" name="bairro" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-2">
          <label class="form-label">CEP</label>
          <input type="text" name="cep" class="form-control soft-input" inputmode="numeric">
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Cidade</label>
          <input type="text" name="cidade" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Celular</label>
          <input type="text" name="celular" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Tel. Residencial</label>
          <input type="text" name="tel_residencial" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Escola</label>
          <input type="text" name="escola" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Série</label>
          <input type="text" name="serie" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Turno</label>
          <select name="turno" class="form-select soft-input">
            <option value="" selected>Selecione</option>
            <option value="Matutino">Matutino</option>
            <option value="Vespertino">Vespertino</option>
            <option value="Noturno">Noturno</option>
            <option value="Integral">Integral</option>
          </select>
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Filiação 1</label>
          <input type="text" name="filiacao1" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Filiação 2</label>
          <input type="text" name="filiacao2" class="form-control soft-input">
        </div>
      </div>

      {{-- Bloco alergias / medicação --}}
      <div class="row g-3 mt-4">
        <div class="col-12 col-lg-4">
          <label class="form-label">Alérgico a algum medicamento?</label>
          <div class="soft-radio">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="alergico_medicamento" id="am_sim" value="Sim">
              <label class="form-check-label" for="am_sim">Sim</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="alergico_medicamento" id="am_nao" value="Não">
              <label class="form-check-label" for="am_nao">Não</label>
            </div>
          </div>
          <label class="form-label mt-2">Qual?</label>
          <textarea name="alergico_medicamento_qual" class="form-control soft-input soft-textarea" rows="3"></textarea>
        </div>

        <div class="col-12 col-lg-4">
          <label class="form-label">Alérgico a algum alimento?</label>
          <div class="soft-radio">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="alergico_alimento" id="aa_sim" value="Sim">
              <label class="form-check-label" for="aa_sim">Sim</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="alergico_alimento" id="aa_nao" value="Não">
              <label class="form-check-label" for="aa_nao">Não</label>
            </div>
          </div>
          <label class="form-label mt-2">Qual?</label>
          <textarea name="alergico_alimento_qual" class="form-control soft-input soft-textarea" rows="3"></textarea>
        </div>

        <div class="col-12 col-lg-4">
          <label class="form-label">Faz uso de uma medicação específica?</label>
          <div class="soft-radio">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="usa_medicacao" id="um_sim" value="Sim">
              <label class="form-check-label" for="um_sim">Sim</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="usa_medicacao" id="um_nao" value="Não">
              <label class="form-check-label" for="um_nao">Não</label>
            </div>
          </div>
          <label class="form-label mt-2">Qual?</label>
          <textarea name="usa_medicacao_qual" class="form-control soft-input soft-textarea" rows="3"></textarea>
        </div>
      </div>

      <div class="mt-4">
        <label class="form-label">Quais profissionais a criança passa</label>
        <textarea name="profissionais_crianca" class="form-control soft-input soft-textarea" rows="4"></textarea>
      </div>

      {{-- Dados do responsável --}}
      <h2 class="section-title mt-4">Dados do Responsável</h2>

      <div class="row g-3">
        <div class="col-12 col-md-6">
          <label class="form-label">Nome completo</label>
          <input type="text" name="resp_nome" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Data de Nascimento</label>
          <input type="date" name="resp_data_nascimento" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">RG</label>
          <input type="text" name="resp_rg" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">CPF</label>
          <input type="text" name="resp_cpf" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Estado Civil</label>
          <input type="text" name="resp_estado_civil" class="form-control soft-input">
        </div>
      </div>

      <div class="mt-4">
        <label class="form-label">Quais profissionais o aluno necessita?</label>
        <div class="chips">
          @php
            $profissionais = [
              'Psicólogo', 'Fonoaudiólogo', 'Neurologista', 'Pediatra',
              'Terapeuta Ocupacional', 'Fisioterapeuta', 'Psicopedagogo', 'Outro'
            ];
          @endphp

          @foreach($profissionais as $p)
            <label class="chip">
              <input type="checkbox" name="necessita_profissionais[]" value="{{ $p }}">
              <span>{{ $p }}</span>
            </label>
          @endforeach
        </div>
      </div>

      



      
{{-- ============================= --}}
{{-- SEÇÃO DE MÉTRICAS DO NÚCLEO --}}
{{-- ============================= --}}

<div class="metric-section mt-5">

  <h2 class="metric-title">
    📊 Informações para Metrificação do Núcleo
  </h2>

  <p class="metric-subtitle">
    Dados utilizados para relatórios estatísticos e planejamento institucional
  </p>

  <div class="row g-4 mt-2">

    {{-- Tipo de Deficiência --}}
    <div class="col-12">
      <label class="form-label">Tipo de Deficiência</label>

      <div class="chips metric-chips">
        @php
          $deficiencias = [
            'Deficiência Intelectual',
            'Deficiência Física',
            'Deficiência Auditiva',
            'Deficiência Visual',
            'Deficiência Múltipla'
          ];
        @endphp

        @foreach($deficiencias as $d)
          <label class="chip metric-chip">
            <input type="checkbox" name="deficiencias[]" value="{{ $d }}">
            <span>{{ $d }}</span>
          </label>
        @endforeach
      </div>

      <input 
        type="text"
        name="outra_deficiencia"
        class="form-control soft-input mt-3"
        placeholder="Caso não esteja na lista, informe o tipo de deficiência"
      >
    </div>

    {{-- Diagnósticos --}}
    <div class="col-12">
      <label class="form-label">Diagnósticos Clínicos</label>

      <div class="chips metric-chips">
        @php
          $diagnosticos = [
            'TEA',
            'TDAH',
            'TOD',
            'Dislexia',
            'Síndrome de Down',
            'Paralisia Cerebral'
          ];
        @endphp

        @foreach($diagnosticos as $diag)
          <label class="chip metric-chip">
            <input type="checkbox" name="diagnosticos[]" value="{{ $diag }}">
            <span>{{ $diag }}</span>
          </label>
        @endforeach
      </div>

      <input 
        type="text"
        name="outro_diagnostico"
        class="form-control soft-input mt-3"
        placeholder="Caso não esteja na lista, informe o diagnóstico"
      >
    </div>

    {{-- Grau de suporte --}}
    <div class="col-12 col-md-4">
      <label class="form-label">Grau de Suporte</label>
      <select name="grau_suporte" class="form-select soft-input">
        <option value="">Selecione</option>
        <option value="Nível 1">Nível 1 (Leve)</option>
        <option value="Nível 2">Nível 2 (Moderado)</option>
        <option value="Nível 3">Nível 3 (Intenso)</option>
      </select>
    </div>

    {{-- Possui laudo --}}
    <div class="col-12 col-md-4">
      <label class="form-label">Possui Laudo Médico?</label>
      <select name="possui_laudo" class="form-select soft-input">
        <option value="">Selecione</option>
        <option value="Sim">Sim</option>
        <option value="Não">Não</option>
      </select>
    </div>

    {{-- Atendimento pelo núcleo --}}
    <div class="col-12 col-md-4">
      <label class="form-label">Já recebe atendimento no Núcleo?</label>
      <select name="atendimento_nucleo" class="form-select soft-input">
        <option value="">Selecione</option>
        <option value="Sim">Sim</option>
        <option value="Não">Não</option>
      </select>
    </div>

    {{-- Origem do encaminhamento --}}
    <div class="col-12 col-md-6">
      <label class="form-label">Origem do Encaminhamento</label>
      <select name="origem_encaminhamento" class="form-select soft-input">
        <option value="">Selecione</option>
        <option value="Escola">Escola</option>
        <option value="Conselho Tutelar">Conselho Tutelar</option>
        <option value="Ordem Judicial">Ordem Judicial</option>
        <option value="Procura Espontânea">Procura Espontânea</option>
        <option value="Outro">Outro</option>
      </select>
    </div>

    {{-- Data diagnóstico --}}
    <div class="col-12 col-md-6">
      <label class="form-label">Data do Diagnóstico</label>
      <input type="date" name="data_diagnostico" class="form-control soft-input">
    </div>

  </div>
</div>










      <div class="mt-4">
          <label class="form-label">Anexar documentos (opcional)</label>
      
          <input 
              type="file" 
              name="documentos[]" 
              class="form-control soft-input" 
              multiple
          >
      
          <small class="text-muted">
              Você pode selecionar mais de um arquivo (PDF, imagem, etc.)
          </small>
      </div>



      {{-- Botões (DENTRO do form) --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="" class="btn btn-soft-secondary">Cancelar</a>
        <button type="submit" class="btn btn-soft-primary">Salvar</button>
      </div>

    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
  const input = document.getElementById('foto');
  const preview = document.getElementById('previewFoto');

  input.addEventListener('change', function () {
    const file = this.files && this.files[0];
    if (!file) return;

    preview.src = URL.createObjectURL(file);
    preview.style.display = 'block';

    const icon = document.querySelector('.upload-icon');
    const text = document.querySelector('.upload-text');
    if (icon) icon.style.display = 'none';
    if (text) text.style.display = 'none';
  });
</script>
@endpush