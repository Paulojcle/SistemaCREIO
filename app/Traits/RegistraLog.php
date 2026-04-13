<?php

namespace App\Traits;
use App\Models\LogAtividade;

trait RegistraLog{
    protected function registrarLog(string $acao, string $modulo, string $descricao) : void{
        LogAtividade::create([
            'user_id' => auth()->id(),
            'acao' => $acao,
            'modulo' => $modulo,
            'descricao' => $descricao,
            'ip' => request()->ip(),
        ]);
    }
}