@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/aluno/showAluno.css') }}">
{{-- Se quiser separar:
<link rel="stylesheet" href="{{ asset('assets/css/aluno/editAluno.css') }}">
--}}
@endpush

@section('content')
<div class="aluno-page">
  <div class="aluno-card">

    {{-- Cabeçalho --}}
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h1 class="aluno-title m-0">EDITAR ALUNO</h1>

      {{-- (Opcional) botão voltar --}}
      <a href="" class="icon-btn" title="Voltar">
        <i class="bi bi-arrow-left"></i>
      </a>
      {{-- href esperado:
      href="{{ route('alunos.show', $aluno->id) }}"
      --}}
    </div>

    {{-- FORM PRINCIPAL DE EDIÇÃO --}}
    <form action="" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- action esperado:
      action="{{ route('alunos.update', $aluno->id) }}"
      --}}

      {{-- Topo: Foto + Status/Motivo + Upload --}}
      <div class="row g-3 align-items-start mb-4">

        {{-- FOTO + upload --}}
        <div class="col-12 col-lg-3">
          <div class="photo-card">

            <label class="photo-34" for="foto" style="cursor:pointer;">
              {{-- Se já existir foto:
              <img id="previewFoto" src="{{ asset('storage/' . $aluno->foto) }}" alt="Foto do aluno">
              --}}

              <img id="previewFoto" src="" alt="Foto do aluno">
              {{-- src esperado:
              src="{{ asset('storage/' . $aluno->foto) }}"
              --}}
            </label>

            <input id="foto" name="foto" type="file" accept="image/*" class="d-none">

            <small class="text-muted d-block text-center mt-2">
              Clique na foto para alterar
            </small>
          </div>
        </div>

        <div class="col-12 col-lg-9">
          <div class="top-card">
            <div class="row g-3">

              {{-- STATUS (agora habilitado) --}}
              <div class="col-12 col-lg-5">
                <label class="form-label">Status</label>
                <div class="soft-radio">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="Ativo"
                      {{-- {{ $aluno->status === 'Ativo' ? 'checked' : '' }} --}}
                    >
                    <label class="form-check-label">Ativo</label>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="Desistente"
                      {{-- {{ $aluno->status === 'Desistente' ? 'checked' : '' }} --}}
                    >
                    <label class="form-check-label">Desistente</label>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="Desligado"
                      {{-- {{ $aluno->status === 'Desligado' ? 'checked' : '' }} --}}
                    >
                    <label class="form-check-label">Desligado</label>
                  </div>
                </div>
              </div>

              {{-- MOTIVO (agora editável) --}}
              <div class="col-12 col-lg-7">
                <label class="form-label">Motivo</label>
                <textarea name="motivo" class="form-control soft-input soft-textarea" rows="3">{{-- {{ $aluno->motivo }} --}}</textarea>
              </div>

            </div>

            {{-- Upload de documentos (opcional) - agora dentro do mesmo form --}}
            <div class="mt-3 d-flex justify-content-end align-items-center gap-2">
              <label class="btn btn-upload mb-0">
                Envie um arquivo
                <input type="file" name="documentos[]" class="d-none" multiple>
              </label>

              {{-- Esse botão salva tudo (dados + anexos) --}}
              <button class="btn btn-soft-primary" type="submit">
                Salvar alterações
              </button>
            </div>

          </div>
        </div>

      </div>

      {{-- Dados do aluno --}}
      <h2 class="section-title">Dados do aluno</h2>

      <div class="row g-3">

        <div class="col-12 col-lg-8">
          <label class="form-label">Nome completo</label>
          <input name="nome" class="form-control soft-input" value="{{-- {{ $aluno->nome }} --}}">
        </div>

        <div class="col-12 col-md-4 col-lg-2">
          <label class="form-label">Data de Nascimento</label>
          <input type="date" name="data_nascimento" class="form-control soft-input" value="">
          {{-- value esperado:
          value="{{ $aluno->data_nascimento }}"
          --}}
        </div>

        <div class="col-12 col-md-4 col-lg-2">
          <label class="form-label">Idade</label>
          <input class="form-control soft-input" value="{{-- {{ $aluno->idade }} --}}" readonly>
          {{-- Idade pode ser calculada, por isso deixei readonly --}}
        </div>

        <div class="col-12 col-md-4 col-lg-4">
          <label class="form-label">Sexo</label>
          <div class="soft-radio">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="sexo" value="M"
                {{-- {{ $aluno->sexo === 'M' ? 'checked' : '' }} --}}
              >
              <label class="form-check-label">Masculino</label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="sexo" value="F"
                {{-- {{ $aluno->sexo === 'F' ? 'checked' : '' }} --}}
              >
              <label class="form-check-label">Feminino</label>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-6">
          <label class="form-label">Endereço</label>
          <input name="endereco" class="form-control soft-input" value="{{-- {{ $aluno->endereco }} --}}">
        </div>

        <div class="col-12 col-md-4 col-lg-2">
          <label class="form-label">Número</label>
          <input name="numero" class="form-control soft-input" value="{{-- {{ $aluno->numero }} --}}">
        </div>

        <div class="col-12 col-md-4 col-lg-3">
          <label class="form-label">Bairro</label>
          <input name="bairro" class="form-control soft-input" value="{{-- {{ $aluno->bairro }} --}}">
        </div>

        <div class="col-12 col-md-4 col-lg-3">
          <label class="form-label">CEP</label>
          <input name="cep" class="form-control soft-input" value="{{-- {{ $aluno->cep }} --}}">
        </div>

        <div class="col-12 col-md-6 col-lg-3">
          <label class="form-label">Cidade</label>
          <input name="cidade" class="form-control soft-input" value="{{-- {{ $aluno->cidade }} --}}">
        </div>

        <div class="col-12 col-md-6 col-lg-3">
          <label class="form-label">Celular</label>
          <input name="celular" class="form-control soft-input" value="{{-- {{ $aluno->celular }} --}}">
        </div>

        <div class="col-12 col-md-4 col-lg-3">
          <label class="form-label">Tel. Residencial</label>
          <input name="tel_residencial" class="form-control soft-input" value="{{-- {{ $aluno->tel_residencial }} --}}">
        </div>

        <div class="col-12 col-md-8 col-lg-9">
          <label class="form-label">Escola</label>
          <input name="escola" class="form-control soft-input" value="{{-- {{ $aluno->escola }} --}}">
        </div>

        <div class="col-12 col-md-4 col-lg-2">
          <label class="form-label">Série</label>
          <input name="serie" class="form-control soft-input" value="{{-- {{ $aluno->serie }} --}}">
        </div>

        <div class="col-12 col-md-4 col-lg-3">
          <label class="form-label">Turno</label>
          <input name="turno" class="form-control soft-input" value="{{-- {{ $aluno->turno }} --}}">
        </div>

        <div class="col-12 col-md-4 col-lg-7">
          <label class="form-label">Filiação 1</label>
          <input name="filiacao1" class="form-control soft-input" value="{{-- {{ $aluno->filiacao1 }} --}}">
        </div>

        <div class="col-12 col-lg-6">
          <label class="form-label">Filiação 2</label>
          <input name="filiacao2" class="form-control soft-input" value="{{-- {{ $aluno->filiacao2 }} --}}">
        </div>

        {{-- Alergias / Medicação --}}
        <div class="col-12 col-lg-4">
          <label class="form-label">Alérgico a algum medicamento?</label>
          <div class="soft-radio">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="alergico_medicamento" value="Sim"
                {{-- {{ $aluno->alergico_medicamento === 'Sim' ? 'checked' : '' }} --}}
              >
              <label class="form-check-label">Sim</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="alergico_medicamento" value="Não"
                {{-- {{ $aluno->alergico_medicamento === 'Não' ? 'checked' : '' }} --}}
              >
              <label class="form-check-label">Não</label>
            </div>
          </div>
          <input name="alergico_medicamento_qual" class="form-control soft-input mt-2" value="{{-- {{ $aluno->alergico_medicamento_qual }} --}}">
        </div>

        <div class="col-12 col-lg-4">
          <label class="form-label">Alérgico a algum alimento?</label>
          <div class="soft-radio">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="alergico_alimento" value="Sim"
                {{-- {{ $aluno->alergico_alimento === 'Sim' ? 'checked' : '' }} --}}
              >
              <label class="form-check-label">Sim</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="alergico_alimento" value="Não"
                {{-- {{ $aluno->alergico_alimento === 'Não' ? 'checked' : '' }} --}}
              >
              <label class="form-check-label">Não</label>
            </div>
          </div>
          <input name="alergico_alimento_qual" class="form-control soft-input mt-2" value="{{-- {{ $aluno->alergico_alimento_qual }} --}}">
        </div>

        <div class="col-12 col-lg-4">
          <label class="form-label">Faz uso de uma medicação específica?</label>
          <div class="soft-radio">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="usa_medicacao" value="Sim"
                {{-- {{ $aluno->usa_medicacao === 'Sim' ? 'checked' : '' }} --}}
              >
              <label class="form-check-label">Sim</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="usa_medicacao" value="Não"
                {{-- {{ $aluno->usa_medicacao === 'Não' ? 'checked' : '' }} --}}
              >
              <label class="form-check-label">Não</label>
            </div>
          </div>
          <input name="usa_medicacao_qual" class="form-control soft-input mt-2" value="{{-- {{ $aluno->usa_medicacao_qual }} --}}">
        </div>

        <div class="col-12">
          <label class="form-label">Quais profissionais a criança passa</label>
          <textarea name="profissionais_crianca" class="form-control soft-input soft-textarea" rows="4">{{-- {{ $aluno->profissionais_crianca }} --}}</textarea>
        </div>

      </div> {{-- fecha row Dados do aluno --}}

      {{-- Dados do responsável --}}
      <h2 class="section-title mt-4">Dados do Responsável</h2>

      <div class="row g-3">

        <div class="col-12 col-lg-6">
          <label class="form-label">Nome completo</label>
          <input name="resp_nome" class="form-control soft-input" value="{{-- {{ $aluno->resp_nome }} --}}">
        </div>

        <div class="col-12 col-lg-6">
          <label class="form-label">Data de Nascimento</label>
          <input type="date" name="resp_data_nascimento" class="form-control soft-input" value="">
          {{-- value="{{ $aluno->resp_data_nascimento }}" --}}
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">RG</label>
          <input name="resp_rg" class="form-control soft-input" value="{{-- {{ $aluno->resp_rg }} --}}">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">CPF</label>
          <input name="resp_cpf" class="form-control soft-input" value="{{-- {{ $aluno->resp_cpf }} --}}">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Estado Civil</label>
          <input name="resp_estado_civil" class="form-control soft-input" value="{{-- {{ $aluno->resp_estado_civil }} --}}">
        </div>

        <div class="col-12 col-lg-5">
          <label class="form-label">O aluno ficará na lista de espera?</label>
          <div class="soft-radio">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="lista_espera" value="Sim"
                {{-- {{ $aluno->lista_espera === 'Sim' ? 'checked' : '' }} --}}
              >
              <label class="form-check-label">Sim</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="lista_espera" value="Não"
                {{-- {{ $aluno->lista_espera === 'Não' ? 'checked' : '' }} --}}
              >
              <label class="form-check-label">Não</label>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-7">
          <label class="form-label">Quais profissionais o aluno necessita?</label>
          <div class="chips">

            {{-- quando tiver isso vindo do banco:
            @php $listaNecessita = $aluno->necessita_profissionais ?? []; @endphp
            --}}

            @php $listaNecessita = []; @endphp

            @foreach(['Psicopedagogo','Psiconutricista','Fisioterapeuta','Fonoaudiólogo','Neuropsicólogo','Libras','Musicoterapia'] as $p)
              <label class="chip">
                <input type="checkbox" name="necessita_profissionais[]" value="{{ $p }}"
                  {{-- {{ in_array($p, $listaNecessita) ? 'checked' : '' }} --}}
                >
                <span>{{ $p }}</span>
              </label>
            @endforeach
          </div>
        </div>

      </div> {{-- fecha row responsável --}}

      {{-- BOTÕES FINAIS (opcional, já tem Salvar lá em cima; mas é bom ter aqui também) --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="" class="btn btn-upload">Cancelar</a>
        {{-- href esperado:
        href="{{ route('alunos.show', $aluno->id) }}"
        --}}
        <button type="submit" class="btn btn-soft-primary">Salvar alterações</button>
      </div>

    </form>
    {{-- FIM DO FORM PRINCIPAL --}}

    {{-- ===============================
         Áreas que NÃO são edição direta
         (Arquivos lançados / Histórico)
         Você pode manter fora do form.
         =============================== --}}

    {{-- Arquivos lançados --}}
    <div class="mt-4">
      <h2 class="section-title">Arquivos lançados</h2>

      <div class="file-list">

        {{-- DESCOMENTE QUANDO TIVER $arquivos
        @forelse($arquivos as $arq)
        --}}
          <div class="file-item">
            <div>
              <div class="file-name">Nome do arquivo</div>
              <div class="file-sub">Categoria</div>
              {{-- <div class="file-name">{{ $arq->nome_original }}</div>
              <div class="file-sub">{{ $arq->categoria ?? 'Documento' }}</div> --}}
            </div>

            <div class="file-actions">
              <a class="icon-btn" href="" title="Visualizar">
                <i class="bi bi-eye"></i>
              </a>

              <form action="" method="POST" onsubmit="return confirm('Excluir este arquivo?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="icon-btn danger" title="Excluir">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </div>
          </div>
        {{--
        @empty
          <div class="muted">Nenhum arquivo anexado.</div>
        @endforelse
        --}}

      </div>
    </div>

    {{-- Histórico de atendimentos --}}
    <div class="mt-4">
      <div class="d-flex align-items-center justify-content-between">
        <h2 class="section-title m-0">Histórico de atendimentos</h2>
        <a href="" class="link-mini">Ver tudo</a>
      </div>

      <div class="history-box mt-2">

        {{-- DESCOMENTE QUANDO TIVER $atendimentos
        @forelse($atendimentos as $at)
        --}}
          <div class="history-item">
            <div class="history-col">
              <div class="history-label">Data de atendimento</div>
              <div class="history-value">21/11/2025</div>
            </div>

            <div class="history-col">
              <div class="history-label">Profissional</div>
              <div class="history-value">Nome do Profissional</div>
            </div>

            <div class="history-col">
              <div class="history-label">Presente no atendimento</div>
              <div class="history-value">Sim</div>
            </div>

            <a class="icon-btn" href="" title="Ver atendimento">
              <i class="bi bi-eye"></i>
            </a>
          </div>
        {{--
        @empty
          <div class="muted p-3">Sem atendimentos cadastrados.</div>
        @endforelse
        --}}

      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
  // preview foto 3x4
  const inputFoto = document.getElementById('foto');
  const preview = document.getElementById('previewFoto');

  if (inputFoto && preview) {
    inputFoto.addEventListener('change', function () {
      const file = this.files && this.files[0];
      if (!file) return;
      preview.src = URL.createObjectURL(file);
    });
  }
</script>
@endpush