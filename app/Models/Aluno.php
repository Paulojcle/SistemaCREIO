<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Deficiencia;
use App\Models\Diagnostico;
use App\Models\ListaEspera;
use App\Models\DocumentoAluno;
use App\Models\Escola;
use App\Models\OrigemEncaminhamento;


class Aluno extends Model
{
    protected $table = 'alunos';

    protected $fillable = [
        'nome',
        'data_nascimento',
        'sexo',
        'celular',
        'foto',
        'ativo',

        'endereco',
        'numero',
        'bairro',
        'cep',
        'cidade',
        'tel_residencial',

        'escola_id',
        'serie',
        'turno',

        'filiacao1',
        'filiacao2',

        'alergico_medicamento',
        'alergico_medicamento_qual',
        'alergico_alimento',
        'alergico_alimento_qual',
        'usa_medicacao',
        'usa_medicacao_qual',
        'profissionais_crianca',

        'resp_nome',
        'resp_data_nascimento',
        'resp_rg',
        'resp_cpf',
        'resp_estado_civil',

        'grau_suporte',
        'possui_laudo',
        'origem_encaminhamento_id',
        'data_diagnostico',
    ];

    public function deficiencias(){
        return $this->belongsToMany(Deficiencia::class, 'aluno_deficiencia');
    }

    public function diagnosticos(){
        return $this->belongsToMany(Diagnostico::class, 
        'aluno_diagnostico');
    }

    public function listasEspera(){
        return $this->belongsToMany(ListaEspera::class, 'lista_espera_aluno')
                    ->withPivot('data_entrada', 'status');
    }

    public function documentosAluno(){
        return $this->hasMany(DocumentoAluno::class, 'aluno_id');
    }

    public function escola(){
        return $this->belongsTo(Escola::class);
    }

    public function origemEncaminhamento(){
        return $this->belongsTo(OrigemEncaminhamento::class);
    }
}
