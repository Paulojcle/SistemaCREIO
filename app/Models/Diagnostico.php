<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aluno;

class Diagnostico extends Model

{

    protected $table = 'diagnostico';

    protected $fillable = [
        'nome',
    ];

    public function alunos(){
        return $this->belongsToMany(Aluno::class, 'aluno_diagnostico');
    }


}
