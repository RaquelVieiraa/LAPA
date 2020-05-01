<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postagem;
use App\User;
use Validator;
use App\Http\Requests\PostagemRequest;

class PostagemController extends Controller
{
    
    // Model de postagem adicionado ao controller para evitar uso estatico
    protected $postagem;
    protected $user;


    public function __construct(Postagem $postagem, User $user)
    {
        $this->middleware('auth', ['except' => ['siteIndex','sitePostagemvizualizar','siteHome']]);
        $this->postagem = $postagem;
        $this->user = $user;
    }

    public function index() 
    {
        $registros = $this->postagem->all();
        return view('auth.postagem.index', compact('registros'));
    }

    public function adicionar() 
    {
        $users = $this->user->all();
        return view('auth.postagem.adicionar', compact('users'));
    }

    public function salvar(PostagemRequest $request) 
    {
        $request->validated();
        $dados = $request->all();

        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = rand(1111,9999);
            $dir = 'img/postagens/';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }
        $this->postagem->create($dados);
        return redirect()->route('auth.postagens')->with('success', 'Postagem adicionada com sucesso!');
    }

    public function editar($identifier) 
    {
        $registro = $this->postagem->find($identifier);
         $users = $this->user->all();
        return view('auth.postagem.editar', compact('registro','users'));        
    }

    public function atualizar(PostagemRequest $request, $identifier)
    {
        $request->validated();
        $dados = $request->all();

        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = rand(1111,9999);
            $dir = 'img/postagens';
            $ex = $anexo->guessClientExtension(); //Define a extensao do arquivo
            $nomeAnexo = 'anexo_'.$num.'.'.$ex;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        $this->postagem->find($identifier)->update($dados);
        return redirect()->route('auth.postagens')->with('success', 'Postagem atualizada com sucesso!');
    }

    public function deletar($identifier)
    {
        $this->postagem->find($identifier)->delete();
        return redirect()->route('auth.postagens')->with('success', 'Postagem deletada com sucesso!');
    }
    public function siteIndex(){
        $registros = $this->postagem->all();
        return view('site.postagens.index', compact('registros'));
    }
    public function sitePostagemvizualizar($identifier){
        $registro = $this->postagem->find($identifier);
       
        return view('site.postagens.vizualizar', compact('registro'));
    }
     public function siteHome(){//ordenar por data
        $registros = $this->postagem->all();
        return view('site.postagens.home', compact('registros'));
    }
    
    
}
