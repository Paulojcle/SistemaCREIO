<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ListaEspera;
use App\Models\HorarioProfissional;

class Profissional extends Model
{

  protected $table = 'profissionais';

  protected $fillable = [
    'nome',
    'data_nascimento',
    'rg',
    'cpf',
    'celular',
    'numero_registro',
    'profissao',
    'especializacao',
    'ativo',
    'user_id',
  ];

  protected $casts = [
    'ativo' => 'boolean',
    'data_nascimento' => 'date',
  ];
  
  public function formacoes()
  {
    return $this->hasMany(FormacoesProfissionais::class);
  }

  public function documentos()
  {
    return $this->hasMany(DocumentosProfissionais::class);
  }

  public function listasEspera(){
    return $this->belongsToMany(ListaEspera::class, 'lista_espera_profissional');
  }

  public function horarios(){
    return $this->hasMany(HorarioProfissional::class);
  }

  public function usuario(){
    return $this->belongsTo(User::class, 'user_id');
  }
}
