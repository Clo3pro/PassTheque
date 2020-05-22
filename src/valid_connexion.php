<?php
session_start();
include("header.php");
$membres = $pdo ->prepare('
SELECT *
FROM Membre
WHERE email=?');
$membres -> execute(array($_POST['mail']));
$listeMembres = $membres->fetch();

$goodPassword = password_verify($_POST['password'],$listMembres['motDePasse']);

    if($goodPassword){
        $_SESSION['connexion']=true;
        $_SESSION['nom'] = $listeMembres['nom'];
        $_SESSION['prenom']= $listeMembres['prenom'];
        $_SESSION['email']= $listeMembres['email'];
        $_SESSION['admin']= $listeMembres['niveauAcces'];
        $_SESSION['phone']= $listeMembres['telephone'];
        header('Location: accueil.php');
    }else{
        header('Location : connexion.php');
        echo "Mot de passe ou adresse mail erroné ! veuillez réessayer";
    }
    ?>