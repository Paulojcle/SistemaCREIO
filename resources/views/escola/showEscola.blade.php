@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/showEscola.css') }}">
@endpush

@section('content')
<div class="escola-page">
  <div class="escola-card">

    <h1 class="escola-title">INFORMAÇÕES DA ESCOLA</h1>

    <div class="row g-3">

      <div class="col-12 col-lg-7">
        <label class="form-label">Nome da escola</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $escola->nome }}" --}}
      </div>

      <div class="col-12 col-lg-5">
        <label class="form-label">CNPJ</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $escola->cnpj }}" --}}
      </div>

      <div class="col-12 col-lg-7">
        <label class="form-label">Endereço</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $escola->endereco }}" --}}
      </div>

      <div class="col-12 col-md-6 col-lg-2">
        <label class="form-label">Número</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $escola->numero }}" --}}
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <label class="form-label">Bairro</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $escola->bairro }}" --}}
      </div>

      <div class="col-12 col-md-6 col-lg-3">
        <label class="form-label">Cidade</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $escola->cidade }}" --}}
      </div>

      <div class="col-12 col-md-6 col-lg-2">
        <label class="form-label">CEP</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $escola->cep }}" --}}
      </div>

    </div>

    {{-- Arquivo anexado --}}
    <div class="mt-4">
      <label class="form-label">Arquivo anexado</label>

      <div class="file-box">
        <span class="file-pill">Nenhum arquivo</span>

        {{-- Se existir:
        <a class="file-pill"
           href="{{ asset('storage/' . $escola->arquivo) }}"
           target="_blank">
          Ver arquivo
        </a>
        --}}
      </div>
    </div>

    {{-- Botões (canto inferior direito) --}}
    <div class="mt-4 d-flex justify-content-end gap-2">

      <a href="" class="icon-btn neutral" title="Voltar">
        <i class="bi bi-arrow-left"></i>
      </a>
      {{-- href esperado:
      href="{{ route('escolas.index') }}"
      --}}

      <a href="" class="icon-btn success" title="Editar">
        <i class="bi bi-pencil-square"></i>
      </a>
      {{-- href esperado:
      href="{{ route('escolas.edit', $escola->id) }}"
      --}}

    </div>

  </div>
</div>
@endsection