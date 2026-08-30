<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Popula o banco com os dados iniciais.
     */
    public function run(): void
    {
        // Usuário administrador para entrar no sistema.
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@filmes.com',
            'password' => Hash::make('123456'),
        ]);

        // Chama os outros seeders (a ordem importa: categorias antes dos filmes).
        $this->call([
            CategoriaSeeder::class,
            FilmeSeeder::class,
        ]);
    }
}
