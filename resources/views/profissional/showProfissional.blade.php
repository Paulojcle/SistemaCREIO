@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/profissional/showProfissional.css') }}">
@endpush

@section('content')
<div class="prof-page">
    <div class="prof-card">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ $profissional->foto ? Storage::url($profissional->foto) : 'https://ui-avatars.com/api/?name='.urlencode($profissional->nome).'&background=c8d8e8&color=555&size=100' }}"
                    alt="Foto de {{ $profissional->nome }}"
                    style="width:80px;height:80px;object-fit:cover;border-radius:50%;border:2px solid #ddd;flex-shrink:0;">
                <h1 class="prof-title mb-0">INFORMAÇÕES DO PROFISSIONAL</h1>
            </div>
            <span class="badge-status {{ $profissional->ativo ? 'badge-ativo' : 'badge-inativo' }}">
                {{ $profissional->ativo ? 'Ativo' : 'Inativo' }}
            </span>
        </div>

        <div class="row g-4">

            <div class="col-12 col-lg-8">
                <div class="info-group">
                    <p class="info-label">Nome Completo</p>
                    <p class="info-value">{{ $profissional->nome }}</p>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="info-group">
                    <p class="info-label">Data de Nascimento</p>
                    <p class="info-value">{{ \Carbon\Carbon::parse($profissional->data_nascimento)->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="info-group">
                    <p class="info-label">RG</p>
                    <p class="info-value">{{ $profissional->rg ?? 'Não informado' }}</p>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="info-group">
                    <p class="info-label">CPF</p>
                    <p class="info-value">{{ $profissional->cpf ?? 'Não informado' }}</p>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="info-group">
                    <p class="info-label">Celular</p>
                    <p class="info-value">{{ $profissional->celular ?? 'Não informado' }}</p>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="info-group">
                    <p class="info-label">Número de Registro</p>
                    <p class="info-value">{{ $profissional->numero_registro ?? 'Não informado' }}</p>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="info-group">
                    <p class="info-label">Profissão</p>
                    <p class="info-value">{{ $profissional->profissao ?? 'Não informado' }}</p>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="info-group">
                    <p class="info-label">Especialização</p>
                    <p class="info-value">{{ $profissional->especializacao ?? 'Não informado' }}</p>
                </div>
            </div>

        </div>

        {{-- Formações --}}
        <div class="section-docs mt-5">
            <p class="info-label mb-3">Formações</p>

            <div class="row">
                @forelse($profissional->formacoes as $formacao)
                    <div class="col-12 col-md-6">
                        <div class="doc-item">
                            <div class="doc-info">
                                <span style="font-size: 20px;">🎓</span>
                                <span>{{ $formacao->descricao }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-muted" style="font-style: italic;">Nenhuma formação cadastrada.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Documentos --}}
        <div class="section-docs mt-4">
            <p class="info-label mb-3">Documentos Anexados</p>

            <div class="row">
                @forelse($profissional->documentos as $doc)
                    <div class="col-12 col-md-6">
                        <div class="doc-item">
                            <div class="doc-info">
                                <span style="font-size: 20px;">📄</span>
                                <span class="text-truncate" style="max-width: 200px;">
                                    {{ $doc->nome_original }}
                                </span>
                            </div>
                            <a href="{{ Storage::url($doc->arquivo) }}" target="_blank" class="btn-soft-primary"
                                style="text-decoration: none; font-size: 12px; padding: 6px 15px;">
                                Visualizar
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-muted" style="font-style: italic;">Nenhum documento foi enviado.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <hr class="my-4" style="opacity: 0.1;">

        <div class="d-flex justify-content-end gap-3">
            <a href="{{ route('profissionais.index') }}" class="btn-soft-secondary text-decoration-none">
                Voltar para Lista
            </a>

            <form action="{{ route('profissionais.toggle', $profissional->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                @if($profissional->ativo)
                    <button type="submit" class="btn-soft-warning"
                        onclick="return confirm('Deseja desligar {{ addslashes($profissional->nome) }}?')">
                        Desligar Profissional
                    </button>
                @else
                    <button type="submit" class="btn-soft-success"
                        onclick="return confirm('Deseja reativar {{ addslashes($profissional->nome) }}?')">
                        Reativar Profissional
                    </button>
                @endif
            </form>

            <a href="{{ route('profissionais.edit', $profissional->id) }}" class="btn-soft-primary text-decoration-none">
                Editar Cadastro
            </a>
        </div>

    </div>
</div>
@endsection