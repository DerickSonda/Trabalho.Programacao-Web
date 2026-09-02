# 🎬 Gerenciador de Filmes

Trabalho da disciplina de Programação Web III (2º trimestre) — IFRS Campus Bento Gonçalves.

Sistema web feito em **Laravel 12** para cadastrar e mostrar filmes. Ele tem duas partes:

- **Galeria (pública):** qualquer pessoa vê os filmes em cards, filtra por ano e por categoria,
  busca pelo nome e clica no filme para ver os detalhes com o trailer do YouTube.
- **Administração (com login):** cadastro, edição e exclusão de filmes, com upload da imagem da capa.
  Cada filme guarda o usuário que fez o cadastro.

## Tecnologias

- PHP 8.2 + Laravel 12
- Banco de dados SQLite
- Blade para as telas (CSS próprio, sem framework de front-end)
- Migrations e Seeders

## Como instalar e rodar

```bash
# 1. Instalar as dependências
composer install

# 2. Criar o arquivo .env e gerar a chave da aplicação
cp .env.example .env
php artisan key:generate

# 3. Criar o banco (SQLite) e popular com os dados de exemplo
php artisan migrate --seed

# 4. Criar o link para as imagens enviadas (capas dos filmes)
php artisan storage:link

# 5. Subir o servidor
php artisan serve
```

Depois é só abrir <http://localhost:8000>.

> No Windows, no lugar do `cp .env.example .env` use `copy .env.example .env`.

Para apagar tudo e começar de novo com os dados de exemplo:

```bash
php artisan migrate:fresh --seed
```

## Login de teste

| E-mail             | Senha    |
| ------------------ | -------- |
| admin@filmes.com   | 123456   |

## Telas do sistema

| Endereço                      | O que é                                        |
| ----------------------------- | ---------------------------------------------- |
| `/`                           | Galeria de filmes (com filtros e busca)        |
| `/filme/{id}`                 | Detalhes do filme e trailer                    |
| `/entrar`                     | Login da administração                         |
| `/admin/filmes`               | Listagem dos filmes (editar e excluir)         |
| `/admin/filmes/criar`         | Cadastro de um filme novo                      |
| `/admin/filmes/{id}/editar`   | Edição do filme                                |

## Banco de dados

- **users** — usuários que podem entrar na administração
- **categorias** — Ação, Animação, Comédia, Drama, Ficção Científica e Terror
- **filmes** — nome, sinopse, ano, capa, link do trailer e as chaves estrangeiras
  `categoria_id` e `user_id`

Os relacionamentos das Models usam `hasMany()` (um usuário tem vários filmes, uma categoria tem
vários filmes), `hasOne()` (o último filme cadastrado pelo usuário) e `belongsTo()` (o filme
pertence a uma categoria e a um usuário).

## Extras implementados

- Busca por nome na galeria
- Paginação na galeria e na listagem da administração
