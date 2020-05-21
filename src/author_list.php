<?php include "connexion_db.php"?>
<?php 
// requête qui permet la sélection de livres par écrivain
$query3 = $pdo->query('
SELECT DISTINCT Personne.nom,Personne.prenom,Personne.id
FROM Personne
JOIN Auteur ON Auteur.idPersonne = Personne.id
WHERE Auteur.idRole = 1
ORDER BY Personne.nom
');
$author_list = $query3->fetchAll();

?>
<!-- affichage de la liste des auteurs par lequels on peut trier la liste des livres -->
<form action='exploration.php' method="GET">
        <fieldset id = "grille_auteur">
        <legend>Sélection par Auteur</legend>
           <?php foreach($author_list as $author){?>
                    <label for="<?= $author['id']?>"><?= $author['prenom'].' '.$author['nom']?><label>
                  <input type="checkbox" id='<?= $author['id']?>' name="author_choice" value="<?= $author['id']?>">
                  
           <?php }?>
           <input type="submit" value="valider"></input>
        </fieldset>
</form>