<?php
//INICIALIZA AS VARIAVEIS COM O VALOR VAZIO
$logradouro = $bairro = $cidade = $uf = "";
// OBTEM O VALOR DO FORMULARIO DE CEP
$cep = isset($_POST['cep']) ? $_POST['cep'] : "";
$data = [];
if (!empty($cep)) {
  $url = "https://viacep.com.br/ws/{$cep}/json/";
  //suprime erros de aviso caso a requisição falhe.
  $resposta = @file_get_contents($url);
  if ($resposta !== FALSE) {
    $data = json_decode($resposta, true);
  }
}
//Se o CEP não for encontrado, define todas as variáveis de endereço como "CEP não encontrado
if (isset($data['erro']) && $data['erro']) {
  $logradouro = $bairro = $cidade = $uf = "CEP não encontrado";
  /*Caso contrário, atribui os valores retornados pela API às variáveis correspondentes. 
    Utiliza o operador ?? para garantir que, se algum campo não estiver presente, a variável recebe uma string vazia.*/
} else {
  $logradouro = $data['logradouro'] ?? "";
  $bairro = $data['bairro'] ?? "";
  $cidade = $data['localidade'] ?? "";
  $uf = $data['uf'] ?? "";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tela Inicial</title>
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
  <main id="conteudo-principal">
    <aside id="menu-lateral">
      <img src="./imgs/logo-doe-vida.png" alt="" id="logo-doe-vida" />
      <nav id="nav-menu-lateral">
        <div class="btn-menu-lateral">
          <a href="#" class="link-menu-lateral"><img src="./imgs/inicio-icon.svg" alt="" class="icon-menu-lateral" />Início</a>
        </div>
        <div class="btn-menu-lateral">
          <a href="#" class="link-menu-lateral"><img src="./imgs/perfil-icon.svg" alt="" class="icon-menu-lateral" />Perfil</a>
        </div>
        <div class="btn-menu-lateral">
          <a href="#" class="link-menu-lateral"><img src="./imgs/cruz-icon1.0.svg" alt="" class="icon-menu-lateral" />Histórico</a>
        </div>
        <div class="btn-menu-lateral">
          <a href="#" class="link-menu-lateral"><img src="./imgs/campanhas-icon.svg" alt="" class="icon-menu-lateral" />Campanhas</a>
        </div>
        <div class="btn-menu-lateral">
          <a href="#" class="link-menu-lateral"><img src="./imgs/sangue-icon.svg" alt="" class="icon-menu-lateral" />Doadores</a>
        </div>
        <div class="btn-menu-lateral">
          <a href="#" class="link-menu-lateral"><img src="./imgs/perguntas-icon.svg" alt="" class="icon-menu-lateral" />Pergunta</a>
        </div>
      </nav>
      <h1>&copy; Doe Vida</h1>
    </aside>

    <div id="div-tela-inical">
      <header id="cabecalho-tela-inicial">
        <a href="" id="btn-perfil-usuario">
          <span class="dados-usuario">
            <h1>Usuário</h1>
            <p>A+</p>
          </span>
          <span class="icon-menu-superior">
            <img src="./imgs/perfil-icon.svg" alt="" />
          </span>
        </a>
      </header>

      <main>
        <h1 id="editar">Editar Perfil</h1>
        <div id="Editar_perfil">
          <h1>Dados Pessoas</h1>
          <h1>Informações Auto-Declaradas</h1>
        </div>
        <div id="perfil_container">
          <div class="container1">
            <form action="">
              <label for="nome">Nome civil:</label>
              <input type="text" name="nome" id="nome" readonly>

              <label for="CPF">CPF</label>
              <input type="text" name="CPF" id="CPF" pattern="\d{3}\,\d{3}\,\d{3}-\d{2}" readonly>

              <label for="data">Data de Nascimento</label>
              <input type="date" name="data" id="data" readonly>

              <label for="carteira">Carteira de Doador</label>
              <input type="carteira" name="carteira" id="carteira" pattern="\d{4}\,\d{4}\,\d{4}\,\d{4}" readonly>
            </form>
          </div>
          <div id="linha_divisor"></div>
          <div class="container1">
            <form action="">
              <label for="email">Email:</label>
              <div class="icon"> <input type="email" name="email" id="email">
                <img src="imgs/edit.png" alt="icone de editar" style="width: 25px; height: 25px; position: absolute; margin-left: 350px; ">
              </div>

              <label for="Contato">Contato:</label>
              <div class="icon"><input type="tel" id="Contato" name="Contato" pattern="[0-9]{2} [0-9]{4}-[0-9]{4}">
                <img src="imgs/edit.png" alt="icone de editar" style="width: 25px; height: 25px; position: absolute; margin-left: 350px;">
              </div>

              <div>
                <form action="" method="POST">
                  <label for="cep">CEP</label>
                  <div class="icon"><input type="text" name="cep" id="cep" maxlength="9" pattern="[0-9]{5}-[0-9]{3}" placeholder="00000-000" required>
                    <img src="imgs/edit.png" alt="icone de editar" style="width: 25px; height: 25px; position: absolute; margin-left: 350px;">
                  </div>
                  <button type="submit">Buscar</button>
                </form>
              </div>

              <label for="logradouro">Logradouro:</label>
              <div class="icon"> <input type="text" name="logradouro" id="logradouro" value="<?php echo ($logradouro); ?>">
                <img src="imgs/edit.png" alt="icone de editar" style="width: 25px; height: 25px; position: absolute; margin-left: 350px;">
              </div>

              <label for="bairro">Bairro:</label>
              <div class="icon"> <input type="text" name="bairro" id="bairro" value="<?php echo ($bairro); ?>">
                <img src="imgs/edit.png" alt="icone de editar" style="width: 25px; height: 25px; position: absolute; margin-left: 350px;">
              </div>

              <label for="cidade">Cidade:</label>
              <div class="icon"><input type="text" name="cidade" id="cidade" value="<?php echo ($cidade); ?>">
                <img src="imgs/edit.png" alt="icone de editar" style="width: 25px; height: 25px; position: absolute; margin-left: 350px;">
              </div>

              <label for="uf">Estado:</label>
              <div class="icon"><input type="text" name="uf" id="uf" value="<?php echo ($uf); ?>">
                <img src="imgs/edit.png" alt="icone de editar" style="width: 25px; height: 25px; position: absolute; margin-left: 350px;">
              </div>

            </form>
            <button type="submit">Salvar</button>

          </div>
        </div>
      </main>
    </div>
  </main>
</body>

</html>