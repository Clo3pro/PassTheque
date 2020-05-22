<?php include('header.php')?>
<?php 
   $languesearch ='
   SELECT  id, libelle
   FROM Langue
  ';
   $languesearch = $pdo->query($languesearch);
   $langueliste = $languesearch->fetchAll();

    ?>
<a href="ajouter_livre.php"><input type="button" name="retour" value="Retour"></a>
    <form method="post" action="ajout_langue.php" name="addBook">
        <div id="formulaire">   
            <p>Les Langues</p>
            <input type=text name="langue" id="langue"></br>
                <select name="langueListe" id="langueListe">
                <option value=""></option>
                    <?php foreach($langueliste AS $langue) : ?>
                        <option value ="<?=$langue['id'] ?>"><?=$langue['libelle'] ?></option>
                    <?php endforeach; ?>
                </select>
            <input type="submit" name="Valider" value="Valider">
         </div>
     </form>

     <?php
     var_dump($_POST['auteur']);
            // requête qui ajoute un auteur de préface dans la liste d'auteurs
                if (isset($_POST['langue'])){
                    $addlangue = $pdo->prepare('
                    INSERT INTO Langue (libelle)
                    VALUES (?)
                    ');
                    $addlangue->execute(array($_POST['langue']));
                    header('Location: ajout_langue.php');
                    echo "<p>La langue a bien été ajouté!</p>";
                }
                else{
                    $_POST['langue'] = NULL;
                   
                }
            
            ?>
<?php include('bas.php')?>