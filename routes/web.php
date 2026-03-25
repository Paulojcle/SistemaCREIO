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

/*Rotas para definir a página inicial como o índex do sistema e para deixar o diretório de partida sendo o login*/
Route::get('/', fn () => redirect()->route('login.form'));
Route::view('/index', 'index')->name('index');

//rotas de autenticação e login
Route::view('/login', 'auth.login')->name('login.form');
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');

//Rotas view escola
Route::resource('escolas', EscolaController::class);

//Rota Exclusão de Documento de Escola
Route::delete('/documentos/{id}', [DocumentosEscolaController::class, 'destroy'])
    ->name('documentos.destroy');

//Rotas aluno
Route::resource('alunos', AlunoController::class)->except(['destroy']);
Route::patch('alunos/{aluno}/toggle', [AlunoController::class, 'toggle'])->name('alunos.toggle');
Route::delete('/alunos/documentos/{id}', [DocumentoAlunoController::class, 'destroy'])->name('alunos.documentos.destroy');

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
Route::view('/agendamento', 'atendimento.index')->name('agendamento');
Route::view('/atendimentoLancar', 'atendimento.postAtendimento')->name('atendimento.lancar');

// Testes para novas funcionalidades
Route::resource('diagnosticos', DiagnosticoController::class)->only(['index', 'store', 'update', 'destroy']);

Route::resource('deficiencias', DeficienciaController::class)->only(['index', 'store', 'update', 'destroy']);

Route::resource('origensEncaminhamento', OrigemEncaminhamentoController::class)->only(['index', 'store', 'update', 'destroy']);


//Lista de espera
Route::get('listasEspera/filas', [ListaEsperaController::class, 'filas'])->name('listasEspera.filas');
Route::resource('listasEspera', ListaEsperaController::class)->parameters(['listasEspera' => 'lista'])->only(['index', 'store', 'update']);
Route::patch('listasEspera/{lista}/toggle', [ListaEsperaController::class, 'toggle'])->name('listasEspera.toggle');