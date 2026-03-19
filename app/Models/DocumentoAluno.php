<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aluno;

class DocumentoAluno extends Model
{
    protected $table = 'documentos_alunos';

    protected $fillable = [
        'aluno_id',
        'nome_original',
        'arquivo',
        'tipo_mime',
    ];

    public function aluno(){
        return $this->belongsTo(Aluno::class);
    }
}
