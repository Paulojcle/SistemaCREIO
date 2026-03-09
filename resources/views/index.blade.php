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

        <a href="#" class="metric-card link-card">
            <div class="metric-icon">👨‍🎓</div>
            <div>
                <h2>128</h2>
                <span>Alunos Matriculados</span>
            </div>
        </a>

        <a href="#" class="metric-card link-card">
            <div class="metric-icon">🏫</div>
            <div>
                <h2>12</h2>
                <span>Escolas Atendidas</span>
            </div>
        </a>

        <a href="#" class="metric-card link-card">
            <div class="metric-icon">👩‍⚕️</div>
            <div>
                <h2>8</h2>
                <span>Profissionais</span>
            </div>
        </a>

        <a href="#" class="metric-card highlight link-card">
            <div class="metric-icon">📅</div>
            <div>
                <h2>24</h2>
                <span>Atendimentos Hoje</span>
            </div>
        </a>

    </div>

    <!-- ===== SEÇÃO DEFICIÊNCIAS ===== -->
    <div class="dashboard-section">
        <h3>Alunos por Tipo de Deficiência</h3>

        <div class="mini-cards">

            <a href="#" class="mini-card link-mini">
                <strong>32</strong>
                <span>Deficiência Intelectual</span>
            </a>

            <a href="#" class="mini-card link-mini">
                <strong>18</strong>
                <span>Deficiência Física</span>
            </a>

            <a href="#" class="mini-card link-mini">
                <strong>9</strong>
                <span>Deficiência Auditiva</span>
            </a>

            <a href="#" class="mini-card link-mini">
                <strong>6</strong>
                <span>Deficiência Visual</span>
            </a>

        </div>
    </div>

    <!-- ===== SEÇÃO TRANSTORNOS ===== -->
    <div class="dashboard-section">
        <h3>Alunos por Tipo de Transtorno</h3>

        <div class="mini-cards">

            <a href="#" class="mini-card link-mini">
                <strong>41</strong>
                <span>TEA</span>
            </a>

            <a href="#" class="mini-card link-mini">
                <strong>22</strong>
                <span>TDAH</span>
            </a>

            <a href="#" class="mini-card link-mini">
                <strong>7</strong>
                <span>TOD</span>
            </a>

            <a href="#" class="mini-card link-mini">
                <strong>5</strong>
                <span>Dislexia</span>
            </a>

        </div>
    </div>

</div>
@endsection