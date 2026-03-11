<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormacoesProfissionais extends Model
{

    protected $table = 'profissional_formacoes';
    
    protected $fillable = [
        'profissional_id',  
        'descricao',
    ];

    public function profissional(){
        return $this->belongsTo(Profissional::class);
    }
}