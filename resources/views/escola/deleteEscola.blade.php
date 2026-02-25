@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/deleteEscola.css') }}">
@endpush

@section('content')
<div class="escola-page">
  <div class="escola-card">

    <h1 class="escola-title danger-title">EXCLUIR ESCOLA</h1>

    {{-- ALERTA --}}
    <div class="danger-box">
      <strong>Atenção:</strong> essa ação não pode ser desfeita.
      <div class="mt-1">Confirme se deseja excluir a escola abaixo.</div>
    </div>

    <form action="" method="POST">
      @csrf
      @method('DELETE')

      {{-- action esperado:
      action="{{ route('escolas.destroy', $escola->id) }}"
      --}}

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

      {{-- Arquivo anexado (somente visual) --}}
      <div class="mt-4">
        <label class="form-label">Arquivo anexado</label>

        <div class="file-box">
          <span class="file-pill">Nenhum arquivo</span>

          {{-- Se existir arquivo:
          <a class="file-pill" href="{{ asset('storage/' . $escola->arquivo) }}" target="_blank">
            Ver arquivo
          </a>
          --}}
        </div>
      </div>

      {{-- Botões (canto inferior direito) --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="" class="icon-btn danger" title="Cancelar">
          <i class="bi bi-x-lg"></i>
        </a>
        {{-- href esperado:
        href="{{ route('escolas.index') }}"
        --}}

        <button type="submit" class="icon-btn trash" title="Excluir"
          onclick="return confirm('Tem certeza que deseja excluir esta escola?')">
          <i class="bi bi-trash"></i>
        </button>
      </div>

    </form>

  </div>
</div>
@endsection