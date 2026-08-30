@extends('layouts.app')

@section('conteudo')
    <p><a href="{{ route('filmes.index') }}">&larr; Voltar para a listagem</a></p>

    <h2>Editar filme</h2>

    @if ($errors->any())
        <div class="erros">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('filmes.update', $filme) }}" enctype="multipart/form-data" class="formulario">
        @csrf
        {{-- O formulário HTML só envia GET e POST, então o @method avisa o Laravel que é um PUT --}}
        @method('PUT')

        <div class="campo">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $filme->nome) }}" autofocus>
        </div>

        <div class="campo">
            <label for="sinopse">Sinopse</label>
            <textarea name="sinopse" id="sinopse">{{ old('sinopse', $filme->sinopse) }}</textarea>
        </div>

        <div class="campo">
            <label for="ano">Ano</label>
            <input type="number" name="ano" id="ano" value="{{ old('ano', $filme->ano) }}">
        </div>

        <div class="campo">
            <label for="categoria_id">Categoria</label>
            <select name="categoria_id" id="categoria_id">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ old('categoria_id', $filme->categoria_id) == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="campo">
            <label for="capa">Imagem da capa <span class="dica">(deixe vazio para manter a atual)</span></label>
            <input type="file" name="capa" id="capa" accept="image/*">

            @if ($filme->capa)
                <p><img src="{{ asset('storage/' . $filme->capa) }}" alt="Capa atual" height="120"></p>
            @endif
        </div>

        <div class="campo">
            <label for="trailer">Link do trailer no YouTube <span class="dica">(opcional)</span></label>
            <input type="url" name="trailer" id="trailer" value="{{ old('trailer', $filme->trailer) }}"
                   placeholder="https://www.youtube.com/watch?v=...">
        </div>

        <button type="submit" class="btn">Gravar</button>
        <a href="{{ route('filmes.index') }}">Cancelar</a>
    </form>
@endsection
