<?php
// tentative de connexion à la base de données
try{
    $pdo = new PDO('mysql:host=localhost;dbname=passTheque;charset=utf8', 'root', 'root');
}
// Si impossible de se connecter, affichage d'un message d'erreur
catch(Exception $e){
    echo 'Impossible de se connecter à la Base de Données!';
    die('Error :' .$e->getMessage());
}
?>
