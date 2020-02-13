<?php include("connexion_db.php")?>

<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>PassThèque - Ajouter</title>
        <link href="css/modification.css" rel="stylesheet" type="text/css" media="all" />


    </head>

    <body>
        <?php include("nav.php"); ?>
        <form method="post" action="Ajouter.php">

            <p>
            Envie de nouveaux livres? ajoutez-les! nous les rendrons très vite disponibles.
            </p>
            <p>Le titre</p>
            <input type=text name="titre">
            <p>L'année de publication</p>
            <input type=text name="année">
            <p>L'identifiant du livre (isbn)</p>
            <input type=text name='isbn'>
            <p>Le nombre de pages</p>
            <input type=text name="nbPages">
            <input type="button" name="Valider" value="Valider">
            

        </form>


    </body>
    
    
</html>