@extends('layouts.app')

@section('conteudo')
    <h2>Entrar na administração</h2>

    @if ($errors->any())
        <div class="erros">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('entrar') }}" class="formulario">
        @csrf

        <div class="campo">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" autofocus>
        </div>

        <div class="campo">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password">
        </div>

        <button type="submit" class="btn">Entrar</button>
    </form>
@endsection
