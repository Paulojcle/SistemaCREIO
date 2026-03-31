<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Agendamento;

class HorarioProfissional extends Model
{
    protected $table = 'horarios_profissional';

    protected $fillable = [
        'profissional_id',
        'dia_semana',
        'hora_inicio',
        'duracao_minutos',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function profissional()
    {
        return $this->belongsTo(Profissional::class);
    }

    public function getNomeDiaAttribute(): string
    {
        $dias = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
        return $dias[$this->dia_semana] ?? '-';
    }

    public function agendamentos(){
        return $this->hasMany(Agendamento::class, 'horarios_profissional_id');
    }
}
