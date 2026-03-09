<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\DocumentosEscolaController;

/*Rotas para definir a página inicial como o índex do sistema e para deixar o diretório de partida sendo o login*/
Route::get('/', fn () => redirect()->route('login.form'));
Route::view('/index', 'index')->name('index');

//rotas de autenticação e login
Route::view('/login', 'auth.login')->name('login.form');
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');

//Rotas view escola
Route::view('/escolaCriar', 'escola.createEscola')->name('escola.criar');
Route::view('/escolarDeletar', 'escola.deleteEscola')->Name('escola.deletar');
Route::view('/escolaEditar', 'escola.editEscola')->name('escola.editar');

Route::resource('escolas', EscolaController::class);

//Rota Exclusão de Documento
Route::delete('/documentos/{id}', [DocumentosEscolaController::class, 'destroy'])
->name('documentos.destroy');

//Rotas view aluno
Route::view('/alunoCriar', 'aluno.createAluno')->name('aluno.criar');
Route::view('/alunoDeletar', 'aluno.deleteAluno')->Name('aluno.deletar');
Route::view('/alunoEditar', 'aluno.editALuno')->name('aluno.editar');
Route::view('/alunoVisualizar', 'aluno.showAluno')->name('aluno.visualizar');


//Rotas view profissional
Route::view('/profissionalCriar', 'profissional.createProfissional')->name('profissional.criar');
Route::view('/profissionalDeletar', 'profissional.deleteProfissional')->Name('profissional.deletar');
Route::view('/profissionalEditar', 'profissional.editProfissional')->name('profissional.editar');
Route::view('/profissionalVisualizar', 'profissional.showProfissional')->name('profissional.visualizar');

//Rotas de atendimento
Route::view('/agendamento', 'atendimento.index')->name('agendamento');
Route::view('/atendimentoLancar', 'atendimento.postAtendimento')->name('atendimento.lancar');


