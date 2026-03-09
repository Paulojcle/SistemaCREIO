@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/index.css') }}">
@endpush

@section ('content')

<div class="escola-page">
    <div class="escola-card">

        <div class="header-flex">
            <h1 class="escola-title">Lista de Escolas</h1>

            <a href="{{ route('escolas.create') }}" class="btn-nova">
                + Nova Escola
            </a>
        </div>

        @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome da Instituição</th>
                        <th>CNPJ</th>
                        <th>Cidade</th>
                        <th style="text-align: right;">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($escolas as $index => $escola)
                    <tr>
                        <td style="font-weight: 700;">#{{ $index + 1 }}</td>
                        <td style="color: #1e293b; font-weight: 600;">{{ $escola->nome }}</td>
                        <td>{{ $escola->cnpj }}</td>
                        <td>{{ $escola->cidade }}</td>

                        <td style="text-align: right;">
                            <a href="{{ route('escolas.show', $escola->id) }}" class="btn-action btn-ver">
                                Ver
                            </a>

                            <a href="{{ route('escolas.edit', $escola->id) }}" class="btn-action btn-editar">
                                Editar
                            </a>

                            <form action="{{ route('escolas.destroy', $escola->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-excluir"
                                    onclick="return confirm('Tem certeza que deseja excluir esta escola?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:40px; color: #94a3b8;">
                            <p style="font-size: 18px; margin: 0;"> Nenhuma escola cadastrada.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection