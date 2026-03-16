@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/createEscola.css') }}">
@endpush

@section('content')

<div class="escola-page">
  <div class="escola-card">

    <h1 class="escola-title">CADASTRO DE NOVA ESCOLA</h1>

    <form action="{{ route('escolas.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- Dados da escola --}}
      <div class="section-header">
        <div class="section-icon">🏫</div>
        <h2 class="section-title">Dados da Escola</h2>
      </div>

      <div class="row g-3">

        <div class="col-12 col-lg-7">
          <label class="form-label">Nome da escola</label>
          <input type="text" name="nome" class="form-control soft-input" required>
        </div>

        <div class="col-12 col-lg-5">
          <label class="form-label">CNPJ</label>
          <input type="text" name="cnpj" class="form-control soft-input" inputmode="numeric">
        </div>

      </div>

      {{-- Endereço --}}
      <hr class="block-divider">
      <div class="section-header">
        <div class="section-icon">📍</div>
        <h2 class="section-title">Endereço</h2>
      </div>

      <div class="row g-3">

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

      {{-- Documentos --}}
      <hr class="block-divider">
      <div class="section-header">
        <div class="section-icon">📎</div>
        <h2 class="section-title">Documentos da Escola</h2>
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
        <a href="{{ route('escolas.index') }}" class="btn btn-soft-secondary">Cancelar</a>
        <button type="submit" class="btn btn-soft-primary">Salvar</button>
      </div>

    </form>
  </div>
</div>

<script>
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