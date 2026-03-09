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

  <div class="row g-3">

    <div class="col-12 col-lg-7">
      <label class="form-label">Nome da escola</label>
      <input type="text" name="nome" placeholder="Nome da escola" class="form-control soft-input" required>
    </div>

    <div class="col-12 col-lg-5">
      <label class="form-label">CNPJ</label>
      <input type="text" name="cnpj" placeholder="CNPJ" class="form-control soft-input" inputmode="numeric">
    </div>

    <div class="col-12 col-lg-7">
      <label class="form-label">Endereço</label>
      <input type="text" name="endereco" placeholder="Endereço" class="form-control soft-input">
    </div>

    <div class="col-12 col-md-6 col-lg-2">
      <label class="form-label">Número</label>
      <input type="text" name="numero" placeholder="Número" class="form-control soft-input">
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <label class="form-label">Bairro</label>
      <input type="text" name="bairro" placeholder="Bairro" class="form-control soft-input">
    </div>

    <div class="col-12 col-md-6 col-lg-3">
      <label class="form-label">Cidade</label>
      <input type="text" name="cidade" placeholder="Cidade" class="form-control soft-input">
    </div>

    <div class="col-12 col-md-6 col-lg-2">
      <label class="form-label">CEP</label>
      <input type="text" name="cep" placeholder="CEP" class="form-control soft-input" inputmode="numeric">
    </div>

  </div>

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
      PDF ou imagem (opcional).
    </small>

    <ul id="listaDocumentos" class="lista-documentos mt-2"></ul>
  </div>

  <div class="mt-4 d-flex justify-content-end gap-2">
    <a href="{{ route('escolas.index') }}" class="btn btn-soft-secondary">Cancelar</a>
    <button type="submit" class="btn btn-soft-primary">Salvar</button>
  </div>

</form>

  </div>
</div>

<script>
let arquivosSelecionados = [];

document.getElementById('documentos').addEventListener('change', function() {
    const input = this;
    const lista = document.getElementById('listaDocumentos');
    
    for (let i = 0; i < input.files.length; i++) {
        arquivosSelecionados.push(input.files[i]);
    }

    renderizarLista();
});

function renderizarLista() {
    const lista = document.getElementById('listaDocumentos');
    const input = document.getElementById('documentos');
    const dataTransfer = new DataTransfer();

    lista.innerHTML = "";

    arquivosSelecionados.forEach((arquivo, index) => {
        dataTransfer.items.add(arquivo);

        let item = document.createElement("li");
        item.className = "d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded";
        item.innerHTML = `
            <span>📄 ${arquivo.name}</span>
            <button type="button" class="btn btn-sm btn-danger py-0 px-2" onclick="removerArquivo(${index})">
                &times;
            </button>
        `;
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
