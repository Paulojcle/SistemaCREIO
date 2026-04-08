<?php

use App\Http\Controllers\DeficienciaController;
use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\DocumentosEscolaController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\DocumentosProfissionalController;
use App\Http\Controllers\ListaEsperaController;
use App\Http\Controllers\OrigemEncaminhamentoController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\DocumentoAlunoController;
use App\Http\Controllers\HorarioProfissionalController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\ContaController;
use App\Http\Controllers\RegistroAtendimentoController;

Route::middleware('auth')->group(function(){

    //Rotas para administração de conta
    Route::get('/conta', [ContaController::class, 'index'])->name('conta.index');
    Route::put('/conta/perfil', [ContaController::class, 'updatePerfil'])->name('conta.perfil');
    Route::put('/conta/senha', [ContaController::class, 'updateSenha'])->name('conta.senha');

    Route::get('/index', [DashboardController::class, 'index'])->name('index');

    //Rotas view escola
    Route::resource('escolas', EscolaController::class);

    //Rota Exclusão de Documento de Escola
    Route::delete('/documentos/{id}', [DocumentosEscolaController::class, 'destroy'])->name('documentos.destroy');

    //Rotas aluno
    Route::resource('alunos', AlunoController::class)->except(['destroy']);

    Route::patch('alunos/{aluno}/toggle', [AlunoController::class, 'toggle'])->name('alunos.toggle');

    Route::delete('/alunos/documentos/{id}', [DocumentoAlunoController::class, 'destroy'])->name('alunos.documentos.destroy');

    Route::get('/alunos/{aluno}/ficha', [AlunoController::class, 'ficha'])->name('alunos.ficha');

    //Rotas view profissional
    Route::delete('/profissionais/documentos/{id}', [DocumentosProfissionalController::class,'destroy'])->name('profissionais.documentos.destroy');

    Route::resource('profissionais', ProfissionalController::class)->parameters(['profissionais' => 'profissional'])->except(['destroy']);

    Route::patch('profissionais/{profissional}/toggle', [ProfissionalController::class, 'toggle'])->name('profissionais.toggle');

    //Horários do profissional
    Route::get('horarios', [HorarioProfissionalController::class, 'index'])->name('horarios.index');

    Route::get('horarios/{profissional}', [HorarioProfissionalController::class, 'show'])->name('horarios.show');

    Route::post('horarios/{profissional}', [HorarioProfissionalController::class, 'store'])->name('horarios.store');

    Route::get('horarios/{profissional}/{horario}/edit', [HorarioProfissionalController::class, 'edit'])->name('horarios.edit');

    Route::put('horarios/{profissional}/{horario}', [HorarioProfissionalController::class, 'update'])->name('horarios.update');

    Route::delete('horarios/{profissional}/{horario}', [HorarioProfissionalController::class, 'destroy'])->name('horarios.destroy');

    Route::patch('horarios/{profissional}/{horario}/toggle', [HorarioProfissionalController::class, 'toggle'])->name('horarios.toggle');


    //Rotas de atendimento
    Route::get('/agendamento',[AgendamentoController::class, 'index'])->name('agendamentos');
    Route::get('/agendamento/criar', [AgendamentoController::class, 'create'])->name('agendamentos.create');

    Route::get('/atendimentoLancar', [RegistroAtendimentoController::class, 'index'])->name('atendimento.lancar');

    Route::get('/atendimento/{alunoId}/novo',[RegistroAtendimentoController::class, 'create'])->name('atendimento.form');

    Route::post('/atendimento',[RegistroAtendimentoController::class, 'store'])->name('atendimento.store');

    Route::get('/atendimento/{id}/editar',[RegistroAtendimentoController::class, 'edit'])->name('atendimento.edit');

    Route::put('/atendimento/{id}',[RegistroAtendimentoController::class, 'update'])->name('atendimento.update');

    Route::delete('/atendimento/documento/{id}',[RegistroAtendimentoController::class, 'destroyDocumento'])->name('atendimento.documento.destroy');

    Route::post('/agendamento',[AgendamentoController::class, 'store'])->name('agendamentos.store');

    Route::get('/agendamento/horarios',[AgendamentoController::class, 'horarios'])->name('agendamentos.horarios');

    Route::get('/agendamento/profissionais/{alunoId}',[AgendamentoController::class, 'profissionaisPorAluno'])->name('agendamentos.profissionais');

    Route::get('/agendamento/{id}/editar',[AgendamentoController::class, 'edit'])->name('agendamentos.edit');

    Route::put('/agendamento/{id}',[AgendamentoController::class, 'update'])->name('agendamentos.update');

    Route::get('/agendamento/relatorio/{alunoId}', [AgendamentoController::class, 'relatorioAluno'])->name('agendamentos.relatorio');
    Route::get('/agendamento/relatorio-profissional/{profissionalId}', [AgendamentoController::class, 'relatorioProfissional'])->name('agendamentos.relatorio.profissional');

    Route::delete('/agendamento/{id}',[AgendamentoController::class, 'destroy'])->name('agendamentos.destroy');


    // Rotas para controle dos diagnósticos, deficiências e as origens de encaminhamento
    Route::resource('diagnosticos', DiagnosticoController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('deficiencias', DeficienciaController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('origensEncaminhamento', OrigemEncaminhamentoController::class)->only(['index', 'store', 'update', 'destroy']);


    //Lista de espera
    Route::get('listasEspera/filas', [ListaEsperaController::class, 'filas'])->name('listasEspera.filas');

    Route::resource('listasEspera', ListaEsperaController::class)->parameters(['listasEspera' => 'lista'])->only(['index', 'store', 'update']);

    Route::patch('listasEspera/{lista}/toggle', [ListaEsperaController::class, 'toggle'])->name('listasEspera.toggle');

});


//rotas de autenticação, login e logout
Route::view('/login', 'auth.login')->name('login.form');

Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');

 Route::get('/', fn () => redirect()->route('login.form'));

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    


