<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Mostra o formulário de login da administração.
     */
    public function mostrarFormulario()
    {
        return view('login');
    }

    /**
     * Confere o e-mail e a senha e coloca o usuário logado na sessão.
     */
    public function entrar(Request $request)
    {
        $dados = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // O Auth::attempt já compara a senha digitada com o hash salvo no banco.
        if (Auth::attempt($dados)) {
            $request->session()->regenerate();

            return redirect()->route('filmes.index')->with('mensagem', 'Bem-vindo(a) de volta!');
        }

        // Se não bateu, volta para o formulário com a mensagem de erro.
        return back()->withErrors(['email' => 'E-mail ou senha incorretos.'])->withInput();
    }

    /**
     * Faz logout e volta para a galeria.
     */
    public function sair(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('galeria.index')->with('mensagem', 'Você saiu do sistema.');
    }
}
