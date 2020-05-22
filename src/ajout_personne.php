<?php include('header.php')?>
<?php 
   $auteursearch ='
   SELECT DISTINCT p.nom, p.prenom, p.id
   FROM personne p
  ';
   $auteursearch = $pdo->query($auteursearch);
   $auteurliste = $auteursearch->fetchAll();

    ?>
    <a href="ajouter_livre.php"><input type="button" name="retour" value="Retour"></a>
    <form method="post" action="ajout_personne.php" name="addBook">
        <div id="formulaire">   
            <p>Le nom de la personne</p>
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
                if (isset($_POST['nomPersonne']) && isset($_POST['prenomPersonne'])){
                    $addEditeur = $pdo->prepare('
                    INSERT INTO Personne (nom,prenom)
                    VALUES (?,?)
                    ');
                    $addEditeur->execute(array($_POST['nomPersonne'],$_POST['prenomPersonne']));
                    header('Location: ajout_personne.php');
                    echo "<p>La personne a bien été ajouté!</p>";
                }
                else{
                    $_POST['nomPersonne'] = NULL;
                    $_POST['prenomPersonne'] = NULL;
                }
            
            ?>
<?php include('bas.php')?>