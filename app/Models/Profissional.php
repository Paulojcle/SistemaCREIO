<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
