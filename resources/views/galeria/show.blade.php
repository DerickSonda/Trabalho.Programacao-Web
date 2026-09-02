@extends('layouts.app')

@section('conteudo')
    <p><a href="{{ route('galeria.index') }}">&larr; Voltar para a galeria</a></p>

    <div class="detalhe">
        @if ($filme->capa)
            <img src="{{ asset('storage/' . $filme->capa) }}" alt="Capa de {{ $filme->nome }}">
        @endif

        <div class="texto">
            <h2>{{ $filme->nome }} ({{ $filme->ano }})</h2>

            {{-- Os dados abaixo vêm dos relacionamentos (belongsTo) --}}
            <p><b>Categoria:</b> {{ $filme->categoria->nome }}</p>
            <p><b>Cadastrado por:</b> {{ $filme->usuario->name }}</p>

            <p><b>Sinopse:</b></p>
            <p>{{ $filme->sinopse }}</p>
        </div>
    </div>

    {{-- Trailer: tenta mostrar o vídeo do YouTube na página (embed).
         Se o link não for do YouTube, mostra só o link para abrir fora. --}}
    @if ($filme->trailer)
        <div class="trailer">
            <h2>Trailer</h2>

            @if ($filme->linkEmbed())
                <iframe src="{{ $filme->linkEmbed() }}" allowfullscreen></iframe>
            @else
                <p><a href="{{ $filme->trailer }}" target="_blank">Assistir ao trailer</a></p>
            @endif
        </div>
    @endif
@endsection
