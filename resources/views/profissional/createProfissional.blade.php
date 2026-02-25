@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/profissional/createProfissional.css') }}">
@endpush

@section('content')

<div class="prof-page">
  <div class="prof-card">

    <h1 class="prof-title">CADASTRO DE NOVO PROFISSIONAL</h1>

    <form action="" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="row g-3">

        {{-- Linha 1 --}}
        <div class="col-12 col-md-8">
          <label class="form-label">Nome completo</label>
          <input type="text" name="nome" class="form-control soft-input" required>
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Data de Nascimento</label>
          <input type="date" name="data_nascimento" class="form-control soft-input" required>
        </div>

        {{-- Linha 2 --}}
        <div class="col-12 col-md-3">
          <label class="form-label">RG</label>
          <input type="text" name="rg" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">CPF</label>
          <input type="text" name="cpf" class="form-control soft-input" inputmode="numeric">
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Celular</label>
          <input type="text" name="celular" class="form-control soft-input" inputmode="tel">
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Número de registro</label>
          <input type="text" name="numero_registro" class="form-control soft-input" placeholder="Ex: CRP, CREFITO...">
        </div>

        {{-- Linha 3 --}}
        <div class="col-12 col-md-3">
          <label class="form-label">Profissão</label>
          <input type="text" name="profissao" class="form-control soft-input" required>
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Formação</label>
          <input type="text" name="formacao" class="form-control soft-input" placeholder="Ex: Graduação em...">
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Especialização</label>
          <input type="text" name="especializacao" class="form-control soft-input" placeholder="Ex: ABA, TEA, Neuro...">
        </div>

        {{-- Espaço em branco (pra ficar como a imagem) --}}
        <div class="col-12 col-md-3 d-none d-md-block"></div>

        {{-- Upload --}}
        <div class="col-12 col-md-4">
          <label class="form-label">Enviar arquivo</label>
          <input
            type="file"
            name="arquivo"
            class="form-control soft-input"
            accept=".pdf,image/*"
          >
          <small class="text-muted">Envie PDF ou imagem (opcional).</small>
        </div>

      </div>

      {{-- Botões --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="" class="btn btn-soft-secondary">Cancelar</a>
        <button type="submit" class="btn btn-soft-primary">Salvar</button>
      </div>

    </form>

  </div>
</div>

@endsection