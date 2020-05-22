<?php
// tentative de connexion à la base de données
try{
    // $pdo = new PDO('mysql:host=localhost;dbname=passTheque;charset=utf8', 'root', 'root');
    $pdo = new PDO('mysql:host=localhost;dbname=passTheque;charset=utf8', 'root', '');
}
// Si impossible de se connecter, affichage d'un message d'erreur
catch(Exception $e){
    echo '<p style="background-color: red; text-align:center";>Impossible de se connecter à la Base de Données!</p>';
    die('Error :' .$e->getMessage());
}
?>
