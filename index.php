<?php
include "./conn.php";

if(isset($_POST['submit'])){
    $nom = htmlspecialchars($_POST['nom']);
    $tel = htmlspecialchars($_POST['tel']);
    $email = filter_var($_POST['email']);

  
    if(!empty($nom) && !empty($tel) && !empty($email)){
        try {
    
            $sql = "INSERT INTO `person` (nom, telephone, email) VALUES (:nom, :tel, :email)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['nom' => $nom, 'tel' => $tel, 'email' => $email]);
            header('Location: ./display.php');
            echo "Données insérées avec succès!";
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
        }
    } else {
        echo "Veuillez renseigner tous les champs";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">

  <title>PHP CREUD</title>
</head>
<body>
  
<div class="form_conrtainer">
  <form  method="post">


    

    <div class="nom">

      <label for="nom">Nom *</label>
      <input type="text" name="nom" id="nom">
    </div>
    <div class="tel">
      <label for="tel">Tel *</label>
      <input type="number" name="tel" id="tel">
    </div>
    <div class="email">

      <label for="email">Email *</label>
      <input type="text" name="email" id="email">
    </div>
    <button type="submit" name="submit">Creer</button>
  </form>
 
</body>
</html>