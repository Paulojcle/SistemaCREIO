<?php

namespace App\Http\Controllers;

use App\Models\HorarioProfissional;
use App\Models\Profissional;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HorarioProfissionalController extends Controller
{
    public function index()
    {
        $profissionais = Profissional::where('ativo', true)->orderBy('nome')->get();
        return view('horarios.index', compact('profissionais'));
    }

    public function show(Profissional $profissional)
    {
        $profissional->load('horarios');
        return view('horarios.show', compact('profissional'));
    }

    public function store(Request $request, Profissional $profissional)
    {
        $request->validate([
            'dia_semana'      => 'required|integer|min:0|max:6',
            'hora_inicio'     => [
                'required',
                'date_format:H:i',
                Rule::unique('horarios_profissional')->where(fn ($q) => $q
                    ->where('profissional_id', $profissional->id)
                    ->where('dia_semana', $request->dia_semana)
                ),
            ],
            'duracao_minutos' => 'required|integer|min:1',
        ], [
            'hora_inicio.unique' => 'Já existe um horário cadastrado para este dia e horário.',
        ]);

        $profissional->horarios()->create([
            'dia_semana'      => $request->dia_semana,
            'hora_inicio'     => $request->hora_inicio,
            'duracao_minutos' => $request->duracao_minutos,
        ]);

        return redirect()->route('horarios.show', $profissional->id)
            ->with('success', 'Horário cadastrado com sucesso!');
    }

    public function destroy(Profissional $profissional, HorarioProfissional $horario)
    {
        $horario->delete();

        return redirect()->route('horarios.show', $profissional->id)
            ->with('success', 'Horário removido com sucesso!');
    }

    public function edit(Profissional $profissional, HorarioProfissional $horario)
    {
        return view('horarios.edit', compact('profissional', 'horario'));
    }

    public function update(Request $request, Profissional $profissional, HorarioProfissional $horario)
    {
        $request->validate([
            'dia_semana'      => 'required|integer|min:0|max:6',
            'hora_inicio'     => [
                'required',
                'date_format:H:i',
                Rule::unique('horarios_profissional')->where(fn ($q) => $q
                    ->where('profissional_id', $profissional->id)
                    ->where('dia_semana', $request->dia_semana)
                )->ignore($horario->id),
            ],
            'duracao_minutos' => 'required|integer|min:1',
        ], [
            'hora_inicio.unique' => 'Já existe um horário cadastrado para este dia e horário.',
        ]);

        $horario->update([
            'dia_semana'      => $request->dia_semana,
            'hora_inicio'     => $request->hora_inicio,
            'duracao_minutos' => $request->duracao_minutos,
        ]);

        return redirect()->route('horarios.show', $profissional->id)
            ->with('success', 'Horário atualizado com sucesso!');
    }

    public function toggle(Profissional $profissional, HorarioProfissional $horario)
    {
        $horario->update(['ativo' => !$horario->ativo]);

        return redirect()->route('horarios.show', $profissional->id)
            ->with('success', 'Status do horário atualizado!');
    }
}
