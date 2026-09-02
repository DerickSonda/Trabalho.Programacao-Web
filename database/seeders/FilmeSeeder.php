<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Filme;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FilmeSeeder extends Seeder
{
    /**
     * Cadastra alguns filmes de exemplo.
     */
    public function run(): void
    {
        // Pega o usuário admin (é ele que vai ficar como dono dos filmes de exemplo).
        $usuario = User::first();

        $filmes = [
            [
                'nome' => 'Matrix',
                'ano' => 1999,
                'categoria' => 'Ficção Científica',
                'sinopse' => 'Thomas Anderson é um programador comum durante o dia e hacker conhecido como Neo durante a noite. Ele descobre que o mundo em que vive é uma simulação criada por máquinas e precisa escolher entre continuar iludido ou lutar pela liberdade das pessoas.',
                'trailer' => 'https://www.youtube.com/watch?v=vKQi3bBA1y8',
                'capa' => 'matrix.svg',
            ],
            [
                'nome' => 'Interestelar',
                'ano' => 2014,
                'categoria' => 'Ficção Científica',
                'sinopse' => 'Com a Terra ficando sem condições de abrigar a humanidade, um grupo de exploradores atravessa um buraco de minhoca em busca de um novo planeta. O piloto Cooper precisa escolher entre salvar a espécie humana e rever a própria filha.',
                'trailer' => 'https://www.youtube.com/watch?v=zSWdZVtXT7E',
                'capa' => 'interestelar.svg',
            ],
            [
                'nome' => 'O Poderoso Chefão',
                'ano' => 1972,
                'categoria' => 'Drama',
                'sinopse' => 'A história da família Corleone, uma das mais poderosas da máfia italiana nos Estados Unidos. Depois de um atentado contra o patriarca Vito, o filho mais novo, Michael, acaba assumindo os negócios da família.',
                'trailer' => 'https://www.youtube.com/watch?v=sY1S34973zA',
                'capa' => 'chefao.svg',
            ],
            [
                'nome' => 'Cidade de Deus',
                'ano' => 2002,
                'categoria' => 'Drama',
                'sinopse' => 'Buscapé é um jovem pobre e sensível que cresce em uma favela violenta do Rio de Janeiro. Com medo de virar bandido, ele descobre na fotografia uma forma de contar a história do lugar onde vive.',
                'trailer' => 'https://www.youtube.com/watch?v=ioUE_5wpg_E',
                'capa' => 'cidade-de-deus.svg',
            ],
            [
                'nome' => 'Toy Story',
                'ano' => 1995,
                'categoria' => 'Animação',
                'sinopse' => 'O cowboy Woody é o brinquedo preferido de Andy até a chegada do patrulheiro espacial Buzz Lightyear. Os dois viram rivais, se perdem de casa e precisam trabalhar juntos para voltar para o dono.',
                'trailer' => 'https://www.youtube.com/watch?v=v-PjgYDrg70',
                'capa' => 'toy-story.svg',
            ],
            [
                'nome' => 'Shrek',
                'ano' => 2001,
                'categoria' => 'Animação',
                'sinopse' => 'Shrek é um ogro rabugento que vive sozinho no pântano. Para ter o seu sossego de volta, ele faz um acordo com o Lorde Farquaad e sai em uma aventura para resgatar a princesa Fiona, ao lado do falante Burro.',
                'trailer' => 'https://www.youtube.com/watch?v=CwXOrWvPBPk',
                'capa' => 'shrek.svg',
            ],
            [
                'nome' => 'Mad Max: Estrada da Fúria',
                'ano' => 2015,
                'categoria' => 'Ação',
                'sinopse' => 'Em um mundo pós-apocalíptico e sem água, Max é capturado por um exército comandado por Immortan Joe. Ele acaba se unindo à guerreira Furiosa, que foge levando um caminhão e um grupo de mulheres em busca de liberdade.',
                'trailer' => 'https://www.youtube.com/watch?v=hEJnMQG9ev8',
                'capa' => 'mad-max.svg',
            ],
            [
                'nome' => 'O Iluminado',
                'ano' => 1980,
                'categoria' => 'Terror',
                'sinopse' => 'O escritor Jack Torrance aceita cuidar de um hotel isolado nas montanhas durante o inverno e leva a família junto. Aos poucos, o lugar começa a afetar a sua sanidade, enquanto o filho Danny enxerga coisas assustadoras.',
                'trailer' => 'https://www.youtube.com/watch?v=S014oGZiSdI',
                'capa' => 'iluminado.svg',
            ],
            [
                'nome' => 'Esqueceram de Mim',
                'ano' => 1990,
                'categoria' => 'Comédia',
                'sinopse' => 'A família McCallister viaja para Paris no Natal e esquece o pequeno Kevin em casa. Sozinho, o menino precisa se virar e ainda defender a casa de dois ladrões atrapalhados.',
                'trailer' => 'https://www.youtube.com/watch?v=jEDaVHmw7r4',
                'capa' => 'esqueceram-de-mim.svg',
            ],
            [
                'nome' => 'Coringa',
                'ano' => 2019,
                'categoria' => 'Drama',
                'sinopse' => 'Arthur Fleck é um comediante fracassado que sofre com problemas mentais e com o desprezo da cidade de Gotham. Aos poucos, ele se transforma no criminoso conhecido como Coringa.',
                'trailer' => 'https://www.youtube.com/watch?v=zAGVQLHvwOY',
                'capa' => 'coringa.svg',
            ],
            [
                'nome' => 'Vingadores: Ultimato',
                'ano' => 2019,
                'categoria' => 'Ação',
                'sinopse' => 'Depois de metade do universo desaparecer, os heróis que sobraram se unem em uma última tentativa de desfazer o estrago causado por Thanos e trazer todos de volta.',
                'trailer' => 'https://www.youtube.com/watch?v=TcMBFSGVi1c',
                'capa' => 'vingadores.svg',
            ],
            [
                'nome' => 'Divertida Mente',
                'ano' => 2015,
                'categoria' => 'Animação',
                'sinopse' => 'A história se passa dentro da cabeça de Riley, uma menina de 11 anos que se muda de cidade. Alegria, Tristeza, Raiva, Medo e Nojinho precisam trabalhar juntos para ajudá-la nessa fase difícil.',
                'trailer' => 'https://www.youtube.com/watch?v=yRUAzGQ3nSY',
                'capa' => 'divertida-mente.svg',
            ],
            [
                'nome' => 'Parasita',
                'ano' => 2019,
                'categoria' => 'Drama',
                'sinopse' => 'A família Kim é pobre e desempregada. Aos poucos, todos conseguem emprego na casa da rica família Park, escondendo que são parentes. O plano funciona até um segredo da casa vir à tona.',
                'trailer' => 'https://www.youtube.com/watch?v=5xH0HfJHsaY',
                'capa' => 'parasita.svg',
            ],
        ];

        foreach ($filmes as $dados) {
            // Procura a categoria pelo nome para pegar o id (chave estrangeira).
            $categoria = Categoria::where('nome', $dados['categoria'])->first();

            // Copia a capa de exemplo para a pasta de uploads (storage/app/public/capas).
            $arquivo = database_path('seeders/capas/' . $dados['capa']);
            $capa = 'capas/' . $dados['capa'];
            Storage::disk('public')->put($capa, file_get_contents($arquivo));

            Filme::create([
                'nome' => $dados['nome'],
                'sinopse' => $dados['sinopse'],
                'ano' => $dados['ano'],
                'capa' => $capa,
                'trailer' => $dados['trailer'],
                'categoria_id' => $categoria->id,
                'user_id' => $usuario->id,
            ]);
        }
    }
}
