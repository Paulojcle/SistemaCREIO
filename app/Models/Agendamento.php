<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aluno;
use App\Models\HorarioProfissional;
use App\Models\ListaEspera;

class Agendamento extends Model
{
    protected $table = 'agendamentos';

    protected $fillable = [
        'aluno_id',
        'lista_espera_id',
        'horarios_profissional_id',
        'data',
        'status',
        'observacoes',
    ];

    protected $casts = [
        'data' => 'date',
    ];

    public function aluno(){
        return $this->belongsTo(Aluno::class);
    }

    public function listaEspera(){
        return $this->belongsTo(ListaEspera::class);
    }

    public function horarioProfissional(){
        return $this->belongsTo(HorarioProfissional::class, 'horarios_profissional_id');
    }
}
