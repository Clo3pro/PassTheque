<?php include('header.php')?>
<?php 
   $genresearch ='
   SELECT  id, libelle
   FROM Genre
  ';
   $genresearch = $pdo->query($genresearch);
   $genreliste = $genresearch->fetchAll();

    ?>

    <form method="post" action="ajout_genre.php" name="addBook">
        <div id="formulaire">   
            <p>Les Genres</p>
            <input type=text name="genre" id="genre"></br>
                <select name="genreListe" id="genreListe">
                <option value=""></option>
                    <?php foreach($genreliste AS $genre) : ?>
                        <option value ="<?=$genre['id'] ?>"><?=$genre['libelle'] ?></option>
                    <?php endforeach; ?>
                </select>
            <input type="submit" name="Valider" value="Valider">
         </div>
     </form>

     <?php
     var_dump($_POST['genre']);
            // requête qui ajoute un auteur de préface dans la liste d'auteurs
                if (isset($_POST['genre'])){
                    $addgenre = $pdo->prepare('
                    INSERT INTO Genre (libelle)
                    VALUES (?)
                    ');
                    $addgenre->execute(array($_POST['genre']));
                    echo "<p>Le Genre a bien été ajouté!</p>";
                    header('Location: ajout_genre.php');
                }
                else{
                    $_POST['genre'] = NULL;
                   
                }
            
            ?>
<?php include('bas.php')?>