<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Deficiencia;
use App\Models\Diagnostico;
use App\Models\ListaEspera;
use App\Models\Escola;
use App\Models\OrigemEncaminhamento;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $alunos = Aluno::with('escola', 'listasEspera')->get();
        
        return view('aluno.index', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $escolas = Escola::all();
        $deficiencias = Deficiencia::all();
        $diagnosticos = Diagnostico::all();
        $origens = OrigemEncaminhamento::all();
        $listaEspera = ListaEspera::where('ativo', true)->get();

        return view('aluno.createAluno', compact('escolas', 'deficiencias', 'diagnosticos', 'origens', 'listaEspera'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'            => 'required|string|max:100',
            'data_nascimento' => 'required|date',
            'sexo'            => 'required|in:M,F',
        ], [
            'nome.required'            => 'O nome do aluno é obrigatório.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'sexo.required'            => 'O sexo do aluno é obrigatório.',
        ]);

        $data = $request->except(['deficiencias', 'diagnosticos', 'listasEspera', 'documentos', '_token']);
        $data['possui_laudo'] = $request->boolean('possui_laudo');

        $aluno = Aluno::create($data);
        if($request->hasFile('foto')){
            $caminho = $request->file('foto')->store('fotos/alunos', 'public');
            $aluno->update(['foto' => $caminho]);
        }

        $aluno->deficiencias()->sync($request->deficiencias ?? []);
        $aluno->diagnosticos()->sync($request->diagnosticos ?? []);

        $listasSync = collect($request->listasEspera ?? [])->mapWithKeys(fn($id) => [
            $id => ['data_entrada' => now()->toDateString()],
        ])->toArray();
        $aluno->listasEspera()->sync($listasSync);

        if ($request->hasFile('documentos')){
            foreach($request->file('documentos') as $arquivo){
                $caminho = $arquivo->store('documentos/alunos', 'public');
                $aluno->documentosAluno()->create([
                    'nome_original' => $arquivo->getClientOriginalName(),
                    'arquivo' => $caminho,
                    'tipo_mime' => $arquivo->getMimeType(),
                ]);
            }
        }

        return redirect()->route('alunos.index')->with('success', "Aluno {$aluno->nome} cadastrado com sucesso");
    }

    /**
     * Display the specified resource.
     */
    public function show(Aluno $aluno)
    {
        $aluno->load('escola', 'origemEncaminhamento', 'deficiencias', 'diagnosticos', 'listasEspera', 'documentosAluno');
        $atendimentos = $aluno->registrosAtendimento()->with('documentos', 'profissional')->get();
        return view('aluno.showAluno', compact('aluno', 'atendimentos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aluno $aluno)
    {
        $escolas = Escola::all();
        $deficiencias = Deficiencia::all();
        $diagnosticos = Diagnostico::all();
        $origens = OrigemEncaminhamento::all();
        $listaEspera = ListaEspera::where('ativo', true)->get();

        $aluno->load('deficiencias', 'diagnosticos', 'listasEspera');

        return view('aluno.editAluno', compact('aluno', 'escolas', 'deficiencias', 'diagnosticos', 'origens', 'listaEspera'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aluno $aluno)
    {
        $data = $request->except(['deficiencias', 'diagnosticos', 'listasEspera', 'documentos', '_token', '_method']);
        $data['possui_laudo'] = $request->boolean('possui_laudo');


        if ($request->hasFile('foto')){
            $caminho = $request->file('foto')->store('fotos/alunos', 'public');
            $data['foto'] = $caminho;
        }

        $aluno->update($data);

        $aluno->deficiencias()->sync($request->deficiencias ?? []);
        $aluno->diagnosticos()->sync($request->diagnosticos ?? []);

        $aluno->load('listasEspera');
        $datasExistentes = $aluno->listasEspera->pluck('pivot.data_entrada', 'id');
        $listasSync = collect($request->listasEspera ?? [])->mapWithKeys(fn($id) => [
            $id => ['data_entrada' => $datasExistentes->get($id) ?? now()->toDateString()],
        ])->toArray();
        $aluno->listasEspera()->sync($listasSync);

        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $arquivo) {
                $caminho = $arquivo->store('documentos/alunos', 'public');
                $aluno->documentosAluno()->create([
                    'nome_original' => $arquivo->getClientOriginalName(),
                    'arquivo'       => $caminho,
                    'tipo_mime'     => $arquivo->getMimeType(),
                ]);
            }
        }

        return redirect()->route('alunos.show', $aluno->id)->with('success', "Aluno {$aluno->nome} atualizado com sucesso!");
    }

    /**
     * Ativa ou desativa o aluno.
     */
    public function toggle(Request $request, Aluno $aluno)
    {
        if ($aluno->ativo) {
            $request->validate([
                'justificativa' => 'required|string|max:1000',
                'documento'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            ], [
                'justificativa.required' => 'A justificativa de desligamento é obrigatória.',
            ]);

            $aluno->update([
                'ativo'                      => false,
                'justificativa_desligamento' => $request->justificativa,
            ]);

            if ($request->hasFile('documento')) {
                $arquivo = $request->file('documento');
                $caminho = $arquivo->store('documentos/alunos', 'public');
                $aluno->documentosAluno()->create([
                    'nome_original' => $arquivo->getClientOriginalName(),
                    'arquivo'       => $caminho,
                    'tipo_mime'     => $arquivo->getMimeType(),
                ]);
            }

            return redirect()->route('alunos.index')->with('success', "Aluno {$aluno->nome} desativado com sucesso!");
        }

        $aluno->update(['ativo' => true, 'justificativa_desligamento' => null]);
        return redirect()->route('alunos.index')->with('success', "Aluno {$aluno->nome} reativado com sucesso!");
    }
}
