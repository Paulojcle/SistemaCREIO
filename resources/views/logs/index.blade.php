@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/escola/index.css') }}">
<style>
    .badge-acao {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .acao-criou      { background:#dcfce7; color:#166534; }
    .acao-editou     { background:#dbeafe; color:#1e40af; }
    .acao-desativou  { background:#ffedd5; color:#9a3412; }
    .acao-reativou   { background:#ccfbf1; color:#0f766e; }
    .acao-excluiu    { background:#fee2e2; color:#991b1b; }
    .acao-login      { background:#f3e8ff; color:#6b21a8; }
    .acao-logout     { background:#f1f5f9; color:#475569; }
    .acao-default    { background:#f1f5f9; color:#475569; }
</style>
@endpush

@section('content')

<div class="escola-page">
    <div class="escola-card">

        <div class="header-flex">
            <h1 class="escola-title">Logs de Atividade</h1>
        </div>

        <form method="GET" action="{{ route('logs.index') }}" class="mb-4">
            <div style="display:flex; flex-wrap:wrap; gap:12px; align-items:flex-end;">

                <div style="min-width:180px;">
                    <label style="font-size:0.8rem; color:#64748b;">Usuário</label>
                    <select name="user_id" class="form-select form-select-sm">
                        <option value="">Todos</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ request('user_id') == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->firstName }} {{ $usuario->lastName }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="min-width:160px;">
                    <label style="font-size:0.8rem; color:#64748b;">Módulo</label>
                    <select name="modulo" class="form-select form-select-sm">
                        <option value="">Todos</option>
                        @foreach($modulos as $modulo)
                            <option value="{{ $modulo }}" {{ request('modulo') === $modulo ? 'selected' : '' }}>
                                {{ $modulo }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="min-width:140px;">
                    <label style="font-size:0.8rem; color:#64748b;">Data início</label>
                    <input type="date" name="data_inicio" value="{{ request('data_inicio') }}"
                        class="form-control form-control-sm">
                </div>

                <div style="min-width:140px;">
                    <label style="font-size:0.8rem; color:#64748b;">Data fim</label>
                    <input type="date" name="data_fim" value="{{ request('data_fim') }}"
                        class="form-control form-control-sm">
                </div>

                <div style="display:flex; gap:8px;">
                    <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
                    <a href="{{ route('logs.index') }}" class="btn btn-outline-secondary btn-sm">Limpar</a>
                </div>

            </div>
        </form>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Data/Hora</th>
                        <th>Usuário</th>
                        <th>Ação</th>
                        <th>Módulo</th>
                        <th>Descrição</th>
                        <th>IP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td style="white-space:nowrap; color:#64748b; font-size:0.85rem;">
                            {{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i') }}
                        </td>
                        <td style="font-weight:600;">
                            {{ $log->user ? $log->user->firstName . ' ' . $log->user->lastName : '—' }}
                        </td>
                        <td>
                            @php $classe = 'acao-' . $log->acao; @endphp
                            <span class="badge-acao {{ in_array($log->acao, ['criou','editou','desativou','reativou','excluiu','login','logout']) ? $classe : 'acao-default' }}">
                                {{ $log->acao }}
                            </span>
                        </td>
                        <td>{{ $log->modulo }}</td>
                        <td>{{ $log->descricao }}</td>
                        <td style="color:#94a3b8; font-size:0.82rem;">{{ $log->ip ?? '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:40px; color:#94a3b8;">
                            <p style="font-size:18px; margin:0;">Nenhum registro encontrado.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $logs->links() }}
        </div>

    </div>
</div>

@endsection
