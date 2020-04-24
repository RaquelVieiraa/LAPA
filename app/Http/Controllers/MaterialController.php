<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use App\Disciplina;
use Validator;
use App\Http\Requests\MaterialRequest;
class MaterialController extends Controller
{
   protected $material;
   protected $disciplina;
   


    public function __construct(Material $material, Disciplina $disciplina)
    {
        $this->middleware('auth');
        $this->material = $material;
        $this->disciplina = $disciplina;
    }

    public function index() 
    { 
	
        $registros = $this->material->all();
        return view('auth.materiais.index', compact('registros'));
    }

    public function adicionar() 
    {
        $disciplinas=$this->disciplina->all();
        return view('auth.materiais.adicionar', compact('disciplinas'));
    }

    public function salvar(MaterialRequest $request) 
    {
        $request->validated();
        $dados = $request->all();

        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = rand(1111,9999);
            $dir = 'img/materiais/';
            $exAnexo = $anexo->guessClientExtension();
            $nomeAnexo = 'anexo_'.$num.'.'.$exAnexo;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }
        $this->material->create($dados);
        return redirect()->route('auth.materiais');
    }

    public function editar($material_id) 
    {
        $registro = $this->material->find($material_id);
	$disciplinas=$this->disciplina->all();
        return view('auth.materiais.editar', compact('registro','disciplinas'));        
    }

    public function atualizar(MaterialRequest $request, $material_id)
    {
        $request->validated();
        $dados = $request->all();

        if($request->hasFile('anexo')) {
            $anexo = $request->file('anexo');
            $num = rand(1111,9999);
            $dir = 'img/materiais';
            $exAnexo = $anexo->guessClientExtension(); 
            $nomeAnexo = 'anexo_'.$num.'.'.$exAnexo;
            $anexo->move($dir, $nomeAnexo);
            $dados['anexo'] = $dir.'/'.$nomeAnexo;
        }

        $this->material->find($material_id)->update($dados);
        return redirect()->route('auth.materiais');
    }

    public function deletar($material_id)
    {
        $this->material->find($material_id)->delete();
        return redirect()->route('auth.materiais');
    }
    
}
