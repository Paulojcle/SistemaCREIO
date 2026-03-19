@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/aluno/createAluno.css') }}">
@endpush

@section('content')

<div class="aluno-page">
  <div class="aluno-card">

    {{-- Cabeçalho --}}
    <div class="d-flex align-items-center justify-content-between mb-1">
      <h1 class="aluno-title m-0">INFORMAÇÕES DE ALUNO</h1>
      <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn btn-soft-primary" style="font-size:13px; padding:8px 16px;">
        Editar
      </a>
    </div>

    @if(session('success'))
      <div style="background:#f0fdf4; border:1px solid #86efac; border-radius:8px; padding:12px 16px; margin:16px 0; color:#166534;">
        {{ session('success') }}
      </div>
    @endif

    {{-- Foto + dados principais --}}
    <div class="foto-row">

      <div class="foto-col">
        <div class="foto-show-circle">
          @if($aluno->foto)
            <img src="{{ asset('storage/' . $aluno->foto) }}" alt="Foto do aluno"
              style="width:100%; height:100%; object-fit:cover; border-radius:50%;"
              onclick="document.getElementById('lightboxBackdrop').classList.add('open')"
              title="Clique para ampliar">
          @else
            <div class="upload-avatar-icon">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
              </svg>
              <span>Sem foto</span>
            </div>
          @endif
        </div>

        <span class="foto-label">
          {{ $aluno->ativo ? '✅ Ativo' : '⛔ Inativo' }}
        </span>
      </div>

      {{-- Lightbox --}}
      @if($aluno->foto)
        <div class="lightbox-backdrop" id="lightboxBackdrop">
          <div class="lightbox-inner">
            <button type="button" class="lightbox-close" id="lightboxClose">&times;</button>
            <img src="{{ asset('storage/' . $aluno->foto) }}" alt="Foto do aluno">
          </div>
        </div>
      @endif

      <div class="foto-fields">
        <div class="row g-3">
          <div class="col-12 col-md-8">
            <label class="form-label">Nome completo</label>
            <input type="text" class="form-control soft-input" value="{{ $aluno->nome }}" readonly>
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label">Data de Nascimento</label>
            <input type="text" class="form-control soft-input"
              value="{{ $aluno->data_nascimento ? \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') : '—' }}" readonly>
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label">Sexo</label>
            <div class="soft-radio">
              <div class="form-check">
                <input class="form-check-input" type="radio" disabled {{ $aluno->sexo === 'M' ? 'checked' : '' }}>
                <label class="form-check-label">Masculino</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" disabled {{ $aluno->sexo === 'F' ? 'checked' : '' }}>
                <label class="form-check-label">Feminino</label>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label">Celular</label>
            <input type="text" class="form-control soft-input" value="{{ $aluno->celular ?? '—' }}" readonly>
          </div>

        </div>
      </div>

    </div>{{-- fim .foto-row --}}

    {{-- Dados do aluno --}}
    <hr class="block-divider">
    <div class="section-header">
      <div class="section-icon">👤</div>
      <h2 class="section-title">Dados do aluno</h2>
    </div>

    <div class="row g-3">
      <div class="col-12 col-md-5">
        <label class="form-label">Endereço</label>
        <input type="text" class="form-control soft-input" value="{{ $aluno->endereco ?? '—' }}" readonly>
      </div>

      <div class="col-6 col-md-2">
        <label class="form-label">Número</label>
        <input type="text" class="form-control soft-input" value="{{ $aluno->numero ?? '—' }}" readonly>
      </div>

      <div class="col-6 col-md-3">
        <label class="form-label">Bairro</label>
        <input type="text" class="form-control soft-input" value="{{ $aluno->bairro ?? '—' }}" readonly>
      </div>

      <div class="col-6 col-md-2">
        <label class="form-label">CEP</label>
        <input type="text" class="form-control soft-input" value="{{ $aluno->cep ?? '—' }}" readonly>
      </div>

      <div class="col-6 col-md-4">
        <label class="form-label">Cidade</label>
        <input type="text" class="form-control soft-input" value="{{ $aluno->cidade ?? '—' }}" readonly>
      </div>

      <div class="col-12 col-md-4">
        <label class="form-label">Tel. Residencial</label>
        <input type="text" class="form-control soft-input" value="{{ $aluno->tel_residencial ?? '—' }}" readonly>
      </div>

      <div class="col-12 col-md-4">
        <label class="form-label">Escola</label>
        <input type="text" class="form-control soft-input" value="{{ $aluno->escola->nome ?? '—' }}" readonly>
      </div>

      <div class="col-6 col-md-4">
        <label class="form-label">Série</label>
        <input type="text" class="form-control soft-input" value="{{ $aluno->serie ?? '—' }}" readonly>
      </div>

      <div class="col-6 col-md-4">
        <label class="form-label">Turno</label>
        <input type="text" class="form-control soft-input" value="{{ $aluno->turno ?? '—' }}" readonly>
      </div>

      <div class="col-12 col-md-4">
        <label class="form-label">Filiação 1</label>
        <input type="text" class="form-control soft-input" value="{{ $aluno->filiacao1 ?? '—' }}" readonly>
      </div>

      <div class="col-12 col-md-4">
        <label class="form-label">Filiação 2</label>
        <input type="text" class="form-control soft-input" value="{{ $aluno->filiacao2 ?? '—' }}" readonly>
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
            <input class="form-check-input" type="radio" disabled {{ $aluno->alergico_medicamento ? 'checked' : '' }}>
            <label class="form-check-label">Sim</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" disabled {{ !$aluno->alergico_medicamento ? 'checked' : '' }}>
            <label class="form-check-label">Não</label>
          </div>
        </div>
        @if($aluno->alergico_medicamento && $aluno->alergico_medicamento_qual)
          <label class="form-label mt-2">Qual?</label>
          <textarea class="form-control soft-input soft-textarea" rows="3" readonly>{{ $aluno->alergico_medicamento_qual }}</textarea>
        @endif
      </div>

      <div class="col-12 col-lg-4">
        <label class="form-label">Alérgico a algum alimento?</label>
        <div class="soft-radio">
          <div class="form-check">
            <input class="form-check-input" type="radio" disabled {{ $aluno->alergico_alimento ? 'checked' : '' }}>
            <label class="form-check-label">Sim</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" disabled {{ !$aluno->alergico_alimento ? 'checked' : '' }}>
            <label class="form-check-label">Não</label>
          </div>
        </div>
        @if($aluno->alergico_alimento && $aluno->alergico_alimento_qual)
          <label class="form-label mt-2">Qual?</label>
          <textarea class="form-control soft-input soft-textarea" rows="3" readonly>{{ $aluno->alergico_alimento_qual }}</textarea>
        @endif
      </div>

      <div class="col-12 col-lg-4">
        <label class="form-label">Faz uso de medicação específica?</label>
        <div class="soft-radio">
          <div class="form-check">
            <input class="form-check-input" type="radio" disabled {{ $aluno->usa_medicacao ? 'checked' : '' }}>
            <label class="form-check-label">Sim</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" disabled {{ !$aluno->usa_medicacao ? 'checked' : '' }}>
            <label class="form-check-label">Não</label>
          </div>
        </div>
        @if($aluno->usa_medicacao && $aluno->usa_medicacao_qual)
          <label class="form-label mt-2">Qual?</label>
          <textarea class="form-control soft-input soft-textarea" rows="3" readonly>{{ $aluno->usa_medicacao_qual }}</textarea>
        @endif
      </div>

      <div class="col-12">
        <label class="form-label">Quais profissionais a criança já passa?</label>
        <textarea class="form-control soft-input soft-textarea" rows="3" readonly>{{ $aluno->profissionais_crianca ?? '—' }}</textarea>
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
        <input type="text" class="form-control soft-input" value="{{ $aluno->resp_nome ?? '—' }}" readonly>
      </div>

      <div class="col-12 col-md-6">
        <label class="form-label">Data de Nascimento</label>
        <input type="text" class="form-control soft-input"
          value="{{ $aluno->resp_data_nascimento ? \Carbon\Carbon::parse($aluno->resp_data_nascimento)->format('d/m/Y') : '—' }}" readonly>
      </div>

      <div class="col-12 col-md-4">
        <label class="form-label">RG</label>
        <input type="text" class="form-control soft-input" value="{{ $aluno->resp_rg ?? '—' }}" readonly>
      </div>

      <div class="col-12 col-md-4">
        <label class="form-label">CPF</label>
        <input type="text" class="form-control soft-input" value="{{ $aluno->resp_cpf ?? '—' }}" readonly>
      </div>

      <div class="col-12 col-md-4">
        <label class="form-label">Estado Civil</label>
        <input type="text" class="form-control soft-input" value="{{ $aluno->resp_estado_civil ?? '—' }}" readonly>
      </div>

      <div class="col-12">
        <label class="form-label">Filas de espera</label>
        <div class="chips">
          @forelse($aluno->listasEspera as $lista)
            <label class="chip" style="cursor:default;">
              <input type="checkbox" disabled checked>
              <span>{{ $lista->nome }}</span>
            </label>
          @empty
            <p style="color:#94a3b8; font-size:0.85rem; margin:0;">Nenhuma lista de espera.</p>
          @endforelse
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
            @forelse($aluno->deficiencias as $deficiencia)
              <label class="chip metric-chip" style="cursor:default;">
                <input type="checkbox" disabled checked>
                <span>{{ $deficiencia->nome }}</span>
              </label>
            @empty
              <p style="color:#94a3b8; font-size:0.85rem; margin:0;">Nenhuma deficiência registrada.</p>
            @endforelse
          </div>
        </div>

        <div class="col-12">
          <label class="form-label">Diagnósticos Clínicos</label>
          <div class="chips metric-chips">
            @forelse($aluno->diagnosticos as $diagnostico)
              <label class="chip metric-chip" style="cursor:default;">
                <input type="checkbox" disabled checked>
                <span>{{ $diagnostico->nome }}</span>
              </label>
            @empty
              <p style="color:#94a3b8; font-size:0.85rem; margin:0;">Nenhum diagnóstico registrado.</p>
            @endforelse
          </div>
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Grau de Suporte</label>
          <input type="text" class="form-control soft-input" value="{{ $aluno->grau_suporte ?? '—' }}" readonly>
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Possui Laudo Médico?</label>
          <input type="text" class="form-control soft-input" value="{{ $aluno->possui_laudo ? 'Sim' : 'Não' }}" readonly>
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Origem do Encaminhamento</label>
          <input type="text" class="form-control soft-input"
            value="{{ $aluno->origemEncaminhamento->nome ?? '—' }}" readonly>
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Data do Diagnóstico</label>
          <input type="text" class="form-control soft-input"
            value="{{ $aluno->data_diagnostico ? \Carbon\Carbon::parse($aluno->data_diagnostico)->format('d/m/Y') : '—' }}" readonly>
        </div>

      </div>
    </div>

    {{-- Documentos --}}
    <hr class="block-divider">
    <div class="section-header">
      <div class="section-icon">📎</div>
      <h2 class="section-title">Documentos do Aluno</h2>
    </div>

    @forelse($aluno->documentosAluno as $doc)
      @php
        $ext = strtolower(pathinfo($doc->nome_original, PATHINFO_EXTENSION));
        $isPdf = $ext === 'pdf';
      @endphp
      <div class="doc-card">
        <div class="doc-card-icon">
          @if($isPdf)
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
          @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>
          @endif
        </div>
        <div class="doc-card-info">
          <span class="doc-card-nome">{{ $doc->nome_original }}</span>
          <span class="doc-card-ext">{{ strtoupper($ext) }}</span>
        </div>
        <a href="{{ asset('storage/' . $doc->arquivo) }}" target="_blank" class="doc-card-btn" title="Visualizar documento">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          Ver
        </a>
      </div>
    @empty
      <p class="doc-vazio">Nenhum documento anexado.</p>
    @endforelse

    {{-- Histórico de atendimentos --}}
    <hr class="block-divider">
    <div class="section-header">
      <div class="section-icon">📋</div>
      <h2 class="section-title">Histórico de atendimentos</h2>
    </div>

    <div style="background:#f3f3f3; border-radius:12px; padding:12px; border:1px solid #ececec;">
      <div style="opacity:.7; padding:8px;">Sem atendimentos cadastrados.</div>
    </div>

  </div>
</div>

@if($aluno->foto)
<script>
  document.getElementById('lightboxClose').addEventListener('click', function () {
    document.getElementById('lightboxBackdrop').classList.remove('open');
  });
  document.getElementById('lightboxBackdrop').addEventListener('click', function (e) {
    if (e.target === this) this.classList.remove('open');
  });
</script>
@endif

@endsection
