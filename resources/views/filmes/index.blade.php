@extends('layouts.app')

@section('conteudo')
    <h2>Administração - Filmes</h2>

    {{-- hasOne: mostra o último filme que o usuário logado cadastrou --}}
    @if (Auth::user()->ultimoFilme)
        <p class="vazio">Seu último cadastro: {{ Auth::user()->ultimoFilme->nome }}</p>
    @endif

    <p><a href="{{ route('filmes.create') }}" class="btn">+ Novo filme</a></p>

    @if (count($filmes) > 0)
        <table>
            <tr>
                <th>Capa</th>
                <th>Nome</th>
                <th>Ano</th>
                <th>Categoria</th>
                <th>Cadastrado por</th>
                <th>Ações</th>
            </tr>

            @foreach ($filmes as $filme)
                <tr>
                    <td>
                        @if ($filme->capa)
                            <img src="{{ asset('storage/' . $filme->capa) }}" alt="Capa">
                        @endif
                    </td>
                    <td>{{ $filme->nome }}</td>
                    <td>{{ $filme->ano }}</td>
                    {{-- categoria e usuario vêm dos relacionamentos --}}
                    <td>{{ $filme->categoria->nome }}</td>
                    <td>{{ $filme->usuario->name }}</td>
                    <td>
                        <a href="{{ route('filmes.edit', $filme) }}">Editar</a> |
                        <a href="{{ route('filmes.delete', $filme) }}">Excluir</a>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $filmes->links() }}
    @else
        <p class="vazio">Nenhum filme cadastrado ainda.</p>
    @endif
@endsection
