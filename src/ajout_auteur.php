<?php include('header.php')?>
<?php 
   $auteursearch ='
   SELECT DISTINCT p.nom, p.prenom, p.id
   FROM personne p
  ';
   $auteursearch = $pdo->query($auteursearch);
   $auteurliste = $auteursearch->fetchAll();

    ?>

    <form method="post" action="ajout_editeur.php" name="addBook">
        <div id="formulaire">   
            <p>Le nom de l'écrivain</p>
            <input type=text name="nomPersonne" id="nomPersonne"></br>
            <input type=text name="prenomPersonne" id="prenomPersonne"></br>
                <select name="ecrivainListe" id="ecrivainListe">
                <option value=""></option>
                    <?php foreach($auteurliste AS $auteur) : ?>
                        <option value ="<?=$auteur['id'] ?>"><?=$auteur['nom'] ?> <?=$auteur['prenom'] ?></option>
                    <?php endforeach; ?>
                </select>
            <input type="submit" name="Valider" value="Valider">
         </div>
     </form>

     <?php
     var_dump($_POST['auteur']);
            // requête qui ajoute un auteur de préface dans la liste d'auteurs
                if (isset($_POST['auteur'])){
                    $addEditeur = $pdo->prepare('
                    INSERT INTO Auteur (libelle)
                    VALUES (?)
                    ');
                    $addEditeur->execute(array($_POST['editeur']));
                    echo "<p>L'Editeur a bien été ajouté!</p>";
                    header('Location: ajout_genre.php');
                }
                else{
                    $_POST['editeur'] = NULL;
                }
            
            ?>
<?php include('bas.php')?>