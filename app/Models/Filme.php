<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    protected $table = 'filmes';

    protected $fillable = ['nome', 'sinopse', 'ano', 'capa', 'trailer', 'categoria_id', 'user_id'];

    /**
     * O filme PERTENCE A uma categoria (lado da chave estrangeira categoria_id).
     * Uso: $filme->categoria->nome
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * O filme PERTENCE AO usuário que o cadastrou (chave estrangeira user_id).
     * Uso: $filme->usuario->name
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Monta o link de embed do YouTube a partir do link normal do trailer.
     * Ex.: https://www.youtube.com/watch?v=ABC123  ->  https://www.youtube.com/embed/ABC123
     * Se não conseguir descobrir o código do vídeo, devolve null (aí a view mostra só o link).
     */
    public function linkEmbed()
    {
        if (! $this->trailer) {
            return null;
        }

        $codigo = null;

        // Formato normal: youtube.com/watch?v=CODIGO
        if (str_contains($this->trailer, 'watch?v=')) {
            $codigo = explode('&', explode('watch?v=', $this->trailer)[1])[0];
        }

        // Formato curto: youtu.be/CODIGO
        if (str_contains($this->trailer, 'youtu.be/')) {
            $codigo = explode('?', explode('youtu.be/', $this->trailer)[1])[0];
        }

        // Já é um link de embed: youtube.com/embed/CODIGO
        if (str_contains($this->trailer, '/embed/')) {
            $codigo = explode('?', explode('/embed/', $this->trailer)[1])[0];
        }

        return $codigo ? 'https://www.youtube.com/embed/' . $codigo : null;
    }
}
