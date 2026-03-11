<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoEscola extends Model
{
    protected $fillable = [
      'escola_id', 
      'nome_original',
      'arquivo',
      'tipo_mime',
    ];

    public function escola(){
        return $this->belongsTo(Escola::class);
    }
}
