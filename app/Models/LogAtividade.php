<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAtividade extends Model
{
    public $timestamps = false;

    protected $table = 'logs_atividade';

    protected $fillable = [
        'user_id',
        'acao',
        'modulo',
        'descricao',
        'ip',
        'created_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
