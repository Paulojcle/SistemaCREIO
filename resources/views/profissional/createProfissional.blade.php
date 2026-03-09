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

        <div class="col-12 col-md-6">
          <label class="form-label">Formações</label>

          <div id="formacoes-wrapper">
            <div class="formacao-item d-flex gap-2 mb-2">
              <input 
                type="text" 
                name="formacoes[]" 
                class="form-control soft-input"
                placeholder="Ex: Graduação em Psicologia"
              >
              <button type="button" class="btn-remove d-none">✕</button>
            </div>
          </div>

          <button type="button" id="add-formacao" class="btn-add">
            + Adicionar formação
          </button>
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Especialização</label>
          <input type="text" name="especializacao" class="form-control soft-input" placeholder="Ex: ABA, TEA, Neuro...">
        </div>

        {{-- Nova linha para organizar o layout --}}
        <div class="w-100"></div>

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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){

  const addBtn = document.getElementById('add-formacao');
  const wrapper = document.getElementById('formacoes-wrapper');

  if(addBtn){

    addBtn.addEventListener('click', function(){

      const div = document.createElement('div');
      div.classList.add('formacao-item','d-flex','gap-2','mb-2');

      div.innerHTML = `
        <input 
          type="text" 
          name="formacoes[]" 
          class="form-control soft-input"
          placeholder="Ex: Pós-graduação em ABA"
        >
        <button type="button" class="btn-remove">✕</button>
      `;

      wrapper.appendChild(div);
    });

  }

  document.addEventListener('click', function(e){
    if(e.target.classList.contains('btn-remove')){
      e.target.parentElement.remove();
    }
  });

});
</script>
@endpush

@endsection