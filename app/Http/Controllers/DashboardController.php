<?php

namespace App\Http\Controllers;
use App\Models\Aluno;
use App\Models\Escola;
use App\Models\Profissional;
use App\Models\Agendamento;
use App\Models\Deficiencia;
use App\Models\Diagnostico;

class DashboardController extends Controller
{
    public Function index(){
        $totalAlunos = Aluno::where('ativo', true)->count();
        $totalEscolas = Escola::count();
        $totalProfissionais = Profissional::where('ativo', true)->count();
        $diaSemana = today()->dayOfWeek;
        $atendimentosHoje = Agendamento::where('status', 'agendado')
            ->whereHas('horarioProfissional', fn($q) => $q->where('dia_semana', $diaSemana)->where('ativo', true))
            ->count();

        $deficiencias = Deficiencia::withCount(['alunos' => fn($q) => $q->where('ativo', true)])->orderByDesc('alunos_count')->get();

        $diagnosticos = Diagnostico::withCount(['alunos' => fn($q) => $q->where('ativo', true)]) ->orderByDesc('alunos_count')-> get();

        return view('index', compact('totalAlunos', 'totalEscolas', 'totalProfissionais', 'atendimentosHoje', 'deficiencias', 'diagnosticos'));
    }
}
