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

      {{-- Dados pessoais --}}
      <div class="section-header">
        <div class="section-icon">👤</div>
        <h2 class="section-title">Dados Pessoais</h2>
      </div>

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

      </div>

      {{-- Dados profissionais --}}
      <hr class="block-divider">
      <div class="section-header">
        <div class="section-icon">💼</div>
        <h2 class="section-title">Dados Profissionais</h2>
      </div>

      <div class="row g-3">

        <div class="col-12 col-md-4">
          <label class="form-label">Profissão</label>
          <input type="text" name="profissao" class="form-control soft-input" required>
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Número de Registro</label>
          <input type="text" name="numero_registro" class="form-control soft-input" placeholder="Ex: CRP, CREFITO...">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Especialização</label>
          <input type="text" name="especializacao" class="form-control soft-input" placeholder="Ex: ABA, TEA, Neuro...">
        </div>

        <div class="col-12">
          <label class="form-label">Formações</label>
          <div id="formacoes-wrapper">
            <div class="formacao-item d-flex gap-2 mb-2">
              <input
                type="text"
                name="formacoes[]"
                class="form-control soft-input"
                placeholder="Ex: Graduação em Psicologia">
              <button type="button" class="btn-remove d-none" title="Remover">✕</button>
            </div>
          </div>
          <button type="button" id="add-formacao" class="btn-add">
            + Adicionar formação
          </button>
        </div>

      </div>

      {{-- Documentos --}}
      <hr class="block-divider">
      <div class="section-header">
        <div class="section-icon">📎</div>
        <h2 class="section-title">Documentos do Profissional</h2>
      </div>

      <div class="documentos-area">
        <label class="documentos-dropzone" id="dropzone" for="documentos">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
          </svg>
          <span class="dropzone-titulo">Clique para selecionar ou arraste os arquivos aqui</span>
          <span class="dropzone-sub">PDF ou imagem • Você pode enviar vários arquivos</span>
        </label>
        <input type="file" id="documentos" name="documentos[]" multiple class="d-none" accept=".pdf,image/*">

        <ul id="listaDocumentos" class="lista-documentos"></ul>
      </div>

      {{-- Botões --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="{{ route('profissionais.index') }}" class="btn btn-soft-secondary">Cancelar</a>
        <button type="submit" class="btn btn-soft-primary">Salvar</button>
      </div>

    </form>
  </div>
</div>

<script>
  // ── Formações dinâmicas ───────────────────────────────────────
  document.getElementById('add-formacao').addEventListener('click', function () {
    var wrapper = document.getElementById('formacoes-wrapper');
    var div     = document.createElement('div');
    div.classList.add('formacao-item', 'd-flex', 'gap-2', 'mb-2');
    div.innerHTML =
      '<input type="text" name="formacoes[]" class="form-control soft-input" placeholder="Ex: Pós-graduação em ABA">' +
      '<button type="button" class="btn-remove" title="Remover">✕</button>';
    wrapper.appendChild(div);
  });

  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('btn-remove')) {
      e.target.parentElement.remove();
    }
  });

  // ── Documentos (drag & drop + clique) ────────────────────────
  var arquivosSelecionados = [];
  var inputDocumentos      = document.getElementById('documentos');
  var dropzone             = document.getElementById('dropzone');

  inputDocumentos.addEventListener('change', function () {
    adicionarArquivos(this.files);
  });

  dropzone.addEventListener('dragover', function (e) {
    e.preventDefault();
    dropzone.classList.add('dragover');
  });

  dropzone.addEventListener('dragleave', function () {
    dropzone.classList.remove('dragover');
  });

  dropzone.addEventListener('drop', function (e) {
    e.preventDefault();
    dropzone.classList.remove('dragover');
    adicionarArquivos(e.dataTransfer.files);
  });

  function adicionarArquivos(files) {
    for (var i = 0; i < files.length; i++) {
      arquivosSelecionados.push(files[i]);
    }
    renderizarLista();
  }

  function renderizarLista() {
    var lista        = document.getElementById('listaDocumentos');
    var dataTransfer = new DataTransfer();
    lista.innerHTML  = '';

    arquivosSelecionados.forEach(function (arquivo, index) {
      dataTransfer.items.add(arquivo);

      var icone   = arquivo.type.startsWith('image/') ? '🖼️' : '📄';
      var tamanho = (arquivo.size / 1024).toFixed(1) + ' KB';

      var item = document.createElement('li');
      item.innerHTML =
        '<div class="doc-info">' +
          '<span class="doc-icone">' + icone + '</span>' +
          '<div>' +
            '<span class="doc-nome">' + arquivo.name + '</span>' +
            '<span class="doc-tamanho">' + tamanho + '</span>' +
          '</div>' +
        '</div>' +
        '<button type="button" class="doc-remover" onclick="removerArquivo(' + index + ')" title="Remover">' +
          '&times;' +
        '</button>';
      lista.appendChild(item);
    });

    inputDocumentos.files = dataTransfer.files;
  }

  function removerArquivo(index) {
    arquivosSelecionados.splice(index, 1);
    renderizarLista();
  }
</script>

@endsection