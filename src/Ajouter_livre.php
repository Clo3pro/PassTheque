<?php include("connexion_db.php")?>

<?php


    $idlangueRequest = '
    SELECT *
    FROM LANGUE';
    $idlangueRequest = $pdo->query($idlangueRequest);
    $idlangueliste = $idlangueRequest->fetchAll();

    $auteursearch ='
    SELECT DISTINCT p.nom, p.prenom, p.id
    FROM personne p
    JOIN auteur a ON p.id = a.idPersonne
    JOIN role r ON a.idRole = r.id
    WHERE a.idRole = 1';
    $auteursearch = $pdo->query($auteursearch);
    $auteurliste = $auteursearch->fetchAll();

    $editeursearch ='
    SELECT e.id, e.libelle
    FROM editeur e ';
    $editeursearch = $pdo->query($editeursearch);
    $editeurliste = $editeursearch->fetchAll();

    $illustrateursearch ='
    SELECT DISTINCT p.nom, p.prenom, p.id
    FROM Personne p
    JOIN Auteur a ON p.id = a.idPersonne
    JOIN Role r ON a.idRole = r.id
    WHERE a.idRole = 2';
    $illustrateursearch = $pdo->query($illustrateursearch);
    $illustrateurliste = $illustrateursearch->fetchAll();

    $traducteursearch ='
    SELECT DISTINCT p.nom, p.prenom, p.id
    FROM Personne p
    JOIN Auteur a ON p.id = a.idPersonne
    JOIN Role r ON a.idRole = r.id
    WHERE a.idRole = 3';
    $traducteursearch = $pdo->query($traducteursearch);
    $traducteurliste = $traducteursearch->fetchAll();

    $prefacesearch ='
    SELECT DISTINCT p.nom, p.prenom, p.id
    FROM Personne p
    JOIN Auteur a ON p.id = a.idPersonne
    JOIN Role r ON a.idRole = r.id
    WHERE a.idRole = 4';
    $prefacesearch = $pdo->query($prefacesearch);
    $prefaceliste = $prefacesearch->fetchAll();

    $genresearch='
    SELECT DISTINCT g.id, g.libelle
    FROM genre g';
    $genresearch = $pdo->query($genresearch);
    $genreliste = $genresearch->fetchAll();

?>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>PassThèque - Ajouter</title>
        <link href="css/modification.css" rel="stylesheet" type="text/css"/>


    </head>

    <body>
        <?php include("nav.php"); ?>
        <form method="post" action="ajouter_livre.php" name="addBook" onsubmit=" return checkForm()">
        <div id="formulaire">
            <p>Envie de nouveaux livres? ajoutez-les! nous les rendrons très vite disponibles.</p>
            <p>Le titre</p>
                <input type=text name="titre" id="titre" textarea cols="100" rows="90">
                <p id='verif_titre'></p>

            <p>L'identifiant du livre (isbn)</p>
                <input type=text name='isbn' id="isbn">
                <p id='verif_isbn'></p>

            <p>Le nom de l'écrivain</p>
                <select name="ecrivain" id="ecrivain">
                <option value=""></option>
                    <?php foreach($auteurliste AS $auteur) : ?>
                        <option value ="<?=$auteur['id'] ?>"><?=$auteur['nom'] ?> <?=$auteur['prenom'] ?></option>
                    <?php endforeach; ?>
                </select>
                
            <p>Le nom de l'éditeur</p>
                <select name="editeur" id="editeur">
                    <?php foreach($editeurliste as $editeur) : ?>
                        <option value="<?=$editeur['id'] ?>"><?=$editeur['libelle'] ?></option>
                    <?php endforeach; ?>
                </select>

            <p>Le nom de l'illustrateur</p>
                <select name="illustrateur" id="illustrateur">
                    <option value=""></option>
                    <?php foreach($illustrateurliste AS $illustrateur) : ?>
                        <option value ="<?=$illustrateur['id'] ?>"><?=$illustrateur['nom'] ?> <?=$illustrateur['prenom'] ?></option>
                    <?php endforeach; ?>
                </select>

            <p>Le nom de la preface</p>
                <select name="preface" id="preface">
                    <option value=""></option>
                    <?php foreach($prefaceliste AS $preface) : ?>
                        <option value ="<?=$preface['id'] ?>"><?=$preface['nom'] ?> <?=$preface['prenom'] ?></option>
                    <?php endforeach; ?>
                </select>

            <p>Le genre du livre</p>
                <select name="genre" id="genre">
                    <?php foreach($genreliste AS $genre) : ?>
                        <option value ="<?=$genre['id'] ?>"><?=$genre['libelle']?></option>
                    <?php endforeach; ?>
                </select>
            <p>L'année de publication</p>
                <input type=text name="annee" id="annee">
                <p id='verif_annee'></p>

            <p>La langue du livre</p>
                <select name="langue" id="langue">
                    <?php foreach($idlangueliste AS $langue) : ?>
                    <option value= "<?= $langue['id'] ?>"><?=$langue['libelle'] ?></option>
                    <?php endforeach;?>
                </select>

            <p>Le nom du traducteur</p>
                <select name="traducteur" id="traducteur" value =''>
                    <option value=""></option>
                    <?php foreach($traducteurliste AS $traducteur) : ?>
                        <option value ="<?=$traducteur['id'] ?>"><?=$traducteur['nom'] ?> <?=$traducteur['prenom'] ?></option>
                    <?php endforeach; ?>
                </select>

            <p>Le nombre de pages</p>
                <input type=text name="nbPages" id="nbPages"></br>
                <p id='verif_nbPages'></p></br>
            <input type="submit" name="Valider" value="Valider">
            
            
        </div>
        </form>
        <script src='form_check.js'></script>
            <?php
            if(isset($_POST['isbn'],$_POST['titre'],$_POST['editeur'],$_POST['annee'],$_POST['genre'],$_POST['langue'],$_POST['nbPages'])){
                $livreRequest = $pdo->prepare('
                INSERT INTO Livre
                VALUES( "'.$_POST['isbn'].'",
                        "'.$_POST['titre'].'",
                        "'.$_POST['editeur'].'",
                        "'.$_POST['annee'].'",
                        "'.$_POST['genre'].'",
                        "'.$_POST['langue'].'",
                        "'.$_POST['nbPages'].'")
                ');
                $livreRequest->execute(array($_POST['isbn'],$_POST['titre'],$_POST['editeur'],$_POST['annee'],$_POST['genre'],$_POST['langue'],$_POST['nbPages'])) ;  
            ?>
            
            <?php
                $auteurRequest = $pdo->prepare('
                INSERT INTO Auteur
                VALUES( "'.$_POST['ecrivain'].'",
                        "'.$_POST['isbn'].'",
                        "1")
                ');
                $auteurRequest->execute(array($_POST['ecrivain'],$_POST['isbn'],1));
            ?>

            <?php
                if ($illustrateur != NULL){
                    $illustrateurRequest = $pdo->prepare('
                    INSERT INTO Auteur
                    VALUES("'.$_POST['illustrateur'].'",
                           "'.$_POST['isbn'].'",
                           "2")
                    ');
                    $illustrateurRequest->execute(array($_POST['illustrateur'],$_POST['isbn'],2));
                }else {
                    $illustrateur = NULL;
                }
            ?>

            <?php
                if ($traducteur != NULL){
                    $traducteurRequest = $pdo->prepare('
                    INSERT INTO Auteur
                    VALUES ("'.$_POST['traducteur'].'",
                            "'.$_POST['isbn'].'",
                            "3")
                    ');
                    $traducteurRequest->execute(array($_POST['traducteur'],$_POST['isbn'],3));
                }else{
                    $traducteur = NULL;
                }
            ?>

            <?php
                if ($preface != NULL){
                    $prefaceRequest = $pdo->prepare('
                    INSERT INTO Auteur
                    VALUES ("'.$_POST['preface'].'",
                            "'.$_POST['isbn'].'",
                            "4")
                    ');
                    $prefaceRequest->execute(array($_POST['preface'],$_POST['isbn'],4));
                }
                else{
                    $preface = NULL;
                }
            }
            ?>
    </body>
</html>