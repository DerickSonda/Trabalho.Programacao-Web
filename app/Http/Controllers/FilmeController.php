<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Filme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FilmeController extends Controller
{
    /**
     * Listagem dos filmes na administração (com os botões de editar e excluir).
     */
    public function index()
    {
        // O with() já traz a categoria e o usuário junto (join automático do Eloquent).
        $filmes = Filme::with('categoria', 'usuario')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('filmes.index', ['filmes' => $filmes]);
    }

    /**
     * Formulário de cadastro de um novo filme.
     */
    public function create()
    {
        return view('filmes.create', [
            'categorias' => Categoria::orderBy('nome')->get(),
        ]);
    }

    /**
     * Grava o filme novo no banco.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'sinopse' => 'required|string',
            'ano' => 'required|integer|min:1888|max:2100',
            'categoria_id' => 'required|exists:categorias,id',
            'trailer' => 'nullable|url',
            'capa' => 'nullable|image|max:2048',
        ]);

        // Se enviou uma imagem, guarda em storage/app/public/capas.
        if ($request->hasFile('capa')) {
            $dados['capa'] = $request->file('capa')->store('capas', 'public');
        }

        // Chave estrangeira: guarda quem está logado como dono do cadastro.
        $dados['user_id'] = Auth::id();

        Filme::create($dados);

        return redirect()->route('filmes.index')->with('mensagem', 'Filme cadastrado com sucesso.');
    }

    /**
     * Formulário de edição de um filme.
     */
    public function edit(Filme $filme)
    {
        return view('filmes.edit', [
            'filme' => $filme,
            'categorias' => Categoria::orderBy('nome')->get(),
        ]);
    }

    /**
     * Atualiza o filme.
     */
    public function update(Request $request, Filme $filme)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'sinopse' => 'required|string',
            'ano' => 'required|integer|min:1888|max:2100',
            'categoria_id' => 'required|exists:categorias,id',
            'trailer' => 'nullable|url',
            'capa' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('capa')) {
            // Apaga a capa antiga antes de guardar a nova.
            if ($filme->capa) {
                Storage::disk('public')->delete($filme->capa);
            }
            $dados['capa'] = $request->file('capa')->store('capas', 'public');
        } else {
            // Sem imagem nova: mantém a que já estava salva.
            unset($dados['capa']);
        }

        $filme->update($dados);

        return redirect()->route('filmes.index')->with('mensagem', 'Filme atualizado com sucesso.');
    }

    /**
     * Tela de confirmação antes de excluir.
     */
    public function delete(Filme $filme)
    {
        return view('filmes.delete', ['filme' => $filme]);
    }

    /**
     * Exclui o filme (e a capa dele, se existir).
     */
    public function destroy(Filme $filme)
    {
        if ($filme->capa) {
            Storage::disk('public')->delete($filme->capa);
        }

        $filme->delete();

        return redirect()->route('filmes.index')->with('mensagem', 'Filme excluído.');
    }
}
