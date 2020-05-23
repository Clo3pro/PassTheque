<?php include("header.php")?>
<?php 
// requêtes qui récupère toutes les informations possibles sur les livres et auteurs
if(isset($_GET['for'])){
$former = $_GET['for'];

$thisidlangueRequest = $pdo->prepare('
    SELECT *
    FROM Langue
    JOIN Livre ON Langue.id = Livre.langue
    WHERE Livre.isbn = ?');
    $thisidlangueRequest ->execute(array($former));
    $thisidlangue = $thisidlangueRequest->fetch();

    $thisauteursearch = $pdo->prepare('
    SELECT DISTINCT p.nom, p.prenom, r.id
    FROM Personne p
    JOIN Auteur a ON p.id = a.idPersonne
    JOIN Role r ON a.idRole = r.id
    WHERE a.idRole = 1 AND a.idLivre =?');
    $thisauteursearch->execute(array($_GET['for']));
    $thisauteur = $thisauteursearch->fetch();
    

    $thisediteursearch = $pdo -> prepare('
    SELECT e.id, e.libelle
    FROM Editeur e 
    JOIN Livre l 
        ON e.id = l.editeur
    WHERE l.isbn = ? ');
    $thisediteursearch->execute(array($_GET['for']));
    $thisediteur = $thisediteursearch->fetch();

    $thisillustrateursearch =$pdo->prepare('
    SELECT DISTINCT p.nom, p.prenom, p.id
    FROM Personne p
    JOIN Auteur a ON p.id = a.idPersonne
    JOIN Role r ON a.idRole = r.id
    WHERE a.idRole = 2 AND a.idLivre =?');
    $thisillustrateursearch->execute(array($_GET['for']));
    $thisillustrateur = $thisillustrateursearch->fetch();

    $thistraducteursearch = $pdo->prepare('
    SELECT DISTINCT p.nom, p.prenom, p.id
    FROM Personne p
    JOIN Auteur a ON p.id = a.idPersonne
    JOIN Role r ON a.idRole = r.id
    WHERE a.idRole = 3 AND a.idLivre = ?');
    $thistraducteursearch->execute(array($_GET['for']));
    $thistraducteur = $thistraducteursearch->fetch();

    $thisprefacesearch =$pdo ->prepare('
    SELECT DISTINCT p.nom, p.prenom, p.id
    FROM Personne p
    JOIN Auteur a ON p.id = a.idPersonne
    JOIN Role r ON a.idRole = r.id
    WHERE a.idRole = 4 AND a.idLivre=?');
    $thisprefacesearch->execute(array($_GET['for']));
    $thispreface = $thisprefacesearch->fetch();

    $thisgenresearch=$pdo ->prepare('
    SELECT g.id, g.libelle
    FROM Genre g
    JOIN Livre ON Livre.genre = g.id
    WHERE Livre.isbn =?');
    $thisgenresearch->execute(array($_GET['for']));
    $thisgenre = $thisgenresearch->fetch();

    $numberSearch=$pdo->prepare('
    SELECT annee,nbpages,titre,isbn
    FROM Livre
    WHERE isbn=?
    ');
    $numberSearch->execute(array($_GET['for']));
    $number = $numberSearch -> fetch();


    $idlangueRequest = '
    SELECT *
    FROM Langue';
    $idlangueRequest = $pdo->query($idlangueRequest);
    $idlangueliste = $idlangueRequest->fetchAll();

    $auteursearch ='
    SELECT DISTINCT p.nom, p.prenom, p.id
    FROM Personne p
    JOIN Auteur a ON p.id = a.idPersonne
    JOIN Role r ON a.idRole = r.id
    WHERE a.idRole = 1 AND a.idLivre !=?';
    $auteursearch = $pdo->prepare($auteursearch);
    $auteursearch ->execute(array($_GET['for']));
    $auteurliste = $auteursearch->fetchAll();

    $editeursearch ='
    SELECT e.id, e.libelle
    FROM Editeur e ';
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
    FROM Genre g';
    $genresearch = $pdo->query($genresearch);
    $genreliste = $genresearch->fetchAll();

   
}


?>



        <form method="post" action="modifier_livre.php?for=<?=$_GET["for"]?>" name="addBook" onsubmit=" return checkForm()">
        <div id="formulaire">
            <p>uh-oh. Vous avez vu une erreur? modifiez les informations du livre!</p>
            <p>Le titre</p>
                <input type=text name="titre" id="titre" value="<?=$number['titre']?>"textarea cols="150" rows="200">
                <p id='verif_titre'></p>

            <p>L'identifiant du livre (isbn)</p>
                <input type=text name='isbn' value="<?=$number['isbn']?>" id="isbn">
                <p id='verif_isbn'></p>

            <p>Le nom de l'auteur</p>
                <select name="auteur" id="auteur">
                    <?php foreach ($auteurliste as $auteur){
                        if($auteur['id'] == $thisauteur['id']){
                            echo ('<option value="'.$thisauteur['id'].'" selected="selected">'.$thisauteur['nom'] .' ' .$thisauteur['prenom'].'</option>');
                        }
                        else{
                            echo ('<option value="' .$auteur['id'].'">'.$auteur['nom'] .' '  .$auteur['prenom'] .'</option>');
                        }

                    }
                    ?>
                        
                    </select>
                
            <p>Le nom de l'éditeur</p>
                <select name="editeur" id="editeur">
                        <?php foreach($editeurliste as $editeur){
                            if($editeur['id'] == $thisediteur['id']){
                                echo('<option value="'.$thisediteur['id'].'" selected="selected">'.$thisediteur['libelle'].'</option>');
                            }
                            else{
                                echo('<option value="'.$editeur['id'].'">'.$editeur['libelle'].'</option>');
                            }
                        }
                        ?>
                </select>


            <p>Le nom de l'illustrateur</p>
                <select name="illustrateur" id="illustrateur">
                <?php foreach ($illustrateurliste as $illustrateur){
                        if($illustrateur['id'] == $thisillustrateur['id']){
                            echo ('<option value="' .$thisillustrateur['id'].'" selected="selected">' .$thisillustrateur['nom'] .' ' .$thisillustrateur['prenom'] .'</option>');
                        }
                        elseif(!$thisillustrateur){
                            echo ('<option value="" selected="selected"></option>');
                            foreach($illustrateurliste as $illustrateur){
                                echo ('<option value="' .$illustrateur['id'].'">'.$illustrateur['nom'] .' '  .$illustrateur['prenom'] .'</option>');
                            }
                        }

                        else{
                            echo ('<option value="' .$illustrateur['id'].'">'.$illustrateur['nom'] .' '  .$illustrateur['prenom'] .'</option>');
                        }

                    }
                    ?>
                </select>

            <p>Le nom de la preface</p>
                <select name="preface" id="preface">
                <?php foreach ($prefaceliste as $preface){
                        if($preface['id'] == $thispreface['id']){
                            echo ('<option value="'.$thispreface['id'].'" selected="selected">'.$thispreface['nom'] .' ' .$thispreface['prenom'].'</option>');
                        }
                        elseif(!$thisillustrateur){
                            echo ('<option value="" selected="selected"></option>');
                            foreach($prefaceliste as $preface){
                                echo ('<option value="' .$preface['id'].'">'.$preface['nom'] .' '  .$preface['prenom'] .'</option>');
                            }
                        }
                        else{
                            echo ('<option value="' .$preface['id'].'">'.$preface['nom'] .' ' .$preface['prenom'] .'</option>');
                        }

                    }
                    ?>
                </select>

            <p>Le genre du livre</p>
                <select name="genre" id="genre">
                <?php foreach ($genreliste as $genre){
                        if($genre['id'] == $thisgenre['id']){
                            echo ('<option value="'.$thisgenre['id'].'" selected="selected">'.$thisgenre['libelle'].'</option>');
                        }
                        else{
                            echo ('<option value="' .$genre['id'].'">'.$genre['libelle'].'</option>');
                        }

                    }
                    ?>
                </select>
            
            <p>L'année de publication</p>
                <input type=text name="annee" id="annee" value="<?=$number['annee']?>">
                <p id='verif_annee'></p>

            <p>La langue du livre</p>
                <select name="langue" id="langue">
                <?php foreach ($idlangueliste as $langue){
                        if($langue['id'] == $thisidlangue['id']){
                            echo ('<option value="'.$thisidlangue['id'].'" selected="selected">'.$thisidlangue['libelle'].'</option>');
                        }
                        else{
                            echo ('<option value="' .$langue['id'].'">'.$langue['libelle'].'</option>');
                        }

                    }
                    ?>
                </select>

            <p>Le nom du traducteur</p>
                <select name="traducteur" id="traducteur">
            <?php foreach ($traducteurliste as $traducteur){
                        if($traducteur['id'] == $thistraducteur['id']){
                            echo ('<option value="'.$thistraducteur['id'].'" selected="selected">'.$thistraducteur['nom'] .' ' .$thistraducteur['prenom'].'</option>');
                        }
                        elseif(!$thistraducteur){
                            echo ('<option value="" selected="selected"></option>');
                            foreach($traducteurliste as $traducteur){
                                echo ('<option value="' .$traducteur['id'].'">'.$traducteur['nom'] .' '  .$traducteur['prenom'] .'</option>');
                            }
                        break;
                        }
                        else{
                            echo ('<option value="' .$traducteur['id'].'">'.$traducteur['nom'] .' ' .$traducteur['prenom'] .'</option>');
                        }

                    }
                    ?>
                </select>

            <p>Le nombre de pages</p>
                <input type=text name="nbPages" id="nbPages" value="<?=$number['nbpages']?>"></br>
                <p id='verif_nbPages'></p></br>
            <input type="submit" name="Valider" value="Valider">
            
            
        </div>
        </form>
        <script src='form_check.js'></script>

        <?php
        // requêtes de modification de la bdd 
            if(isset($_POST['isbn'],$_POST['titre'],$_POST['editeur'],$_POST['annee'],$_POST['genre'],$_POST['langue'],$_POST['nbPages'])){
                $livreRequest = $pdo->prepare('
                UPDATE Livre
                SET  isbn = "'.$_POST['isbn'].'",
                       titre = "'.$_POST['titre'].'",
                       editeur = "'.$_POST['editeur'].'",
                        annee ="'.$_POST['annee'].'",
                        genre ="'.$_POST['genre'].'",
                        langue="'.$_POST['langue'].'",
                       nbpages= "'.$_POST['nbPages'].'"
                       WHERE isbn = "'.$_POST['isbn'].'"
                ');
                $livreRequest->execute(array($_POST['isbn'],$_POST['titre'],$_POST['editeur'],$_POST['annee'],$_POST['genre'],$_POST['langue'],$_POST['nbPages'])) ;  
            ?>
            
            <?php
                $auteurRequest = $pdo->prepare('
                UPDATE Auteur
                SET idPersonne = "'.$_POST['auteur'].'",
                    idLivre = "'.$_POST['isbn'].'",
                    idRole = "1"
                    WHERE idLivre= "'.$_POST['isbn'].'"
                ');
                $auteurRequest->execute(array($_POST['auteur'],$_POST['isbn'],1));
            ?>

            <?php
                if ($illustrateur != NULL){
                    $illustrateurRequest = $pdo->prepare('
                    UPDATE Auteur
                    SET idPersonne = "'.$_POST['illustrateur'].'",
                          idLivre = "'.$_POST['isbn'].'",
                           idRole = "2"
                           WHERE idLivre = "'.$_POST['isbn'].'"
                    ');
                    $illustrateurRequest->execute(array($_POST['illustrateur'],$_POST['isbn'],2));
                }else {
                    $illustrateur = NULL;
                }
            ?>

            <?php
                if ($traducteur != NULL){
                    $traducteurRequest = $pdo->prepare('
                    UPDATE Auteur
                    SET idPersonne = "'.$_POST['traducteur'].'",
                            idLivre ="'.$_POST['isbn'].'",
                            idRole = "3"
                            WHERE idLivre = "'.$_POST['isbn'].'"
                    ');
                    $traducteurRequest->execute(array($_POST['traducteur'],$_POST['isbn'],3));
                }else{
                    $traducteur = NULL;
                }
            ?>

            <?php
                if ($preface != NULL){
                    $prefaceRequest = $pdo->prepare('
                    UPDATE Auteur
                    SET idPersonne = "'.$_POST['preface'].'",
                        idLivre = "'.$_POST['isbn'].'",
                           idRole = "4"
                           WHERE idLivre = "'.$_POST['isbn'].'"
                    ');
                    $prefaceRequest->execute(array($_POST['preface'],$_POST['isbn'],4));
                }
                else{
                    $preface = NULL;
                }
            }
            ?>
            <?php include "bas.php"?>
 