<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoEscola extends Model
{
    protected $fillable = [
      'escola_id',
      'arquivo',  
    ];

    public function escola(){
        return $this->belongsTo(Escola::class);
    }
}
