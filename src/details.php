
<?php include("connexion_db.php");?>
<?php $isbn = HtmlSpecialChars($_GET['isbn'])?>
<?php $query = $pdo->prepare('
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
<<<<<<< HEAD
//var_dump($donnees);
//var_dump($auteurs);
=======

>>>>>>> nouvelle_pt
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PassTheque</title>
        <link rel="stylesheet" type="text/css" href="css/modification.css"/>
    </head>
    <body>
        <?php include("nav.php"); ?>
            
        <div id="bloc_Livre">
            <div id="image_Livre">
            <?php

<<<<<<< HEAD
                $image = "images/".$donnees['isbn'].".jpg";  
=======
                $image = "images/" . $donnees['isbn'] . ".jpg";  
>>>>>>> nouvelle_pt

                $imageDefaut = "images/image_defaut.jpg";

            if(file_exists($image)){
                echo '<img src="'.$image.'" alt="try again"/>';
            }else{
                echo '<img src="'.$imageDefaut.'" alt="try again"/>';
            }


            ?>
            </div>
            <div id = "text_Livre">
            <p id="affich_Liv"> <?php 
                echo "Titre: ".
                HtmlSpecialChars($donnees['titre']); ?><br/>

                <?php
                foreach($auteurs as $auteur){
                    if($auteur['role']==1){
                        echo "Ecrivain: ".HtmlSpecialChars($auteur['prenom'])." ".HtmlSpecialChars($auteur['nom'])."<br/>";
                    }
                    if($auteur['role']==2){
                    echo "Illustrateur: ".HtmlSpecialChars($auteur['prenom'])." ".HtmlSpecialChars($auteur['nom'])."<br/>"; 
                    }
                    if($auteur['role']==3){
                        echo "Traducteur: ".HtmlSpecialChars($auteur['prenom'])." ".HtmlSpecialChars($auteur['nom'])."<br/>"; 
                    }
                    if($auteur['role']==4){
                        echo "Préface: ".HtmlSpecialChars($auteur['prenom'])." ".HtmlSpecialChars($auteur['nom']); 
                    }
                }

                   
                ?>
                Publié en : <?php echo HtmlSpecialChars($donnees['annee']);?><br/>
                <?php echo "Genre: " . HtmlSpecialChars($donnees['genre'])?><br/>
                <?php echo "Editeur: ".HtmlSpecialChars($donnees['editeur'])?><br/>
<<<<<<< HEAD
                <?php echo "Langue: ".HtmlSpecialCHars($donnees['langue'])?><br/>
                <?php if($donnees['nbpages'] !=null){
                    echo "nbpages: ".HtmlSpecialCHars($donnees['nbpages']);
                }?><br/>

=======
                <?php if(isset($donnees['nbpages'])){
                    echo "Nombre de Pages:".HtmlSpecialChars($donnees['nbpages']);
                }?><br/>
                <?php echo "Identifiant:".HtmlSpecialChars($donnees['isbn'])?><br/>
                <?php echo "Disponible en ".HtmlSpecialChars($donnees['langue'])?>


                
>>>>>>> nouvelle_pt
            </p>
            
            <?php 


            $query->closeCursor(); // Termine le traitement de la requête
            $query2->closeCursor();
            ?>
            </div>  
        </div>
        <?php include("bas.php");?>
    </body>
</html>

