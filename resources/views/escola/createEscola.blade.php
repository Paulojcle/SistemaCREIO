@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/createEscola.css') }}">
@endpush

@section('content')
<div class="escola-page">
  <div class="escola-card">

    <h1 class="escola-title">CADASTRO DE NOVA ESCOLA</h1>

    <form action="" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- action esperado:
      action="{{ route('escolas.store') }}"
      --}}

      <div class="row g-3">

        <div class="col-12 col-lg-7">
          <label class="form-label">Nome da escola</label>
          <input type="text" name="nome" class="form-control soft-input" required>
        </div>

        <div class="col-12 col-lg-5">
          <label class="form-label">CNPJ</label>
          <input type="text" name="cnpj" class="form-control soft-input" inputmode="numeric">
        </div>

        <div class="col-12 col-lg-7">
          <label class="form-label">Endereço</label>
          <input type="text" name="endereco" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-6 col-lg-2">
          <label class="form-label">Número</label>
          <input type="text" name="numero" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-6 col-lg-3">
          <label class="form-label">Bairro</label>
          <input type="text" name="bairro" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-6 col-lg-3">
          <label class="form-label">Cidade</label>
          <input type="text" name="cidade" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-6 col-lg-2">
          <label class="form-label">CEP</label>
          <input type="text" name="cep" class="form-control soft-input" inputmode="numeric">
        </div>

      </div>

      {{-- Upload (igual a imagem) --}}
      <div class="mt-4">
        <label class="btn btn-upload mb-0">
          Envie um arquivo
          <input type="file" name="arquivo" class="d-none" accept=".pdf,image/*">
        </label>

        <small class="text-muted d-block mt-2">
          PDF ou imagem (opcional).
        </small>
      </div>

      {{-- Botões (canto inferior direito, como na imagem) --}}
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