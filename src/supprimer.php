  <?php include('connexion_db.php')?>
  <?php 
            if(isset($_GET['id'])){
                $livreRequestSupp = $pdo->prepare('
                DELETE FROM Livre
                WHERE  isbn = ?   
                ');
                $auteurRequestSupp = $pdo->prepare('
                DELETE FROM Auteur
                WHERE idLivre = ?');
                $livreRequestSupp->execute(array($_GET['id'])) ;  
                $auteurRequestSupp->execute(array($_GET['id'])) ;
            }
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/modification.css" rel="stylesheet" type="text/css"/>
    <title>Document</title>
</head>
<body>
    <?php include "nav.php"?>
    <a href="admin.php"><h1> Livre supprimé ! cliquez pour revenir sur la page admin.</h1></a>
</body>
</html>