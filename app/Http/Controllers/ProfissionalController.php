<?php

namespace App\Http\Controllers;

use App\Models\Profissional;
use Illuminate\Http\Request;
use App\Traits\RegistraLog;

class ProfissionalController extends Controller
{
    use RegistraLog;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profissionais = Profissional::orderBy('nome')->get();
        return view('profissional.index', ['profissionais' => $profissionais]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profissional.createProfissional');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([        
            'nome'            => 'required|string|      max:255',
            'data_nascimento' => 'nullable|dat      e',
            'rg'              => 'nullable|string|      max:20',
            'cpf'             => 'nullable|string|max:14',
            'celular'         => 'nullable|string|max:20',
            'numero_registro' => 'nullable|string|max:30',
            'profissao'       => 'nullable|string|max:255',
            'especializacao'  => 'nullable|string|max:255',
            'documentos'      => 'nullable|ar       ray',
            'documentos.*'    => 'file|mimes:pdf,       jpg,jpeg,png|max:10240',
        ]);


        $profissional = Profissional::create([
            'nome'             => $request->nome,
            'data_nascimento'  => $request->data_nascimento,
            'rg'               => $request->rg,
            'cpf'              => $request->cpf,
            'celular'          => $request->celular,
            'numero_registro'  => $request->numero_registro,
            'profissao'        => $request->profissao,
            'especializacao'   => $request->especializacao,
        ]);
        $this->registrarLog('criou', 'Profissional', "Cadastrou o profissional {$profissional->nome}");

        // Salva as formações
        if ($request->filled('formacoes')) {
            foreach ($request->formacoes as $formacao) {
                if (trim($formacao) !== '') {
                    $profissional->formacoes()->create(['descricao' => $formacao]);
                }
            }
        }

        // Salva os documentos
        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $arquivo) {
                $nomeOriginal = $arquivo->getClientOriginalName();
                $nomeUnico    = pathinfo($nomeOriginal, PATHINFO_FILENAME) . '_' . time() . '.' . $arquivo->getClientOriginalExtension();
                $path         = $arquivo->storeAs('profissionais/documentos', $nomeUnico, 'public');

                $profissional->documentos()->create([
                    'nome_original' => $nomeOriginal,
                    'arquivo'       => $path,
                    'tipo_mime'     => $arquivo->getMimeType(),
                ]);
            }
        }

        return redirect()->route('profissionais.index')->with('success', 'Profissional cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profissional $profissional)
    {
        // Carrega formações e documentos de uma vez só (eager loading)
        $profissional->load(['formacoes', 'documentos']);

        return view('profissional.showProfissional', compact('profissional'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profissional $profissional)
    {
        $profissional->load(['formacoes', 'documentos']);

        return view('profissional.editProfissional', compact('profissional'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profissional $profissional)
    {

        $request->validate([
            'nome'            => 'required|string|max:255',
            'data_nascimento' => 'nullable|date',
            'rg'              => 'nullable|string|max:20',
            'cpf'             => 'nullable|string|max:14',
            'celular'         => 'nullable|string|max:20',
            'numero_registro' => 'nullable|string|max:30',
            'profissao'       => 'nullable|string|max:255',
            'especializacao'  => 'nullable|string|max:255',
            'documentos'      => 'nullable|array',
            'documentos.*'    => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);
        
        $profissional->update([
            'nome'             => $request->nome,
            'data_nascimento'  => $request->data_nascimento,
            'rg'               => $request->rg,
            'cpf'              => $request->cpf,
            'celular'          => $request->celular,
            'numero_registro'  => $request->numero_registro,
            'profissao'        => $request->profissao,
            'especializacao'   => $request->especializacao,
        ]);

        $this->registrarLog('editou', 'Profissional', "Editou o profissional {$profissional->nome}");

        // Atualiza formações: remove as antigas e recria
        if ($request->filled('formacoes')) {
            $profissional->formacoes()->delete();

            foreach ($request->formacoes as $formacao) {
                if (trim($formacao) !== '') {
                    $profissional->formacoes()->create(['descricao' => $formacao]);
                }
            }
        }

        // Adiciona novos documentos (sem remover os existentes)
        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $arquivo) {
                $nomeOriginal = $arquivo->getClientOriginalName();
                $nomeUnico    = pathinfo($nomeOriginal, PATHINFO_FILENAME) . '_' . time() . '.' . $arquivo->getClientOriginalExtension();
                $path         = $arquivo->storeAs('profissionais/documentos', $nomeUnico, 'public');

                $profissional->documentos()->create([
                    'nome_original' => $nomeOriginal,
                    'arquivo'       => $path,
                    'tipo_mime'     => $arquivo->getMimeType(),
                ]);
            }
        }

        return redirect()->route('profissionais.show', $profissional->id)
            ->with('success', 'Profissional atualizado com sucesso!');
    }

    /**
     * Alterna o status ativo/inativo do profissional.
     */
    public function toggle(Profissional $profissional)
    {
        $profissional->update([
            'ativo' => !$profissional->ativo,
        ]);

        if ($profissional->ativo){
            $this->registrarLog('reativou', 'Profissional', "Reativou o profissional {$profissional->nome}");
        }else{
            $this->registrarLog('desativou', 'Profissional', "Desativou o profissional {$profissional->nome}");
        }

        $status = $profissional->ativo ? 'reativado' : 'desligado';

        return redirect()->route('profissionais.index')
            ->with('success', "Profissional {$status} com sucesso.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profissional $profissional) {}
}
