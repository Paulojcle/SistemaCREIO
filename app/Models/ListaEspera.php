<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profissional;
use App\Models\Aluno;
use App\Models\Agendamento;


class ListaEspera extends Model
{
    protected $table = 'listas_espera'; 

    protected $fillable = [
        'nome',
        'ativo',
    ];

    public function profissionais(){
        return $this->belongsToMany(Profissional::class, 'lista_espera_profissional');
    }

    public function alunos(){
        return $this->belongsToMany(Aluno::class, 'lista_espera_aluno')->withPivot('data_entrada', 'status');
    }

    public function agendamentos(){
        return $this->hasMany(Agendamento::class);
    }
}
