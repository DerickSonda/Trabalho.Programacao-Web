# Gerenciador de Filmes

Este projeto, desenvolvido por Derick Sonda, aluno do curso Técnico em Informática do IFRS –
Campus Bento Gonçalves, é o trabalho da disciplina de Programação Web III referente ao segundo
trimestre. Trata-se de uma aplicação web feita em PHP com o framework Laravel, que serve para
cadastrar filmes e apresentá-los ao público em uma galeria.

O sistema é dividido em duas partes. A parte pública mostra os filmes em cards com a imagem da
capa e permite filtrar por ano e por categoria, além de buscar pelo nome. Ao clicar em um filme,
o visitante vê a página de detalhes, com a sinopse completa, a categoria, o ano e o trailer do
YouTube exibido dentro da própria página. A parte de administração exige login e é onde os filmes
são cadastrados, editados e excluídos, com upload da imagem da capa.

O banco de dados foi criado com migrations e populado com seeders, e as informações ficam ligadas
por chaves estrangeiras: cada filme pertence a uma categoria e ao usuário que o cadastrou. Esse
usuário é gravado automaticamente a partir de quem está logado, sem campo no formulário. As
consultas entre as tabelas são feitas pelos relacionamentos do Eloquent, usando hasMany, hasOne e
belongsTo, o que faz o Laravel montar os joins sozinho.

## Tecnologias utilizadas

- PHP 8.2 com Laravel 12
- Banco de dados SQLite
- Blade para as telas, com CSS escrito à mão (sem framework de front-end)
- Migrations e Seeders para criar e popular o banco

## Como instalar e rodar

Com o PHP e o Composer instalados, execute os comandos abaixo dentro da pasta do projeto:

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

O sistema fica disponível em http://localhost:8000. Em Linux ou macOS, troque o `copy` por `cp`.
O comando `storage:link` só precisa ser executado uma vez e é o que faz as capas dos filmes
aparecerem no navegador. Para apagar tudo e recomeçar com os dados de exemplo, use
`php artisan migrate:fresh --seed`.

## Acesso

Para entrar na administração é preciso ter uma conta. O cadastro é feito na tela de registro, em
/registrar, informando nome, e-mail e senha. Depois de criar a conta o usuário já entra logado e
pode cadastrar os seus filmes.

## Estrutura do banco

São três tabelas principais. A tabela `users` guarda quem pode entrar na administração, a tabela
`categorias` guarda os gêneros dos filmes (Ação, Animação, Comédia, Drama, Ficção Científica e
Terror) e a tabela `filmes` guarda nome, sinopse, ano, capa e link do trailer, junto com as chaves
estrangeiras `categoria_id` e `user_id`. Os seeders já deixam o banco com treze filmes de exemplo,
cada um com a sua capa e o link do trailer.

## Funcionalidades extras

Além do que foi pedido no enunciado, a galeria conta com busca pelo nome do filme e com paginação,
que também é usada na listagem da administração. O sistema ainda permite que novos usuários criem
a própria conta, e cada um vê na administração qual foi o último filme que cadastrou.
