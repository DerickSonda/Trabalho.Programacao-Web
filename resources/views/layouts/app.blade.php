<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎬 Gerenciador de Filmes</title>
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            max-width: 950px;
            margin: 0 auto;
            padding: 16px;
            background-color: #f5f5f5;
            color: #333;
        }

        h1 { font-size: 24px; margin: 0 0 6px; }
        h2 { font-size: 19px; margin: 0 0 12px; }

        /* Menu do topo */
        .menu { padding-bottom: 10px; border-bottom: 2px solid #444; margin-bottom: 16px; }
        .menu form { display: inline; }
        .menu button {
            background: none; border: none; padding: 0; cursor: pointer;
            font-family: inherit; font-size: inherit; color: #0645ad; text-decoration: underline;
        }

        /* Avisos */
        .mensagem { background: #e6f4ea; border: 1px solid #9ccfae; padding: 8px 12px; margin-bottom: 14px; }
        .erros { background: #fdecea; border: 1px solid #e0a2a0; padding: 8px 12px; margin-bottom: 14px; }
        .erros ul { margin: 0; padding-left: 20px; }
        .vazio { color: #777; }

        /* Botões */
        .btn {
            display: inline-block; background: #444; color: #fff; border: none;
            padding: 7px 14px; font-family: inherit; font-size: 14px; cursor: pointer; text-decoration: none;
        }
        .btn:hover { background: #222; }

        /* Filtros da galeria */
        .filtros { background: #fff; border: 1px solid #ccc; padding: 12px; margin-bottom: 16px; }
        .filtros label { font-size: 13px; }
        .filtros select, .filtros input { padding: 5px; margin-right: 10px; }

        /* Galeria de filmes */
        .galeria { display: flex; flex-wrap: wrap; gap: 14px; }
        .cartao {
            width: 170px; background: #fff; border: 1px solid #ccc;
            padding: 8px; text-decoration: none; color: #333;
        }
        .cartao:hover { border-color: #444; }
        .cartao img { width: 100%; height: 230px; object-fit: cover; display: block; }
        .cartao .sem-capa {
            width: 100%; height: 230px; background: #eee; color: #999;
            display: flex; align-items: center; justify-content: center; font-size: 13px;
        }
        .cartao .nome { font-weight: bold; font-size: 14px; margin: 6px 0 2px; }
        .cartao .info { font-size: 12px; color: #666; margin: 0; }

        /* Página de detalhes */
        .detalhe { display: flex; flex-wrap: wrap; gap: 20px; }
        .detalhe img { width: 240px; border: 1px solid #ccc; }
        .detalhe .texto { flex: 1 1 300px; }
        .trailer iframe { width: 100%; max-width: 640px; height: 360px; border: 1px solid #ccc; }

        /* Tabela da administração */
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { border: 1px solid #ccc; padding: 7px 9px; text-align: left; font-size: 14px; }
        th { background: #eee; }
        td img { width: 40px; height: 60px; object-fit: cover; display: block; }

        /* Formulários */
        .formulario { background: #fff; border: 1px solid #ccc; padding: 14px; max-width: 560px; }
        .formulario .campo { margin-bottom: 12px; }
        .formulario label { display: block; font-weight: bold; font-size: 14px; margin-bottom: 3px; }
        .formulario input[type="text"], .formulario input[type="number"], .formulario input[type="email"],
        .formulario input[type="password"], .formulario input[type="url"],
        .formulario select, .formulario textarea { width: 100%; padding: 6px; font-family: inherit; font-size: 14px; }
        .formulario textarea { height: 110px; }
        .dica { font-weight: normal; color: #777; font-size: 12px; }

        /* Paginação */
        .pagination { list-style: none; padding: 0; margin: 18px 0 0; display: flex; gap: 5px; flex-wrap: wrap; }
        .pagination li a, .pagination li span { display: block; padding: 4px 9px; border: 1px solid #ccc; background: #fff; }
        .pagination li.active span { background: #444; color: #fff; border-color: #444; }
        .pagination li.disabled span { color: #aaa; }
    </style>
</head>
<body>
    <h1>🎬 Gerenciador de Filmes</h1>

    <div class="menu">
        <a href="{{ route('galeria.index') }}">Galeria</a> |

        {{-- @auth aparece só para quem está logado; @guest só para visitante --}}
        @auth
            <a href="{{ route('filmes.index') }}">Administração</a> |
            <form method="post" action="{{ route('sair') }}">
                @csrf
                <button type="submit">Sair ({{ Auth::user()->name }})</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}">Entrar</a> |
            <a href="{{ route('registro') }}">Registrar</a>
        @endguest
    </div>

    {{-- Mensagem de sucesso que vem do redirect dos controllers --}}
    @if (session('mensagem'))
        <div class="mensagem">👍 {{ session('mensagem') }}</div>
    @endif

    @yield('conteudo')
</body>
</html>
