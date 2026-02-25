@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/aluno/showAluno.css') }}">
@endpush

@section('content')
<div class="aluno-page">
  <div class="aluno-card">

    {{-- Cabeçalho --}}
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h1 class="aluno-title m-0">INFORMAÇÕES DE ALUNO</h1>

      {{-- botão editar (ícone) --}}
      <a href="" class="icon-btn" title="Editar">
        <i class="bi bi-pencil-square"></i>
      </a>
    </div>

    {{-- Topo: Foto + Status/Motivo + Upload --}}
    <div class="row g-3 align-items-start mb-4">

      <div class="col-12 col-lg-3">
        <div class="photo-card">
          <div class="photo-34">
            <img src="" alt="Foto do aluno">
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-9">
        <div class="top-card">
          <div class="row g-3">
            <div class="col-12 col-lg-5">
              <label class="form-label">Status</label>
              <div class="soft-radio">
                <div class="form-check">
                  <input class="form-check-input" type="radio" disabled
                    {{-- {{ $aluno->status === 'Ativo' ? 'checked' : '' }} --}}
                  >
                  <label class="form-check-label">Ativo</label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="radio" disabled
                    {{-- {{ $aluno->status === 'Desistente' ? 'checked' : '' }} --}}
                  >
                  <label class="form-check-label">Desistente</label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="radio" disabled
                    {{-- {{ $aluno->status === 'Desligado' ? 'checked' : '' }} --}}
                  >
                  <label class="form-check-label">Desligado</label>
                </div>
              </div>
            </div>

            <div class="col-12 col-lg-7">
              <label class="form-label">Motivo</label>
              <textarea class="form-control soft-input soft-textarea" rows="3" readonly>{{-- {{ $aluno->motivo }} --}}</textarea>
            </div>
          </div>

          <div class="mt-3 d-flex justify-content-end">
            {{-- Upload de documentos (opcional) --}}
            <form action="" method="POST" enctype="multipart/form-data">
              @csrf

              <label class="btn btn-upload mb-0">
                Envie um arquivo
                <input type="file" name="documentos[]" class="d-none" multiple>
              </label>

              <button class="btn btn-soft-primary ms-2" type="submit">
                Anexar
              </button>
            </form>
          </div>
        </div>
      </div>

    </div>

    {{-- Dados do aluno --}}
    <h2 class="section-title">Dados do aluno</h2>

    <div class="row g-3">

      <div class="col-12 col-lg-8">
        <label class="form-label">Nome completo</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->nome }} --}}" readonly>
      </div>

      <div class="col-12 col-md-4 col-lg-2">
        <label class="form-label">Data de Nascimento</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->data_nascimento?->format('d/m/Y') }} --}}" readonly>
      </div>

      <div class="col-12 col-md-4 col-lg-2">
        <label class="form-label">Idade</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->idade }} --}} anos" readonly>
      </div>

      <div class="col-12 col-md-4 col-lg-4">
        <label class="form-label">Sexo</label>
        <div class="soft-radio">
          <div class="form-check">
            <input class="form-check-input" type="radio" disabled
              {{-- {{ $aluno->sexo === 'M' ? 'checked' : '' }} --}}
            >
            <label class="form-check-label">Masculino</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" disabled
              {{-- {{ $aluno->sexo === 'F' ? 'checked' : '' }} --}}
            >
            <label class="form-check-label">Feminino</label>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-6">
        <label class="form-label">Endereço</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->endereco }} --}}" readonly>
      </div>

      <div class="col-12 col-md-4 col-lg-2">
        <label class="form-label">Número</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->numero }} --}}" readonly>
      </div>

      <div class="col-12 col-md-4 col-lg-3">
        <label class="form-label">Bairro</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->bairro }} --}}" readonly>
      </div>

      <div class="col-12 col-md-4 col-lg-3">
        <label class="form-label">CEP</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->cep }} --}}" readonly>
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <label class="form-label">Cidade</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->cidade }} --}}" readonly>
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <label class="form-label">Celular</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->celular }} --}}" readonly>
      </div>

      <div class="col-12 col-md-4 col-lg-3">
        <label class="form-label">Tel. Residencial</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->tel_residencial }} --}}" readonly>
      </div>

      <div class="col-12 col-md-8 col-lg-9">
        <label class="form-label">Escola</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->escola }} --}}" readonly>
      </div>

      <div class="col-12 col-md-4 col-lg-2">
        <label class="form-label">Série</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->serie }} --}}" readonly>
      </div>

      <div class="col-12 col-md-4 col-lg-3">
        <label class="form-label">Turno</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->turno }} --}}" readonly>
      </div>

      <div class="col-12 col-md-4 col-lg-7">
        <label class="form-label">Filiação 1</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->filiacao1 }} --}}" readonly>
      </div>

      <div class="col-12 col-lg-6">
        <label class="form-label">Filiação 2</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->filiacao2 }} --}}" readonly>
      </div>

      {{-- Alergias / Medicação --}}
      <div class="col-12 col-lg-4">
        <label class="form-label">Alérgico a algum medicamento?</label>
        <div class="soft-radio">
          <div class="form-check">
            <input class="form-check-input" type="radio" disabled
              {{-- {{ $aluno->alergico_medicamento === 'Sim' ? 'checked' : '' }} --}}
            >
            <label class="form-check-label">Sim</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" disabled
              {{-- {{ $aluno->alergico_medicamento === 'Não' ? 'checked' : '' }} --}}
            >
            <label class="form-check-label">Não</label>
          </div>
        </div>
        <input class="form-control soft-input mt-2" value="{{-- {{ $aluno->alergico_medicamento_qual }} --}}" readonly>
      </div>

      <div class="col-12 col-lg-4">
        <label class="form-label">Alérgico a algum alimento?</label>
        <div class="soft-radio">
          <div class="form-check">
            <input class="form-check-input" type="radio" disabled
              {{-- {{ $aluno->alergico_alimento === 'Sim' ? 'checked' : '' }} --}}
            >
            <label class="form-check-label">Sim</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" disabled
              {{-- {{ $aluno->alergico_alimento === 'Não' ? 'checked' : '' }} --}}
            >
            <label class="form-check-label">Não</label>
          </div>
        </div>
        <input class="form-control soft-input mt-2" value="{{-- {{ $aluno->alergico_alimento_qual }} --}}" readonly>
      </div>

      <div class="col-12 col-lg-4">
        <label class="form-label">Faz uso de uma medicação específica?</label>
        <div class="soft-radio">
          <div class="form-check">
            <input class="form-check-input" type="radio" disabled
              {{-- {{ $aluno->usa_medicacao === 'Sim' ? 'checked' : '' }} --}}
            >
            <label class="form-check-label">Sim</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" disabled
              {{-- {{ $aluno->usa_medicacao === 'Não' ? 'checked' : '' }} --}}
            >
            <label class="form-check-label">Não</label>
          </div>
        </div>
        <input class="form-control soft-input mt-2" value="{{-- {{ $aluno->usa_medicacao_qual }} --}}" readonly>
      </div>

      <div class="col-12">
        <label class="form-label">Quais profissionais a criança passa</label>
        <textarea class="form-control soft-input soft-textarea" rows="4" readonly>{{-- {{ $aluno->profissionais_crianca }} --}}</textarea>
      </div>

    </div> {{-- ✅ fecha row dos Dados do aluno --}}

    {{-- Dados do responsável --}}
    <h2 class="section-title mt-4">Dados do Responsável</h2>

    <div class="row g-3">

      <div class="col-12 col-lg-6">
        <label class="form-label">Nome completo</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->resp_nome }} --}}" readonly>
      </div>

      <div class="col-12 col-lg-6">
        <label class="form-label">Data de Nascimento</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->resp_data_nascimento?->format('d/m/Y') }} --}}" readonly>
      </div>

      <div class="col-12 col-md-4">
        <label class="form-label">RG</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->resp_rg }} --}}" readonly>
      </div>

      <div class="col-12 col-md-4">
        <label class="form-label">CPF</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->resp_cpf }} --}}" readonly>
      </div>

      <div class="col-12 col-md-4">
        <label class="form-label">Estado Civil</label>
        <input class="form-control soft-input" value="{{-- {{ $aluno->resp_estado_civil }} --}}" readonly>
      </div>

      <div class="col-12 col-lg-5">
        <label class="form-label">O aluno ficará na lista de espera?</label>
        <div class="soft-radio">
          <div class="form-check">
            <input class="form-check-input" type="radio" disabled
              {{-- {{ $aluno->lista_espera === 'Sim' ? 'checked' : '' }} --}}
            >
            <label class="form-check-label">Sim</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" disabled
              {{-- {{ $aluno->lista_espera === 'Não' ? 'checked' : '' }} --}}
            >
            <label class="form-check-label">Não</label>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-7">
        <label class="form-label">Quais profissionais o aluno necessita?</label>
        <div class="chips">

          {{-- deixe isso descomentado quando você tiver $listaNecessita vindo do banco
          @php
            $listaNecessita = $aluno->necessita_profissionais ?? [];
          @endphp
          --}}

          @php
            $listaNecessita = []; // placeholder por enquanto
          @endphp

          @foreach(['Psicopedagogo','Psiconutricista','Fisioterapeuta','Fonoaudiólogo','Neuropsicólogo','Libras','Musicoterapia'] as $p)
            <label class="chip chip-readonly">
              <input type="checkbox" disabled
                {{-- {{ in_array($p, $listaNecessita) ? 'checked' : '' }} --}}
              >
              <span>{{ $p }}</span>
            </label>
          @endforeach
        </div>
      </div>

    </div> {{-- ✅ fecha row dos Dados do responsável --}}

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
        {{-- <a href="{{ route('atendimentos.index', ['aluno' => $aluno->id]) }}" class="link-mini">Ver tudo</a> --}}
      </div>

      <div class="history-box mt-2">

        {{-- DESCOMENTE QUANDO TIVER $atendimentos
        @forelse($atendimentos as $at)
        --}}
          <div class="history-item">
            <div class="history-col">
              <div class="history-label">Data de atendimento</div>
              <div class="history-value">21/11/2025</div>
              {{-- <div class="history-value">{{ \Carbon\Carbon::parse($at->data)->format('d/m/Y') }}</div> --}}
            </div>

            <div class="history-col">
              <div class="history-label">Profissional</div>
              <div class="history-value">Nome do Profissional</div>
              {{-- <div class="history-value">{{ $at->profissional_nome }}</div> --}}
            </div>

            <div class="history-col">
              <div class="history-label">Presente no atendimento</div>
              <div class="history-value">Sim</div>
              {{-- <div class="history-value">{{ $at->presente ? 'Sim' : 'Não' }}</div> --}}
            </div>

            <a class="icon-btn" href="" title="Ver atendimento">
              <i class="bi bi-eye"></i>
            </a>
            {{-- <a class="icon-btn" href="{{ route('atendimentos.show', $at->id) }}" title="Ver atendimento"><i class="bi bi-eye"></i></a> --}}
          </div>
        {{--
        @empty
          <div class="muted p-3">Sem atendimentos cadastrados.</div>
        @endforelse
        --}}

      </div>
    </div>

  </div> {{-- ✅ fecha aluno-card --}}
</div> {{-- ✅ fecha aluno-page --}}
@endsection