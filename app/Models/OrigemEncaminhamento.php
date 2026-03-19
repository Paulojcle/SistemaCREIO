<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aluno;

class OrigemEncaminhamento extends Model
{
    protected $table = 'origens_encaminhamento';

    protected $fillable = [
        'nome',
    ];

    public function alunos(){
        return $this->hasMany(Aluno::class);
    }
}
