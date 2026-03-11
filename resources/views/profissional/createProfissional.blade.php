@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/profissional/createProfissional.css') }}">
@endpush

@section('content')

<div class="prof-page">
  <div class="prof-card">

    <h1 class="prof-title">CADASTRO DE NOVO PROFISSIONAL</h1>

    <form action="{{ route('profissionais.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="row g-3">

        <div class="col-12 col-md-8">
          <label class="form-label">Nome completo</label>
          <input type="text" name="nome" class="form-control soft-input" required>
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Data de Nascimento</label>
          <input type="date" name="data_nascimento" class="form-control soft-input" required>
        </div>

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

      </div>

      {{-- Anexar documentos --}}
      <div class="mt-4">
        <label class="btn btn-upload mb-0">
          Enviar documentos
          <input
            type="file"
            id="documentos"
            name="documentos[]"
            multiple
            class="d-none"
            accept=".pdf,image/*"
          >
        </label>

        <small class="text-muted d-block mt-2">
          PDF ou imagem (opcional). Você pode selecionar mais de um arquivo.
        </small>

        <ul id="listaDocumentos" class="lista-documentos mt-2"></ul>
      </div>

      {{-- Botões --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="" class="btn btn-soft-secondary">Cancelar</a>
        <button type="submit" class="btn btn-soft-primary">Salvar</button>
      </div>

    </form>
  </div>
</div>

<script>
  // Adicionar ou remover formações
  document.getElementById('add-formacao').addEventListener('click', function () {
    var wrapper = document.getElementById('formacoes-wrapper');
    var div = document.createElement('div');
    div.classList.add('formacao-item', 'd-flex', 'gap-2', 'mb-2');
    div.innerHTML =
      '<input type="text" name="formacoes[]" class="form-control soft-input" placeholder="Ex: Pós-graduação em ABA">' +
      '<button type="button" class="btn-remove">✕</button>';
    wrapper.appendChild(div);
  });

  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('btn-remove')) {
      e.target.parentElement.remove();
    }
  });

  // Lista de documentos interativa
  var arquivosSelecionados = [];

  document.getElementById('documentos').addEventListener('change', function () {
    for (var i = 0; i < this.files.length; i++) {
      arquivosSelecionados.push(this.files[i]);
    }
    renderizarLista();
  });

  function renderizarLista() {
    var lista        = document.getElementById('listaDocumentos');
    var input        = document.getElementById('documentos');
    var dataTransfer = new DataTransfer();

    lista.innerHTML = '';

    arquivosSelecionados.forEach(function (arquivo, index) {
      dataTransfer.items.add(arquivo);

      var item = document.createElement('li');
      item.innerHTML =
        '<span>📄 ' + arquivo.name + '</span>' +
        '<button type="button" class="btn btn-sm btn-danger py-0 px-2" onclick="removerArquivo(' + index + ')">&times;</button>';
      lista.appendChild(item);
    });

    input.files = dataTransfer.files;
  }

  function removerArquivo(index) {
    arquivosSelecionados.splice(index, 1);
    renderizarLista();
  }
</script>

@endsection