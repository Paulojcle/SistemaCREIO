<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Perfil;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'foto',
        'ativo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function perfis()
    {
        return $this->belongsToMany(Perfil::class, 'perfil_user');
    }

    public function profissional()
    {
        return $this->hasOne(\App\Models\Profissional::class, 'user_id');
    }

    public function temPermissao(string $permissao): bool
    {
        return once(function () {
            return $this->perfis()
                ->with('permissoes')
                ->get()
                ->flatMap(fn($p) => $p->permissoes->pluck('nome'))
                ->unique();
        })->contains($permissao);
    }
}
