<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/

use Illuminate\Support\Facades\Hash;

class AdditionalSteps extends \Codeception\Actor
{

    use _generated\AcceptanceTesterActions;

    /**
     * @Given Eu estou logado como :arg1 com email :arg2 e senha :arg3
     */
    public function euEstouLogadoComoComEmailESenha($arg1, $arg2, $arg3)
    {
        $this->haveInDatabase('users', [
            'name' => $arg1,
            'cpf' =>  "123.456.789-10",
            'cpf_verified_at' => now(),
            'email' => $arg2,
            'email_verified_at' => now(),
            'telephone' => "(81)98181-8181",
            'user_type' => 'admin',
        ]);

        $user = $this->grabFromDatabase('users', 'id', array('email' => $arg2));

        $this->haveInDatabase('contas', [
            'password' => '$2y$10$ND9yznr7gDYnYyaEbMtzNuwAWs6oAvX8K/SIguz8teFBSTAbPeyG6',
            'user_id' => $user,
        ]);

        $this->amOnPage('/login');
        $this->fillField(['name' => 'email'], $arg2);
        $this->fillField(['name' => 'password'], $arg3);
        $this->click('Entrar');
        $this->see($arg1, '//a');
    }
    
    /**
     * @Given Eu crio a disciplina :arg1 para teste
     */
    public function euCrioADisciplinaParaTeste($arg1)
    {
        $disciplina=$this->haveInDatabase('disciplinas', [
            'nome' => $arg1,
            'slug'=> $arg1,
        ]);
       
    }

    /**
     * @Given A disciplina :arg1 ja exista
     */
    public function aDisciplinaJaExista($arg1)
    {
        $this->haveInDatabase('disciplinas', [
            'nome' => $arg1,
            'slug'=> $arg1,
        ]);
    }

   /**
    * @Given O material :arg1 ja exista
    */
    public function oMaterialJaExista($arg1)
    {
        $disciplina = $this->grabFromDatabase('disciplinas', 'id', array('nome' => 'Ihc'));

        $this->haveInDatabase('materials', [
            'titulo' => $arg1,
            'texto' => 'Texto do material',
            'anexo' => 'file.png',
            'disciplina_id' => $disciplina,
            'slug'=> $arg1,
            ]);
    }
    
    /**
    * @Given A categoria :arg1 ja exista
    */
    public function aCategoriaJaExista($arg1)
    {
        $disciplina = $this->grabFromDatabase('disciplinas', 'id', array('nome' => 'Ihc'));

        $this->haveInDatabase('categorias', [
            'nome' =>$arg1,
            'disciplina_id' => $disciplina,
            'slug'=>$arg1,
        ]);
    }

    /**
     * @Given O atla :arg1 ja exista
     */
    public function oAtlaJaExista($arg1)
    {
        $this->haveInDatabase('disciplinas', [
            'nome' => 'teste',
            'slug'=> 'teste',
        ]);

        $disciplina = $this->grabFromDatabase('disciplinas', 'id', array('nome' => 'teste'));

        $this->haveInDatabase('categorias', [
            'nome' => 'Sistema nervoso',
            'disciplina_id' => $disciplina,
            'slug'=> 'Sistema nervoso',
        ]);

        $categoria = $this->grabFromDatabase('categorias', 'id', array('nome' => 'Sistema nervoso'));

        $this->haveInDatabase('atlas', [
            'titulo' => $arg1,
            'descricao' => 'Texto do atlas',
            'anexo' => 'anexo.pdf',
            'categoria_id' => $categoria,
            'slug'=> $arg1,
        ]);
    }

    /**
    * @Given A visita :arg1 ja exista
    */
    public function aVisitaJaExista($arg1)
    {
        $user = $this->grabFromDatabase('users', 'id', array('email' => $arg1));

        $this->haveInDatabase('visitas', [
                'data' => now(),
                'hora_inicial' => now(),
                'hora_final' => now(),
                'descricao' => 'Teste de testo de visita',
                'confirmada' => false,
                'user_id' => $user,
        ]);
    }

    /**
     * @Given o contato :arg1 ja exista
     */
    public function oContatoJaExista($arg1)
    {
        $user = $this->grabFromDatabase('users', 'id', array('email' => $arg1));

        $this->haveInDatabase('contatos', [
                'user_id' => $user,
                'email' => $arg1,
                'texto' => 'teste de uma descricao',
                'telefone' => '88 999999999',
                'instagram' => 'https://instagram.com/exemplo',
                'twitter' => 'https://twitter.com/exemplo',
                'facebook' => 'https://facebook.com/exemplo',
        ]);
    }

    /**
    * @Given A postagem :arg1 ja exista
    */
    public function aPostagemJaExista($arg1)
    {
        $this->haveInDatabase('postagems', [
            'titulo' => $arg1,
            'descricao' => 'Texto do material',
            'anexo' => 'file.png',
            'user_id' => null,
            'publicado' => true,
            'slug'=> $arg1,
            'tipo_postagem' => 'edital',
        ]);    
    }


     /**
     * @Given O usuario administrador com nome :arg1,email :arg2 e senha :arg3 existe
     */
     public function oUsuarioAdministradorComNomeemailESenhaExiste($arg1, $arg2, $arg3)
     {
         $this->haveInDatabase('users', [
            'name' => $arg1,
            'cpf' =>  "123.456.789-10",
            'cpf_verified_at' => now(),
            'email' => $arg2,
            'email_verified_at' => now(),
            'telephone' => "(81)98181-8181",
            'user_type' => 'admin',
        ]);

        $user = $this->grabFromDatabase('users', 'id', array('email' => $arg2));

        $this->haveInDatabase('contas', [
            'password' => '$2y$10$4fSjqJsdiTwWChNwuxoYteEqPQEaF6Z87YLtX9Jh5UbZT9jtPPMha',
            'user_id' => $user,
        ]);

     }

      /**
    * @When Eu seleciono o campo escolher origem do anexo link do drive
    */
    public function euSelecionoOCampoEscolherOrigemDoAnexoLinkDoDrive()
    {
        $this->selectOption('input[name=tipo_anexo]', 'link_drive');
    }

    /**
    * @When Eu seleciono o campo escolher origem do anexo link da web
    */
    public function euSelecionoOCampoEscolherOrigemDoAnexoLinkDaWeb()
    {
        $this->selectOption('input[name=tipo_anexo]', 'link_web');
    }

    /**
    * @When Eu preencho o campo do link do arquivo com :arg1
    */
    public function euPreenchoOCampoDoLinkDoArquivoCom($arg1)
    {
        $this->fillField(['name' => 'anexo_drive'], $arg1);
    }

     /**
    * @When Eu preencho o campo do link da web com :arg1
    */
    public function euPreenchoOCampoDoLinkDaWebCom($arg1)
    {
        $this->fillField(['name' => 'anexo_web'], $arg1);
    }
      /**
    * @When Eu seleciono o campo escolher origem do avatar link do drive
    */
    public function euSelecionoOCampoEscolherOrigemDoAvatarLinkDoDrive()
    {
        $this->selectOption('input[name=tipo_avatar]', 'link_drive');
    }

}