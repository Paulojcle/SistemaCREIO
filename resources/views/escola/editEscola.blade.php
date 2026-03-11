@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/editEscola.css') }}">
@endpush

@section('content')

<div class="escola-page">
  <div class="escola-card">

    <h1 class="escola-title">EDITAR ESCOLA</h1>

    @if(session('success'))
      <div class="alert-success-banner">
        <span class="alert-icon">✅</span>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    {{-- Forms de remoção de documento (fora do form principal) --}}
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

      <div class="row g-3">

        <div class="col-12 col-lg-7">
          <label class="form-label">Nome da Escola</label>
          <input type="text" name="nome" value="{{ $escola->nome }}" class="form-control soft-input" required>
        </div>

        <div class="col-12 col-lg-5">
          <label class="form-label">CNPJ</label>
          <input type="text" name="cnpj" value="{{ $escola->cnpj }}" class="form-control soft-input" inputmode="numeric">
        </div>

        <div class="col-12 col-lg-7">
          <label class="form-label">Endereço</label>
          <input type="text" name="endereco" value="{{ $escola->endereco }}" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-6 col-lg-2">
          <label class="form-label">Número</label>
          <input type="text" name="numero" value="{{ $escola->numero }}" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-6 col-lg-3">
          <label class="form-label">Bairro</label>
          <input type="text" name="bairro" value="{{ $escola->bairro }}" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-6 col-lg-3">
          <label class="form-label">Cidade</label>
          <input type="text" name="cidade" value="{{ $escola->cidade }}" class="form-control soft-input">
        </div>

        <div class="col-12 col-md-6 col-lg-2">
          <label class="form-label">CEP</label>
          <input type="text" name="cep" value="{{ $escola->cep }}" class="form-control soft-input" inputmode="numeric">
        </div>

      </div>

      {{-- Documentos existentes --}}
      <div class="section-block mt-4">
        <label class="form-label">Documentos Anexados</label>

        @forelse($escola->documentos as $doc)
          <div class="doc-item">
            <div class="doc-info">
              <span style="font-size: 18px;">📄</span>
              <span class="text-truncate" style="max-width: 220px;">{{ basename($doc->arquivo) }}</span>
            </div>
            <div class="d-flex gap-2">
              <a href="{{ Storage::url($doc->arquivo) }}" target="_blank" class="btn-soft-primary"
                style="text-decoration: none; font-size: 12px; padding: 5px 14px;">
                Visualizar
              </a>
              <button type="button"
                class="btn-soft-danger btn-remover-doc"
                style="font-size: 12px; padding: 5px 14px;"
                data-id="{{ $doc->id }}"
                data-nome="{{ basename($doc->arquivo) }}">
                Remover
              </button>
            </div>
          </div>
        @empty
          <p class="text-muted" style="font-style: italic; font-size: 13px;">Nenhum documento anexado.</p>
        @endforelse
      </div>

      {{-- Upload novos documentos --}}
      <div class="section-block mt-3">
        <label class="form-label">
          Adicionar novos documentos
          <span class="text-muted" style="font-weight: 400;">(opcional)</span>
        </label>
        <input type="file" id="input-documentos" name="documentos[]" class="form-control soft-input" accept=".pdf,image/*" multiple>
        <small class="text-muted">PDF ou imagem. Segure Ctrl (ou Cmd no Mac) para selecionar múltiplos arquivos.</small>

        <div id="preview-documentos" class="preview-lista mt-2" style="display:none;">
          <p class="preview-titulo">Arquivos selecionados:</p>
          <ul id="lista-preview" class="preview-items"></ul>
        </div>
      </div>

      {{-- Botões --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="{{ route('escolas.show', $escola->id) }}" class="btn btn-soft-secondary">Cancelar</a>
        <button type="submit" class="btn btn-soft-primary">Salvar Alterações</button>
      </div>

    </form>

  </div>
</div>

@push('scripts')
<script>
  // Remoção de documentos existentes
  document.querySelectorAll('.btn-remover-doc').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var id   = this.dataset.id;
      var nome = this.dataset.nome;
      if (confirm('Remover o documento "' + nome + '"?')) {
        document.getElementById('form-remover-doc-' + id).submit();
      }
    });
  });

  // Acumula arquivos sem sobrescrever seleções anteriores
  const inputDocumentos = document.getElementById('input-documentos');
  const dataTransfer = new DataTransfer();

  inputDocumentos.addEventListener('change', function() {
    Array.from(this.files).forEach(function(file) {
      const jaExiste = Array.from(dataTransfer.files).some(f => f.name === file.name);
      if (!jaExiste) dataTransfer.items.add(file);
    });

    inputDocumentos.files = dataTransfer.files;

    const preview = document.getElementById('preview-documentos');
    const lista   = document.getElementById('lista-preview');
    lista.innerHTML = '';

    if (dataTransfer.files.length === 0) {
      preview.style.display = 'none';
      return;
    }

    preview.style.display = 'block';
    Array.from(dataTransfer.files).forEach(function(file) {
      const li = document.createElement('li');
      li.className = 'preview-item';
      const tamanho = (file.size / 1024).toFixed(1);
      li.innerHTML = `
        <span>📄</span>
        <span>${file.name}</span>
        <span class="preview-tamanho">${tamanho} KB</span>
        <button type="button" class="btn-remover-preview" onclick="removerPreview('${file.name}', this.closest('li'))">✕</button>
      `;
      lista.appendChild(li);
    });
  });

  function removerPreview(nome, li) {
    Array.from(dataTransfer.items).forEach(function(item, index) {
      if (item.getAsFile().name === nome) dataTransfer.items.remove(index);
    });
    inputDocumentos.files = dataTransfer.files;
    li.remove();
    if (dataTransfer.files.length === 0) {
      document.getElementById('preview-documentos').style.display = 'none';
    }
  }
</script>
@endpush

@endsection