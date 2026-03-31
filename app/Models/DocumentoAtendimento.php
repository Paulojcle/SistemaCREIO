<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoAtendimento extends Model
{
    protected $table = 'documentos_atendimento';

    protected $fillable = [
        'registro_atendimento_id',
        'nome_original',
        'arquivo',
        'tipo_mime',
    ];

    public function registroAtendimento()
    {
        return $this->belongsTo(RegistroAtendimento::class);
    }
}
