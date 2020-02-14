
<?php include("connexion_db.php");?>

<?php if(isset($_GET['author_choice'])){
    $query = $pdo->prepare('SELECT Personne.nom, Personne.prenom, Livre.titre,Livre.annee,Livre.isbn,Editeur.libelle AS editeur,Genre.libelle AS genre
    FROM Livre
    JOIN Auteur ON Livre.isbn = Auteur.idLivre
    JOIN Personne ON Auteur.idPersonne = Personne.id
    JOIN Genre ON Livre.genre = Genre.id
    JOIN Editeur ON Livre.editeur = Editeur.id
    WHERE Personne.id = ?
    ORDER BY Livre.annee
    ');
    $query->execute(array($_GET['author_choice']));
    $book_list=$query->fetchAll();

}else{
    $query = $pdo->query('SELECT Personne.nom, Personne.prenom, Livre.titre,Livre.annee,Livre.isbn,Editeur.libelle AS editeur,Genre.libelle AS genre
    FROM Livre
    JOIN Auteur ON Livre.isbn = Auteur.idLivre
    JOIN Personne ON Auteur.idPersonne = Personne.id
    JOIN Genre ON Livre.genre = Genre.id
    JOIN Editeur ON Livre.editeur = Editeur.id
    WHERE Auteur.idRole =1
    ORDER BY Livre.annee 
    ');
$book_list = $query->fetchAll();
}

$query2 = $pdo->query('
SELECT DISTINCT Personne.nom,Personne.prenom,Auteur.idRole AS id
FROM Personne
JOIN Auteur ON Auteur.idPersonne = Personne.id
WHERE Auteur.idRole = 1
ORDER BY Personne.nom;');



$author_list=$query2->fetchAll();
?>


<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>PassThèque - Explorer</title>
        <link href="css/modification.css" rel="stylesheet" type="text/css" media="all" />


    </head>
    
    <body>
        <?php include("nav.php"); ?>
            
        <div id="author_list">
        <?php include "author_list.php";?>
        </div>
        <?php

        foreach($book_list as $donnees){
        ?>
       
        <div id="bloc_Livre">
            <div id= "image_Livre">
        <?php

            $image = "images/".$donnees['isbn'].".jpg";  

            $imageDefaut = "images/image_defaut.jpg";
            
        if(file_exists($image)){
            echo '<a id=link_details href ="./details.php?isbn='.HtmlSpecialChars($donnees['isbn']).'"><img src="'.$image.'" alt="texte alternatif" /></a>';
        }else{
            echo '<a id=link_details href="./details.php?isbn='.HtmlSpecialChars($donnees['isbn']).'"><img src="'.$imageDefaut.'" alt="texte alternatif" /></a>';
        }


        ?>
        </div>
        <div id = "text_Livre">
            <p id="affich_Liv"> <?php 
            echo "Titre: ".
            HtmlSpecialChars($donnees['titre']); ?><br />

            <?php 
                echo "Ecrivain: ".HtmlSpecialChars($donnees['prenom'])." ".HtmlSpecialChars($donnees['nom']); 
            ?>
            <br/>
            en : <?php echo HtmlSpecialChars($donnees['annee']);?><br/>
            <?php echo "Genre: " .HtmlSpecialChars($donnees['genre'])?><br/>
            <?php echo "Editeur: ".HtmlSpecialChars($donnees['editeur'])?>
        
        </p>
            
        </div>
        </div>

        <?php 
        }

        $query->closeCursor(); // Termine le traitement de la requête

        ?>

        <?php include("bas.php");?>

</body>
    
    
</html>