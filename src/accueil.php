<?php  include("header.php")?>

    <div id="wrapper">
        <div class="container">
    <!-- <?php if( $_SESSION['niveauAcces'] !=NULL){
             echo" <h2 class='title'> Bonjour ".$_SESSION['prenom']." ".$_SESSION['nom']."!</h2>";
         }else{
            echo '<aside class="aside">
            <?php include("inscription.php")?>
             </aside>';
        }
    ?> -->
            <aside class="aside">
            <?php include("inscription.php")?>
             </aside>
            <div class="title">
           
                <h2>Nos Nouveautés</h2>
                <p>La saga Eragon est désormais disponible !</p>
            
            </div>
            
            <div class="flexPhotos">
                <?php $donnees = $reponse = $pdo->query('SELECT Personne.nom, Personne.prenom, Livre.titre,Livre.annee,Livre.isbn
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
                $imageDefaut = "images/image_defaut.jpg";
                if(file_exists($image)){
                    echo '<a id=link_details href ="details.php?isbn='.HtmlSpecialChars($donnees['isbn']).'"><img  class="image" src="'.$image.'" alt="uh-oh" /></a>';
                }else{
                    echo '<a id=link_details href="details.php?isbn='.HtmlSpecialChars($donnees['isbn']).'"><img class="image" src="'.$imageDefaut.'" alt="uh-oh" /></a>';
                }

               ?></div>
              
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
                    <span>N'hésitez pas a nous en suggérer de nouveaux  via  l'onglet <strong><a href="ajouter_livre.php"  title="">Ajouter</a></strong></span></h2>
                <ul class="style3">
                    <li class="first">
                        <p class="date">20<b>FEV</b></p>
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
        </div>
    </div>
<?php include "bas.php"; ?>



