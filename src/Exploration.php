
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
            echo  " Titre: ".
            HtmlSpecialChars($donnees['titre'])." ";($donnees['titre']); ?><br/>
            <?php 
                echo " Ecrivain: ".HtmlSpecialChars($donnees['prenom'])." ".HtmlSpecialChars($donnees['nom']); 
            ?>
            <br/>
            en : <?php echo HtmlSpecialChars($donnees['annee']);?><br/>
            <?php echo "Genre: " .HtmlSpecialChars($donnees['genre'])?><br/>
            <?php echo "Editeur: ".HtmlSpecialChars($donnees['editeur']);
            if(isset($_SESSION['email'])){
             echo "<a href='?id=".$donnees['isbn']."'><input type='button' name='resa' value='Réserver'></a>";
            }
            if(isset($_SESSION['email']) && $_SESSION['niveauAcces']==1){
                echo '<a id="link_details"  href= "modifier_livre.php?for='.$donnees["isbn"].'"><input type="button"  name="modify" value="Modifier" ></a>';
            }
            ?>
        </p>
            
        </div>
        </div>

        <?php 
        }

        $query->closeCursor(); // Termine le traitement de la requête

         if (isset($_GET['id'])){
            // echo $_GET['id'];
        
            // Ajouter le produit au panier
            if(!isset($_SESSION['panier'])){
                $_SESSION['panier'] = array();
            }
                // ajouter produit au panier
                
            if(isset($_SESSION['panier'][$_GET['id']])){
                    $_SESSION['panier'][$_GET['id']]++;
            }else{
                    $_SESSION['panier'][$_GET['id']]=1;
        
            }
            var_dump($_SESSION['panier']);
        }else{
            echo "Pas de id <br>";
            // ne pas ajouter le produit
        }
        ?>
        

        <?php include("bas.php");?>

