<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./ajouter.css">
  <title>Document</title>
</head>
<body>
  


 <?php require "./conn.php";?>
 
 <a href="./index.php">retour</a>
 <table>
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </div>
        
        <?php
try {
  $sql = "SELECT * FROM person";
  $stmt = $pdo->query($sql);

    if ($stmt->rowCount() == 0) {
        echo "Aucune personne trouvée.";
    } else {
        while ($row = $stmt->fetch()) {?>
        <tr>
          <td> <?=$row['id'];?> </td>
          <td> <?=$row['nom'];?> </td>
          <td> <?=$row['telephone'];?> </td>
          <td> <?=$row['email'];?> </td>
          <td>
            <a href="?delete=<?=$row['id']?>">Supprimer</a>
            <a href="?edit=<?=$row['id']?>">Editer</a>
        
        </td>
        </tr>
        <?php
  }?>
    <?php
    }
  } catch (PDOException $e) {
    echo "Erreur lors de la requête : " . $e->getMessage();
  }
  ?>

<?php


if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = (int) $_GET['delete']; //proteger l'ID
    $sql = "DELETE FROM person WHERE id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
} 


?>
</table>
</body>
</html>