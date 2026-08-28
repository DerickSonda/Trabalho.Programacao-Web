<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // O plural de "categoria" em PT-BR é "categorias", então informamos a tabela.
    protected $table = 'categorias';

    protected $fillable = ['nome'];

    /**
     * Uma categoria TEM VÁRIOS filmes (hasMany).
     * Com isso dá para fazer $categoria->filmes e o Laravel faz o join sozinho.
     */
    public function filmes()
    {
        return $this->hasMany(Filme::class);
    }
}
