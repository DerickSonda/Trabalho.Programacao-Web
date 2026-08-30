@extends('layouts.app')

@section('conteudo')
    <h2>Excluir filme</h2>

    <p>Tem certeza que deseja excluir o filme <b>{{ $filme->nome }}</b> ({{ $filme->ano }})?</p>

    <form method="post" action="{{ route('filmes.destroy', $filme) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn">Sim, excluir</button>
        <a href="{{ route('filmes.index') }}">Não, voltar</a>
    </form>
@endsection
