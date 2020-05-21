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



        <section id="admin">
            <h1 id='titre_admin'>Tableau d'actions</h1>
            
                <table id='tableau_admin'>
                    <tr id= "ligne_table">
                        <th id="case_table">Titre</th>
                        <th id="case_table">ISBN</th>
                        <th id="case_table">Auteur</th>
                        <th id="case_table">Options</th>
                    </tr>
                    <?php
                    // boucle qui permet l'affichage de la liste des livres récupérés
                    foreach($book_list as $donnees){
                    
                    
                    ?>
                   
                    <tr id= "ligne_table">
                        <td id="case_table"><?php echo $donnees['titre']?></td>
                        <td id="case_table2" value ="<?=$donnees['isbn']?>"><?php echo $donnees['isbn']?></td>
                        <td id="case_table"><?php echo $donnees['prenom']." ".$donnees['nom']?> </td>
                        <td id="case_table"><a id="link_details"  href= "modifier_livre.php?for=<?=HtmlSpecialChars($donnees['isbn'])?>"><input type="button"  id="modifier" name="modify" value="Modifier" ></input></a>
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