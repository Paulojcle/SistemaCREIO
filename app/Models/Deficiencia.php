<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aluno;

class Deficiencia extends Model
{
    protected $table = 'deficiencias';

    protected $fillable = [
        'nome',
    ];

    public function alunos(){
        return $this->belongsToMany(Aluno::class, 'aluno_deficiencia');
    }
}
