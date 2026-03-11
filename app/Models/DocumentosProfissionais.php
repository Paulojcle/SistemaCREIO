<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentosProfissionais extends Model
{

    protected $table = 'profissional_documentos';
    
    protected $fillable = [
        'profissional_id',
        'nome_original',
        'caminho',
        'arquivo', 
        'descricao',
    ];

    public function profissional(){
        return $this->belongsTo(Profissional::class);
    }
}
