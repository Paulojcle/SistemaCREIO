@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/profissional/showProfissional.css') }}">
@endpush

@section('content')

<div class="prof-page">
  <div class="prof-card">

    <div class="d-flex align-items-center justify-content-between mb-3">
      <h1 class="prof-title m-0">INFORMAÇÕES DO PROFISSIONAL</h1>
    </div>

    <div class="row g-3">

      <div class="col-12 col-md-8">
        <label class="form-label">Nome completo</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $profissional->nome }}" --}}
      </div>

      <div class="col-12 col-md-4">
        <label class="form-label">Data de Nascimento</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ \Carbon\Carbon::parse($profissional->data_nascimento)->format('d/m/Y') }}" --}}
      </div>

      <div class="col-12 col-md-3">
        <label class="form-label">RG</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $profissional->rg }}" --}}
      </div>

      <div class="col-12 col-md-3">
        <label class="form-label">CPF</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $profissional->cpf }}" --}}
      </div>

      <div class="col-12 col-md-3">
        <label class="form-label">Celular</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $profissional->celular }}" --}}
      </div>

      <div class="col-12 col-md-3">
        <label class="form-label">Número de registro</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $profissional->numero_registro }}" --}}
      </div>

      <div class="col-12 col-md-3">
        <label class="form-label">Profissão</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $profissional->profissao }}" --}}
      </div>

      <div class="col-12 col-md-3">
        <label class="form-label">Formação</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $profissional->formacao }}" --}}
      </div>

      <div class="col-12 col-md-3">
        <label class="form-label">Especialização</label>
        <input type="text" class="form-control soft-input" value="" readonly>
        {{-- value="{{ $profissional->especializacao }}" --}}
      </div>

      <div class="col-12 col-md-3 d-none d-md-block"></div>

      {{-- Arquivo anexado --}}
      <div class="col-12 col-md-6">
        <label class="form-label">Arquivo anexado</label>

        <div class="file-box">
          <span class="file-pill">Nenhum arquivo</span>

          {{-- Se existir arquivo:
          <a class="file-pill" href="{{ asset('storage/' . $profissional->arquivo) }}" target="_blank">
            Ver arquivo
          </a>
          --}}
        </div>
      </div>

    </div>

    {{-- Botões no final --}}
    <div class="mt-4 d-flex justify-content-end gap-2">
      <a href="" class="btn btn-soft-secondary">Voltar</a>
      {{-- href esperado:
      href="{{ route('profissionais.index') }}"
      --}}

      <a href="" class="btn btn-soft-primary">Editar</a>
      {{-- href esperado:
      href="{{ route('profissionais.edit', $profissional->id) }}"
      --}}

      <form action="" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        {{-- action esperado:
        action="{{ route('profissionais.destroy', $profissional->id) }}"
        --}}
        <button type="submit" class="btn btn-soft-danger"
          onclick="return confirm('Tem certeza que deseja excluir este profissional?')">
          Excluir
        </button>
      </form>
    </div>

  </div>
</div>

@endsection