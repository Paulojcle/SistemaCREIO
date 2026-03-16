<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\DocumentosEscolaController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\DocumentosProfissionalController;

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

//Rotas view aluno
Route::view('/alunoCriar', 'aluno.createAluno')->name('aluno.criar');
Route::view('/alunoDeletar', 'aluno.deleteAluno')->Name('aluno.deletar');
Route::view('/alunoEditar', 'aluno.editALuno')->name('aluno.editar');
Route::view('/alunoVisualizar', 'aluno.showAluno')->name('aluno.visualizar');

//Rotas view profissional
Route::delete('/profissionais/documentos/{id}', [DocumentosProfissionalController::class,'destroy'])->name('profissionais.documentos.destroy');

Route::resource('profissionais', ProfissionalController::class)->parameters(['profissionais' => 'profissional'])->except(['destroy']);

Route::patch('profissionais/{profissional}/toggle', [ProfissionalController::class, 'toggle'])->name('profissionais.toggle');


//Rotas de atendimento
Route::view('/agendamento', 'atendimento.index')->name('agendamento');
Route::view('/atendimentoLancar', 'atendimento.postAtendimento')->name('atendimento.lancar');