<?php

namespace App\Http\Controllers;
use App\Models\Aluno;
use App\Models\Escola;
use App\Models\Profissional;
use App\Models\Agendamento;
use App\Models\Deficiencia;
use App\Models\Diagnostico;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public Function index(){
        $totalAlunos = Aluno::where('ativo', true)->count();
        $totalEscolas = Escola::count();
        $totalProfissionais = Profissional::where('ativo', true)->count();
        $atendimentosHoje = Agendamento::where('status', 'agendado')->whereDate('data', today())->count();

        $deficiencias = Deficiencia::withCount(['alunos' => fn($q) => $q->where('ativo', true)])->orderByDesc('alunos_count')->get();

        $diagnosticos = Diagnostico::withCount(['alunos' => fn($q) => $q->where('ativo', true)]) ->orderByDesc('alunos_count')-> get();

        return view('index', compact('totalAlunos', 'totalEscolas', 'totalProfissionais', 'atendimentosHoje', 'deficiencias', 'diagnosticos'));
    }
}
