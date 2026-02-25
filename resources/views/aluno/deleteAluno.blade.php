@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/aluno/deleteAluno.css') }}">
@endpush

@section('content')

<div class="aluno-page">
  <div class="aluno-card">

    <h1 class="aluno-title danger-title">EXCLUIR ALUNO</h1>

    {{-- ALERTA DE PERIGO --}}
    <div class="danger-box">
      <strong>Atenção:</strong> essa ação não pode ser desfeita.
      <div class="mt-1">Confirme se deseja excluir o aluno abaixo.</div>
    </div>

    {{-- FORM DE EXCLUSÃO (não precisa de enctype nem inputs editáveis) --}}
    <form action="" method="POST">
      @csrf
      @method('DELETE')

      {{-- =========================
           FOTO (somente visual)
           ========================= --}}
      <div class="row g-4 justify-content-center mb-4">
        <div class="col-12 col-lg-4">
          <div class="upload-box read-only">
            {{-- Se você tiver foto, aqui você coloca:
            <img src="{{ asset('storage/' . $aluno->foto) }}" alt="Foto do aluno" style="width:100%; height:100%; object-fit:cover;">
            --}}
            <div class="upload-icon">👤</div>
            <div class="upload-text">Sem foto</div>
          </div>
        </div>
      </div>

      {{-- Dados do aluno --}}
      <h2 class="section-title">Dados do aluno</h2>

      <div class="row g-3">

        <div class="col-12 col-md-8">
          <label class="form-label">Nome completo</label>
          <input
            type="text"
            class="form-control soft-input"
            value=""
            readonly
          >
          {{-- valor esperado:
          value="{{ $aluno->nome }}"
          --}}
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Veio por ordem judicial?</label>
          <input
            type="text"
            class="form-control soft-input"
            value=""
            readonly
          >
          {{-- valor esperado:
          value="{{ $aluno->ordem_judicial }}"
          --}}
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Data de Nascimento</label>
          <input
            type="text"
            class="form-control soft-input"
            value=""
            readonly
          >
          {{-- valor esperado (exemplo):
          value="{{ \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') }}"
          --}}
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Sexo</label>
          <input
            type="text"
            class="form-control soft-input"
            value=""
            readonly
          >
          {{-- valor esperado:
          value="{{ $aluno->sexo }}"
          --}}
        </div>

        <div class="col-12 col-md-5">
          <label class="form-label">Endereço</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- valor esperado:
          value="{{ $aluno->endereco }}"
          --}}
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Número</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- valor esperado:
          value="{{ $aluno->numero }}"
          --}}
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Bairro</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->bairro }}" --}}
        </div>

        <div class="col-12 col-md-2">
          <label class="form-label">CEP</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->cep }}" --}}
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Cidade</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->cidade }}" --}}
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Celular</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->celular }}" --}}
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Tel. Residencial</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->tel_residencial }}" --}}
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Escola</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->escola }}" --}}
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Série</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->serie }}" --}}
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Turno</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->turno }}" --}}
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Filiação 1</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->filiacao1 }}" --}}
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Filiação 2</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->filiacao2 }}" --}}
        </div>

      </div>

      {{-- Bloco alergias / medicação (apenas leitura) --}}
      <h2 class="section-title mt-4">Alergias / Medicação</h2>

      <div class="row g-3">

        <div class="col-12 col-lg-4">
          <label class="form-label">Alérgico a medicamento?</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->alergico_medicamento }}" --}}
          <label class="form-label mt-2">Qual?</label>
          <textarea class="form-control soft-input soft-textarea" rows="3" readonly></textarea>
          {{-- {{ $aluno->alergico_medicamento_qual }} --}}
        </div>

        <div class="col-12 col-lg-4">
          <label class="form-label">Alérgico a alimento?</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->alergico_alimento }}" --}}
          <label class="form-label mt-2">Qual?</label>
          <textarea class="form-control soft-input soft-textarea" rows="3" readonly></textarea>
          {{-- {{ $aluno->alergico_alimento_qual }} --}}
        </div>

        <div class="col-12 col-lg-4">
          <label class="form-label">Usa medicação específica?</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->usa_medicacao }}" --}}
          <label class="form-label mt-2">Qual?</label>
          <textarea class="form-control soft-input soft-textarea" rows="3" readonly></textarea>
          {{-- {{ $aluno->usa_medicacao_qual }} --}}
        </div>

      </div>

      <div class="mt-4">
        <label class="form-label">Quais profissionais a criança passa</label>
        <textarea class="form-control soft-input soft-textarea" rows="4" readonly></textarea>
        {{-- {{ $aluno->profissionais_crianca }} --}}
      </div>

      {{-- Dados do responsável --}}
      <h2 class="section-title mt-4">Dados do Responsável</h2>

      <div class="row g-3">
        <div class="col-12 col-md-6">
          <label class="form-label">Nome completo</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->resp_nome }}" --}}
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Data de Nascimento</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ \Carbon\Carbon::parse($aluno->resp_data_nascimento)->format('d/m/Y') }}" --}}
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">RG</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->resp_rg }}" --}}
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">CPF</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->resp_cpf }}" --}}
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Estado Civil</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $aluno->resp_estado_civil }}" --}}
        </div>
      </div>

      {{-- Botões --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="" class="btn btn-soft-secondary">Cancelar</a>
        <button type="submit" class="btn btn-soft-danger">Excluir</button>
      </div>

    </form>

  </div>
</div>

@endsection