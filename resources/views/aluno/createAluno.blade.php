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

      {{-- Foto + primeiros campos lado a lado --}}
      <div class="foto-row">

        <div class="foto-col">
          <label class="upload-avatar-wrapper" for="foto">
            <div class="upload-avatar-circle" id="avatarCircle">

              {{-- Ícone câmera (SVG) --}}
              <div class="upload-avatar-icon" id="avatarIcon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                </svg>
                <span>Foto do aluno</span>
              </div>

              {{-- Preview --}}
              <img id="previewFoto" alt="Foto do aluno" style="display:none;">

            </div>

            {{-- Badge + --}}
            <div class="upload-avatar-badge">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
              </svg>
            </div>

          </label>
          <span class="foto-label">Clique para adicionar</span>
          <input id="foto" name="foto" type="file" accept="image/*" class="d-none">
        </div>

        <div class="foto-fields">
          <div class="row g-3">
            <div class="col-12 col-md-8">
              <label class="form-label">Nome completo</label>
              <input type="text" name="nome" class="form-control soft-input">
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

            <div class="col-12 col-md-4">
              <label class="form-label">Veio por ordem judicial?</label>
              <select name="ordem_judicial" class="form-select soft-input">
                <option value="">Selecione</option>
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
              </select>
            </div>

            <div class="col-12 col-md-4">
              <label class="form-label">Celular</label>
              <input type="text" name="celular" class="form-control soft-input">
            </div>
          </div>
        </div>

      </div>

      {{-- Dados do aluno --}}
      <hr class="block-divider">
      <div class="section-header">
        <div class="section-icon">👤</div>
        <h2 class="section-title">Dados do aluno</h2>
      </div>

      <div class="row g-3">

        <div class="col-12 col-md-5">
          <label class="form-label">Endereço</label>
          <input type="text" name="endereco" class="form-control soft-input">
        </div>

        <div class="col-6 col-md-2">
          <label class="form-label">Número</label>
          <input type="text" name="numero" class="form-control soft-input">
        </div>

        <div class="col-6 col-md-3">
          <label class="form-label">Bairro</label>
          <input type="text" name="bairro" class="form-control soft-input">
        </div>

        <div class="col-6 col-md-2">
          <label class="form-label">CEP</label>
          <input type="text" name="cep" class="form-control soft-input" inputmode="numeric">
        </div>

        <div class="col-6 col-md-4">
          <label class="form-label">Cidade</label>
          <input type="text" name="cidade" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Tel. Residencial</label>
          <input type="text" name="tel_residencial" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Escola</label>
          <input type="text" name="escola" class="form-control soft-input">
        </div>

        <div class="col-6 col-md-4">
          <label class="form-label">Série</label>
          <input type="text" name="serie" class="form-control soft-input">
        </div>

        <div class="col-6 col-md-4">
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

      {{-- Saúde --}}
      <hr class="block-divider">
      <div class="section-header">
        <div class="section-icon">💊</div>
        <h2 class="section-title">Saúde</h2>
      </div>

      <div class="row g-3">
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
          <label class="form-label">Faz uso de medicação específica?</label>
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

        <div class="col-12">
          <label class="form-label">Quais profissionais a criança já passa?</label>
          <textarea name="profissionais_crianca" class="form-control soft-input soft-textarea" rows="3"></textarea>
        </div>
      </div>

      {{-- Dados do responsável --}}
      <hr class="block-divider">
      <div class="section-header">
        <div class="section-icon">👨‍👩‍👧</div>
        <h2 class="section-title">Dados do Responsável</h2>
      </div>

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

        <div class="col-12">
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
      </div>

      {{-- Métricas do núcleo --}}
      <div class="metric-section">

        <h2 class="metric-title">📊 Informações para Metrificação do Núcleo</h2>
        <p class="metric-subtitle">Dados utilizados para relatórios estatísticos e planejamento institucional</p>

        <div class="row g-4">

          <div class="col-12">
            <label class="form-label">Tipo de Deficiência</label>
            <div class="chips metric-chips">
              @php
                $deficiencias = [
                  'Deficiência Intelectual', 'Deficiência Física',
                  'Deficiência Auditiva', 'Deficiência Visual', 'Deficiência Múltipla'
                ];
              @endphp
              @foreach($deficiencias as $d)
                <label class="chip metric-chip">
                  <input type="checkbox" name="deficiencias[]" value="{{ $d }}">
                  <span>{{ $d }}</span>
                </label>
              @endforeach
            </div>
            <input type="text" name="outra_deficiencia" class="form-control soft-input mt-3"
              placeholder="Outra deficiência não listada acima">
          </div>

          <div class="col-12">
            <label class="form-label">Diagnósticos Clínicos</label>
            <div class="chips metric-chips">
              @php
                $diagnosticos = ['TEA', 'TDAH', 'TOD', 'Dislexia', 'Síndrome de Down', 'Paralisia Cerebral'];
              @endphp
              @foreach($diagnosticos as $diag)
                <label class="chip metric-chip">
                  <input type="checkbox" name="diagnosticos[]" value="{{ $diag }}">
                  <span>{{ $diag }}</span>
                </label>
              @endforeach
            </div>
            <input type="text" name="outro_diagnostico" class="form-control soft-input mt-3"
              placeholder="Outro diagnóstico não listado acima">
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label">Grau de Suporte</label>
            <select name="grau_suporte" class="form-select soft-input">
              <option value="">Selecione</option>
              <option value="Nível 1">Nível 1 (Leve)</option>
              <option value="Nível 2">Nível 2 (Moderado)</option>
              <option value="Nível 3">Nível 3 (Intenso)</option>
            </select>
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label">Possui Laudo Médico?</label>
            <select name="possui_laudo" class="form-select soft-input">
              <option value="">Selecione</option>
              <option value="Sim">Sim</option>
              <option value="Não">Não</option>
            </select>
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label">Já recebe atendimento no Núcleo?</label>
            <select name="atendimento_nucleo" class="form-select soft-input">
              <option value="">Selecione</option>
              <option value="Sim">Sim</option>
              <option value="Não">Não</option>
            </select>
          </div>

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

          <div class="col-12 col-md-6">
            <label class="form-label">Data do Diagnóstico</label>
            <input type="date" name="data_diagnostico" class="form-control soft-input">
          </div>

        </div>
      </div>

      {{-- Anexar documentos --}}
      <div class="mt-4">
        <label class="btn btn-upload mb-0">
          Enviar documentos
          <input type="file" id="documentos" name="documentos[]" multiple class="d-none" accept=".pdf,image/*">
        </label>
        <small class="text-muted d-block mt-2">PDF ou imagem (opcional). Você pode selecionar mais de um arquivo.</small>
        <ul id="listaDocumentos" class="lista-documentos"></ul>
      </div>

      {{-- Botões --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="" class="btn btn-soft-secondary">Cancelar</a>
        <button type="submit" class="btn btn-soft-primary">Salvar</button>
      </div>

    </form>
  </div>
</div>

<script>
  // Preview da foto no círculo
  document.getElementById('foto').addEventListener('change', function () {
    var file = this.files && this.files[0];
    if (!file) return;

    var preview = document.getElementById('previewFoto');
    var icon    = document.getElementById('avatarIcon');

    preview.src = URL.createObjectURL(file);
    preview.style.display = 'block';
    if (icon) icon.style.display = 'none';
  });

  // Lista de documentos interativa
  var arquivosSelecionados = [];

  document.getElementById('documentos').addEventListener('change', function () {
    for (var i = 0; i < this.files.length; i++) {
      arquivosSelecionados.push(this.files[i]);
    }
    renderizarLista();
  });

  function renderizarLista() {
    var lista        = document.getElementById('listaDocumentos');
    var input        = document.getElementById('documentos');
    var dataTransfer = new DataTransfer();

    lista.innerHTML = '';

    arquivosSelecionados.forEach(function (arquivo, index) {
      dataTransfer.items.add(arquivo);
      var item = document.createElement('li');
      item.innerHTML =
        '<span>📄 ' + arquivo.name + '</span>' +
        '<button type="button" class="btn btn-sm btn-danger py-0 px-2" onclick="removerArquivo(' + index + ')">&times;</button>';
      lista.appendChild(item);
    });

    input.files = dataTransfer.files;
  }

  function removerArquivo(index) {
    arquivosSelecionados.splice(index, 1);
    renderizarLista();
  }
</script>

@endsection