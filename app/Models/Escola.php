<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aluno;

class Escola extends Model
{
    protected $fillable = [
        'nome',
        'cnpj',
        'endereco',
        'numero',
        'bairro',
        'cidade',
        'cep',
    ];

    public function documentos()
    {
        return $this->hasMany(DocumentoEscola::class);
    }

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }
}