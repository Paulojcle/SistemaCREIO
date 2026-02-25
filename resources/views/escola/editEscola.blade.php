@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/editEscola.css') }}">
@endpush

@section('content')
<div class="escola-page">
  <div class="escola-card">

    <h1 class="escola-title">EDITAR ESCOLA</h1>

    <form action="" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- action esperado:
      action="{{ route('escolas.update', $escola->id) }}"
      --}}

      <div class="row g-3">

        <div class="col-12 col-lg-7">
          <label class="form-label">Nome da escola</label>
          <input type="text" name="nome" class="form-control soft-input"
            value="">
          {{-- value="{{ $escola->nome }}" --}}
        </div>

        <div class="col-12 col-lg-5">
          <label class="form-label">CNPJ</label>
          <input type="text" name="cnpj" class="form-control soft-input"
            value="">
          {{-- value="{{ $escola->cnpj }}" --}}
        </div>

        <div class="col-12 col-lg-7">
          <label class="form-label">Endereço</label>
          <input type="text" name="endereco" class="form-control soft-input"
            value="">
          {{-- value="{{ $escola->endereco }}" --}}
        </div>

        <div class="col-12 col-md-6 col-lg-2">
          <label class="form-label">Número</label>
          <input type="text" name="numero" class="form-control soft-input"
            value="">
          {{-- value="{{ $escola->numero }}" --}}
        </div>

        <div class="col-12 col-md-6 col-lg-3">
          <label class="form-label">Bairro</label>
          <input type="text" name="bairro" class="form-control soft-input"
            value="">
          {{-- value="{{ $escola->bairro }}" --}}
        </div>

        <div class="col-12 col-md-6 col-lg-3">
          <label class="form-label">Cidade</label>
          <input type="text" name="cidade" class="form-control soft-input"
            value="">
          {{-- value="{{ $escola->cidade }}" --}}
        </div>

        <div class="col-12 col-md-6 col-lg-2">
          <label class="form-label">CEP</label>
          <input type="text" name="cep" class="form-control soft-input"
            value="">
          {{-- value="{{ $escola->cep }}" --}}
        </div>

      </div>

      {{-- Arquivo atual --}}
      <div class="mt-4">
        <label class="form-label">Arquivo atual</label>

        <div class="file-box">
          <span class="file-pill">Nenhum arquivo</span>

          {{-- Se existir:
          <a class="file-pill"
             href="{{ asset('storage/' . $escola->arquivo) }}"
             target="_blank">
             Ver arquivo atual
          </a>
          --}}
        </div>
      </div>

      {{-- Substituir arquivo --}}
      <div class="mt-3">
        <label class="form-label">Substituir arquivo (opcional)</label>

        <label class="btn btn-upload mb-0">
          Envie um novo arquivo
          <input type="file" name="arquivo" class="d-none" accept=".pdf,image/*">
        </label>

        <small class="text-muted d-block mt-2">
          Se enviar um novo arquivo, o anterior será substituído.
        </small>
      </div>

      {{-- Botões --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="" class="icon-btn danger" title="Cancelar">
          <i class="bi bi-x-lg"></i>
        </a>
        {{-- href esperado:
        href="{{ route('escolas.index') }}"
        --}}

        <button type="submit" class="icon-btn success" title="Salvar">
          <i class="bi bi-save"></i>
        </button>
      </div>

    </form>

  </div>
</div>
@endsection