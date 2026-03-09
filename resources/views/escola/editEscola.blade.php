@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/createEscola.css') }}">
<style>
  .escola-page {
    padding: 24px;
  }

  .escola-card {
    max-width: 980px;
    margin: 0 auto;
    background: #fff;
    border-radius: 16px;
    padding: 22px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, .06);
  }

  .escola-title {
    font-weight: 800;
    font-size: 20px;
    margin-bottom: 20px;
  }

  .current-docs {
    background: #f8fafc;
    border-radius: 12px;
    padding: 15px;
    border: 1px solid #e2e8f0;
    margin-bottom: 20px;
  }

  .doc-old-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 12px;
    background: #fff;
    border-radius: 8px;
    margin-bottom: 8px;
    border: 1px solid #eee;
  }

  .doc-old-item span {
    flex: 1;
  }

  .doc-old-item form button {
    font-size: 12px;
    padding: 2px 6px;
  }

  .lista-documentos li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 6px 10px;
    background: #f5f5f5;
    border-radius: 6px;
    margin-bottom: 5px;
  }

  .lista-documentos button {
    background: #dc2626;
    border: none;
    color: white;
    padding: 3px 8px;
    border-radius: 4px;
    cursor: pointer;
  }

  .btn-upload {
    background: #163C25;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 6px;
    cursor: pointer;
    display: inline-block;
  }

  .badge-new {
    background: #163C25;
    color: white;
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 4px;
    text-transform: uppercase;
    margin-right: 4px;
  }

  .btn-soft-primary {
    background: #1D4ED8;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .btn-soft-secondary {
    background: #6B7280;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
  }
</style>
@endpush

@section('content')

@if(session('success'))
<div style="background: #d1fae5; padding: 10px 15px; border-radius: 6px; color: #065f46; margin-bottom: 15px;">
  {{ session('success') }}
</div>
@endif

<div class="escola-page">
  <div class="escola-card">

    <h1 class="escola-title">EDITAR CADASTRO: {{ $escola->nome }}</h1>

    <form action="{{ route('escolas.update', $escola->id) }}" method="POST" enctype="multipart/form-data">

      @csrf
      @method('PUT')

      <div class="row g-3">

        <div class="col-12 col-lg-7">
          <label class="form-label">Nome da escola</label>
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

      <!-- DOCUMENTOS JÁ ANEXADOS -->
      <div class="mt-4">

        <label class="form-label d-block">Documentos já anexados</label>

        <div class="current-docs">

          @forelse($escola->documentos as $doc)

          <div class="doc-old-item">

            <span>📄 {{ basename($doc->arquivo) }}</span>

            <div class="d-flex gap-2">

              <a href="{{ Storage::url($doc->arquivo) }}" target="_blank" class="btn btn-sm btn-light">
                Ver
              </a>

              {{-- Botão chama JS, sem form aninhado --}}
              <button type="button"
                class="btn btn-sm btn-danger"
                data-id="{{ $doc->id }}"
                onclick="confirmarExclusao(this.dataset.id)">
                Excluir
              </button>

            </div>

          </div>

          @empty

          <p class="text-muted m-0" style="font-size:13px;">
            Nenhum documento cadastrado.
          </p>

          @endforelse

        </div>

      </div>

      <!-- NOVOS DOCUMENTOS -->
      <div class="mt-4">

        <label class="btn btn-upload mb-0">

          + Adicionar novos documentos

          <input type="file"
            id="documentos"
            name="documentos[]"
            multiple
            class="d-none"
            accept=".pdf,image/*">

        </label>

        <ul id="listaDocumentos" class="lista-documentos mt-3"></ul>

      </div>

      <div class="mt-5 d-flex justify-content-end gap-2">

        <a href="{{ route('escolas.index') }}" class="btn btn-soft-secondary">
          Cancelar
        </a>

        <button type="submit" class="btn btn-soft-primary">
          Atualizar Cadastro
        </button>

      </div>

    </form>

  </div>
</div>

{{-- Form de exclusão de documento FORA do form principal --}}
<form id="form-excluir-doc" method="POST" style="display:none;">
  @csrf
  @method('DELETE')
</form>

<script>
  function confirmarExclusao(id) {
    if (!confirm('Deseja realmente excluir este documento?')) return;

    const form = document.getElementById('form-excluir-doc');
    form.action = '/documentos/' + id;
    form.submit();
  }

  document.addEventListener("DOMContentLoaded", function() {

    let arquivosSelecionados = [];
    const input = document.getElementById('documentos');

    input.addEventListener('change', function() {

      for (let i = 0; i < input.files.length; i++) {
        arquivosSelecionados.push(input.files[i]);
      }

      renderizarLista();

    });

    function renderizarLista() {

      const lista = document.getElementById('listaDocumentos');
      const dataTransfer = new DataTransfer();

      lista.innerHTML = "";

      arquivosSelecionados.forEach((arquivo, index) => {

        dataTransfer.items.add(arquivo);

        let item = document.createElement("li");

        item.className = "d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded border";

        item.innerHTML = `
<span><span class="badge-new">Novo</span> ${arquivo.name}</span>
<button type="button" class="btn btn-sm btn-danger py-0 px-2" onclick="removerArquivo(${index})">&times;</button>
`;

        lista.appendChild(item);

      });

      input.files = dataTransfer.files;

    }

    window.removerArquivo = function(index) {

      arquivosSelecionados.splice(index, 1);
      renderizarLista();

    };

  });
</script>

@endsection