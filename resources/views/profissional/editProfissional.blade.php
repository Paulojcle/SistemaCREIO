@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/profissional/editProfissional.css') }}">
@endpush

@section('content')

<div class="prof-page">
  <div class="prof-card">

    <h1 class="prof-title">EDITAR PROFISSIONAL</h1>

    <form action="" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- action esperado:
      action="{{ route('profissionais.update', $profissional->id) }}"
      --}}

      <div class="row g-3">

        {{-- Nome completo --}}
        <div class="col-12 col-md-8">
          <label class="form-label">Nome completo</label>
          <input type="text" name="nome" class="form-control soft-input" value="">
          {{-- value esperado:
          value="{{ $profissional->nome }}"
          --}}
        </div>

        {{-- Data de Nascimento --}}
        <div class="col-12 col-md-4">
          <label class="form-label">Data de Nascimento</label>
          <input type="date" name="data_nascimento" class="form-control soft-input" value="">
          {{-- value esperado:
          value="{{ $profissional->data_nascimento }}"
          --}}
        </div>

        {{-- RG --}}
        <div class="col-12 col-md-3">
          <label class="form-label">RG</label>
          <input type="text" name="rg" class="form-control soft-input" value="">
          {{-- value="{{ $profissional->rg }}" --}}
        </div>

        {{-- CPF --}}
        <div class="col-12 col-md-3">
          <label class="form-label">CPF</label>
          <input type="text" name="cpf" class="form-control soft-input" value="" inputmode="numeric">
          {{-- value="{{ $profissional->cpf }}" --}}
        </div>

        {{-- Celular --}}
        <div class="col-12 col-md-3">
          <label class="form-label">Celular</label>
          <input type="text" name="celular" class="form-control soft-input" value="" inputmode="tel">
          {{-- value="{{ $profissional->celular }}" --}}
        </div>

        {{-- Número de registro --}}
        <div class="col-12 col-md-3">
          <label class="form-label">Número de registro</label>
          <input type="text" name="numero_registro" class="form-control soft-input" value="" placeholder="Ex: CRP, CREFITO...">
          {{-- value="{{ $profissional->numero_registro }}" --}}
        </div>

        {{-- Profissão --}}
        <div class="col-12 col-md-3">
          <label class="form-label">Profissão</label>
          <input type="text" name="profissao" class="form-control soft-input" value="">
          {{-- value="{{ $profissional->profissao }}" --}}
        </div>

        {{-- Formação --}}
        <div class="col-12 col-md-3">
          <label class="form-label">Formação</label>
          <input type="text" name="formacao" class="form-control soft-input" value="">
          {{-- value="{{ $profissional->formacao }}" --}}
        </div>

        {{-- Especialização --}}
        <div class="col-12 col-md-3">
          <label class="form-label">Especialização</label>
          <input type="text" name="especializacao" class="form-control soft-input" value="">
          {{-- value="{{ $profissional->especializacao }}" --}}
        </div>

        <div class="col-12 col-md-3 d-none d-md-block"></div>

        {{-- Arquivo atual (visualizar) --}}
        <div class="col-12 col-md-4">
          <label class="form-label">Arquivo atual</label>

          <div class="file-box">
            <span class="file-pill">Nenhum arquivo</span>

            {{-- Se existir arquivo:
            <a class="file-pill" href="{{ asset('storage/' . $profissional->arquivo) }}" target="_blank">
              Ver arquivo
            </a>
            --}}
          </div>

          <small class="text-muted d-block mt-2">
            Se você enviar um novo arquivo, ele substituirá o anterior.
          </small>
        </div>

        {{-- Upload novo arquivo --}}
        <div class="col-12 col-md-4">
          <label class="form-label">Enviar novo arquivo (opcional)</label>
          <input
            type="file"
            name="arquivo"
            class="form-control soft-input"
            accept=".pdf,image/*"
          >
          <small class="text-muted">PDF ou imagem.</small>
        </div>

      </div>

      {{-- Botões --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="" class="btn btn-soft-secondary">Cancelar</a>
        {{-- cancelar esperado:
        href="{{ route('profissionais.index') }}"
        --}}
        <button type="submit" class="btn btn-soft-primary">Salvar alterações</button>
      </div>

    </form>

  </div>
</div>

@endsection