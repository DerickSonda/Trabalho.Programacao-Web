<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    /**
     * Mostra o formulário de cadastro de usuário.
     */
    public function mostrarFormulario()
    {
        return view('registro');
    }

    /**
     * Cria o usuário novo e já deixa ele logado.
     */
    public function registrar(Request $request)
    {
        $dados = $request->validate([
            'name' => 'required|string|max:255',
            // unique:users garante que não existe outro usuário com o mesmo e-mail
            'email' => 'required|email|unique:users,email',
            // confirmed faz o Laravel conferir com o campo password_confirmation
            'password' => 'required|min:6|confirmed',
        ]);

        // A senha é guardada com hash (nunca em texto puro).
        $dados['password'] = Hash::make($dados['password']);

        $usuario = User::create($dados);

        // Já entra no sistema depois de se cadastrar.
        Auth::login($usuario);

        return redirect()->route('filmes.index')->with('mensagem', 'Conta criada com sucesso!');
    }
}
