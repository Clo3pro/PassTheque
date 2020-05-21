
<?php include("header.php");?>

<?php
// requête qui affiche la liste des livres d'un auteur séléctionné au préalable
if(isset($_GET['author_choice'])){
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
// requête qui affiche la liste de tous les livres
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



            
        <div id="author_list">
        <?php include "author_list.php";?>
        </div>
        <?php
        // affichage de l'image correspondant au livre
        foreach($book_list as $donnees){
        ?>
       
        <div id="bloc_Livre">
            <div id= "image_Livre">
        <?php

            $image = "images/".$donnees['isbn'].".jpg";  

            $imageDefaut = "images/image_defaut.jpg";
            
        if(file_exists($image)){
            echo '<a id=link_details href ="./details.php?isbn='.HtmlSpecialChars($donnees['isbn']).'"><img  class="image" src="'.$image.'" alt="texte alternatif" /></a>';
        }else{
            echo '<a id=link_details href="./details.php?isbn='.HtmlSpecialChars($donnees['isbn']).'"><img class="image" src="'.$imageDefaut.'" alt="texte alternatif" /></a>';
        }


        ?>
        </div>
        <div id = "text_Livre">
        <!-- affichage de la liste des livres -->
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
            <a id="link_details"  href= "modifier_livre.php?for=<?=HtmlSpecialChars($donnees['isbn'])?>"><input type="button"  name="modify" value="Modifier" ></input></a>
        </p>
            
        </div>
        </div>

        <?php 
        }

        $query->closeCursor(); // Termine le traitement de la requête

        ?>

        <?php include("bas.php");?>

