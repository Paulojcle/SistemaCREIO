@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
@endpush

@section('content')


<div class="dashboard">

    <!-- ===== HEADER ===== -->
    <div class="dashboard-header">
        <h1>Dashboard Geral</h1>
        <p>Visão geral do CREIO</p>
    </div>

    <!-- ===== MÉTRICAS PRINCIPAIS ===== -->
    <div class="metrics">

        <a href="{{ route('alunos.index') }}" class="metric-card link-card">
            <div class="metric-icon">👨‍🎓</div>
            <div>
                <h2>{{ $totalAlunos }}</h2>
                <span>Alunos Matriculados</span>
            </div>
        </a>

        <a href="{{ route('escolas.index') }}" class="metric-card link-card">
            <div class="metric-icon">🏫</div>
            <div>
                <h2>{{ $totalEscolas }}</h2>
                <span>Escolas Atendidas</span>
            </div>
        </a>

        <a href="{{ route ('profissionais.index') }}" class="metric-card link-card">
            <div class="metric-icon">👩‍⚕️</div>
            <div>
                <h2>{{ $totalProfissionais }}</h2>
                <span>Profissionais</span>
            </div>
        </a>

        <a href="{{ route('agendamentos') }}" class="metric-card highlight link-card">
            <div class="metric-icon">📅</div>
            <div>
                <h2>{{ $atendimentosHoje }}</h2>
                <span>Atendimentos Hoje</span>
            </div>
        </a>

    </div>

    <!-- ===== SEÇÃO DEFICIÊNCIAS ===== -->
    <div class="dashboard-section">
        <h3>Alunos por Tipo de Deficiência</h3>

        <div class="mini-cards">


            @forelse($deficiencias as $def)

                <a href="{{ route('alunos.index', ['deficiencia_id' => $def->id]) }}" class="mini-card link-mini">
                    <strong>
                        {{ $def->alunos_count }}
                    </strong>

                    <span>
                        {{ $def->nome }}
                    </span>
                </a>

                @empty
                    <p>Nenhuma deficiência cadastrada</p>

            @endforelse

            

        </div>
    </div>

    <!-- ===== SEÇÃO DIAGNÓSTICOS ===== -->
    <div class="dashboard-section">
        <h3>Alunos por Tipo de Diagnósticos</h3>

        <div class="mini-cards">

            @forelse($diagnosticos as $dia)

                <a href="{{ route('alunos.index', ['diagnostico_id' => $dia->id]) }}" class="mini-card link-mini">
                        <strong>
                            {{ $dia->alunos_count }}
                        </strong>

                        <span>
                            {{ $dia->nome }}
                        </span>
                </a>

                @empty
                <p>nenhum diagnóstico cadastrado</p>

            @endforelse

            


        </div>
    </div>

</div>
@endsection