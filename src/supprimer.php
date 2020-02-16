  <?php 
            /* if(isset($_GET['isbn'])){
                $livreRequestSupp = $pdo->prepare('
                DELETE FROM Livre
                WHERE( "'.$_GET['isbn'].'"     
                )');
                $auteurRequestSupp = $pdo->prepare('
                DELETE FROM Auteur
                WHERE( "'.$_GET['isbn'].'"     
                )');
                $livreRequestSupp->execute(array($_GET['isnb'])) ;  
                $auteurRequestSupp->execute(array($_GET['isnb'])) ;
            }*/
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
    <?php echo $_GET['id']?>
    <a href="admin.php"><h1> Livre supprimé ! cliquez pour revenir sur la page admin.</h1></a>
</body>
</html>