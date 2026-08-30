<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Cadastra as categorias de filmes.
     */
    public function run(): void
    {
        $categorias = ['Ação', 'Animação', 'Comédia', 'Drama', 'Ficção Científica', 'Terror'];

        foreach ($categorias as $nome) {
            Categoria::create(['nome' => $nome]);
        }
    }
}
