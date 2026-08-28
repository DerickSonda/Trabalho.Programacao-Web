<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Campos que podem ser preenchidos em massa.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Campos escondidos.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversões de tipo (a senha já sai com hash).
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

    /**
     * Um usuário TEM VÁRIOS filmes cadastrados (hasMany).
     * O Laravel liga pela chave estrangeira user_id da tabela filmes.
     * Uso: $usuario->filmes
     */
    public function filmes()
    {
        return $this->hasMany(Filme::class);
    }

    /**
     * Um usuário TEM UM último filme cadastrado (hasOne).
     * O hasOne traz só um registro; o latest() faz ele pegar o mais recente.
     * Uso: $usuario->ultimoFilme
     */
    public function ultimoFilme()
    {
        return $this->hasOne(Filme::class)->latest();
    }
}
