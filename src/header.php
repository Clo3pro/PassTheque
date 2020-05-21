<?php  
session_start();
include("connexion_db.php");
if(isset($_GET["empty"]) && $_GET["empty"]=="true"){
    $_SESSION['panier']= array();
}?>
<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Passthèque</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/default.css" media="all" />-->
        <link rel="stylesheet" type="text/css" href="css/modification.css" />


    </head>

    <body>

    <div id="header-banner">
        <div id="header">
            <div id="logo">
                <div classe="imglogo"><img src="images/logo3.PNG" width="200" height="200" alt="" /></div>
            </div>
            <div id="menu">
                <ul>
                    <li><a href="accueil.php">Accueil</a></li>
                    <li><a href="exploration.php">Explorer</a></li>
                    <li><a href="ajouter_livre.php">Ajouter</a></li>
                <?php
                var_dump($_SESSION);
                if($_SESSION['niveauAcces']=0){
                    echo "<li><a href='deconnexion.php'>Déconnexion</a></li>";
                }elseif($_SESSION['niveauAcces'] = 1){
                    echo' <li><a href="admin.php">Admin</a></li>';
                    echo "<li><a href='deconnexion.php'>Déconnexion</a></li>";
                    
                    
                }else{
                 echo"   <li><a href='connexion.php'>Connexion</a></li>";
                    
                }?>
                   
                    
                    
                </ul>
            </div>
        </div>
    </div>

