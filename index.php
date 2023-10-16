<?php
  include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=AR+One+Sans&family=Ubuntu&display=swap" rel="stylesheet">
</head>
<body>
  <h1>Usuários do sistema</h1>
  <div class="container">
    <table>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CPF</th>
        <th></th>
      </tr>
      <?php
        $sql = "SELECT * FROM user";
        $result = mysqli_query($connection, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] .'</td>';
            echo '<td>' .$row['name'] .'</td>';
            echo '<td>' .$row['cpf'] .'</td>';
            echo '
              <td>
                <div class="buttons">
                  <a href="updateForm.php?id=' .$row['id']. '" class="edit">Editar</a>
                  <a href="index.php?id=' .$row['id']. '" class="delete">Delete</a>
                </div>
              </td>'; 
            echo '<tr>';
          }
      }
      //Código do DELETE
        if(isset($_GET['id'])) {
          $id = $_GET['id'];
          $del_query = "DELETE FROM user WHERE id = '$id'";
          $result_delete = mysqli_query($connection, $del_query);
          header("location:index.php");
        }
      ?>
    </table>
  </div>
</body>
</html>