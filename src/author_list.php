<?php include "connexion_db.php"?>
<?php 
$query3 = $pdo->query('
SELECT DISTINCT Personne.nom,Personne.prenom,Personne.id
FROM Personne
JOIN Auteur ON Auteur.idPersonne = Personne.id
WHERE Auteur.idRole = 1
ORDER BY Personne.nom
');
$author_list = $query3->fetchAll();

?>

<form action='exploration.php' method="GET">
        <fieldset>
        <legend>Sélection par Auteur</legend>
           <?php foreach($author_list as $author){?>
                    <label for="author_choice"><?= $author['prenom'].' '.$author['nom']?><label>
                  <input type="checkbox" name="author_choice" value="<?= $author['id']?>">
                  
           <?php }?>
           <input type="submit" value="valider"></input>
        </fieldset>
</form>