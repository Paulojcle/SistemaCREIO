@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/profissional/createProfissional.css') }}">
@endpush

@section('content')

<div class="prof-page">
  <div class="prof-card">

    <h1 class="prof-title">EDITAR PROFISSIONAL</h1>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
    <div class="alert-success-banner">
      <span class="alert-icon">✅</span>
      <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- Forms ocultos de remoção (fora do form principal) --}}
    @foreach($profissional->documentos as $doc)
    <form id="form-remover-doc-{{ $doc->id }}"
      action="{{ route('profissionais.documentos.destroy', $doc->id) }}"
      method="POST"
      style="display:none;">
      @csrf
      @method('DELETE')
    </form>
    @endforeach

    {{-- Formulário principal --}}
    <form action="{{ route('profissionais.update', $profissional->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- Dados pessoais --}}
      <div class="section-header">
        <div class="section-icon">👤</div>
        <h2 class="section-title">Dados Pessoais</h2>
      </div>

      <div class="row g-3">

        <div class="col-12 col-md-8">
          <label class="form-label">Nome completo</label>
          <input type="text" name="nome" class="form-control soft-input"
            value="{{ old('nome', $profissional->nome) }}" required>
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Data de Nascimento</label>
          <input type="date" name="data_nascimento" class="form-control soft-input"
            value="{{ old('data_nascimento', $profissional->data_nascimento) }}">
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">RG</label>
          <input type="text" name="rg" class="form-control soft-input"
            value="{{ old('rg', $profissional->rg) }}">
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">CPF</label>
          <input type="text" name="cpf" class="form-control soft-input" inputmode="numeric"
            value="{{ old('cpf', $profissional->cpf) }}">
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Celular</label>
          <input type="text" name="celular" class="form-control soft-input" inputmode="tel"
            value="{{ old('celular', $profissional->celular) }}">
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
          <input type="text" name="profissao" class="form-control soft-input"
            value="{{ old('profissao', $profissional->profissao) }}" required>
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Número de Registro</label>
          <input type="text" name="numero_registro" class="form-control soft-input"
            placeholder="Ex: CRP, CREFITO..."
            value="{{ old('numero_registro', $profissional->numero_registro) }}">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Especialização</label>
          <input type="text" name="especializacao" class="form-control soft-input"
            placeholder="Ex: ABA, TEA, Neuro..."
            value="{{ old('especializacao', $profissional->especializacao) }}">
        </div>

        <div class="col-12">
          <label class="form-label">Formações</label>
          <div id="formacoes-wrapper">
            @forelse($profissional->formacoes as $formacao)
            <div class="formacao-item d-flex gap-2 mb-2">
              <input type="text" name="formacoes[]" class="form-control soft-input"
                value="{{ $formacao->descricao }}">
              <button type="button" class="btn-remove" title="Remover">✕</button>
            </div>
            @empty
            <div class="formacao-item d-flex gap-2 mb-2">
              <input type="text" name="formacoes[]" class="form-control soft-input"
                placeholder="Ex: Graduação em Psicologia">
              <button type="button" class="btn-remove d-none" title="Remover">✕</button>
            </div>
            @endforelse
          </div>
          <button type="button" id="add-formacao" class="btn-add">
            + Adicionar formação
          </button>
        </div>

      </div>

      {{-- Documentos existentes --}}
      <hr class="block-divider">
      <div class="section-header">
        <div class="section-icon">📎</div>
        <h2 class="section-title">Documentos do Profissional</h2>
      </div>

      @forelse($profissional->documentos as $doc)
      @if($loop->first)<ul class="lista-documentos">@endif
        <li id="doc-item-{{ $doc->id }}">
          <div class="doc-info">
            <span class="doc-icone">📄</span>
            <div>
              <span class="doc-nome">{{ $doc->nome_original }}</span>
              <a href="{{ Storage::url($doc->arquivo) }}" target="_blank" class="doc-link">
                Visualizar
              </a>
            </div>
          </div>
          <button
            type="button"
            class="doc-remover"
            data-id="{{ $doc->id }}"
            data-nome="{{ $doc->nome_original }}"
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
        <a href="{{ route('profissionais.show', $profissional->id) }}" class="btn btn-soft-secondary">Cancelar</a>
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
  // ── Formações dinâmicas ───────────────────────────────────────
  document.getElementById('add-formacao').addEventListener('click', function() {
    var wrapper = document.getElementById('formacoes-wrapper');
    var div = document.createElement('div');
    div.classList.add('formacao-item', 'd-flex', 'gap-2', 'mb-2');
    div.innerHTML =
      '<input type="text" name="formacoes[]" class="form-control soft-input" placeholder="Ex: Pós-graduação em ABA">' +
      '<button type="button" class="btn-remove" title="Remover">✕</button>';
    wrapper.appendChild(div);
  });

  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-remove')) {
      var wrapper = document.getElementById('formacoes-wrapper');
      if (wrapper.children.length > 1) {
        e.target.parentElement.remove();
      } else {
        e.target.previousElementSibling.value = '';
      }
    }
  });

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
    var url = form.action;
    var token = form.querySelector('input[name="_token"]').value;

    // Faz a requisição sem recarregar a página
    fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: '_token=' + encodeURIComponent(token) + '&_method=DELETE'
      })
      .then(function(res) {
        if (res.ok || res.redirected) {
          // Remove o item visualmente sem recarregar
          var item = document.getElementById('doc-item-' + docAlvoId);
          if (item) item.remove();

          // Se não sobrou nenhum documento, mostra mensagem vazia
          var lista = item && item.closest('ul');
          if (lista && lista.children.length === 0) {
            lista.insertAdjacentHTML('afterend', '<p class="docs-vazios">Nenhum documento anexado ainda.</p>');
            lista.remove();
          }
        } else {
          alert('Erro ao remover o documento. Tente novamente.');
        }
      })
      .catch(function() {
        alert('Erro de conexão ao tentar remover o documento.');
      })
      .finally(function() {
        docAlvoId = null;
        document.getElementById('confirmDocBackdrop').classList.remove('open');
      });
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