<?php include("header.php");?>
<?php
// requête qui permet d'afficher la liste des livres avec quelques détails dans un tableau admin
$query = $pdo->query('SELECT Personne.nom, Personne.prenom, Livre.titre,Livre.annee,Livre.isbn
    FROM Livre
    JOIN Auteur ON Livre.isbn = Auteur.idLivre
    JOIN Personne ON Auteur.idPersonne = Personne.id
    WHERE Auteur.idRole =1
    ORDER BY Livre.annee 
    ');
$book_list = $query->fetchAll();
?>


    
    <div>
    <a id="link_details"  href= "liste_reservations_admin.php"><input type="button"  name="reserve_admin" value="Toutes les Réservations" ></input></a>
    <a id="link_details"  href= "ajouter_livre.php"><input type="button"  name="add_livre" value="Ajouter un Livre" ></input></a>
   
    </div>
 
        <section class="admin">
            <h1 id='titre_admin'>Tableau d'actions</h1>
            
                <table class='tableau_admin'>
                    <tr class= "ligne_table">
                        <th class="case_table">Titre</th>
                        <th class="case_table">ISBN</th>
                        <th class="case_table">Auteur</th>
                        <th class="case_table">Options</th>
                    </tr>
                    <?php
                    // boucle qui permet l'affichage de la liste des livres récupérés
                    foreach($book_list as $donnees){
                    
                    
                    ?>
                   
                    <tr class= "ligne_table">
                        <td class="case_table"><?php echo $donnees['titre']?></td>
                        <td class="case_table2" value ="<?=$donnees['isbn']?>"><?php echo $donnees['isbn']?></td>
                        <td class="case_table"><?php echo $donnees['prenom']." ".$donnees['nom']?> </td>
                        <td class="case_table"><a id="link_details"  href= "modifier_livre.php?for=<?=HtmlSpecialChars($donnees['isbn'])?>"><input type="button"  id="modifier" name="modify" value="Modifier" ></input></a>
                        <a id="link_details"  href= "supprimer.php?id=<?=HtmlSpecialChars($donnees['isbn'])?>" onclick= "return areYouSure()" ><input type="button" id= "supprimer" name="delete" value="Supprimer" ></input></a>
                        </td>
                        
                    </tr>
                    
                      
                <?php 
              
                }

                $query->closeCursor(); // Termine le traitement de la requête

                ?>
                </table>
                <!-- vérifie si l'utilisateur veut vraiment supprimer le livre de la bdd -->
            <script src= "delete_check.js"></script>
           
            
        </section>
        <?php include "bas.php"?>
    </body>
</html>