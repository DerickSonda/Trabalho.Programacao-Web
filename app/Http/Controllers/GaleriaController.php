<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Filme;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    /**
     * Galeria pública de filmes, com filtro por ano, por categoria e busca pelo nome.
     */
    public function index(Request $request)
    {
        // Começa a consulta e vai montando os filtros conforme o que o usuário escolheu.
        $consulta = Filme::with('categoria');

        // Filtro por categoria
        if ($request->categoria_id) {
            $consulta->where('categoria_id', $request->categoria_id);
        }

        // Filtro por ano
        if ($request->ano) {
            $consulta->where('ano', $request->ano);
        }

        // Busca pelo nome do filme (extra)
        if ($request->busca) {
            $consulta->where('nome', 'like', '%' . $request->busca . '%');
        }

        // Paginação (extra). O withQueryString mantém os filtros ao trocar de página.
        $filmes = $consulta->orderBy('nome')->paginate(8)->withQueryString();

        return view('galeria.index', [
            'filmes' => $filmes,
            'categorias' => Categoria::orderBy('nome')->get(),
            // Lista de anos que existem no banco, para montar o select do filtro.
            'anos' => Filme::select('ano')->distinct()->orderBy('ano', 'desc')->pluck('ano'),
        ]);
    }

    /**
     * Página com os detalhes de um filme e o trailer.
     */
    public function show(Filme $filme)
    {
        return view('galeria.show', ['filme' => $filme]);
    }
}
