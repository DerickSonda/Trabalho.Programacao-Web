@extends('layouts.app')

@section('conteudo')
    <h2>Filmes</h2>

    {{-- Filtros: categoria, ano e busca pelo nome. Vão por GET na própria página. --}}
    <form method="get" action="{{ route('galeria.index') }}" class="filtros">
        <label for="categoria_id">Categoria:</label>
        <select name="categoria_id" id="categoria_id">
            <option value="">Todas</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>

        <label for="ano">Ano:</label>
        <select name="ano" id="ano">
            <option value="">Todos</option>
            @foreach ($anos as $ano)
                <option value="{{ $ano }}" {{ request('ano') == $ano ? 'selected' : '' }}>{{ $ano }}</option>
            @endforeach
        </select>

        <label for="busca">Nome:</label>
        <input type="text" name="busca" id="busca" value="{{ request('busca') }}" placeholder="Buscar filme...">

        <button type="submit" class="btn">Filtrar</button>
        <a href="{{ route('galeria.index') }}">Limpar</a>
    </form>

    {{-- Galeria em formato de cards --}}
    <div class="galeria">
        @forelse ($filmes as $filme)
            <a href="{{ route('galeria.show', $filme) }}" class="cartao">
                @if ($filme->capa)
                    <img src="{{ asset('storage/' . $filme->capa) }}" alt="Capa de {{ $filme->nome }}">
                @else
                    <div class="sem-capa">sem capa</div>
                @endif

                <p class="nome">{{ $filme->nome }}</p>
                {{-- $filme->categoria vem do relacionamento belongsTo --}}
                <p class="info">{{ $filme->ano }} &middot; {{ $filme->categoria->nome }}</p>
            </a>
        @empty
            <p class="vazio">Nenhum filme encontrado.</p>
        @endforelse
    </div>

    {{-- Links da paginação --}}
    {{ $filmes->links() }}
@endsection
