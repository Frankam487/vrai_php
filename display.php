<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./ajouter.css">
  <title>Afficher</title>
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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier que les données existent et sont valides
    if (isset($_POST['id'], $_POST['nom'], $_POST['telephone'], $_POST['email'])) {
        $id = (int) $_POST['id']; // Protéger l'ID
        $nom = htmlspecialchars($_POST['nom']); // Assurer que le nom est sécurisé
        $telephone = htmlspecialchars($_POST['telephone']);
        $email = htmlspecialchars($_POST['email']);

        // Préparer la requête SQL pour la mise à jour
        $sql = "UPDATE person SET nom = :nom, telephone = :telephone, email = :email WHERE id = :id";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // Exécuter la requête
            $stmt->execute();

            // Rediriger vers la page principale après la mise à jour
            header("Location: index.php"); // Assurer que tu rediriges vers la page d'affichage des données
            exit();
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }
} else {
    echo "Méthode incorrecte";
}
?>
 

</table>
</body>
</html>