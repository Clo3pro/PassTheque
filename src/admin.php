<?php include("connexion_db.php");?>
<?php
$query = $pdo->query('SELECT Personne.nom, Personne.prenom, Livre.titre,Livre.annee,Livre.isbn
    FROM Livre
    JOIN Auteur ON Livre.isbn = Auteur.idLivre
    JOIN Personne ON Auteur.idPersonne = Personne.id
    WHERE Auteur.idRole =1
    ORDER BY Livre.annee 
    ');
$book_list = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/modification.css" rel="stylesheet" type="text/css"/>
        <title>PassThèque - Admin</title>
    </head>
    <body>
        <?php include "nav.php"?>
        <section id="admin">
            <h1 id='titre_admin'>Tableau d'actions</h1>
            <form method="GET">
                <table id='tableau_admin'>
                    <tr id= "ligne_table">
                        <th id="case_table">Titre</th>
                        <th id="case_table">ISBN</th>
                        <th id="case_table">Auteur</th>
                        <th id="case_table">Options</th>
                    </tr>
                    <?php

                    foreach($book_list as $donnees){
                    ?>
                    <tr id= "ligne_table">
                        <td id="case_table"><?php echo $donnees['titre']?></td>
                        <td id="case_table2" value ="<?=$donnees['isbn']?>"><?php echo $donnees['isbn']?></td>
                        <td id="case_table"><?php echo $donnees['prenom']." ".$donnees['nom']?> </td>
                        <td id="case_table"><input type="button"  id="modifier" name="modify" value="Modifier" method="GET" action="modifier_livre.php?id=<?=$donnees['isbn']?>"></input>
                        <input type="button" id= "supprimer" name="delete" value="Supprimer"  onclick= "areYouSure()"></input>
                        <input type="hidden" name="id" value="<?php echo $donnees["isbn"]?>"></input>
                    <script> var variableRecuperee = <?php echo json_encode($donnees['isbn']); ?>;</script>
                        </td>
                    </tr>
                    
                
                <?php 
                }

                $query->closeCursor(); // Termine le traitement de la requête

                ?>
                </table>
            <script src= "delete_check.js"></script>
            </form>
            
        </section>
        <?php include "bas.php"?>
    </body>
</html>