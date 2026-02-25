@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/profissional/deleteProfissional.css') }}">
@endpush

@section('content')

<div class="prof-page">
  <div class="prof-card">

    <h1 class="prof-title danger-title">EXCLUIR PROFISSIONAL</h1>

    {{-- ALERTA --}}
    <div class="danger-box">
      <strong>Atenção:</strong> essa ação não pode ser desfeita.
      <div class="mt-1">Confirme se deseja excluir o profissional abaixo.</div>
    </div>

    {{-- Formulário de exclusão --}}
    <form action="" method="POST">
      @csrf
      @method('DELETE')

      <div class="row g-3">

        {{-- Nome completo --}}
        <div class="col-12 col-md-8">
          <label class="form-label">Nome completo</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- valor esperado:
          value="{{ $profissional->nome }}"
          --}}
        </div>

        {{-- Data de Nascimento --}}
        <div class="col-12 col-md-4">
          <label class="form-label">Data de Nascimento</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- valor esperado:
          value="{{ \Carbon\Carbon::parse($profissional->data_nascimento)->format('d/m/Y') }}"
          --}}
        </div>

        {{-- RG --}}
        <div class="col-12 col-md-3">
          <label class="form-label">RG</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $profissional->rg }}" --}}
        </div>

        {{-- CPF --}}
        <div class="col-12 col-md-3">
          <label class="form-label">CPF</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $profissional->cpf }}" --}}
        </div>

        {{-- Celular --}}
        <div class="col-12 col-md-3">
          <label class="form-label">Celular</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $profissional->celular }}" --}}
        </div>

        {{-- Número de registro --}}
        <div class="col-12 col-md-3">
          <label class="form-label">Número de registro</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $profissional->numero_registro }}" --}}
        </div>

        {{-- Profissão --}}
        <div class="col-12 col-md-3">
          <label class="form-label">Profissão</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $profissional->profissao }}" --}}
        </div>

        {{-- Formação --}}
        <div class="col-12 col-md-3">
          <label class="form-label">Formação</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $profissional->formacao }}" --}}
        </div>

        {{-- Especialização --}}
        <div class="col-12 col-md-3">
          <label class="form-label">Especialização</label>
          <input type="text" class="form-control soft-input" value="" readonly>
          {{-- value="{{ $profissional->especializacao }}" --}}
        </div>

        {{-- Espaço em branco (pra manter layout) --}}
        <div class="col-12 col-md-3 d-none d-md-block"></div>

        {{-- Arquivo anexado (SÓ VISUAL) --}}
        <div class="col-12 col-md-4">
          <label class="form-label">Arquivo anexado</label>
          <div class="file-box">
            <span class="file-pill">Nenhum arquivo</span>

            {{-- Se você tiver arquivo salvo, aqui você troca por um link:
            <a class="file-pill" href="{{ asset('storage/' . $profissional->arquivo) }}" target="_blank">
              Ver arquivo
            </a>
            --}}
          </div>
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