<?php

$db = "creude";
$userName = "root";
$password = "";
$server = "localhost";


try{
$pdo = new PDO("mysql:host=$server;dbname=$db", $userName, $password);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(Exception $e){

  echo "Connexion echoue: " . $e->getMessage();
}
