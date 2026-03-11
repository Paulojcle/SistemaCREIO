@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/profissional/editProfissional.css') }}">
@endpush

@section('content')

<div class="prof-page">
  <div class="prof-card">

    <h1 class="prof-title">EDITAR PROFISSIONAL</h1>

    @if(session('success'))
      <div class="alert-success-banner">
        <span class="alert-icon">✅</span>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    {{-- Forms de remoção de documento (fora do form principal) --}}
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

      <div class="row g-3">

        <div class="col-12 col-md-8">
          <label class="form-label">Nome completo</label>
          <input type="text" name="nome" class="form-control soft-input" value="{{ $profissional->nome }}">
        </div>

        <div class="col-12 col-md-4">
          <label class="form-label">Data de Nascimento</label>
          <input type="date" name="data_nascimento" class="form-control soft-input" value="{{ $profissional->data_nascimento }}">
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">RG</label>
          <input type="text" name="rg" class="form-control soft-input" value="{{ $profissional->rg }}">
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">CPF</label>
          <input type="text" name="cpf" class="form-control soft-input" value="{{ $profissional->cpf }}" inputmode="numeric">
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Celular</label>
          <input type="text" name="celular" class="form-control soft-input" value="{{ $profissional->celular }}" inputmode="tel">
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Número de registro</label>
          <input type="text" name="numero_registro" class="form-control soft-input" value="{{ $profissional->numero_registro }}" placeholder="Ex: CRP, CREFITO...">
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Profissão</label>
          <input type="text" name="profissao" class="form-control soft-input" value="{{ $profissional->profissao }}">
        </div>

        <div class="col-12 col-md-6">
          <label class="form-label">Especialização</label>
          <input type="text" name="especializacao" class="form-control soft-input" value="{{ $profissional->especializacao }}">
        </div>

      </div>

      {{-- Formações --}}
      <div class="section-block mt-4">
        <label class="form-label">Formações</label>

        <div id="formacoes-wrapper">
          @forelse($profissional->formacoes as $formacao)
            <div class="input-removivel">
              <input type="text" name="formacoes[]" class="form-control soft-input" value="{{ $formacao->descricao }}">
              <button type="button" class="btn-remover" onclick="removerCampo(this)">✕</button>
            </div>
          @empty
            <div class="input-removivel">
              <input type="text" name="formacoes[]" class="form-control soft-input" placeholder="Ex: Psicologia - USP">
              <button type="button" class="btn-remover" onclick="removerCampo(this)">✕</button>
            </div>
          @endforelse
        </div>

        <button type="button" class="btn-adicionar mt-2" onclick="adicionarFormacao()">
          + Adicionar formação
        </button>
      </div>

      {{-- Documentos existentes --}}
      <div class="section-block mt-4">
        <label class="form-label">Documentos Anexados</label>

        @forelse($profissional->documentos as $doc)
          <div class="doc-item">
            <div class="doc-info">
              <span style="font-size: 18px;">📄</span>
              <span class="text-truncate" style="max-width: 220px;">{{ $doc->nome_original }}</span>
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
                data-nome="{{ $doc->nome_original }}">
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

        {{-- Preview dos arquivos selecionados --}}
        <div id="preview-documentos" class="preview-lista mt-2" style="display:none;">
          <p class="preview-titulo">Arquivos selecionados:</p>
          <ul id="lista-preview" class="preview-items"></ul>
        </div>
      </div>

      {{-- Botões --}}
      <div class="mt-4 d-flex justify-content-end gap-2">
        <a href="{{ route('profissionais.show', $profissional->id) }}" class="btn btn-soft-secondary">Cancelar</a>
        <button type="submit" class="btn btn-soft-primary">Salvar Alterações</button>
      </div>

    </form>

  </div>
</div>

@push('scripts')
<script>
  // Acumula arquivos sem sobrescrever seleções anteriores
  const inputDocumentos = document.getElementById('input-documentos');
  const dataTransfer = new DataTransfer();

  inputDocumentos.addEventListener('change', function() {
    // Adiciona os novos arquivos ao acumulador
    Array.from(this.files).forEach(function(file) {
      // Evita duplicatas pelo nome
      const jaExiste = Array.from(dataTransfer.files).some(f => f.name === file.name);
      if (!jaExiste) {
        dataTransfer.items.add(file);
      }
    });

    // Atualiza o input com todos os arquivos acumulados
    inputDocumentos.files = dataTransfer.files;

    // Atualiza o preview
    const preview = document.getElementById('preview-documentos');
    const lista = document.getElementById('lista-preview');
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
    // Remove do acumulador
    Array.from(dataTransfer.items).forEach(function(item, index) {
      if (item.getAsFile().name === nome) {
        dataTransfer.items.remove(index);
      }
    });
    // Atualiza o input
    inputDocumentos.files = dataTransfer.files;
    // Remove da lista visual
    li.remove();
    if (dataTransfer.files.length === 0) {
      document.getElementById('preview-documentos').style.display = 'none';
    }
  }
  document.querySelectorAll('.btn-remover-doc').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var id   = this.dataset.id;
      var nome = this.dataset.nome;
      if (confirm('Remover o documento "' + nome + '"?')) {
        document.getElementById('form-remover-doc-' + id).submit();
      }
    });
  });

  function adicionarFormacao() {
    const wrapper = document.getElementById('formacoes-wrapper');
    const div = document.createElement('div');
    div.className = 'input-removivel';
    div.innerHTML = `
      <input type="text" name="formacoes[]" class="form-control soft-input" placeholder="Ex: Psicologia - USP">
      <button type="button" class="btn-remover" onclick="removerCampo(this)">✕</button>
    `;
    wrapper.appendChild(div);
  }

  function removerCampo(btn) {
    const wrapper = document.getElementById('formacoes-wrapper');
    if (wrapper.children.length > 1) {
      btn.parentElement.remove();
    } else {
      btn.previousElementSibling.value = '';
    }
  }
</script>
@endpush

@endsection