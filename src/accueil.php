
<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=passTheque;charset=utf8', 'root', '');
}
catch(Exception $e){
    die('Error :' .$e->getMessage());
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PassThèque</title>
   <!-- <link rel="stylesheet" type="text/css" href="css/default.css" media="all" />-->
    <link rel="stylesheet" type="text/css" href="css/modification.css" media="all" />


</head>

<body>
<?php include "nav.php"; ?>


    <div id="wrapper">
        <div class="container">
            <div class="title">
            <center>
                <h2>Nos Nouveautés</h2>
                <p>La saga Eragon est désormais disponible !</p>
            </center>
            </div>
            
            <div class="flexPhotos">
                <?php $donnees = $reponse = $bdd->query('SELECT Personne.nom, Personne.prenom, Livre.titre,Livre.annee,Livre.isbn
                FROM Livre
                JOIN Auteur ON Livre.isbn = Auteur.idLivre
                JOIN Personne ON Auteur.idPersonne = Personne.id
                WHERE Personne.id = 18
                ORDER BY Livre.annee
                

                ');


                    while($donnees = $reponse->fetch()){


                ?>
                <div class="boxB">
                <?php

                $image = "images/"."$donnees[isbn]".".jpg";

                print '<img src="'.$image.'" alt="UH-OH"
                
                    < width="200" height="350"/>';?></div>
              
            <?php   }?>
            
        </div>
        </div>
        <div id="page" class="container">
            <div class="boxE">
                <h2>Meilleur auteur<br />
                    <span>Classement des auteurs aux meilleurs ventes en 2019.</span></h2>
                <ul class="style4">
                    <li class="first">Le top 5 :</li>
                    <li>Guillaume Musso : 1 435 955 exemplaires</li>
                    <li>Michel Bussi : 964 008 exemplaires</li>
                    <li>Virginie Grimaldi : 755 819 exemplaires</li>
                    <li>Marc Levy : 744 544 exemplaires</li>
                    <li>Aurélie Valognes : 683 338 exemplaires</li>
                </ul>
            </div>
            <div class="boxD">
                <h2>A venir<br />
                    <span>N'hésitez pas a nous en suggérer de nouveaux  via  l'onglet <strong><a href="#"  title="">Ajouter</a></strong></span></h2>
                <ul class="style3">
                    <li class="first">
                        <p class="date"><a href="#">20<b>FEV</b></a></p>
                        <h3>The Witcher</h3>
                        <p>Beaucoup demandé suite a la série Netflix.</p>
                    </li>
                    <li class="first">
                        <p class="date">01<b>MAR</b></p>
                        <h3>Manga</h3>
                        <p>Nous vous proposerons bientôt un tout nouveau genre.
                            Pour les amoureux de la culture Nippone.</p>
                    </li>
                </ul>
            </div>
            <div class="boxF">
                <h2>Voir avec clopro<br />
                    <span>Quoi mettre pour remplir</span></h2>
                <ul class="style4">
                    <li class="first">dd<a href="#"></a></li>
                    <li><a href="#">dddd</a></li>
                    <li><a href="#">Suss</a></li>
                    <li><a href="#">Ur</a></li>
                    <li><a href="#">dd</a></li>
                </ul>
            </div>
        </div>
    </div>
<?php include "bas.php"; ?>


</body>

</html>
