@extends('layouts.app')

@section('conteudo')
    <h2>Criar conta</h2>

    @if ($errors->any())
        <div class="erros">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('registrar') }}" class="formulario">
        @csrf

        <div class="campo">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" autofocus>
        </div>

        <div class="campo">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div class="campo">
            <label for="password">Senha <span class="dica">(mínimo 6 caracteres)</span></label>
            <input type="password" name="password" id="password">
        </div>

        <div class="campo">
            <label for="password_confirmation">Repita a senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <button type="submit" class="btn">Criar conta</button>
        <a href="{{ route('login') }}">Já tenho conta</a>
    </form>
@endsection
