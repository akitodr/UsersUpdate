<?php
  include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans&family=Ubuntu&display=swap" rel="stylesheet">
</head>

<style>
  * {
    font-family: 'AR One Sans', sans-serif;
    font-family: 'Ubuntu', sans-serif;
  }
  body {
    /*garantindo que o body ocupa 100% da altura do viewport*/
    height: 100vh;
    /* removendo margens padrão do body */
    margin: 0;

    /* alterando posicionamento */
    display: flex;
    /* alinhando os filhos no centro com relação a altura */
    align-items: center;
  }

  .container {
    /*garantindo que o container ocupa 100% da largura do viewport*/
    width: 100vw;

    /* alterando posicionamento */
    display: flex;
    /* posicionando o conteúdo no centro com relação a largura */
    justify-content: center;
  }

  .box {
    /* borda sólida com largura de 1 pixel */
    border: solid 1px;
    /* largura da "caixa" de 300 pixels  */
    width: 400px;
    /* altura da "caixa" de 200 pixels */
    height: 260px;
    /* espaçamento interno da caixa (dentro para fora) */
    padding: 10px;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  h1 {
    /* alinhamento do texto no centro da caixa */
    text-align: center;
  }

  .user-info {
    /* alterando posicionamento para ficar um ao lado do outro  */
    display: flex;
    /* adicionando uma margem embaixo de 10 pixels  */
    margin-bottom: 10px;
  }

  .user-info input {
    /* largura do input 100% do espaço restante da caixa */
    width: 100%;
    /* margem de 10 pixels à esquerda */
    margin-left: 10px;
    padding: 6px;
  }

  .cpf-info {
    /* alterando posicionamento para ficar um ao lado do outro  */
    display: flex;
  }

  .cpf-info input {
    /* largura do input 100% do espaço restante da caixa */
    width: 100%;
    /* margem de 10 pixels à esquerda */
    margin-left: 26px;
    padding: 6px;
  }

  form {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
  }

  .edit-button {
    background-color: #008CBA;
    border: none;
    color: white;
    padding: 10px 18px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    margin-top: 30px;
  }
</style>

<body>
  <div class="container">
    <!-- caixa de login -->
    <div class="box">
      <h1>Alteração de Cadastro</h1>
      <form method="post">
        <!-- input de login -->
        <div class="user-info">
          <span>Nome:</span>
          <?php
            $id = $_GET['id'];
            $sql = "SELECT name FROM user WHERE id='$id'";
            $result = mysqli_query($connection, $sql);
            $data = mysqli_fetch_assoc($result);
            if($connection->query($sql)) {
              echo '<input type="text" name="name" value="' .$data['name']. '">';
            }
          ?>
        </div>
        
        <!-- input de senha -->
        <div class="cpf-info">
          <span>CPF:</span>
          <?php
            $sql = "SELECT cpf FROM user WHERE id='$id'";
            $result = mysqli_query($connection, $sql);
            $data = mysqli_fetch_assoc($result);
            if($connection->query($sql)) {
              echo '<input type="text" name="cpf" value="' .$data['cpf']. '">';
            }
          ?>
        </div>

        <input type="submit" class="edit-button" name="edit" value="Concluir">
      </form>
    </div>
  </div>

  <?php
    if(isset($_POST['edit'])) {
      $name = mysqli_real_escape_string($connection, $_POST['name']);
      $cpf = mysqli_real_escape_string($connection, $_POST['cpf']);

      $sql = "UPDATE user SET name = '$name', cpf = '$cpf' WHERE id = '$id'";
      
      if(mysqli_query($connection, $sql) or die($connection->error)) {
        header('Location: index.php');
      } else {
        echo '<script type="text/javascript">
          alert("Error: ' .$sql. ". "
            .$connection->error.
          '");
        </script>';
      }
  }
  mysqli_close($connection);
  ?>
</body>
</html>