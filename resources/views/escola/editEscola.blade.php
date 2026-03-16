@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/createEscola.css') }}">
@endpush

@section('content')

<div class="escola-page">
  <div class="escola-card">

    <h1 class="escola-title">EDITAR ESCOLA</h1>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
    <div class="alert-success-banner">
      <span class="alert-icon">✅</span>
      <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- Forms ocultos de remoção (fora do form principal) --}}
    @foreach($escola->documentos as $doc)
    <form id="form-remover-doc-{{ $doc->id }}"
      action="{{ route('documentos.destroy', $doc->id) }}"
      method="POST"
      style="display:none;">
      @csrf
      @method('DELETE')
    </form>
    @endforeach

    {{-- Formulário principal --}}
    <form action="{{ route('escolas.update', $escola->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- Dados da escola --}}
      <div class="section-header">
        <div class="section-icon">🏫</div>
        <h2 class="section-title">Dados da Escola</h2>
      </div>

      <div class="row g-3">

        <div class="col-12 col-lg-7">
          <label class="form-label">Nome da escola</label>
          <input type="text" name="nome" class="form-control soft-input"
            value="{{ old('nome', $escola->nome) }}" required>
        </div>

        <div class="col-12 col-lg-5">
          <label class="form-label">CNPJ</label>
          <input type="text" name="cnpj" class="form-control soft-input" inputmode="numeric"
            value="{{ old('cnpj', $escola->cnpj) }}">
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
          <input type="text" name="endereco" class="form-control soft-input"
            value="{{ old('endereco', $escola->endereco) }}">
        </div>

        <div class="col-12 col-md-6 col-lg-2">
          <label class="form-label">Número</label>
          <input type="text" name="numero" class="form-control soft-input"
            value="{{ old('numero', $escola->numero) }}">
        </div>

        <div class="col-12 col-md-6 col-lg-3">
          <label class="form-label">Bairro</label>
          <input type="text" name="bairro" class="form-control soft-input"
            value="{{ old('bairro', $escola->bairro) }}">
        </div>

        <div class="col-12 col-md-6 col-lg-3">
          <label class="form-label">Cidade</label>
          <input type="text" name="cidade" class="form-control soft-input"
            value="{{ old('cidade', $escola->cidade) }}">
        </div>

        <div class="col-12 col-md-6 col-lg-2">
          <label class="form-label">CEP</label>
          <input type="text" name="cep" class="form-control soft-input" inputmode="numeric"
            value="{{ old('cep', $escola->cep) }}">
        </div>

      </div>

      {{-- Documentos existentes --}}
      <hr class="block-divider">
      <div class="section-header">
        <div class="section-icon">📎</div>
        <h2 class="section-title">Documentos da Escola</h2>
      </div>

      @forelse($escola->documentos as $doc)
      @if($loop->first)<ul class="lista-documentos">@endif
        <li id="doc-item-{{ $doc->id }}">
          <div class="doc-info">
            <span class="doc-icone">📄</span>
            <div>
              <span class="doc-nome">{{ basename($doc->arquivo) }}</span>
              <a href="{{ Storage::url($doc->arquivo) }}" target="_blank" class="doc-link">
                Visualizar
              </a>
            </div>
          </div>
          <button
            type="button"
            class="doc-remover"
            data-id="{{ $doc->id }}"
            data-nome="{{ basename($doc->arquivo) }}"
            onclick="abrirConfirmacao(this)"
            title="Remover">
            &times;
          </button>
        </li>
        @if($loop->last)
      </ul>@endif
      @empty
      <p class="docs-vazios">Nenhum documento anexado ainda.</p>
      @endforelse

      {{-- Upload de novos documentos --}}
      <div class="documentos-area mt-3">
        <label class="documentos-dropzone" id="dropzone" for="documentos">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
          </svg>
          <span class="dropzone-titulo">Clique para adicionar novos documentos ou arraste aqui</span>
          <span class="dropzone-sub">PDF ou imagem • Você pode enviar vários arquivos</span>
        </label>
        <input type="file" id="documentos" name="documentos[]" multiple class="d-none" accept=".pdf,image/*">

        <ul id="listaDocumentos" class="lista-documentos"></ul>
      </div>

      {{-- Botões --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="{{ route('escolas.show', $escola->id) }}" class="btn btn-soft-secondary">Cancelar</a>
        <button type="submit" class="btn btn-soft-primary">Salvar alterações</button>
      </div>

    </form>
  </div>
</div>

{{-- Modal de confirmação remoção de documento --}}
<div class="confirm-backdrop" id="confirmDocBackdrop">
  <div class="confirm-modal">
    <div class="confirm-icon">🗑️</div>
    <h3 class="confirm-title">Remover documento?</h3>
    <p class="confirm-text" id="confirmDocTexto">O documento será removido permanentemente.</p>
    <div class="confirm-btns">
      <button type="button" class="confirm-btn confirm-btn--cancel" id="btnCancelDoc">Cancelar</button>
      <button type="button" class="confirm-btn confirm-btn--danger" id="btnConfirmDoc">Sim, remover</button>
    </div>
  </div>
</div>

<script>
  // ── Remoção de documentos existentes ─────────────────────────
  var docAlvoId = null;

  function abrirConfirmacao(btn) {
    docAlvoId = btn.dataset.id;
    document.getElementById('confirmDocTexto').textContent =
      'O documento "' + btn.dataset.nome + '" será removido permanentemente.';
    document.getElementById('confirmDocBackdrop').classList.add('open');
  }

  document.getElementById('btnCancelDoc').addEventListener('click', function() {
    docAlvoId = null;
    document.getElementById('confirmDocBackdrop').classList.remove('open');
  });

  document.getElementById('confirmDocBackdrop').addEventListener('click', function(e) {
    if (e.target === this) {
      docAlvoId = null;
      this.classList.remove('open');
    }
  });

  document.getElementById('btnConfirmDoc').addEventListener('click', function() {
    if (!docAlvoId) return;
    var form = document.getElementById('form-remover-doc-' + docAlvoId);
    if (!form) {
      alert('Formulário não encontrado para id: ' + docAlvoId);
      return;
    }
    form.submit();
  });

  // ── Novos documentos (drag & drop + clique) ──────────────────
  var arquivosSelecionados = [];
  var inputDocumentos = document.getElementById('documentos');
  var dropzone = document.getElementById('dropzone');

  inputDocumentos.addEventListener('change', function() {
    adicionarArquivos(this.files);
  });

  dropzone.addEventListener('dragover', function(e) {
    e.preventDefault();
    dropzone.classList.add('dragover');
  });

  dropzone.addEventListener('dragleave', function() {
    dropzone.classList.remove('dragover');
  });

  dropzone.addEventListener('drop', function(e) {
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
    var lista = document.getElementById('listaDocumentos');
    var dataTransfer = new DataTransfer();
    lista.innerHTML = '';

    arquivosSelecionados.forEach(function(arquivo, index) {
      dataTransfer.items.add(arquivo);
      var icone = arquivo.type.startsWith('image/') ? '🖼️' : '📄';
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