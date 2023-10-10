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
  <style>
    a {
      background-color: #008CBA;
      border: none;
      color: white;
      padding: 6px 12px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 14px;
      margin: 4px 2px;
      cursor: pointer;
    }
  </style>

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
                  <a href="updateForm.php?id=' .$row['id']. ' class="button">Editar</a>
                  <input type="submit" class="button delete" name="delete" value="Delete" />
                </div>
              </td>'; 
            echo '<tr>';
          }
      }
      ?>
    </table>
  </div>
</body>
</html>