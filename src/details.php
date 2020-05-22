
<?php include("header.php");?>
<?php $isbn = HtmlSpecialChars($_GET['isbn'])?>
<?php 
//requête qui récupère toutes les informations sur un livre spécifique dont on a récupérer l'isbn par l'url
$query = $pdo->prepare('
SELECT * ,Editeur.libelle AS editeur,Genre.libelle AS genre,Livre.isbn,Livre.nbpages,Livre.annee,Langue.libelle AS langue
FROM Livre
JOIN Auteur ON Livre.isbn = Auteur.idLivre
JOIN Personne ON Auteur.idPersonne = Personne.id
JOIN Genre ON Livre.genre = Genre.id
JOIN Editeur ON Livre.editeur = Editeur.id
JOIN Role ON Auteur.idRole = Role.id
JOIN Langue ON Livre.langue = Langue.id
WHERE Livre.isbn=?
;');?>
<?php
//requête qui permet de récupérer les informations sur l'auteur du livre
$query2 = $pdo->prepare('
SELECT Personne.nom,Personne.prenom,Auteur.idRole AS "role"
FROM Personne
JOIN Auteur ON Personne.id = Auteur.idPersonne
JOIN Role ON Auteur.idRole = Role.id
Where Auteur.idLivre =?
;');

$query->execute(array($isbn));
$query2->execute(array($isbn));

$donnees = $query->fetch();
$auteurs = $query2->fetchAll();

?>

<!-- affichage de l'image du livre grâce à l'isbn récupéré -->
            
        <div id="bloc_Livre">
            <div id="image_Livre">
            <?php

                $image = "images/" . $donnees['isbn'] . ".jpg";  

                $imageDefaut = "images/image_defaut.jpg";

            if(file_exists($image)){
                echo '<img src="'.$image.'" alt="try again"/>';
            }else{
                echo '<img src="'.$imageDefaut.'" alt="try again"/>';
            }


            ?>
            </div>
            <div id = "text_Livre">
            <!-- affichage des détails du livre -->
            <p id="affich_Liv"> <?php 
                echo "<p> <span class='tdetail'> Titre </span>:".
                HtmlSpecialChars($donnees['titre'])."</p>"  ; ?>

                <?php
                foreach($auteurs as $auteur){
                    if($auteur['role']==1){
                        echo "<p> <span class='tdetail'> Ecrivain </span>: ".HtmlSpecialChars($auteur['prenom'])." ".HtmlSpecialChars($auteur['nom'])."<br/>" ."</p>" ;
                    }
                    if($auteur['role']==2){
                    echo "<p> <span class='tdetail'> Illustrateur </span>: ".HtmlSpecialChars($auteur['prenom'])." ".HtmlSpecialChars($auteur['nom'])."<br/>" ."</p>"; 
                    }
                    if($auteur['role']==3){
                        echo "<p> <span class='tdetail'> Traducteur </span>: ".HtmlSpecialChars($auteur['prenom'])." ".HtmlSpecialChars($auteur['nom'])."<br/>" ."</p>"; 
                    }
                    if($auteur['role']==4){
                        echo " <p> <span class ='tdetail'> Préface </span>: ".HtmlSpecialChars($auteur['prenom'])." ".HtmlSpecialChars($auteur['nom']) ."</p>"; 
                    }
                }

                   
                ?>
                <?php echo "<p> <span class ='tdetail'> Publié en </span> : " .htmlSpecialChars($donnees['annee']) ."</p>" ; ?>
                <?php echo "<p> <span class ='tdetail'> Genre </span> : " .HtmlSpecialChars($donnees['genre']) ."</p>" ?>
                <?php echo "<p> <span class ='tdetail'> Editeur </span>: ".HtmlSpecialChars($donnees['editeur']) ."</p>" ?>
                <?php if(isset($donnees['nbpages'])){
                    echo "<p> <span class ='tdetail'> Nombre de Pages </span> :".HtmlSpecialChars($donnees['nbpages']) ."</p>";
                }?>
                <?php echo "<p> <span class ='tdetail'> Identifiant </span>:".HtmlSpecialChars($donnees['isbn']) ."</p>"?>
                <?php echo "<p> <span class ='tdetail'> Disponible en </span> ".HtmlSpecialChars($donnees['langue']) ."</p>"?>

                <a id="link_details"  href= "modifier_livre.php?for=<?=HtmlSpecialChars($donnees['isbn'])?>"><input type="button"  name="modify" value="Modifier" ></input></a>
                <input type="button" name="resa" value="réserver">

                
            </p>
            
            <?php 


            $query->closeCursor(); // Termine le traitement de la requête
            $query2->closeCursor();
            ?>
            </div>  
        </div>
        <?php include("bas.php");?>


