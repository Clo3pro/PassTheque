<?php include('header.php')?>
<?php 
    $editeursearch ='
    SELECT e.id, e.libelle
    FROM Editeur e ';
    $editeursearch = $pdo->query($editeursearch);
    $editeurliste = $editeursearch->fetchAll();
    ?>
    <a href="ajouter_livre.php"><input type="button" name="retour" value="Retour"></a>
    <form method="post" action="ajout_editeur.php" name="addBook">
        <div id="formulaire">   
            <p>Le nom de l'éditeur</p>
            <input type=text name="editeur" id="editeur"></br>
                <p id='verif_editeur'></p></br>
                <select name="editeurListe" id="editeurListe">
                    <?php foreach($editeurliste as $editeur) : ?>
                        <option value="<?=$editeur['id'] ?>"><?=$editeur['libelle'] ?></option>
                    <?php endforeach; ?>
                </select><br/>
            <input type="submit" name="Valider" value="Valider">
         </div>
     </form>

     <?php
     var_dump($_POST['editeur']);
            // requête qui ajoute un auteur de préface dans la liste d'auteurs
                if (isset($_POST['editeur'])){
                    $addEditeur = $pdo->prepare('
                    INSERT INTO Editeur (libelle)
                    VALUES (?)
                    ');
                    $addEditeur->execute(array($_POST['editeur']));
                    header('Location: ajout_editeur.php');
                    echo "<p>L'Editeur a bien été ajouté!</p>";
                }
                else{
                    $_POST['editeur'] = NULL;
                }
            
            ?>
<?php include('bas.php')?>