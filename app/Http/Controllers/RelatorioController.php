<?php

namespace App\Http\Controllers;

use App\Models\Profissional;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\RegistroAtendimento;

class RelatorioController extends Controller
{


    public function atendimentos(Request $request){
        $alunos = Aluno::where('ativo', true)->orderBy('nome')->get();
        $profissionais = Profissional::where('ativo', true)->orderBy('nome')->get();

        $query = RegistroAtendimento::with('aluno', 'profissional')->orderBy('data_atendimento', 'desc');

        if ($request->filled('data_inicio')){
            $query->where('data_atendimento', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')){
            $query->where('data_atendimento', '<=', $request->data_fim);
        }

        if ($request->filled('profissional_id')){
            $query->where('profissional_id', $request->profissional_id);
        }

        if($request->filled('aluno_id')){
            $query->where('aluno_id', $request->aluno_id);
        }

        $registros = $request->hasAny(['data_inicio', 'data_fim', 'profissional_id', 'aluno_id']) ? $query->get() : collect();

        return view ('relatorios.atendimentos', compact('alunos', 'profissionais', 'registros'));
    }
}
