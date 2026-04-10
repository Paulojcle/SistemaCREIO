<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Permissao;

class Perfil extends Model
{
    protected $table = 'perfis';

    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'perfil_user');
    }

    public function permissoes()
    {
        return $this->belongsToMany(Permissao::class, 'perfil_permissao');
    }
}
