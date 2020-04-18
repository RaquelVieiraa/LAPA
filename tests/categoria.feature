Feature: categoria
  In order to gerenciar o sistema do LAPA
  As a user
  I need to poder criar, ver, atualizar e deletar categorias

  Scenario: criar uma disciplina valida para teste de categoria
    Given Eu crio um usuario para o teste
    And Eu estou na pagina de disciplinas
    And Eu clico em Adicionar
    Then Eu devo estar na pagina de criar disciplina
    When Eu preencho o campo nome com "Engenharia de Software"
    And Eu seleciono o professor "Rodrigo"
    And Eu clico em Adicionar
    Then Eu devo ver a disciplina "Engenharia de Software"

  Scenario: criar uma categoria valida
    Given Eu estou logado
    And Eu estou na pagina de categorias
    And Eu clico em Adicionar
    Then Eu devo estar na pagina de criar categoria
    When Eu preencho o campo nome com "Sistema nervoso"
    And Eu seleciono a disciplina "Engenharia de Software"
    And Eu clico em Adicionar
    Then Eu devo ver a categoria "Sistema nervoso"

  Scenario: atualizar uma categoria valida
    Given Eu estou logado
    And Eu estou na pagina de categorias
    And Eu clico em Editar a categoria "Sistema nervoso"
    Then Eu devo estar na pagina de editar a categoria
    When Eu edito o nome para "Sistema linfatico"
    And Eu edito a disciplina para "Nenhum"
    And Eu clico em Editar
    Then Eu devo ver a categoria "Sistema linfatico"
    And Eu devo ver a disciplina "Nenhuma disciplina"

  #deletar na funciona pq o atualizar nao esta funcionando.. 
  Scenario: deletar uma categoria com sucesso
    Given Eu estou logado
    And Eu estou na pagina de categorias
    And Eu clico em Deletar a categoria "Sistema linfatico"
    Then Eu nao vejo categoria "Sistema linfatico"
    And Eu deleto o usuario para o teste
  

    
