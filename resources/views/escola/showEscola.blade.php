@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/showEscola.css') }}">
{{-- O CSS que criamos antes pode ser colocado aqui ou no seu arquivo .css --}}
@endpush

@section('content')
<div class="escola-page">
    <div class="escola-card">
        <h1 class="escola-title">DETALHES DA UNIDADE</h1>

        <div class="row g-4">
            <div class="col-12 col-lg-8">
                <div class="info-group">
                    <p class="info-label">Nome da Instituição</p>
                    <p class="info-value">{{ $escola->nome }}</p>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="info-group">
                    <p class="info-label">CNPJ</p>
                    <p class="info-value">{{ $escola->cnpj ?? 'Não informado' }}</p>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="info-group">
                    <p class="info-label">Endereço</p>
                    <p class="info-value">{{ $escola->endereco }}, {{ $escola->numero }}</p>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="info-group">
                    <p class="info-label">Bairro</p>
                    <p class="info-value">{{ $escola->bairro }}</p>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="info-group">
                    <p class="info-label">CEP</p>
                    <p class="info-value">{{ $escola->cep }}</p>
                </div>
            </div>

            <div class="col-12">
                <div class="info-group">
                    <p class="info-label">Cidade</p>
                    <p class="info-value">{{ $escola->cidade }}</p>
                </div>
            </div>
        </div>

        <div class="section-docs mt-5">
            <p class="info-label mb-3">Documentação Anexada</p>
            
            <div class="row">
                @forelse($escola->documentos as $doc)
                    <div class="col-12 col-md-6">
                        <div class="doc-item">
                            <div class="doc-info">
                                <span style="font-size: 20px;">📄</span>
                                <span class="text-truncate" style="max-width: 200px;">
                                    {{ basename($doc->arquivo) }}
                                </span>
                            </div>
                            <a href="{{ Storage::url($doc->arquivo) }}" target="_blank" class="btn-soft-primary" style="text-decoration: none; font-size: 12px; padding: 6px 15px;">
                                Visualizar
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-muted" style="font-style: italic;">Nenhum documento foi enviado para esta escola.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <hr class="my-4" style="opacity: 0.1;">
        
        <div class="d-flex justify-content-end gap-3">
            <a href="{{ route('escolas.index') }}" class="btn-soft-secondary text-decoration-none">
                Voltar para Lista
            </a>
            <a href="{{ route('escolas.edit', $escola->id) }}" class="btn-soft-primary text-decoration-none">
                Editar Cadastro
            </a>
        </div>
    </div>
</div>
@endsection